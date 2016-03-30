<?php

namespace App\Http\Controllers\Wechat;

use App\WechatBinding;
use App\WechatEvent;
use App\WechatUser;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Message\Text;
use EasyWeChat\Message\News;
use Exception;
use Log;
use Crypt;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function handler($messageEvent, $eventKey, $fromUser)
    {
        switch ($messageEvent) {
            case 'subscribe':
                try {
                    $subscribeUser = WechatUser::whereOpenid($fromUser->openid)->first();

                    if (is_null($subscribeUser))//新增到数据库
                    {
                        $myWechatUser = new WechatUser();

                        $myWechatUser->openid = $fromUser->openid;
                        $myWechatUser->subscribe = 1;
                        $myWechatUser->nickname = $fromUser->nickname;
                        $myWechatUser->sex = $fromUser->sex;
                        $myWechatUser->city = $fromUser->city;
                        $myWechatUser->province = $fromUser->province;
                        $myWechatUser->headimgurl = $fromUser->headimgurl;
                        $myWechatUser->subscribe_time = date('Y-m-d H:i:s', $fromUser->subscribe_time);
                        $myWechatUser->groupid = $fromUser->groupid;

                        $myWechatUser->save();
                    } else {
                        $subscribeUser->subscribe = 1;
                        $subscribeUser->nickname = $fromUser->nickname;
                        $subscribeUser->sex = $fromUser->sex;
                        $subscribeUser->city = $fromUser->city;
                        $subscribeUser->province = $fromUser->province;
                        $subscribeUser->headimgurl = $fromUser->headimgurl;
                        $subscribeUser->subscribe_time = date('Y-m-d H:i:s', $fromUser->subscribe_time);
                        $subscribeUser->groupid = $fromUser->groupid;

                        $subscribeUser->save();
                    }
                } catch (Exception $e) {
                    Log::error('update subscribe user to db exception,openid:' . $fromUser->openid . ',exception:' . $e->getMessage());
                }

                return $this->processMsg('subscribe', []);
            case 'CLICK':
                $wechatUser = WechatUser::whereOpenid($fromUser->openid)->first();
                $wechatBinding = WechatBinding::whereWechatUserId($wechatUser->id)->first();

                if (is_null($wechatBinding)) {
                    $wechatBindingParams = [];
                    $wechatBindingParams[0] = urlencode($fromUser->openid);
                    $wechatBindingParams[1] = Crypt::encrypt($fromUser->openid);
                    $wechatBindingResult = $this->processMsg('binding', $wechatBindingParams);
                    return $wechatBindingResult;
                }

                return $this->processMsg($eventKey, []);
            case 'unsubscribe':
                try {
                    $unsubscribeUser = WechatUser::whereOpenid($fromUser->openid)->first();

                    $unsubscribeUser->subscribe = 0;
                    $unsubscribeUser->status_time = date('Y-m-d H:i:s');

                    $unsubscribeUser->save();

                    $wechatBinding = WechatBinding::whereWechatUserId($unsubscribeUser->id)->first();

                    if(!is_null($wechatBinding))
                    {
                        WechatBinding::destroy($wechatBinding->id);
                    }
                } catch (Exception $eun) {
                    Log::error('unsubscribe user to db exception,openid:' . $fromUser->openid . ',exception:' . $eun->getMessage());
                }

                return null;
            case 'SCAN':
                return null;
            case 'LOCATION':
                return null;
            case 'VIEW':
                return null;
            default:
                return null;
        }
    }

    /**
     * 维护页面。
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('wechat.event.index', ['events' => WechatEvent::orderBy('key')->get()]);
    }

    /**
     * 新增页面。
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wechatEvent = new WechatEvent();

        $wechatEvent->type = 'text';

        return view('wechat.event.create', ['event' => $wechatEvent]);
    }

    /**
     * 提交新增页面。
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $wechatEvent = new WechatEvent();

        $result = '新增失败';

        try {
            $wechatEvent->key = trim($request->key);
            $wechatEvent->type = trim($request->type);
            $wechatEvent->text = null;
            $wechatEvent->is_menu = trim($request->is_menu) == 'on';
            $wechatEvent->title = null;
            $wechatEvent->description = null;
            $wechatEvent->url = null;
            $wechatEvent->image = null;
            $wechatEvent->media_id = null;

            switch ($request->type) {
                case 'text':
                    $wechatEvent->text = trim($request->text);
                    break;
                case 'news':
                    $wechatEvent->title = trim($request->title);
                    $wechatEvent->description = trim($request->description);
                    $wechatEvent->url = trim($request->url);
                    $wechatEvent->image = trim($request->image);
                    break;
                case 'image':
                case 'video':
                case 'voice':
                    $wechatEvent->media_id = trim($request->media_id);
                    break;
                default:
                    break;
            }

            $wechatEvent->save();

            $result = '新增成功';
        } catch (Exception $e) {
            Log::error('add event exception,key:' . $request->key . ',exception:' . $e->getMessage());
        }

        return view('wechat.event.create', ['event' => $wechatEvent, 'result' => $result]);
    }

    /**
     * 处理回复消息。
     *
     * @param $key
     * @param $params
     * @return \EasyWeChat\Message\News|\EasyWeChat\Message\Text|null
     */
    protected function processMsg($key, $params)
    {
        $wechatEvent = WechatEvent::whereKey($key)->first();

        if (is_null($wechatEvent))
            return null;

        switch ($wechatEvent->type) {
            case 'text':
                $text = new Text();

                $myText = $wechatEvent->text;
                $indexText = 10;

                foreach ($params as $param) {
                    $myText = str_replace('@' . $indexText, $param, $myText);
                    $indexText++;
                }

                $text->content = $myText;
                return $text;
            case 'news':
                $news = new News();

                $myUrl = $wechatEvent->url;
                $indexUrl = 10;

                foreach ($params as $param) {
                    $myUrl = str_replace('@' . $indexUrl, $param, $myUrl);
                    $indexUrl++;
                }

                $news->title = $wechatEvent->title;
                $news->url = $myUrl;
                $news->image = $wechatEvent->image;
                $news->description = $wechatEvent->description;
                return $news;
            default:
                return null;
        }
    }

    /**
     * @return mixed|string
     */
    public function show()
    {
        $a = '请先进行绑定，<a href=\'http://wechat2016.nurunci.com/wechat/binding?openid=@10\'>绑定 / Signin...</a>';

        $array =[];

        foreach($array as $item)
        {
            $a =str_replace('@10', 'a', $a);
        }

        return $a;

        //        $wechat = app('wechat');
//        $userId = 'oyPe-vs0Oc0ojnYkevcJkMegu5h4';
//        $templateId = 'wlSToIhYKUvDNbHOJGh9UVWgnI34DewZDIfDMdiGhmQ';
//        $url = 'http://www.dulcolax.com.cn/	';
//        $color = '#FF0000';
//        $data = array(
//            "first"  => "尊敬的用户，您已成功绑定会员账号！",
//            "keyword1"   => "123456789",
//            "keyword2"  => date('Y-m-d'),
//            "remark" => "感谢您的支持，如有疑问，请于客服人员联系。",
//        );
//
//        $wechat->notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();

//        $wechat = app('wechat');
//        $userId = 'oyPe-vs0Oc0ojnYkevcJkMegu5h4';
//        $templateId = 'KKrVYUTYobzwgkhjF8A5hWPBQb-zGreCSb11Paomxv8';
//        $url = 'http://www.dulcolax.com.cn/	';
//        $color = '#FF0000';
//        $data = array(
//            "first" => "尊敬的用户，您已成功绑定会员账号！",
//            "keyword1" => '10',
//            "keyword2" => '210',
//            "keyword3" => '210',
//            "keyword4" => '210',
//            "keyword5" => '210',
//            "remark" => "感谢您的支持，如有疑问，请于客服人员联系。",
//        );
//
//        $wechat->notice->uses($templateId)->andData($data)->andReceiver($userId)->send();

//        $wechat->notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();
    }

    /**
     * 编辑页面。
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wechatEvent = WechatEvent::whereId($id)->first();

        if (is_null($wechatEvent))
            return response()->redirectToRoute('wechat.event.manage');

        return view('wechat.event.edit', ['event' => $wechatEvent]);
    }

    /**
     * 提交编辑页面。
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $wechatEvent = WechatEvent::whereId($id)->first();

        if (is_null($wechatEvent))
            return response()->redirectToRoute('wechat.event.manage');

        $result = '保存失败';

        try {
            $wechatEvent->key = trim($request->key);
            $wechatEvent->type = trim($request->type);
            $wechatEvent->text = null;
            $wechatEvent->is_menu = trim($request->is_menu) == 'on';
            $wechatEvent->title = null;
            $wechatEvent->description = null;
            $wechatEvent->url = null;
            $wechatEvent->image = null;
            $wechatEvent->media_id = null;

            switch ($request->type) {
                case 'text':
                    $wechatEvent->text = trim($request->text);
                    break;
                case 'news':
                    $wechatEvent->title = trim($request->title);
                    $wechatEvent->description = trim($request->description);
                    $wechatEvent->url = trim($request->url);
                    $wechatEvent->image = trim($request->image);
                    break;
                case 'image':
                case 'video':
                case 'voice':
                    $wechatEvent->media_id = trim($request->media_id);
                    break;
                default:
                    break;
            }

            $wechatEvent->save();

            $result = '保存成功';
        } catch (Exception $e) {
            Log::error('save event exception,id:' . $id . ',exception:' . $e->getMessage());
        }

        return view('wechat.event.edit', ['event' => $wechatEvent, 'result' => $result]);
    }

    /**
     * 删除事件页面。
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wechatEvent = WechatEvent::whereId($id)->first();

        if (is_null($wechatEvent))
            return response()->redirectToRoute('wechat.event.manage');

        $result = '删除失败';

        try {
            $wechatEvent->destroy($id);

            $result = '删除成功';
        } catch (Exception $e) {
            Log::error('delete event exception,id:' . $id . ',exception:' . $e->getMessage());
        }

        return view('wechat.event.delete', ['id' => $id, 'result' => $result]);
    }
}
