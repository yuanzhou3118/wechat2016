<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
    <link href="{{URL::asset('assets/css/jquery-ui.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('assets/css/jPages.css')}}">
    <!-- script -->
    <script src="{{URL::asset('assets/javascript/jquery-1.12.2.min.js')}}"></script>
    <script src="{{URL::asset('assets/javascript/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('assets/javascript/jquery-ui.min.js')}}"></script>
    <script src="{{URL::asset('assets/javascript/jPages.min.js')}}"></script>
</head>
<body>
<nav class="navbar navbar-inverse"  role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- 导航条 -->
            <a class="navbar-brand" href="{{URL::route('admin.dashboard')}}">主页</a>
        </div>
        <div class="collapse navbar-collapse navbar-inverse" id="bs-example-navbar-collapse-1">
            <ul class="nav  navbar-nav">
                <li><a href="{{ URL::route('wechat.menu.manage') }}">自定义菜单</a></li>

                <li><a href="{{ URL::route('wechat.event.manage') }}">事件维护</a></li>
                <li><a href="{{ URL::route('wechat.group.manage')}}">用户组</a></li>
                <li><a href="{{ URL::route('wechat.user.list', 1)}}">用户管理</a></li>
                <li><a href="{{ URL::route('wechat.employee.list', 1)}}">员工管理</a></li>
                {{--<li><a href="{{ URL::route('admin.setting')}}">系统设置</a></li>--}}
                {{--<li><a href="{{ URL('wechat/wechatwall')}}">微信墙</a></li>--}}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{URL::route('admin.logout')}}">登出</a></li>
            </ul>
        </div>
    </div>
</nav>
{{--<ul class="nav nav-pills nav-stacked" style="float:left;width: auto;text-align: center;">--}}
{{--<li><a href="{{ URL::route('wechat.menu.manage') }}">自定义菜单</a></li>--}}
{{--<li><a href="{{ URL::route('wechat.event.manage') }}">事件维护</a></li>--}}
{{--<li><a href="{{ URL::route('wechat.group.manage')}}">用户组</a></li>--}}
{{--<li><a href="{{ URL::route('wechat.user.list', 1)}}">用户管理</a></li>--}}
{{--<li><a href="{{ URL::route('wechat.employee.list', 1)}}">员工管理</a></li>--}}
{{--<li><a href="{{ URL('wechat/wechatwall')}}">微信墙</a></li>--}}
{{--</ul>--}}
<style type="text/css">
    /* Custom Styles */
    .navbar-brand{
        font-weight: bolder;
    }
    ul.nav-tabs {
        width: 140px;
        margin-top: 20px;
        border-radius: 4px;
        border: 1px solid #ddd;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067);
    }

    ul.nav-tabs li {
        margin: 0;
        border-top: 1px solid #ddd;
    }

    ul.nav-tabs li:first-child {
        border-top: none;
    }

    ul.nav-tabs li a {
        margin: 0;
        padding: 8px 16px;
        border-radius: 0;
    }

    ul.nav-tabs li.active a, ul.nav-tabs li.active a:hover {
        color: #fff;
        background: #0088cc;
        border: 1px solid #0088cc;
    }

    ul.nav-tabs li:first-child a {
        border-radius: 4px 4px 0 0;
    }

    ul.nav-tabs li:last-child a {
        border-radius: 0 0 4px 4px;
    }
</style>

@yield('content')

</body>
</html>