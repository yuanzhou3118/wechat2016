@extends('master')

@section('title', '删除员工')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        删除员工
                    </div>
                    <div class="panel-body">
                        <a href="{{URL::route('wechat.employee.list',1)}}"
                           class="btn btn-success">返回</a>
                    </div>
                    <p class="text-center">{{$result or ''}}</p><br><br>
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
