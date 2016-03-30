@extends('master')
@section('title', '员工管理')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">员工管理</div>
                    <div class="panel-body">
                        <a href="{{ URL::route('wechat.employee.list',1)}}" class="btn btn-success">返回</a>
                        <form action="{{ URL::route('import.search',1)}}" method="post" class="form-group"
                              style="margin-top: 15px;">
                            {{csrf_field()}}
                            <div class="col-md-4 form-group">
                                <input class="form-control required" type="text" value="{{$search_id_card or null}}"
                                       name="id_card_search" placeholder="搜索证件号">
                            </div>
                            <div class="col-md-4 form-group">
                                <select title="" class="form-control" name="type">
                                    <option value="">不限</option>
                                    <option value="1">欧家员工</option>
                                    <option value="2">经销商</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">查询</button>
                        </form>
                        {{--<a href="{{ URL::route('import.search')}}" class="btn btn-success">搜索</a>--}}
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="col-lg">员工号</th>
                                <th class="col-lg">中文名</th>
                                <th class="col-lg">英文名</th>
                                <th class="col-lg">部门</th>
                                <th class="col-lg">用户组</th>
                                <th class="col-lg">所在地</th>
                                <th class="col-lg">身份证</th>
                                <th class="col-lg">性别</th>
                                <th class="col-lg">手机</th>
                                <th class="col-lg">邮箱</th>
                                <th class="col-lg">生日</th>
                                <th class="col-lg">区域</th>
                                <th class="col-lg">负责人</th>
                                <th class="col-lg">状态</th>
                                <th class="col-lg">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as  $employee)
                                <tr>
                                    <td>{{$employee->id_card}}</td>
                                    <td>{{$employee->cn_name}}</td>
                                    <td>{{$employee->en_name}}</td>
                                    <td>{{$employee->department}}</td>
                                    <td>{{$employee->type == 1 ? '欧家员工':'经销商'}}</td>
                                    <td>{{$employee->txt_1}}</td>
                                    <td>{{$employee->txt_2}}</td>
                                    <td>{{$employee->txt_3}}</td>
                                    <td>{{$employee->txt_4}}</td>
                                    <td>{{$employee->txt_5}}</td>
                                    <td>{{$employee->txt_6}}</td>
                                    <td>{{$employee->txt_7}}</td>
                                    <td>{{$employee->txt_8}}</td>
                                    <td>{{$employee->status ? '可绑定':'不可绑定'}}</td>
                                    <td class="col-lg">
                                        <a href="{{ URL::route('wechat.employee.edit', $employee->id) }}"
                                           class="btn btn-success">编辑</a>
                                        <form action="{{ URL::route('wechat.employee.delete', $employee->id) }}" method="POST"
                                              style="display: inline;">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-danger">删除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <ul class="pager">
                            <form action="{{URL::route('import.search', 1)}}" method="post" class="form-group" style="display: inline-block;">
                                {{csrf_field()}}
                                <input type="hidden" name="id_card_search" value="{{$search_id_card or null}}">
                                <input type="hidden" name="type" value="{{$search_type or null}}">
                                <li>
                                    <button class="btn btn-default">首页</button>
                                </li>
                            </form>

                            @if($page > 1)
                                <form action="{{URL::route('import.search', $page-1)}}" method="post"
                                      class="form-group" style="display: inline-block;">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id_card_search" value="{{$search_id_card or null}}">
                                    <input type="hidden" name="type" value="{{$search_type or null}}">
                                    <li>
                                        <button class="btn btn-default">上一页</button>
                                    </li>
                                </form>
                            @endif
                            @if($page < $pages)
                                <form action="{{URL::route('import.search', $page+1)}}" method="post"
                                      class="form-group" style="display: inline-block;">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id_card_search" value="{{$search_id_card or null}}">
                                    <input type="hidden" name="type" value="{{$search_type or null}}">
                                    <li>
                                        <button class="btn btn-default">下一页</button>
                                    </li>
                                </form>
                            @endif
                            <form action="{{URL::route('import.search', $pages)}}" method="post" class="form-group" style="display: inline-block;">
                                {{csrf_field()}}
                                <input type="hidden" name="id_card_search" value="{{$search_id_card or null}}">
                                <input type="hidden" name="type" value="{{$search_type or null}}">
                                <li>
                                    <button class="btn btn-default">尾页</button>
                                </li>
                            </form>
                        </ul>
                        <p class="text-center">当前第{{$page}}页，总共{{$pages}}页</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .headimgurl {
            width: 50px;
            height: 50px;
        }

        #text li {
            display: none;
        }
    </style>
    <script>
        $(function () {
            $('select').val({{$search_type}}).attr("selected", true)
        })

    </script>
@endsection
