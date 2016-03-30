@extends('master')

@section('title', '新建员工')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>新建员工</span>
                    </div>
                    <div class="panel-body">
                        <div class="panel-heading"><a href="{{URL::route('wechat.employee.list',1)}}"
                                                      class="btn btn-success">返回</a>
                        </div>
                        <div class="panel-body">
                            <form action="{{ URL::route('wechat.employee.create.do') }} " method="post"
                                  class="form-group">
                                {{csrf_field()}}
                                <label class="control-label">证件号:</label><input type="text" name="id_card"
                                                                                class="form-control required"><br>
                                <label class="control-label">中文名字:</label><input type="text" name="cn_name"
                                                                                 class="form-control required"><br>
                                <label class="control-label">英文名字:</label><input title="" type="text" name="en_name"
                                                                                 class="form-control required"><br>
                                <label class="control-label">部门:</label><input title="" type="text" name="department"
                                                                               class="form-control required"><br>
                                <label class="control-label">用户组:</label>

                                <select title="" class="form-control" name="type" id="type">
                                    <option value="">请选择</option>
                                    <option value="1">欧家员工</option>
                                    <option value="2">经销商</option>
                                </select><br>
                                <label class="control-label">员工类型:</label>
                                <select title="" class="form-control" name="campaign_status">
                                    <option value="1" selected>员工</option>
                                    <option value="0">嘉宾或经销商</option>
                                </select>
                                <br>
                                    <label class="control-label">所在地或经销商公司名称:</label><input type="text" name="txt_1"
                                                                                    class="form-control required"><br>
                                    <label class="control-label">身份证或职务:</label><input type="text" name="txt_2"
                                                                                    class="form-control required"><br>
                                    <label class="control-label">性别:</label>
                                    <input type="text" name="txt_3" class="form-control required">
                                    <br>
                                    <label class="control-label">手机:</label><input type="text" name="txt_4"
                                                                                   class="form-control required"><br>
                                    <label class="control-label">邮箱:</label><input type="text" name="txt_5"
                                                                                   class="form-control required"><br>
                                    <label class="control-label">生日:</label><input type="text" name="txt_6"
                                                                                   class="form-control required"><br>
                                    <label class="control-label">区域:</label><input type="text" name="txt_7"
                                                                                   class="form-control required"><br>
                                    <label class="control-label">负责人:</label><input type="text" name="txt_8"
                                                                                    class="form-control required"><br>
                                <br>
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

        #box1 {
            display: none;
        }

        #box2 {
            display: none;
        }
    </style>
@endsection
