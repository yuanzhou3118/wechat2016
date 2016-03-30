<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Employee;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    /**
     * 员工管理页面。
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function query($id)
    {
        $pagesize = 10;//每页显示记录数
        $count = Employee::count();
        $pages = intval($count / $pagesize);//总页数

        if ($count % $pagesize != 0)
            $pages++;

        if ($pages == 0)
            $pages = 1;

        $page = intval($id);

        if ($page < 1 || $page > $pages)
            return response()->redirectToRoute('wechat.user.list', 1);

        $offset = $pagesize * ($page - 1);//计算偏移量
        $employees = Employee::orderBy('id')->skip($offset)->take($pagesize)->get();

        return view('wechat.employee.query', ['employees' => $employees, 'page' => $page, 'pages' => $pages]);
    }


}
