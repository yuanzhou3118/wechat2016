@extends('master')

@section('title', '自定义菜单')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">自定义菜单</div>
                    <div class="panel-body">
                        <a href="{{ URL::route('wechat.menu.create') }}" class="btn btn-success">新增菜单</a>
                        @if(Session::has('message'))
                            <p class="pull-right text-success">{{Session::get('message')}}</p>
                        @endif
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="col-lg-1">菜单序号</th>
                                <th class="col-lg-1">菜单名称</th>
                                <th class="col-lg-1">菜单级别</th>
                                <th class="col-lg-1">菜单类型</th>
                                <th class="col-lg-1">视图链接</th>
                                <th class="col-lg-1">菜单事件</th>
                                <th class="col-lg-1">编辑</th>
                                <th class="col-lg-1">删除</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($button as  $item)
                                <tr>
                                    <td>{{$item->sort_num}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->is_button ? '一级菜单' : '二级菜单'}}</td>
                                    <td>{{$item->type or null}}</td>
                                    <td>{{$item->url or null}}</td>
                                    <td>{{$item->key  or null}}</td>
                                    <td class="col-lg-1">
                                        <a href="{{ URL::route('wechat.menu.edit', $item->id) }}"
                                           class="btn btn-success">编辑</a>
                                    </td>
                                    <td class="col-lg-1">
                                        <form action="{{ URL::route('wechat.menu.delete', $item->id) }}" method="POST"
                                              style="display: inline;">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-danger">删除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <form action="{{ URL::route('wechat.menu.push') }} " method="post" class="form-group">
                            {{csrf_field()}}
                            <input type="submit" value="提交" class="btn btn-primary form-control"><br>
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
