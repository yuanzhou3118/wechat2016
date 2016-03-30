@extends('master')

@section('title', 'relationMessage')

@section('content')
	<style>
		td{text-align: center;}
		.line_height{line-height: 35px;text-align: right;}
		.colorred{color:red;}
		.modal-header{text-align: center;}
		.modal-body{text-align: center;}
		.modal.fade.in {top: 20%;}
	</style>
	<div class="container">
		<a class="btn btn-default" href="/wechat/relation_messages"><span class="glyphicon glyphicon-chevron-left"></span>返回</a>
		<h3>编辑信息</h3>
		<hr>
		<form action="/wechat/edit_save" method="post">
			<div class="row form-group">
				<div class="col-md-2 line_height">
					员工号：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="employee_id" value="{{$message[0]->no}}" disabled>
				</div>
			</div>
			<div class="row  form-group">
				<div class="col-md-2 line_height">
					姓名：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="name" value="{{$message[0]->name}}">
				</div>
			</div>
			<div class="row  form-group">
				<div class="col-md-2 line_height">
					部门：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="department" value="{{$message[0]->department}}">
				</div>
			</div>
			<div class="row  form-group">
				<div class="col-md-2 line_height">
					城市：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="city" value="{{$message[0]->city}}">
				</div>
			</div>
			<div class="row  form-group">
				<div class="col-md-2 line_height">
					生日：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="birthday" value="{{$message[0]->birthday}}">
				</div>
			</div>
			<div class="row  form-group">
				<div class="col-md-2 line_height">
					性别：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="sex" value="{{$message[0]->sex}}">
				</div>
			</div>
			<div class="row  form-group">
				<div class="col-md-2 line_height">
					电话：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="phone" value="{{$message[0]->phone}}">
				</div>
			</div>
			<div class="row  form-group">
				<div class="col-md-2 line_height">
					身份证：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="id_card" disabled value="{{$message[0]->id_card}}">
				</div>
			</div>
			<input type="hidden" name="id" value="{{$message[0]->id}}">
			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			<div class="row">
				<div class="col-md-offset-2 col-md-6">
					<div class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">提交</div>
				</div>
			</div>
			<div class="modal fade" id="myModal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h3>确认提交更改？</h3>
						</div>
						<div class="modal-body">
							<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
							<input type="submit" class="btn btn-primary" value="确定">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<hr>






	<script>
		$(".edit_submit").click(function(e){
			e.preventDefault();
		})


	</script>




@endsection
