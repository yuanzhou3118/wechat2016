@extends('master')

@section('title', '编辑用户组')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>编辑用户组</span>
                    </div>
                    <div class="panel-body">
                        <div class="panel-heading"><a href="{{URL::route('wechat.group.manage')}}"
                                                      class="btn btn-success">返回</a>
                        </div>
                        <div class="panel-body">
                            <form action="{{ URL::route('wechat.group.edit.do', $group->id) }} " method="post"
                                  class="form-group">
                                {{csrf_field()}}
                                <label class="control-label">用户组名称:</label><input title="" type="text" name="name"
                                                                                 value="{{$group->name  or null}}"
                                                                                 class="form-control required"><br>
                                <input type="submit" value="保存"
                                       class="btn btn-primary form-control"><label>{{$result or ''}}</label>
                            </form>
                        </div>
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
