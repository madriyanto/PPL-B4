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
	.forgetForm {
		background-color: white; 
		border: 5px solid #a1a1a1;
		border-radius: 25px;
		padding-left: 40px;
		padding-right: 40px;
		margin: 0 auto;
		margin-top: 3%;
	}

	#font1{
		text-align: center;
    	font-size: 30px;
	}
	
	#font2{
		text-align: justify;
    	font-size: 16px;
	}
	.row{
		margin-right: 0px;
	}
	.navbar-bottom {
	    margin-bottom: 0px;
	    bottom: 0;
	    position: fixed;
	    width: 100%;
  	}

	@media screen and (max-width:768px){
		.forgetForm{
			width: 80%;
		}
	}

	@media screen and (max-height:600px){
		.row{
			height: 90%;
		}

		.forgetForm{
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
    <div class="col-sm-4 forgetForm">
		<h2 id="font1"><b>Reset Password</b></h2><br>
		<h4 id="font2">Please fill form below to update your password</h4><br>
		<form role="form" name="myForm" action="<?php echo base_url('updatepassword/update/'.$encryption); ?>" method="post" accept-charset="utf-8">
			<?php if (validation_errors() != null) { ?>
			<div class="alert alert-danger" role="alert"><?php echo validation_errors(); ?></div>
			<?php } ?>
			<?php if ($result != '') { ?>
			<div class="alert alert-success" role="alert"><?php echo $result; ?></div>
			<?php } ?>
			<div class="form-group">
				<label for="text">New Password :</label>
				<input type="password" class="form-control" name="newpass" required/>
			</div>
			<div class="form-group">
				<label for="text">New Password Confirmation :</label>
				<input type="password" class="form-control" name="passconf" required/>
			</div>
			<button class="btn btn-primary btn-lg" type="submit" value="Submit" id="btn">Update</button>
		</form>
    </div>
</div>
