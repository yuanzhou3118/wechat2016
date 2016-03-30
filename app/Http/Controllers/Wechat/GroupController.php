<?php

namespace App\Http\Controllers\Wechat;

use App\WechatGroup;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Log;
use Exception;

class GroupController extends Controller
{
    /**
     * 维护用户组。
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('wechat.group.index', ['groups' => WechatGroup::orderBy('group_id')->get()]);
    }

    /**
     * 新增用户组页面。
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('wechat.group.create');
    }

    /**
     * 新增用户组到公众号。
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = trim($request->name);

        if (mb_strlen($name) == 0)
            return view('wechat.group.create', ['result' => '用户组名称不能为空']);

        $wechat = app('wechat');
        $group = $wechat->user_group;
        $result = true;

        try {
            $group->create($name);
        } catch (Exception $e) {
            $result = false;
            Log::error('add user group exception,group name:' . $name . ',exception:' . $e->getMessage());
        }

        if ($result)
            $this->fetch();

        return view('wechat.group.create', ['result' => $result ? '新增成功' : '新增失败']);
    }

    /**
     * 从公众号上获取用户组。
     *
     * @return bool
     */
    protected function fetch()
    {
        $wechat = app('wechat');
        $group = $wechat->user_group;

        try {
            $groups = $group->lists();
            DB::beginTransaction();

            try {
                DB::statement('TRUNCATE TABLE wechat_groups');
                $groups = $groups->groups;

                foreach ($groups as $group) {
                    $wechat_group = new WechatGroup();
                    $wechat_group->group_id = $group['id'];
                    $wechat_group->name = $group['name'];
                    $wechat_group->count = $group['count'];
                    $wechat_group->save();
                }

                DB::commit();
                return true;
            } catch (Exception $ee) {
                Log::error('save user group exception,exception:' . $ee->getMessage());
                DB::rollBack();
                return false;
            }
        } catch (Exception $e) {
            Log::error('fetch user group exception,exception:' . $e->getMessage());
            return false;
        }
    }

    /**
     * 从公众号拉取用户组。
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pull()
    {
        return view('wechat.group.store', ['result' => $this->fetch() ? '更新成功' : '更新失败']);
    }

    /**
     * 编辑用户组页面。
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wechatGroup = WechatGroup::whereId($id)->first();

        if (is_null($wechatGroup))
            return response()->redirectToRoute('wechat.group.manage');

        return view('wechat.group.edit', ['group' => $wechatGroup]);
    }

    /**
     * 提交编辑用户组页面。
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        $wechatGroup = WechatGroup::whereId($id)->first();

        if (is_null($wechatGroup))
            return response()->redirectToRoute('wechat.group.manage');

        $name = trim($request->name);

        if (mb_strlen($name) == 0)
            return view('wechat.group.edit', ['result' => '用户组名称不能为空']);

        $wechat = app('wechat');
        $group = $wechat->user_group;
        $result = true;

        try {
            $group->update($wechatGroup->group_id, $name);
        } catch (Exception $e) {
            $result = false;
            Log::error('update user group exception,group name:' . $name . ',exception:' . $e->getMessage());
        }

        if ($result)
            $this->fetch();

        $wechatGroup->name = $name;

        return view('wechat.group.edit', ['group' => $wechatGroup, 'result' => $result ? '保存成功' : '保存失败']);
    }

    /**
     * 删除用户组。
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wechatGroup = WechatGroup::whereId($id)->first();

        if (is_null($wechatGroup))
            return response()->redirectToRoute('wechat.group.manage');

        $result = true;

        try {
            $wechat = app('wechat');
            $group = $wechat->user_group;
            $group->delete($wechatGroup->group_id);
        } catch (Exception $e) {
            $result = false;
            Log::error('delete user group exception,group id:' . $wechatGroup->group_id . ',exception:' . $e->getMessage());
        }

        if ($result)
            $this->fetch();

        return view('wechat.group.delete', ['result' => $result ? '删除成功' : '删除失败']);
    }
}
