@extends('master')

@section('title', '新增菜单')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><span>新增菜单</span></div>
                    <div class="panel-body"><a href="{{URL::route('wechat.menu.manage')}}"
                                                  class="btn btn-success">返回</a>
                    </div>
                    <div class="panel-body">
                        <form action="{{ URL::route('wechat.menu.create.do') }} " method="post" class="form-group">
                            {{csrf_field()}}
                            <label class="control-label">name:</label><input title="" type="text" name="name"
                                                                             class="form-control required"><br>
                            <label class="control-label">是否父级菜单:</label>
                            <select title="" class="form-control" name="is_button" id="fatherbutton" onclick="removeOption()">
                                <option value="1" selected="selected">是</option>
                                <option value="0">否</option>
                            </select><br>
                            <div class="button_father">
                                <label class="control-label">一级菜单顺序:</label>
                                <select title="" class="form-control  required" name="sort_father1">
                                    <option value="1" selected="selected">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select><br>
                            </div>
                            <div id="sonbutton" style="display: none">
                                <label class="control-label">一级菜单顺序:</label>
                                <select title="" class="form-control  required" name="sort_father2">
                                    <option value="">请选择</option>
                                    @foreach($is_button as $key => $is_button)
                                        <option value={{$key+1}}>{{$is_button['name']}}</option>
                                    @endforeach
                                </select><br>
                                <label class="control-label">二级菜单顺序:</label>
                                <select title="" class="form-control  required" name="sort_son">
                                    <option value="1" selected="selected">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select><br>
                                <label class="control-label">菜单类型:</label>
                                <select title="" class="form-control required" name="type">
                                        <option> </option>
                                    @foreach(config('common.wechat_event_type') as $item)
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <label class="control-label">url:</label><input title="" type="text" name="url"
                                                                                class="form-control required"><br>
                                <label class="control-label">key:</label>
                                <select title="" class="form-control" name="key">
                                    <option> </option>
                                    @foreach($menuId as $item)
                                            <option value="{{$item->key}}">{{$item->key}}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <input type="submit" value="新增" class="btn btn-primary form-control">
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
    <script>
        function removeOption() {
            if ($('#fatherbutton').val() == '1') {
                $('.button_father').css('display', 'block');
                $('#sonbutton').css('display', 'none');
            }
            else if ($('#fatherbutton').val() == '0') {
                $('.button_father').css('display', 'none');
                $('#sonbutton').css('display', 'block');
            }
        }
    </script>
@endsection
