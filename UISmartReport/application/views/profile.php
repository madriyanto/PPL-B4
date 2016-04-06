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
	<?php
	if($Role == 'mahasiswa'){
		echo "<p>NPM: ".$NPM."</p>";
	}else{
		echo "<p>NIP: ".$NPM."</p>.";
	} ?>
	<p>Role: <?php echo $Role; ?></p>
	<p>Faculty: <?php echo $Faculty; ?></p>
	<p>Contact: <?php echo $Contact; ?></p>
	<p><a href="Close">Log Out</a></p>
</div>

</body>
</html>