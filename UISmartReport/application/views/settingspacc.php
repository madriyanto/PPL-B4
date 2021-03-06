<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<style>
	body {
    	background-color: #E4E4E4;
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
</style>
</head>
<body>
<nav class="navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<div class="navbar-brand" id="myNavbar"><a href="<?php echo base_url(); ?>">UI Smart Report</a></span></div>
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
				<li><span class="navbar-brand"><a href="<?php echo base_url('profile'); ?>">Profile</a></span></li>
				<li><span class="navbar-brand"><a href="<?php echo base_url('setting'); ?>">Setting</a></span></li>
				<li><span class="navbar-brand"><a href="<?php echo base_url('notifications'); ?>">Notifications <?php if ($count_notif > 0) { ?><span class="label label-warning"><?php echo $count_notif; ?></span><?php } ?></a></span></li>
				<li><span class="navbar-brand"><a href="#" data-toggle="modal" data-target="#myModal">Logout</a></span></li>
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
<div class="container">
	<div class="col-md-6">
		<?php
			if ($result!="") {
				if($result=="Saved!"){
					?>
					<div class="alert alert-success fade in">
					<?php
				} else {
					?>
					<div class="alert alert-danger fade in">
					<?php
				}
				?>
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    		<strong><?php echo $result; ?></strong>
		  		</div>
		  		<?php
			}
		?>
		<form role="form" action="<?php echo base_url('setting'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<div class="form-group">
				<label for="uploadfile">Upload Profile Picture</label>
				<input id="uploadfile" type="file" name="userfile">
			</div>
			<div class="form-group">
				<label for="contact">Contact Details</label>
				<input id="contact" type="text" class="form-control" name="contact" value=<?php echo '"'.$Contact.'"'; ?> required/>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input id="email" type="email" class="form-control" name="email" value=<?php echo '"'.$Email.'"'; ?> required/>
			</div>
			<div class="form-group">
				<label for="about">About Me</label>
				<textarea id="about" name="about" class="form-control" rows="5" style="resize:none"><?php echo $About; ?></textarea>
			</div>
			<button type="submit" class="btn btn-default">Save</button>
		</form>
	</div>
</div>
