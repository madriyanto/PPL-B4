<style>
	.btn-primary {
		background: #FFFF00;
		color: black;
		border-style: none;
		font-size: 25px;
		padding: 15px 50px;
		margin-left: 110px;
		margin-bottom: 30px;
		margin-top: 10px;
	}
	.forgetForm {
		border: 5px solid;
		padding-left: 40px;
		padding-right: 40px;
	}
	.special {
		text-align: justify;
	}
</style>
<script>
$(document).ready(function(){
	$('#check').click(function(){
		if($(this).attr('checked') == false){
			$('#btn').attr("disabled", "disabled");  
		}
		else {
			$('#btn').removeAttr("disabled");
		}
	});
});
</script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<div class="navbar-brand"><img src="<?php echo base_url('assets/images/makara.png'); ?>" class="img-rounded" alt="Cinque Terre" width="30" height="30"></div>
			<div class="navbar-brand">UI Smart Report</div>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<a href="<?php echo base_url('index.php/Login/index'); ?>"><li class="navbar-brand">Login SSO</li></a>
			<li class="navbar-brand">About Us</li>
		</ul>
	</div>
</nav>
<br><br><br><br>
<div class="row">
	<div class="col-sm-4"></div>
    <div class="col-sm-4 forgetForm">
		<h2 class="text-center"><b>Reset Password</b></h2><br>
		<h4 class="special">Please fill your email here if you forgot the password. We will give a new password and please to change your password</h4><br>
		<form role="form" name="myForm" action="<?php echo base_url('index.php/ForgetPassword'); ?>" method="post" accept-charset="utf-8">
			<?php echo validation_errors(); ?>
			<div class="form-group">
				<label for="text">Email Account :</label>
				<input type="text" class="form-control" name="email" required/>
			</div>
			<div class="checkbox">
				<label><input type="checkbox" id="check"> I'm sure that my email is right</label>
			</div>
			<button class="btn btn-primary btn-lg" type="submit" value="Submit" id="btn" disabled="true">Login</button>
		</form>
    </div>
</div>
