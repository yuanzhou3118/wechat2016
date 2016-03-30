<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    /**
     * 地点介绍页面。
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function map()
    {
        return view('wechat.content.map');
    }

    /**
     * 关注成功页面。
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function follow()
    {
        return view('wechat.content.follow');
    }

    /**
     * 联系我们页面。
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contactUs()
    {
        return view('wechat.content.contactus');
    }

    /**
     * 会议议程页面。
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function meetingAgenda()
    {
        return view('wechat.content.meetingagenda');
    }
}
