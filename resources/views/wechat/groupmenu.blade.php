@extends('master')

@section('title', '个性化菜单维护')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">增加菜单</div>
                    <div class="panel-body">
                        <form  action="{{ URL::route('menu') }} " method="post" class="form-group">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="col-lg-4">排列顺序</th>
                                    <th class="col-lg-4">菜单名称</th>
                                    <th class="col-lg-4">菜单类型</th>
                                    <th class="col-lg-4">url</th>
                                    <th class="col-lg-4">key</th>
                                    <th class="col-lg-1">编辑</th>
                                    <th class="col-lg-1">删除</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($button as  $button)
                                    {
                                    <tr>
                                        <td>{{$button['sort_num']}}</td>
                                        <td>{{$button['name']}}</td>
                                        <td>{{$button['type'] or '顶级菜单'}}</td>
                                        <td>{{$button['url'] or null}}</td>
                                        <td>{{$button['key']  or null}}</td>
                                        <td class="col-lg-1">
                                            <a href="{{ URL('wechat/'.$button['id'].'/editmenu') }}" class="btn btn-success">编辑</a>
                                        </td>
                                        <td class="col-lg-1">
                                            <form action="{{ URL('wechat/'.$button['id']) }}" method="POST" style="display: inline;">
                                                {{--<input name="_method" type="hidden" value="DELETE">--}}
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-danger">删除</button>
                                            </form>
                                        </td>
                                    </tr>

                                    }
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
        #text li{display:none;}
    </style>
    {{--<script>--}}

    {{--window.onload = function() {--}}
    {{--var oSel = document.getElementById('myselect');--}}
    {{--var oUl = document.getElementById('text');--}}
    {{--var oLi = oUl.getElementsByTagName('li');--}}

    {{--oSel.onchange = function() {--}}
    {{--console.log(this.value);--}}
    {{--for(var i=0;i<oLi.length;i++)--}}
    {{--{--}}
    {{--oLi[i].style.display = 'none';--}}
    {{--}--}}
    {{--oLi[this.value-1].style.display = 'block';--}}
    {{--}--}}
    {{--}--}}

    {{--</script>--}}
@endsection
