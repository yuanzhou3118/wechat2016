@extends('master')

@section('title', '编辑菜单')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>编辑菜单</span>
                    </div>
                    <div class="panel-body">
                        <div class="panel-heading"><a href="{{URL::route('wechat.menu.manage')}}"
                                                      class="btn btn-success">返回</a>
                        </div>
                        <div class="panel-body">
                            <form action="{{ URL::route('wechat.menu.edit.do',$menu->id) }} " method="post"
                                  class="form-group">
                                {{csrf_field()}}
                                <label class="control-label">菜单级别:</label><label
                                        class="form-control">{{$menu->is_button ? '一级菜单' : '二级菜单'}}</label><br>
                                <label class="control-label">菜单名称:</label><input title="" type="text" name="name"
                                                                                 value="{{$menu->name  or null}}"
                                                                                 class="form-control required"><br>
                                @if($menu->is_button)
                                    <label class="control-label">是否有二级菜单:</label>
                                    <select title="" class="form-control" name="button_id" id="button_id">
                                        <option value="1" selected="selected">有</option>
                                        <option value="0">无</option>
                                    </select><br>
                                @endif
                                <label class="control-label">菜单序号:</label><input title="" type="text" name="sort"
                                                                                 value="{{$menu->sort_num  or null}}"
                                                                                 class="form-control required"><br>
                                <label class="control-label">菜单类型:</label>
                                <select title="" class="form-control" name="type">
                                    <option value="">请选择</option>
                                    @foreach(config('common.wechat_event_type') as $item)
                                        @if($menu->type == $item)
                                            <option value="{{$item}}" selected="selected">{{$item}}</option>
                                        @else
                                            <option value="{{$item}}">{{$item}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <br>
                                <label class="control-label">视图链接:</label><input title="" type="text" name="url"
                                                                                 value="{{$menu->url  or null}}"
                                                                                 class="form-control required"><br>
                                <label class="control-label">菜单事件:</label>
                                <select title="" class="form-control" name="key">
                                    <option value="">请选择</option>
                                    @foreach($menuId as $item)
                                        @if($menu->key == $item->key)
                                            <option value="{{$item->key}}" selected="selected">{{$item->key}}</option>
                                        @else
                                            <option value="{{$item->key}}">{{$item->key}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <br>
                                <input type="submit" value="保存" class="btn btn-primary form-control">
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
    <script type="text/javascript">
        $(function () {
            @if($menu->is_button)
$('#button_id').val({{$menu->button_id}});
            @endif
        });
    </script>
@endsection
