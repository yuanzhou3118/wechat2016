<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\BackendUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * 维护后台主页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * 后台登录页面。
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('admin.login');
    }

    /**
     * 后台用户登录接口。
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function doLogin(Request $request)
    {

        $account = BackendUser::where(['account' =>$request->account,'pwd' => $request->password])->first();

        if(!is_null($account))
        {
            $request->session()->set('bk_auth', $account->id);
            $request->session()->set('bk_name', $account->name);

            return response()->redirectToRoute('admin.dashboard')
                ->with('message', '成功登录');
        } else {
            return response()->redirectToRoute('admin.login')
                ->with('message', '用户名密码不正确')
                ->withInput();
        }
    }

    /**
     * 后台用户登出接口。
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogout(Request $request)
    {
        $request->session()->forget('bk_auth');
        $request->session()->forget('bk_name');

        return response()->redirectToRoute('admin.login');
    }
}
