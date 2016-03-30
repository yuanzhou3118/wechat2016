<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\WechatUser;
use Exception;
use DB;
use Log;

class UserController extends Controller
{
    /**
     * 微信用户管理页面。
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function query($id)
    {
        $pagesize = 10;//每页显示记录数
        $usercount = WechatUser::count();
        $pages = intval($usercount / $pagesize);//总页数

        if ($usercount % $pagesize != 0)
            $pages++;

        if ($pages == 0)
            $pages = 1;

        $page = intval($id);

        if ($page < 1 || $page > $pages)
            return response()->redirectToRoute('wechat.user.list', 1);

        $offset = $pagesize * ($page - 1);//计算偏移量
        $userlist = WechatUser::orderBy('subscribe_time', 'desc')->skip($offset)->take($pagesize)->get();

        return view('wechat.user.query', ['userlist' => $userlist, 'page' => $page, 'pages' => $pages]);
    }

    /**
     * 从公众号上拉取关注用户到DB。
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fetch()
    {
        $result = true;

        try {
            $wechat = app('wechat');
            $server = $wechat->server;
            $userService = $wechat->user;

            $users = $userService->lists();//获取用户列表
            $data = $users->data;
            $openids = $data['openid'];

            DB::beginTransaction();

            try {
                foreach ($openids as $openid) {
                    $user = $userService->get($openid);
                    $wechatUser = WechatUser::whereOpenid($openid)->first();

                    if (is_null($wechatUser)) {//数据不存在此数据
                        WechatUser::create([
                            'openid' => $user->openid,
                            'nickname' => $user->nickname,
                            'sex' => $user->sex,
                            'city' => $user->city,
                            'province' => $user->province,
                            'headimgurl' => $user->headimgurl,
                            'subscribe_time' => date('Y-m-d H:i:s', $user->subscribe_time),
                            'subscribe' => $user->subscribe,
                            'groupid' => $user->groupid
                        ]);
                    } else {//存在openid,nickname那么不同
                        $wechatUser->nickname = $user->nickname;
                        $wechatUser->sex = $user->sex;
                        $wechatUser->city = $user->city;
                        $wechatUser->province = $user->province;
                        $wechatUser->headimgurl = $user->headimgurl;
                        $wechatUser->subscribe_time = date('Y-m-d H:i:s', $user->subscribe_time);
                        $wechatUser->subscribe = $user->subscribe;
                        $wechatUser->groupid = $user->groupid;

                        $wechatUser->save();
                    }
                }

                DB::commit();
            } catch (Exception $ee) {
                DB::rollBack();
                Log::error('update or add user exception,exception:' . $ee->getMessage());
                throw $ee;
            }
        } catch (Exception $e) {
            $result = false;
            Log::error('fetch user exception,exception:' . $e->getMessage());
        }

        return view('wechat.user.fetch', ['result' => $result ? '获取成功' : '获取失败']);
    }
}
