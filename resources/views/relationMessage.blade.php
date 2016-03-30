@extends('master')

@section('title', 'relationMessage')

@section('content')
	<style>
		td{text-align: center;}
		.modal-header{text-align: center;}
		.modal-body{text-align: center;}
		.modal.fade.in {top: 20%;}
	</style>
	<div class="container">
		<h3>员工管理</h3>
		<hr>
		<div class="row">
			<div class="col-md-2">
				<div class="radio">
					<label>
						<input type="checkbox" class="radiobutton" name="radioAll"  value="0"  onclick="changeStyle(this)">解绑全选
					</label>
				</div>
			</div>
			<div class=" col-md-2">
				<a class="btn btn-default btn-block" href="/wechat/add_relation_messages">新增</a>
			</div>
			<div class=" col-md-2">
				<a class="btn btn-default btn-block" href="/import/employee">导入员工</a>
			</div>
			<div class=" col-md-2">
				<a class="btn btn-default btn-block" href="/import/dealer">导入经销商</a>
			</div>
			<div class=" col-md-2">
				<div class="btn btn-default btn-block">导出</div>
			</div>
		</div>

		<div class="row">
			<table class="table table-bordered">
				<tr>
					<td></td>
					<td>员工号</td>
					<td>姓名</td>
					<td>部门</td>
					<td>城市</td>
					<td>生日</td>
					<td>性别</td>
					<td>电话</td>
					<td>身份证</td>
					<td>用户组</td>
					<td>微信ID</td>
					<td>操作</td>
				</tr>
				<tbody id="movies">
				@foreach($message as $message)
					<tr>
						<td>
							<input type="checkbox" name="checkon">
						</td>
						<td>{{$message->no}}</td>
						<td>{{$message->name}}</td>
						<td>{{$message->department}}</td>
						<td>{{$message->city}}</td>
						<td>{{$message->birthday}}</td>
						<td>{{$message->sex}}</td>
						<td>{{$message->phone}}</td>
						<td>{{$message->id_card}}</td>
						<td>{{$message->type}}</td>
						<td>{{$message->wechat_id}}</td>
						<td>
							<div class="btn btn-default delete_user col-md-4" data-toggle="modal" data-target="#myModal">删除</div>
							<div class="btn btn-default col-md-4">解绑</div>
							<a class="btn btn-default col-md-4" type="submit" href="/wechat/edit_user/{{$message->id}}">编辑</a>

							<div class="modal fade" id="myModal">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h3>确认提交更改？</h3>
										</div>
										<div class="modal-body">
											<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
											<div class="btn btn-primary" onclick="delete_user({{$message->id}},this)">确定</div>
										</div>
									</div>
								</div>
							</div>

						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			<div class="holder"></div>
		</div>
	</div>

	<script>
		function changeStyle(obj){
			if($(obj).val()==1){
				$(obj).attr("value","0");
				$(obj).removeAttr("checked");
				$("input[name='checkon']").attr("checked",false);
			} else {
				$(obj).val("1");
				$(obj).attr("checked","checked");
				$("input[name='checkon']").attr("checked","checked");
			}
		}

		function delete_user(id,obj){
			$.ajax({
				url:'/wechat/delete_user',
				type:"POST",
				data:{'id':id},
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success:function(data){
					if(data){
						alert("删除成功");
					}
					window.location.reload();
				},
				error:function(){
					alert("error");

				}
			})
		}

		$("div.holder").jPages({
			containerID : "movies",
			previous : "前一页",
			next : "后一页",
			perPage : 10,
			delay : 20
		});


	</script>




@endsection
