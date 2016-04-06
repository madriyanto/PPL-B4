<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Example</title>
</head>
<body>

<div id="container">
	<p>PictLink: <?php echo $PictLink; ?></p>
	<p>Username: <?php echo $Username; ?></p>
	<p>Name: <?php echo $Name; ?></p>
	<p>Email: <?php echo $Email; ?></p>
	<p>About: <?php echo $About; ?></p>
	<p>Contact: <?php echo $Contact; ?></p>
	<?php if($this->session->userdata('username') == $Username) {?>
	<p><a href="UpdatePassword">Update Password</a></p>
	<p><a href="Close">Log Out</a></p>
	<?php } ?>
</div>

</body>
</html>