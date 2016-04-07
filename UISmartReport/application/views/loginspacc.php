<style>
	body {
    	background-color: #E4E4E4;
  	}

	.btn-primary {
		background: #FFFF00;
		color: black;
		border-style: none;
		font-size: 25px;
		padding : 15px 30px 14px 30px;
    	margin  : 0px auto;
    	display : block;
    	width   : 150px;
	}
	
	.loginForm {
		background-color: white; 
		border: 5px solid #a1a1a1;
		border-radius: 25px;
		padding-left: 40px;
		padding-right: 40px;
		margin: 0 auto;
		margin-top: 1%;
	}

	#font1{
		text-align: center;
    	font-size: 40px;
	}
	#font2{
		text-align: justify;
    	font-size: 16px;
	}
	.row{
		margin-right: 0px;
	}
	
	@media screen and (max-width:768px){
		.loginForm{
			width: 80%;
			margin-bottom: 20%;
		}
	}

	@media screen and (max-height:500px){
		.row{
			height: 90%;
		}

		.loginForm{
			margin-bottom: 10%;
		}

	}

</style>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
       		 <div class="navbar-brand">UI Smart Report
       		 </div>

       		 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>                        
      		 </button>
		</div>		
		
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				<a href="<?php echo base_url('login'); ?>"><li class="navbar-brand">Login SSO</li></a>
				<li class="navbar-brand">About Us</li>
			</ul>
		</div>
	</div>
</nav>
<br><br><br><br>
<div class="row">
	<div class="col-sm-4"></div>
    <div class="col-sm-4 loginForm">
    	<br>
		<p id="font1"><b>Login</b></p>
		<p id="font2">Please fill your username and password</p><br>
		<?php if ($result != '') { ?>
		<div class="alert alert-danger" role="alert"><?php echo $result; ?></div>
		<?php } ?>
		<form role="form" name="myForm" action="<?php echo base_url('loginsp'); ?>" method="post" accept-charset="utf-8">
			<div class="form-group">
				<label for="text">Username</label>
				<input type="text" class="form-control" name="username" value="<?php echo set_value('username'); ?>" required/>
			</div>
			<div class="form-group">
				<label for="text">Password</label>
				<input type="password" class="form-control" name="password" required/>
			</div>
			Forgot your password? Click <a href="<?php echo base_url('forgetpassword'); ?>">here</a><br><br>
			<button class="btn btn-primary btn-lg" type="submit" value="Submit">Login</button>
		</form>
    </div>
</div>
