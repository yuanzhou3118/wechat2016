@extends('master')

@section('title', '自定义菜单维护')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">自定义菜单</div>
                    <div class="panel-body">
                        <form action="{{ URL::route('menu') }} " method="post" class="form-group">
                            <a href="{{ URL::route('wallupdate') }}" class="btn btn-success">添加微信墙</a>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="col-lg-2">活动主题</th>
                                    <th class="col-lg-2">关键词</th>
                                    <th class="col-lg-2">参与人数</th>
                                    <th class="col-lg-2">状态</th>
                                    <th class="col-lg-2">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($walls as  $wall)

                                    <tr>
                                        <td>{{$wall['theme']}}</td>
                                        <td>{{$wall['keyword']}}</td>
                                        <td>{{''}}</td>
                                        <td>{{''}}</td>
                                        <td>{{''}}</td>
                                        <td class="col-lg-1">
                                            <a href="{{ URL('wechat/'.$wall['id'].'/editmenu') }}"
                                               class="btn btn-success">编辑</a>
                                        </td>
                                        <td class="col-lg-1">
                                            <a href="{{ URL('wechat/'.$wall['id'].'/wechatwallpage') }}"
                                               class="btn btn-success">页面</a>
                                        </td>
                                        <td class="col-lg-1">
                                            <form action="{{ URL('wechat/'.$wall['id']) }}" method="POST"
                                                  style="display: inline;">
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-danger">删除</button>
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
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
