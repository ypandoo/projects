<!DOCTYPE html>
<html>
<head>
	<link href="<?php echo base_url('res/css/bootstrap.css');?>" rel="stylesheet">

<title> Login </title>
<style type="text/css">
	html{
		margin-top: 90px !important;
	}
</style>
</head>
<body>

	<div class="container">
		<div class="row">
			
			<div class="col-md-4"></div>
			
			<div class="col-md-4">
				<div class="well">
				
					<label>para demo:par1=val1&par2=val2...</label>
					<input id="uname" type="text" name="username" value="" class="form-control" style="text-align:center;"/>
					<label>URL demo: user/getPersonalDetail</label>
					<input id="pass" type="text" name="password" value="" style="text-align:center;" class="form-control" />
					<br>
					<button id="btn_login" type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-lock"></span> test</button>
				    <br>
				    <label>output:</label>
					<input id="output" type="text" name="username" value="" class="form-control" style="text-align:center;" height = 200, size = 400/>
			<br>
				
			</div>
			<p style="text-align:center;"> Developed by Novi </p>
			<div class="col-md-4"></div>
			
		</div>
</div>
	</div>


	<script src="<?php echo  base_url('res/js/jquery.min.js');?>"></script>
	<script src="<?php echo  base_url('res/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo  base_url('res/js/bootbox.js');?>"></script>
	<script src="<?php echo  base_url('res/js/login.js');?>"></script>
	</body>
</html>