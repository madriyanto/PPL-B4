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
		border: 5px solid;
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
				<a href="<?php echo base_url('index.php/Login/index'); ?>"><li class="navbar-brand">Login SSO</li></a>
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
		<h4 id="font2">Please fill your email here if you forgot the password. We will give a new password and please to change your password</h4><br>
		<form role="form" name="myForm" action="<?php echo base_url('index.php/ForgetPassword'); ?>" method="post" accept-charset="utf-8">
			<?php echo validation_errors(); ?>
			<div class="form-group">
				<label for="text">Email Account :</label>
				<input type="text" class="form-control" name="email" required/>
			</div>
			<div class="checkbox">
				<label><input type="checkbox" id="check"> I'm sure that my email is right</label>
			</div>
			<button class="btn btn-primary btn-lg" type="submit" value="Submit" id="btn" disabled="true">Send</button>
		</form>
    </div>
</div>
