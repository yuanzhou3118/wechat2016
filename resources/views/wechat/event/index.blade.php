@extends('master')

@section('title', '事件维护')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">事件列表</div>
                    <div class="panel-body">
                        <a href="{{ URL::route('wechat.event.create') }}" class="btn btn-success">新增事件</a>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="col-lg-1">事件名称</th>
                                <th class="col-lg-1">菜单事件</th>
                                <th class="col-lg-1">事件类型</th>
                                <th class="col-lg-3">内容</th>
                                <th class="col-lg-3">标题</th>
                                <th class="col-lg-3">素材ID</th>
                                <th class="col-lg-1">编辑</th>
                                <th class="col-lg-1">删除</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as  $event)
                                <tr>
                                    <td>{{$event->key}}</td>
                                    <td>{{$event->is_menu ? '是' :'否'}}</td>
                                    <td>{{$event->type}}</td>
                                    <td>{{$event->text or ''}}</td>
                                    <td>{{$event->title or ''}}</td>
                                    <td>{{$event->media_id or ''}}</td>
                                    <td class="col-lg-1">
                                        <a href="{{URL::route('wechat.event.edit', $event->id)}}"
                                           class="btn btn-success">编辑</a>
                                    </td>
                                    <td class="col-lg-1">
                                        <form action="{{ URL::route('wechat.event.delete', $event->id)}}" method="POST"
                                              style="display: inline;">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-danger">删除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
