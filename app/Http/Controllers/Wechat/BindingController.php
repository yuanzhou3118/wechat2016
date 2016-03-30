<?php

namespace App\Http\Controllers\Wechat;

use App\Employee;
use App\WechatGroup;
use App\WechatUser;
use Illuminate\Http\Request;
use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\WechatBinding;
use Exception;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class BindingController extends Controller
{
    /**
     * 员工绑定微信用户界面。
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $openid = trim($request->openid);

        if (strlen($openid) == 0)
            return response('error:no openid');

        $sign = trim($request->sign);

        if (strlen($sign) == 0)
            return response('error:no sign');

        $checkSign = false;
        $decrypted = '';

        try {
            $decrypted = Crypt::decrypt($sign);

            $checkSign = true;
        } catch (DecryptException $e) {
        }

        if (!$checkSign || $openid != $decrypted)
            return response('error:sign error');

        $wechatUser = WechatUser::whereOpenid($openid)->first();

        if (is_null($wechatUser))
            return response('error:no user');

        return view('wechat.binding', ['id' => $wechatUser->id, 'sign' => Crypt::encrypt($wechatUser->id)]);
    }

    /**
     * 提交绑定接口.
     * result：1表示绑定成功，2：用户不存在，3：已经绑定过了，0：绑定失败，4：证件号不能为空
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function doBind(Request $request)
    {
        $id = intval(trim($request->id));

        if ($id < 1)
            return response()->json(['result' => 2]);

        $sign = trim($request->sign);

        if (strlen($sign) == 0)
            return response()->json(['result' => 2]);

        $checkSign = false;
        $decrypted = '';

        try {
            $decrypted = Crypt::decrypt($sign);

            $checkSign = true;
        } catch (DecryptException $e) {
        }

        if (!$checkSign || $id != intval($decrypted))
            return response()->json(['result' => 2]);

        $id_card = strtoupper(trim($request->id_card));

        if (strlen($id_card) == 0)
            return response()->json(['result' => 4]);

        $employeeType = trim($request->employee_type);

        if (strlen($employeeType) == 0)
            return response()->json(['result' => 4]);

        if (preg_match('/(1|2|3)/', $employeeType) == 0)
            return response()->json(['result' => 4]);

        $type = intval($employeeType);

        $wechatUser = WechatUser::whereId($id)->first();

        if (is_null($wechatUser))
            return response()->json(['result' => 2]);

        $employee = Employee::whereIdCard($id_card)->first();

        if (is_null($employee) || !$employee->status || $employee->type != $type)
            return response()->json(['result' => 2]);

        if (WechatBinding::whereWechatUserId($id)->count() != 0 || WechatBinding::whereEmployeeId($employee->id)->count() != 0)
            return response()->json(['result' => 2]);

        $wechatBinding = new WechatBinding();

        $wechatBinding->employee_id = $employee->id;
        $wechatBinding->wechat_user_id = $id;

        $success = true;

        try {
            $wechatBinding->save();
        } catch (Exception $e) {
            $success = false;

            Log::error('bind wechat exception,wechat id:' . $id . ',employee id:' . $employee->id . ',exception:' . $e->getMessage());
        }

        if (!$success)
            return response()->json(['result' => 0]);

        $groupName = '测试用户';

        if ($type == 1)
            $groupName = '欧家员工';
        elseif ($type == 2)
            $groupName = '经销商';

        $wechatGroup = WechatGroup::whereName($groupName)->first();

        if (is_null($wechatGroup))
            Log::error('wechat user group not exist,name:' . $groupName);

        try {
            $wechat = app('wechat');
            $group = $wechat->user_group;

            $group->moveUser($wechatUser->openid, $wechatGroup->group_id);
        } catch (Exception $e) {
            Log::error('move user to group exception,openid:' . $wechatUser->openid . ',group_id:' . $wechatGroup->group_id . ',exception:' . $e->getMessage());
        }

        return response()->json(['result' => 1, 'cnname' => $employee->cn_name, 'enname' => $employee->en_name], 200, ['Content-Type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
}
