<?php

namespace App\Http\Controllers\Wechat;

use App\WechatEvent;
use Illuminate\Http\Request;
use App\WechatMenuItem;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\WechatMenu;
use Exception;
use Log;

class MenuController extends Controller
{
    /**
     * 菜单维护界面。
     */
    public function manage()
    {
        return view('wechat.menu.index', ['button' => WechatMenuItem::orderBy('sort_num')->get()]);
    }

    /**
     * 提交编辑页面。
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $wechatMenuItem = WechatMenuItem::whereId($id)->first();

        if(is_null($wechatMenuItem))
            return response()->redirectToRoute('wechat.menu.manage');

        $wechatMenuItem->name = trim($request->name);
        $wechatMenuItem->sort_num = intval(trim($request->sort));

        if($wechatMenuItem->is_button && trim($request->button_id) == '1')
        {
            $wechatMenuItem->type = null;
            $wechatMenuItem->url = null;
            $wechatMenuItem->key = null;
            $wechatMenuItem->button_id = 1;
        }
        else
        {
            $type = trim($request->type);
            $wechatMenuItem->type = $type;

            if($type == 'click') {
                $wechatMenuItem->url = null;
                $wechatMenuItem->key = trim($request->key);
            }
            elseif($type == 'view') {
                $wechatMenuItem->url = trim($request->url);
                $wechatMenuItem->key = null;
            }
            else
            {
                $wechatMenuItem->type = null;
                $wechatMenuItem->url = null;
                $wechatMenuItem->key = null;
            }
        }

        try {
            $wechatMenuItem->save();
        }
        catch(Exception $e)
        {
            Log::error('update WechatMenuItem exception,id' . $id . ',exception:' . $e->getMessage());
        }

        return response()->redirectToRoute('wechat.menu.manage');
    }

    /**
     * 提交新增页面。
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $menuButton = new WechatMenuItem();

        $menuButton->name = trim($request->name);
        $father = $request->sort_father1 * 10;
        $is_button = $request->is_button;
        $is_button = ($is_button == '是') ? 1 : 0;
        $menuButton->is_button = $is_button;

        if ($is_button == 0)//是二级菜单
        {
            $father = $request->sort_father2 * 10;

            $son = $request->sort_son;
            $menuButton->type = trim($request->type);
            $menuButton->url = trim($request->url);
            $menuButton->key = trim($request->key);
            $menuButton->sort_num = $father + $son;

            $menubutton_id = WechatMenuItem::select('id')->where('sort_num', '=', $father)->first();

            $menuButton->button_id = $menubutton_id->id;

        } else {
            $menuButton->sort_num = $father;
        }

        $menuButton->save();

        return response()->redirectToRoute('wechat.menu.manage');
    }

    /**
     * 编辑页面。
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $wechatMenuItem = WechatMenuItem::whereId($id)->first();

        if(is_null($wechatMenuItem))
            return response()->redirectToRoute('wechat.menu.manage');

        $menuId = WechatEvent::whereIsMenu(true)->orderBy('key')->get(['key']);

        return view('wechat.menu.edit', ['menu' => $wechatMenuItem, 'menuId' => $menuId]);
    }

    /**
     * 新增菜单页面。
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $menuId = WechatEvent::whereIsMenu(true)->orderBy('key')->get(['key']);
        $is_button = WechatMenuItem::whereIsButton(true)->get(['name']);

        return view('wechat.menu.create', ['menuId' => $menuId, 'is_button' => $is_button]);
    }

    /**
     * 删除菜单。
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $menuButton = WechatMenuItem::whereId($id)->first();

        if (is_null($menuButton))
            return response()->redirectToRoute('wechat.menu.manage');

        $result = '删除失败';

        try {
            $menuButton->destroy($id);

            $result = '删除成功';
        } catch (Exception $e) {
            Log::error('delete event exception,id:' . $id . ',exception:' . $e->getMessage());
        }

        return view('wechat.menu.delete', ['id' => $id, 'result' => $result]);
    }

    /**
     * 从公众号上拉取菜单到DB。
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function pull()
    {
        $wechat = app('wechat');
        $menu = $wechat->menu;

        $menuAll = $menu->all();
        DB::statement('TRUNCATE TABLE wechat_menu_items');

        $buttons = $menuAll->menu['button'];

        $k = 1;
        foreach ($buttons as $button) {
            $buttonKey = array_key_exists('key', $button) ? $button['key'] : null;
            $buttonType = array_key_exists('type', $button) ? $button['type'] : null;
            $buttonUrl = array_key_exists('url', $button) ? $button['url'] : null;
            $wechat_menu_item = WechatMenuItem::create([
                'name' => $button['name'],
                'type' => $buttonType,
                'url' => $buttonUrl,
                'key' => $buttonKey,
                'sort_num' => $k * 10,
                'is_button' => 1,
                'button_id' => 0,
            ]);

            if (!empty($button['sub_button'])) {
                $i = 1;
                foreach ($button['sub_button'] as $sub_button) {

                    $sub_buttonKey = array_key_exists('key', $sub_button) ? $sub_button['key'] : null;
                    $sub_buttonType = array_key_exists('type', $sub_button) ? $sub_button['type'] : null;
                    $sub_buttonUrl = array_key_exists('url', $sub_button) ? $sub_button['url'] : null;

                    WechatMenuItem::create([
                        'name' => $sub_button['name'],
                        'type' => $sub_buttonType,
                        'url' => $sub_buttonUrl,
                        'key' => $sub_buttonKey,
                        'sort_num' => $k * 10 + $i,
                        'is_button' => 0,
                        'button_id' => $wechat_menu_item->id,
                    ]);
                    $i++;
                }
            }
            $k++;
        }

        $buttons = WechatMenuItem::orderBy('sort_num')->get();

        return view('wechat.menu.index', ['button' => $buttons]);
    }

    /**
     * 备份当前菜单。
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function menuBak()
    {
        $wechat = app('wechat');
        $menu = $wechat->menu;

        $menuAll = $menu->all();

        try {
            WechatMenu::create(['menu_info' => json_encode($menuAll, JSON_UNESCAPED_UNICODE)]);
            return response('success');
        } catch (Exception $e) {
            Log::error('bak exception,exception:' . $e->getMessage());
            return response('fail');
        }
    }

    /**
     *删除公众号菜单。
     */
    public function destroyFromWechat()
    {
        $wechat = app('wechat');
        $menu = $wechat->menu;

        $menu->destroy();

        return response('success');
    }

    /**
     * 提交菜单信息到公众号。
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pushToWechat()
    {
        $wechat = app('wechat');
        $menu = $wechat->menu;

        $array = [];//定义数组
        $buttons = WechatMenuItem::where('id', '>', 0)->orderBy('sort_num')->get();

        $index = 0;
        $subIndex = 0;
        $id = 0;

        foreach ($buttons as $button) {
            if ($button->is_button)//顶级菜单
            {
                if ($id > 0)
                    $index++;

                $array[$index] = [];
                $array[$index]['name'] = $button->name;

                if (!empty($button->key))
                    $array[$index]['key'] = $button->key;

                if (!empty($button->type))
                    $array[$index]['type'] = $button->type;

                if (!empty($button->url))
                    $array[$index]['url'] = $button->url;

                if (WechatMenuItem::whereButtonId($button->id)->count() > 0)
                    $array[$index]['sub_button'] = [];

                $subIndex = 0;

                $id++;
            } else {

                $array[$index]['sub_button'][$subIndex] = [];
                $array[$index]['sub_button'][$subIndex]['name'] = $button->name;
                $array[$index]['sub_button'][$subIndex]['type'] = $button->type;

                if (!empty($button->url))
                    $array[$index]['sub_button'][$subIndex]['url'] = $button->url;

                if (!empty($button->key))
                    $array[$index]['sub_button'][$subIndex]['key'] = $button->key;

                $subIndex++;
            }
        }

        $menu->add($array);

        return response()->redirectToRoute('wechat.menu.manage')
            ->with('message', '提交成功!');
    }
}
