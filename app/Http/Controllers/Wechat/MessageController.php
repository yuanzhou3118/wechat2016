<?php

namespace App\Http\Controllers\Wechat;

use App\Employee;
use App\WechatBinding;
use App\WechatEmployeeManage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function relation()
    {
        $message = Employee::all()->sortByDesc("id");
        $count = $message->count();
        foreach($message as $messages){
            $messages->birthday =  explode(" ",$messages->birthday)[0];
            switch($messages->type){
                case 0:
                    $messages->type = "用户组一";
                    break;
                case 1:
                    $messages->type = "用户组二";
                    break;
                case 2:
                    $messages->type = "用户组三";
                    break;
                default:
                    break;
            }

        }
        return view('relationMessage',['message' => $message,'count'=>$count]);
    }

    public function add(){
        return view('addRelationMessage');
    }

    public function add_user(Request $request){
        try{
            $employee = new Employee();
            $employee->no = $request->employee_id;
            $employee->name = $request->name;
            $employee->department = $request->department;
            $employee->city = $request->city;
            $employee->birthday = $request->birthday;
            $employee->sex = $request->sex;
            $employee->phone = $request->phone;
            $employee->id_card = $request->id_card;
            $employee->save();
        }catch(Exception $e){
            print_r(e);
        }

        return $this->relation();
    }
    public function delete_user()
    {
        $id = json_decode($_POST['id']);
        Employee::query()->where('id','=',$id)->delete();
        return 1;
    }
    public function edit_user($id)
    {
        $message = Employee::whereId($id)->get();
        return view("editRelationMessage",['message'=>$message]);
    }

    public function edit_save(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $department = $request->department;
        $city = $request->city;
        $birthday = $request->birthday;
        $sex = $request->sex;
        $phone = $request->phone;
        Employee::where("id",'=',$id)->update(['name' => $name,'department'=>$department,'city'=>$city,'birthday'=>$birthday,'sex'=>$sex,'phone'=>$phone,]);
        return $this->relation();
    }

    public function vali()
    {
        $id_card = $_POST['id_card'];
        $count = Employee::whereIdCard($id_card)->count();
        return $count;
    }
}
