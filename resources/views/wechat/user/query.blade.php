@extends('master')

@section('title', '用户管理')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">用户管理</div>
                    <div class="panel-body">
                        <a href="{{ URL::route('wechat.user.fetch')}}" class="btn btn-success">获取公众号粉丝到本地</a>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="col-lg-1">openid</th>
                                <th class="col-lg-2">微信名称</th>
                                <th class="col-lg-2">微信头像</th>
                                <th class="col-lg-2">关注状态</th>
                                <th class="col-lg-2">关注时间</th>
                                <th class="col-lg-2">取消关注时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userlist as  $user)
                                <tr>
                                    <td>{{$user->openid}}</td>
                                    <td>{{$user->nickname}}</td>
                                    <td><img src="{{$user->headimgurl}}" class="headimgurl"></td>
                                    <td>{{$user->subscribe == 1 ? '已关注':'未关注'}}</td>
                                    <td>{{$user->subscribe == 1 ? $user['subscribe_time'] :''}}</td>
                                    <td>{{$user->subscribe == 1 ? '' :$user['status_time']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <ul class="pager">
                                <li><a href="{{URL::route('wechat.user.list', 1)}}">首页</a></li>
                                @if($page > 1)
                                <li><a href="{{URL::route('wechat.user.list', $page-1)}}">上一页</a></li>
                                @endif
                            @if($page < $pages)
                                <li><a href="{{URL::route('wechat.user.list', $page+1)}}">下一页</a></li>
                            @endif
                                <li><a href="{{URL::route('wechat.user.list', $pages)}}">尾页</a></li>
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
