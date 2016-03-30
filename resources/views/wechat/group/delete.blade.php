@extends('master')

@section('title', '删除事件')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        删除事件
                    </div>
                    <div class="panel-body">
                        <a href="{{URL::route('wechat.group.manage')}}"
                           class="btn btn-success">返回</a>
                    </div>
                    <p class="text-center">{{$result or ''}}</p><br><br>
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
