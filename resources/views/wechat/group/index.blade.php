@extends('master')

@section('title', '用户组')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">用户组</div>
                    <div class="panel-body">
                        <form action="{{ URL::route('wechat.group.manage') }} " method="post" class="form-group">
                            {{csrf_field()}}
                            <a href="{{ URL::route('wechat.group.create') }}" class="btn btn-success">新增用户组</a>
                            <a href="{{ URL::route('wechat.group.pull') }}" class="btn btn-success">同步更新</a>
                            @if(Session::has('message'))
                                <p class="pull-right text-success">{{Session::get('message')}}</p>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="col-lg-3">用户组id</th>
                                    <th class="col-lg-3">用户组名称</th>
                                    <th class="col-lg-3">人数</th>
                                    <th class="col-lg-2">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($groups as  $group)
                                    <tr>
                                        <td>{{$group->group_id}}</td>
                                        <td>{{$group->name}}</td>
                                        <td>{{$group->count}}</td>
                                        @if($group->group_id >= 100)
                                            <td class="col-lg-1">
                                                <a href="{{ URL::route('wechat.group.edit', $group->id)}}"
                                                   class="btn btn-success">编辑</a>
                                                <form action="{{ URL::route('wechat.group.delete', $group->id) }}" method="POST"
                                                      style="display: inline;">
                                                    {{csrf_field()}}
                                                    <button type="submit" class="btn btn-danger">删除</button>
                                                </form>
                                            </td>
                                            @else
                                            <td class="col-lg-1">
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
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
@endsection
