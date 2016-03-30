@extends('master')

@section('title', '编辑菜单')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>编辑员工信息</span>
                    </div>
                    <div class="panel-body">
                        <div class="panel-heading"><a href="{{URL::route('wechat.employee.list', 1)}}"
                                                      class="btn btn-success">返回</a>
                        </div>
                        <div class="panel-body">
                            <form action="{{ URL::route('wechat.employee.edit.do',$employee->id) }} " method="post"
                                  class="form-group">
                                {{csrf_field()}}
                                <label class="control-label">证件号:</label><input type="text" name="id_card"
                                                                                value="{{$employee->id_card}}"
                                                                                class="form-control required"><br>
                                <label class="control-label">中文名字:</label><input type="text" name="cn_name"
                                                                                 value="{{$employee->cn_name  or null}}"
                                                                                 class="form-control required"><br>
                                <label class="control-label">英文名字:</label><input title="" type="text" name="en_name"
                                                                                 value="{{$employee->en_name  or null}}"
                                                                                 class="form-control required"><br>
                                <label class="control-label">部门:</label><input title="" type="text" name="department"
                                                                               value="{{$employee->department  or null}}"
                                                                               class="form-control required"><br>
                                <label class="control-label">用户组:</label>

                                <select title="" class="form-control" name="type" id="type">
                                    <option value="">请选择</option>
                                    <option value="1">欧家员工</option>
                                    <option value="2">经销商</option>
                                </select>
                                <br>
                                <label class="control-label">员工类型:</label>
                                <select title="" class="form-control" name="campaign_status" id="campaign_status">
                                    <option value="1" selected>员工</option>
                                    <option value="0">嘉宾或经销商</option>
                                </select>
                                <br>
                                @if($employee->type == 1)
                                <label class="control-label">所在地:</label><input type="text" name="txt_1"
                                                                                class="form-control required" value="{{$employee->txt_1  or null}}"><br>
                                <label class="control-label">身份证:</label><input type="text" name="txt_2"
                                                                                class="form-control required" value="{{$employee->txt_2  or null}}"><br>
                                <label class="control-label">性别:</label><input type="text" name="txt_3" class="form-control required" value="{{$employee->txt_3  or null}}">
                                <br>
                                <label class="control-label">手机:</label><input type="text" name="txt_4"
                                                                               class="form-control required" value="{{$employee->txt_4  or null}}"><br>
                                <label class="control-label">邮箱:</label><input type="text" name="txt_5"
                                                                               class="form-control required" value="{{$employee->txt_5  or null}}"><br>
                                <label class="control-label">生日:</label><input type="text" name="txt_6"
                                                                               class="form-control required" value="{{$employee->txt_6  or null}}"><br>
                                <label class="control-label">区域:</label><input type="text" name="txt_7"
                                                                               class="form-control required" value="{{$employee->txt_7  or null}}"><br>
                                <label class="control-label">负责人:</label><input type="text" name="txt_8"
                                                                                class="form-control required" value="{{$employee->txt_8  or null}}"><br>
                                @elseif($employee->type == 2)
                                    <label class="control-label">经销商公司名称:</label><input type="text" name="txt_1"
                                                                                        class="form-control required" value="{{$employee->txt_1  or null}}"><br>
                                    <label class="control-label">职务:</label><input type="text" name="txt_2"
                                                                                   class="form-control required" value="{{$employee->txt_2  or null}}"><br>
                                    <label class="control-label">性别:</label>
                                    <input type="text" name="txt_3" class="form-control required" value="{{$employee->txt_3  or null}}">
                                    <br>
                                    <label class="control-label">手机:</label><input type="text" name="txt_4"
                                                                                   class="form-control required" value="{{$employee->txt_4  or null}}"><br>
                                @endif
                                <input type="submit" value="保存" class="btn btn-primary form-control">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #text li {
            display: none;
        }
    </style>
    <script>
        $(function () {
            $('#type').val({{$employee->type}}).attr("selected", true)
            $('#campaign_status').val({{$employee->campaign_status}}).attr("selected", true)


        })

    </script>

@endsection
