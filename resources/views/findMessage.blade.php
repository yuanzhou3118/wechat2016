@extends('master')

@section('title', 'showMessage')

@section('content')
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
                </tr>
            @endforeach
            </tbody>
            </thead>
   		</table>

		<div class="holder"></div>
   		<div class="btn btn-default message_refresh">刷新</div>
   	</div>

   	<script type="text/javascript">
   	$(function(){
   		$(".message_refresh").click(function(){
   			window.location.reload();
   		});

        $("div.holder").jPages({
			containerID : "movies",
			previous : "前一页",
			next : "后一页",
			perPage : 10,
			delay : 20
        });

   	})
   	</script>
@endsection
