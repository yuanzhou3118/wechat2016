@extends('master')
@section('title', '员工管理')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">员工管理</div>
                    <div class="panel-body">
                        <a href="{{ URL::route('import.employee')}}" class="btn btn-success">导入欧家员工</a>
                        <a href="{{ URL::route('import.dealer')}}" class="btn btn-success">导入经销商用户</a>
                        <a href="{{ URL::route('import.tester')}}" class="btn btn-success">导入测试用户</a>
                        <a href="{{ URL::route('wechat.employee.create')}}" class="btn btn-info">新增员工</a><br>
                        <form action="{{ URL::route('import.search',1)}}" method="post" class="form-group"
                              style="margin-top: 15px;">
                            {{csrf_field()}}
                            <div class="col-md-4 form-group">
                                <input class="form-control required" type="text" name="id_card_search"
                                       placeholder="搜索证件号">
                            </div>
                            <div class="col-md-4 form-group">
                                <select title="" class="form-control" name="type">
                                    <option value="">不限</option>
                                    <option value="1">欧家员工</option>
                                    <option value="2">经销商</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">查询</button>
                        </form><br>

                        {{--<a href="{{ URL::route('import.search')}}" class="btn btn-success">搜索</a>--}}
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="col-lg-1">证件号</th>
                                <th class="col-lg-2">中文名</th>
                                <th class="col-lg-2">英文名</th>
                                <th class="col-lg-2">部门</th>
                                <th class="col-lg-2">用户组</th>
                                <th>操作</th>
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
                                    <td class="col-lg-2">
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
                            <li><a href="{{URL::route('wechat.employee.list', 1)}}">首页</a></li>
                            @if($page > 1)
                                <li><a href="{{URL::route('wechat.employee.list', $page-1)}}">上一页</a></li>
                            @endif
                            @if($page < $pages)
                                <li><a href="{{URL::route('wechat.employee.list', $page+1)}}">下一页</a></li>
                            @endif
                            <li><a href="{{URL::route('wechat.employee.list', $pages)}}">尾页</a></li>
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
@endsection
