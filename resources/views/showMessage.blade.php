@extends('master')

@section('title', 'showMessage')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">自定义菜单</div>
                    <div class="panel-body">
                        <form method="post" action="/wechat/findmessage" class="form-group">
                            {{csrf_field()}}
                            <div class="col-md-12 form-group">
                                <select class="form-control message_type" name="mtype">
                                    <option value="image">图片</option>
                                    <option value="text">文本</option>
                                    <option value="voice">语音</option>
                                    <option value="video">视频</option>
                                </select>
                            </div><br>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control input-group-lg timestart" placeholder="起始日期"
                                       name="timestart">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control input-group-lg timeend" placeholder="截止日期"
                                       name="timeend">
                            </div>
                            <div class="col-md-2 form-group">
                                <input type="submit" value="查询" class="btn btn-default btn-block">
                            </div>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <td>messages_id</td>
                <td>type</td>
                <td>messages</td>
                <td>guid</td>
                <td>open_id</td>
                <td>account_id</td>
                <td>create_time</td>
                <td>option</td>
            </tr>
            <tbody id="movies">
            @foreach($message as $message)
                <tr>
                    <td>{{$message->messages_id}}</td>
                    <td>{{$message->type}}</td>
                    <td>{{$message->messages}}</td>
                    <td>{{$message->guid}}</td>
                    <td>{{$message->open_id}}</td>
                    <td>{{$message->account_id}}</td>
                    <td>{{$message->create_time}}</td>
                    <td>
                        <div class="btn btn-default disabled"
                             onclick="wechat_message_delete({{$message->messages_id}})">删除
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </thead>
        </table>

        <div class="holder"></div>
        <div class="btn btn-default message_refresh">刷新</div>
    </div>

    <hr>

    <script type="text/javascript">
        function wechat_message_delete(id) {
            $.ajax({
                url: "/wechat/deletemessage/" + id,
                type: "GET",
                success: function () {
                    console.log("delete success");
                    window.location.reload();
                },
                error: function () {
                    alert("delete fail");
                }
            })
        }

        $(function () {
            $("input.timestart").datepicker({
                dateFormat: "yy-mm-dd",
                monthNamesShort: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"]
            });
            $("input.timeend").datepicker({
                dateFormat: "yy-mm-dd",
                monthNamesShort: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"]
            });
            $(".message_refresh").click(function () {
                window.location.reload();
            });

            $("div.holder").jPages({
                containerID: "movies",
                previous: "前一页",
                next: "后一页",
                perPage: 10,
                delay: 20
            });

        })
    </script>
@endsection
