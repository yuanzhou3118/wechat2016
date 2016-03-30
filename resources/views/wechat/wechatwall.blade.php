@extends('master')

@section('title', '欢迎')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">用户列表</div>
                    <div class="panel-body">
                        <form action="{{ URL::route('wallupdate') }} " method="post" class="form-group" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{--<label class="control-label">父级菜单:</label><select class="form-control" name="fa-menu"><option>公司活动</option><option>菜单</option></select><br>--}}
                            <label class="control-label">活动主题:</label><input type="text" name="theme"
                                                                             class="form-control required"><br>
                            <label class="control-label">关键词:</label><input type="text" name="keyword"
                                                                            class="form-control required"><br>
                            <label class="control-label">主办方:</label><input type="text" name="title"
                                                                            class="form-control required"><br>
                            {{--<label class="control-label">主办个人&单位LOGO:</label><input name="logo" class="file"--}}
                                                                                    {{--type="file">--}}
                            {{--<br>--}}
                            <label class="control-label">选择二维码:</label><input type="file" name="pic">
                            <br>
                            <br>
                            <label class="control-label">背景:</label>
                            <div class="controls">
                                <img src="{{asset('/img/web1.jpg')}}" style="width: 100px;" name="bg_img">

                            </div>
                            <br>
                            <br>

                            <input type="submit" value="保存" class="btn btn-primary form-control">
                        </form>
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
            .controls {
                margin-left: 180px;
            }


        </style>

@endsection
