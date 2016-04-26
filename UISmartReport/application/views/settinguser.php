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
</style>
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
				<li><span class="navbar-brand"><a href="<?php echo base_url('notifications'); ?>">Notifications</a></span></li>
				<li><span class="navbar-brand"><a href="#" data-toggle="modal" data-target="#myModal">Logout</a></span></li>
			</ul>
		</div>
	</div>
</nav>
<br><br><br><br>
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
				<input id="contact" type="text" class="form-control" name="contact" value=<?php echo '"'.$Contact.'"'; ?> />
			</div>
			<button type="submit" class="btn btn-default">Save</button>
		</form>
	</div>
</div>