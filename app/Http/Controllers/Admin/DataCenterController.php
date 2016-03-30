<?php

namespace App\Http\Controllers\Admin;

use Excel;
use DB;
use App\Employee;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Log;

class DataCenterController extends Controller
{
    public function importTester()
    {
        $time = microtime(true);

        $file = storage_path('test.xlsx');

        if (!is_file($file))
            return 'file not exist';

        Excel::load($file, function ($reader) {
            $results = $reader->toArray();

            if (count($results) > 0) {
                DB::beginTransaction();

                try {
                    foreach ($results as $result) {
                        $employee = new Employee();

                        $employee->cn_name = trim($result['cn_name']);
                        $employee->en_name = trim($result['en_name']);
                        $employee->department = trim($result['department']);
                        $employee->id_card = strtoupper(trim($result['id_card']));
                        $employee->txt_1 = trim($result['txt_1']);//经销商名称
                        $employee->txt_2 = trim($result['txt_2']);//职务
                        $employee->txt_3 = trim($result['txt_3']);//性别
                        $employee->txt_4 = trim($result['txt_4']);//手机
                        $employee->txt_5 = 'nuruntester';
                        $employee->campaign_status = false;
                        $employee->type = 2;
                        $employee->status = true;

                        $employee->save();
                    }

                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                    Log::error('import employee exception:' . $e->getMessage());
                }
            }
        });

        $spendTime = round(microtime(true) - $time, 3);

        return 'success' . ',import time:' . $spendTime . 's';
    }

    public function importEmployee()
    {
        $time = microtime(true);

        $file = storage_path('employee.xlsx');

        if (!is_file($file))
            return 'file not exist';

        Excel::load($file, function ($reader) {
            $results = $reader->toArray();

            if (count($results) > 0) {
                DB::beginTransaction();

                try {
                    foreach ($results as $result) {
                        $employee = new Employee();

                        $employee->cn_name = trim($result['cn_name']);
                        $employee->en_name = trim($result['en_name']);
                        $employee->department = trim($result['department']);
                        $employee->id_card = strtoupper($result['id_card']);//员工号
                        $employee->txt_1 = trim($result['txt_1']);//Base地
                        $employee->txt_2 = strtoupper(trim($result['txt_2']));//身份证
                        $employee->txt_3 = trim($result['txt_3']);//性别
                        $employee->txt_4 = trim($result['txt_4']);//手机
                        $employee->txt_5 = trim($result['txt_5']);//邮箱
                        $employee->txt_6 = trim($result['txt_6']);//生日
                        $employee->txt_7 = trim($result['txt_7']);//区域
                        $employee->txt_8 = trim($result['txt_8']);//负责人
                        $employee->txt_9 = trim($result['txt_9']);
                        $employee->campaign_status = true;
                        $employee->type = 1;
                        $employee->status = true;

                        $employee->save();
                    }

                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                    Log::error('import employee exception:' . $e->getMessage());
                }
            }
        });

        $spendTime = round(microtime(true) - $time, 3);

        return 'success' . ',import time:' . $spendTime . 's';
    }

    public function importEmployeeGuest()
    {
        $time = microtime(true);

        $file = storage_path('employeeguest.xlsx');

        if (!is_file($file))
            return 'file not exist';

        Excel::load($file, function ($reader) {
            $results = $reader->toArray();

            if (count($results) > 0) {
                DB::beginTransaction();

                try {
                    foreach ($results as $result) {
                        $employee = new Employee();

                        $employee->cn_name = trim($result['cn_name']);
                        $employee->en_name = trim($result['en_name']);
                        $employee->department = trim($result['department']);
                        $employee->id_card = strtoupper($result['id_card']);//员工号
                        $employee->txt_1 = trim($result['txt_1']);//Base地
                        $employee->txt_2 = strtoupper(trim($result['txt_2']));//身份证
                        $employee->txt_3 = trim($result['txt_3']);//性别
                        $employee->txt_4 = trim($result['txt_4']);//手机
                        $employee->txt_5 = trim($result['txt_5']);//邮箱
                        $employee->txt_6 = trim($result['txt_6']);//生日
                        $employee->txt_7 = trim($result['txt_7']);//区域
                        $employee->txt_8 = trim($result['txt_8']);//负责人
                        $employee->txt_9 = trim($result['txt_9']);
                        $employee->campaign_status = false;
                        $employee->type = 1;
                        $employee->status = true;

                        $employee->save();
                    }

                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                    Log::error('import employee exception:' . $e->getMessage());
                }
            }
        });

        $spendTime = round(microtime(true) - $time, 3);

        return 'success' . ',import time:' . $spendTime . 's';
    }

    public function importDealer()
    {
        $time = microtime(true);

        $file = storage_path('dealer.xlsx');

        if (!is_file($file))
            return 'file not exist';

        Excel::load($file, function ($reader) {
            $results = $reader->toArray();

            if (count($results) > 0) {
                DB::beginTransaction();

                try {
                    foreach ($results as $result) {
                        $employee = new Employee();

                        $employee->cn_name = trim($result['cn_name']);
                        $employee->en_name = trim($result['en_name']);
                        $employee->department = trim($result['department']);
                        $employee->id_card = strtoupper(trim($result['id_card']));
                        $employee->txt_1 = trim($result['txt_1']);//经销商名称
                        $employee->txt_2 = trim($result['txt_2']);//职务
                        $employee->txt_3 = trim($result['txt_3']);//性别
                        $employee->txt_4 = trim($result['txt_4']);//手机
                        $employee->txt_5 = trim($result['txt_5']);
                        $employee->type = 2;
                        $employee->status = true;
                        $employee->campaign_status = false;

                        $employee->save();
                    }

                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                    Log::error('import dearler exception:' . $e->getMessage());
                }
            }
        });

        $spendTime = round(microtime(true) - $time, 3);

        return 'success' . ',import time:' . $spendTime . 's';
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request, $id)
    {
//分页
        $pagesize = 10;//每页显示记录数
        $search_id_card = $request->id_card_search;
        $search_type = $request->type;

        if ($request->id_card_search == '' && $request->type) {
            $count = Employee::whereType($request->type)->count();
            $pages = intval($count / $pagesize);//总页数

            if ($count % $pagesize != 0)
                $pages++;

            if ($pages == 0)
                $pages = 1;

            $page = intval($id);

            if ($page < 1 || $page > $pages)
                return response()->redirectToRoute('wechat.user.list', 1);

            $offset = $pagesize * ($page - 1);//计算偏移量
            $id_card = Employee::whereType($request->type)->orderBy('id')->skip($offset)->take($pagesize)->get();
        } elseif ($request->id_card_search && $request->type) {
            $count = Employee::whereIdCard($request->id_card_search)->whereType($request->type)->count();
            $pages = intval($count / $pagesize);//总页数

            if ($count % $pagesize != 0)
                $pages++;

            if ($pages == 0)
                $pages = 1;

            $page = intval($id);

            if ($page < 1 || $page > $pages)
                return response()->redirectToRoute('wechat.employee.list', 1);

            $offset = $pagesize * ($page - 1);//计算偏移量
            $id_card = Employee::whereIdCard($request->id_card_search)->whereType($request->type)->orderBy('id')->skip($offset)->take($pagesize)->get();
        } elseif ($request->id_card_search && $request->type == '') {
            $count = Employee::whereIdCard($request->id_card_search)->count();
            $pages = intval($count / $pagesize);//总页数

            if ($count % $pagesize != 0)
                $pages++;

            if ($pages == 0)
                $pages = 1;

            $page = intval($id);

            if ($page < 1 || $page > $pages)
                return response()->redirectToRoute('wechat.employee.list', 1);

            $offset = $pagesize * ($page - 1);//计算偏移量
            $id_card = Employee::whereIdCard($request->id_card_search)->orderBy('id')->skip($offset)->take($pagesize)->get();
        }


        return view('wechat.employee.seach_query', ['employees' => $id_card, 'page' => $page, 'pages' => $pages, 'search_id_card' => $search_id_card, 'search_type' => $search_type]);

    }

    public function edit($id)
    {
        $EmployeeItem = Employee::whereId($id)->first();

        if (is_null($EmployeeItem))
            return response()->redirectToRoute('wechat.employee.list');


        return view('wechat.employee.edit', ['employee' => $EmployeeItem]);
    }

    public function update(Request $request, $id)
    {
        $EmployeeItem = Employee::whereId($id)->first();

        if (is_null($EmployeeItem))
            return response()->redirectToRoute('wechat.employee.list');

        $EmployeeItem->id_card = trim($request->id_card);
        $EmployeeItem->cn_name = trim($request->cn_name);
        $EmployeeItem->en_name = trim($request->en_name);
        $EmployeeItem->department = trim($request->department);
        $EmployeeItem->type = intval(trim($request->type));
        $EmployeeItem->txt_1 = trim($request->txt_1);//经销商名称//Base地
        $EmployeeItem->txt_2 = trim($request->txt_2);//职务//身份证
        $EmployeeItem->txt_3 = trim($request->txt_3);//性别//性别
        $EmployeeItem->txt_4 = trim($request->txt_4);//手机//手机
        $EmployeeItem->txt_5 = trim($request->txt_5);//邮箱
        $EmployeeItem->txt_6 = trim($request->txt_6);//生日
        $EmployeeItem->txt_7 = trim($request->txt_7);//区域
        $EmployeeItem->txt_8 = trim($request->txt_8);//负责人
        $EmployeeItem->campaign_status = trim($request->campaign_status);//负责人


        try {
            $EmployeeItem->save();
        } catch (Exception $e) {
            Log::error('update EmployeeItem exception,id' . $id . ',exception:' . $e->getMessage());
        }

        return response()->redirectToRoute('wechat.employee.list', 1);
    }

    public function delete($id)
    {
        $EmployeeItem = Employee::whereId($id)->first();

        if (is_null($EmployeeItem))
            return response()->redirectToRoute('wechat.employee.list');

        $result = '删除失败';

        try {
            $EmployeeItem->destroy($id);

            $result = '删除成功';
        } catch (Exception $e) {
            Log::error('delete employee exception,id:' . $id . ',exception:' . $e->getMessage());
        }

        return view('wechat.employee.delete', ['id' => $id, 'result' => $result]);
    }

    public function create()
    {

        return view('wechat.employee.create');

    }

    public function store(Request $request)
    {
        $employeeItem = new Employee();

        $employeeItem->id_card = trim($request->id_card);
        $employeeItem->cn_name = trim($request->cn_name);
        $employeeItem->en_name = trim($request->en_name);
        $employeeItem->department = $request->department;
        $employeeItem->type = trim($request->type);
        $employeeItem->txt_1 = trim($request->txt_1);//经销商名称//Base地
        $employeeItem->txt_2 = trim($request->txt_2);//职务//身份证
        $employeeItem->txt_3 = trim($request->txt_3);//性别//性别
        $employeeItem->txt_4 = trim($request->txt_4);//手机//手机
        $employeeItem->txt_5 = trim($request->txt_5);//邮箱
        $employeeItem->txt_6 = trim($request->txt_6);//生日
        $employeeItem->txt_7 = trim($request->txt_7);//区域
        $employeeItem->txt_8 = trim($request->txt_8);//负责人
        $employeeItem->campaign_status = trim($request->campaign_status);//负责人
        $employeeItem->status = true;//负责人


        $employeeItem->save();

        return response()->redirectToRoute('wechat.employee.list',1);

    }

}
