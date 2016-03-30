@extends('master')

@section('title', '新增事件')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        新增事件
                    </div>
                    <div class="panel-body">
                        <a href="{{URL::route('wechat.event.manage')}}"
                           class="btn btn-success">返回</a>
                    </div>
                    <div class="panel-body">
                        <form action="{{ URL::route('wechat.event.create.do') }} " method="post"
                              class="form-group">
                            {{csrf_field()}}
                            <label class="control-label">事件名称:</label><input title="事件名称" type="text" name="key"
                                                                             value="{{$event->key  or null}}"
                                                                             class="form-control required"><br>
                            <label class="control-label">菜单事件:</label>
                            @if($event->is_menu)
                                <input title="菜单事件" type="checkbox" name="is_menu" checked="checked"
                                       class="form-control required">
                            @else
                                <input title="菜单事件" type="checkbox" name="is_menu" class="form-control required">
                            @endif
                            <br>
                            <label class="control-label">事件类型:</label>
                            <select name="type" title="事件类型" class="form-control required">
                                @foreach(config('common.wechat_menu_event_type') as $item)
                                    @if($event->type == $item)
                                        <option value="{{$item}}" selected="selected">{{$item}}</option>
                                    @else
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <br>
                            <label class="control-label">内容:</label>
                            <textarea title="内容" name="text" class="form-control required" rows="3">
{{$event->text  or null}}
                            </textarea><br>
                            <label class="control-label">标题:</label>
                            <textarea title="标题" name="title" class="form-control required" rows="3">
{{$event->title  or null}}
                            </textarea>
                            <br>
                            <label class="control-label">描述:</label>
                            <textarea title="描述" name="description" class="form-control required" rows="3">
{{$event->description  or null}}
                            </textarea><br>
                            <label class="control-label">图片链接:</label><input title="图片链接" type="text" name="image"
                                                                             value="{{$event->image  or null}}"
                                                                             class="form-control required"><br>
                            <label class="control-label">图文链接:</label><input title="图文链接" type="text" name="url"
                                                                             value="{{$event->url  or null}}"
                                                                             class="form-control required"><br>
                            <label class="control-label">素材ID:</label><input title="素材ID" type="text" name="media_id"
                                                                             value="{{$event->media_id  or null}}"
                                                                             class="form-control required"><br>
                            <input type="submit" value="新增" class="btn btn-primary form-control">
                            <label>{{$result or ''}}</label>
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
