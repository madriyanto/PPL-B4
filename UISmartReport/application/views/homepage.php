<!DOCTYPE html>
<html lang="en">
<head>
	<title>UI Smart Report | Homepage</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" />
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
	<style>
		.btn-primary {
			background: #FFFF00;
			color: black;
			border-style: none;
		}
		.jumbotron {
			background: white;
		}
	</style>
</head>
<body>
<!--<div id="container">
	<h5>HOMEPAGE</h5>
	<p>Terms and Conditions</p>
	<a href='Login'>I Agree</a>
</div>-->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
	  <div class="navbar-brand"><img src="<?php echo base_url("assets/images/makara.png"); ?>" class="img-rounded" alt="Cinque Terre" width="30" height="30"></div>
      <div class="navbar-brand">UI Smart Report</div>
    </div>
	<ul class="nav navbar-nav navbar-right">
        <div class="navbar-brand">About Us<div>
    </ul>
  </div>
</nav>
<br><br><br><br>
<div class="jumbotron">
  <div class="row">
    <div class="col-md-6">
	  <h1 class="text-center">The place that you</h1>
	  <h1 class="text-center">can report anything</h1>
	  <h1 class="text-center">about UI's event</h1>
    </div>
    <div class="col-md-6"> 
      <p class="text-center"><button type="button" class="btn btn-primary btn-lg"><h2>Login SSO</h2></button></p>
	  <p><h1 class="text-center">or</h1></p><br>
	  <p class="text-center"><button type="button" class="btn btn-primary btn-lg"><h2>Login SA*</h2></button></p><br>
	  <form role="form">
		<div class="checkbox text-center">
			<label><input type="checkbox" value="">Please read the <a src="#">Agreement</a> here before login here</label>
		</div>
	  </form>
    </div>
  </div>
</div>
<nav class="navbar navbar-inverse navbar-fixed-bottom">
  <div class="container-fluid bg-4 text-center">
    <h4><font color="white">Copyright &#169; 2016, PPL B-04</font></h4>
  </div>
</nav>
</body>
</html>
