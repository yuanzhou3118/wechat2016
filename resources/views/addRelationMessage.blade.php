@extends('master')

@section('title', 'relationMessage')

@section('content')
	<style>
		td{text-align: center;}
		.line_height{line-height: 35px;text-align: right;}
		.colorred{color:red;}
	</style>
	<div class="container">
		<a class="btn btn-default" href="/wechat/relation_messages"><span class="glyphicon glyphicon-chevron-left"></span>返回</a>
		<h3>添加员工</h3>
		<hr>
		<form action="/wechat/add_user" method="post" onsubmit="return abc()">
			<div class="row form-group">
				<div class="col-md-2 line_height">
					员工号：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="employee_id">
				</div>
				<div class="col-md-3 line_height colorred">
					必须输入员工号或者身份证
				</div>
			</div>
			<div class="row  form-group">
				<div class="col-md-2 line_height">
					姓名：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="name">
				</div>
			</div>
			<div class="row  form-group">
				<div class="col-md-2 line_height">
					部门：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="department">
				</div>
			</div>
			<div class="row  form-group">
				<div class="col-md-2 line_height">
					Base地点：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="city">
				</div>
			</div>
			<div class="row  form-group">
				<div class="col-md-2 line_height">
					生日：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="birthday">
				</div>
			</div>
			<div class="row  form-group">
				<div class="col-md-2 line_height">
					性别：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="sex">
				</div>
			</div>
			<div class="row  form-group">
				<div class="col-md-2 line_height">
					电话：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="phone">
				</div>
			</div>
			<div class="row  form-group">
				<div class="col-md-2 line_height">
					身份证：
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="id_card">
				</div>
			</div>
			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			<div class="row">
				<div class="col-md-offset-2 col-md-6">
					<input type="submit" class="btn btn-primary btn-block add_submit">
				</div>
			</div>
		</form>
	</div>

	<script>
		var validate_id = function(id){
			var reg = /(\d{15}|\d{18})/;
			return reg.test(id);
		}

		function abc() {
			if ($("input[name='id_card']").val() == '' && $("input[name='employee_id']").val() == '') {
				alert("必须输入员工号或者身份证");
				return false;
			}
			var idc = $("input[name='id_card']").val()
			if (!validate_id(idc)) {
				alert("身份证格式不对");
				return false;
			}
			var is_exist;
			$.ajax({
				url: "/wechat/vali",
				type: "POST",
				async:false,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {id_card: idc},
				success: function (data) {
					if (data == 1) {
						alert("身份证已存在");
						is_exist = false;
					} else if(data == 0){
						alert("添加成功");
						is_exist = true;
					}
				},
				error:function(){
					alert("error");
				}
			});
			return is_exist;
		}

	</script>




@endsection
