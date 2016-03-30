@extends('master')

@section('title', '获取公众号粉丝')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">获取公众号粉丝</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <h2>{{$result or ''}}</h2>
                            <a href="{{ URL::route('wechat.user.list', 1) }}" class="btn btn-success">返回</a>
                        </table>
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
