<meta http-equiv="refresh" content="15;url=<?php echo base_url('post/view/'.$id); ?>" />
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
  	#mynavbar a{
	    color: #dfdbdb;
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
		if($('#check').prop('checked')){
			$('#btn').prop('disabled', false);
		}
		else {
			$('#btn').prop('disabled', true);
		}
	});
});
</script>
</head>
<body>
<nav class="navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<div class="navbar-brand"><img src="<?php echo base_url('assets/images/makara.png'); ?>" class="img-rounded" alt="Cinque Terre" width="30" height="30"></div>
			<div class="navbar-brand">UI Smart Report</div>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
        		<li><a href="#">About Us</a></li>
        	</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><span class="navbar-brand"><a href="<?php echo base_url(); ?>">Timeline</a></span></li>
				<li><span class="navbar-brand"><a href="<?php echo base_url('profile'); ?>">Profile</a></span></li>
				<li><span class="navbar-brand"><a href="<?php echo base_url('setting'); ?>">Setting</a></span></li>
				<li><span class="navbar-brand"><a href="<?php echo base_url('notifications'); ?>">Notifications <?php if ($count_notif > 0) { ?><span class="label label-warning"><?php echo $count_notif; ?></span><?php } ?></a></span></li>
				<li><span class="navbar-brand"><a data-toggle="modal" data-target="#myModal">Logout</a></span></li>
			</ul>
		</div>
	</div>
</nav>
<br><br><br><br>
<!-- Logout Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you sure you want to log out?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <a href="<?php echo base_url('logout'); ?>" class="btn btn-primary" role="button">Yes</a>
      </div>
    </div>
  </div>
</div>
<!-- End of Logout Modal-->
<div class="row">
	<div class="col-sm-4"></div>
    <div class="col-sm-4 forgetForm">
		<h4 id="font2">You have exceeded 30 minutes time limit to edit/delete your post, please inform administrator. You will be redirected to your post after 15 seconds, or <a href="<?php echo base_url('post/view/'.$id); ?>">click here</a></h4>
    </div>
</div>
