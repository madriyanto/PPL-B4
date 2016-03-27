<style>
	.btn-primary {
		background: #FFFF00;
		color: black;
		border-style: none;
		font-size: 25px;
		padding: 15px 50px;
		margin-left: 110px;
		margin-bottom: 40px;
	}
	.loginForm {
		border: 5px solid;
		padding-left: 40px;
		padding-right: 40px;
	}
</style>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<div class="navbar-brand">
			<img src="<?php echo base_url('assets/images/makara.png'); ?>" class="img-rounded" alt="Cinque Terre" width="30" height="30"></div>
			<div class="navbar-brand">UI Smart Report</div>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<a href="<?php echo base_url('index.php/login/index'); ?>"><li class="navbar-brand">Login SSO</li></a>
			<li class="navbar-brand">About Us</li>
		</ul>
	</div>
</nav>
<br><br><br><br>
<div class="row">
	<div class="col-sm-4"></div>
    <div class="col-sm-4 loginForm">
		<h2 class="text-center"><b>Login</b></h2>
		<h4 class="text-center">Please fill your username and password</h4><br>
		<form role="form" name="myForm" action="<?php echo base_url('index.php/loginsp'); ?>" method="post" accept-charset="utf-8">
			<?php echo validation_errors(); ?>
			<div class="form-group">
				<label for="text">Username</label>
				<input type="text" class="form-control" name="username" value="<?php echo set_value('username'); ?>" required/>
			</div>
			<div class="form-group">
				<label for="text">Password</label>
				<input type="password" class="form-control" name="password" required/>
			</div>
			Forgot your password? Click <a href="<?php echo base_url('index.php/forgetpassword/index'); ?>">here</a><br><br>
			<button class="btn btn-primary btn-lg" type="submit" value="Submit">Login</button>
		</form>
    </div>
</div>
