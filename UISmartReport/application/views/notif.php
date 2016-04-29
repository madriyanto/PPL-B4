<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE <!DOCTYPE html>
<html lang="en">
<head>
	<title>UI Smart Report | Notification</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
	<link rel="stylesheet" href="http://[::1]/UISmartReport/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://[::1]/UISmartReport/assets/css/jquery-ui.css">
	<link rel="stylesheet" href="http://[::1]/UISmartReport/assets/tokenfield/dist/css/bootstrap-tokenfield.css">
	<script type="text/javascript" src="http://[::1]/UISmartReport/assets/js/jquery.js"></script>
	<script type="text/javascript" src="http://[::1]/UISmartReport/assets/js/jquery-ui.js"></script>
	<script type="text/javascript" src="http://[::1]/UISmartReport/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://[::1]/UISmartReport/assets/tokenfield/dist/bootstrap-tokenfield.js"></script>
	<style>
	  body {
	    background-color: #E4E4E4;
	  }
	  #mynavbar a{
	    color: #dfdbdb;
	  }
	  #navbarbawah a{
	    color: black;
	  }
	  #navbarbawah div{
	    margin-top: 3%;
	  }
	  .postButton{
	    background: #FFFF00;
	    color: black;
	    border-style: none;
	  }
	  #coba{
	    top: 65px;
	  }
	  #pic{
	    border: 5px solid white;
	  }
	  #tujuan{
	    text-decoration: underline;
	  }
	  .inipos{
	    border: 5px solid;
	  }
	  #profpic{
	    width: 15%;
	    height: 25%;
	  }
	  #finalPost{
	    background: white;
	    color: black;
	    border-style: none;
	    height: 165px;
	  }
	  .anonim{
	    margin-left: 100px;
	  }
	  .bagian-bawah{
	    margin-bottom: 5%;
	  }
	  #navbar{
	    border: 1px solid blue;
	    margin-top: 3%;
	  }
	  #subnavbar{
	    text-align: center;
	    font-size: 25px;
	    margin-top: 1%;
	    border: 2px solid white;
	    background-color: white;
	    height: 45px;
	  }
	  #search-content{
	      margin-top: 30px;
	  }
	  @media screen and (max-width:1000px){
	    .row{
	      margin-right: 0px;
	    }
	    .form-control{
	      width: 90%;
	    }
	    #datadiri {
	      margin-top: 50px;
	      border: 1px solid white;
	    }
	    #datadiri h3{
	      text-align: center;
	    }
	    #coba h4{
	      text-align: center;
	    }
	    #finalPost{
	      height: 300px;
	      width: 84%;
	      left: 9%;
	      border-radius: 5px;
	    }
	    #navbarbawah{
	      margin-top: 10px;
	      margin-bottom: 10px;
	    }
	    .bagian-bawah{
	      margin-bottom: 15%;
	    }
	    #coba{
	      margin-top: 20px; 
	    }
	    #subnavbar{
	      width: 90%;
	      left: 6%;
	      border-radius: 5px;
	    }
	    #profpic img{
	      margin: auto;
	    }
	    #search-input input{
	      width: 60%;
	    }
	  }
	  .navbar-bottom {
	      margin-bottom: 0px;
	      bottom: 0;
	      width: 100%;
	  }
	  .box-post {
	    background-color: white;
	    border-radius: 20px;
	    margin-bottom: 10px;
	  }
	  .navbar-nav {
  		margin: 7.5px -15px;
	  }
	  .navbar-nav > li > a {
	    padding-top: 10px;
	    padding-bottom: 10px;
	    line-height: 20px;
	  }
	  #divNotif {	  	
	  	margin-top: 50px;
	  	margin-left: 200px;
	  	margin-right: 150px;
	  	border: 2px solid gray;	  	
	  	background-color: white;
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
	<br></br>
	<br></br>
	<br></br>
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-8" id="divNotif">
			<h3><b>Notification</b></h3>
			<div class="row">
				<div class="col-xs-6 col-sm-4" id="divJenis">
					<h3>Unread Post</h3>
					<div id="container">
						<?php
							foreach($notif as $row) {
								echo '<a href="'.base_url().'post/view/'.$row->PostId.'">'.$row->Name.' '.$row->Notes.'</a> '.$row->Timestamps.'<br/>';
								if ($row->Status) {
									echo ' (unread)<br/>';
								}
							}
						?>
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-4" id="divJenis">
					<h3>Read Post</h3>
						<?php
							foreach($notif as $row) {
								echo '<a href="'.base_url().'post/view/'.$row->PostId.'">'.$row->Name.' '.$row->Notes.'</a> '.$row->Timestamps.'<br/>';
								if ($row->Status) {
									echo ' (unread)<br/>';
								}
							}
						?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>