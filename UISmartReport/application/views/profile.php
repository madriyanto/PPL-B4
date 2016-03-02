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
	<p>Username: <?php echo $username; ?></p>
	<p>Name: <?php echo $name; ?></p>
	<p>NPM: <?php echo $npm; ?></p>
	<p>Role: <?php echo $role; ?></p>
	<p>Organization Code: <?php echo $org_code; ?></p>
	<p>Faculty: <?php echo $faculty; ?></p>
	<p>Study Program: <?php echo $study_program; ?></p>
	<p>Educational Program: <?php echo $educational_program; ?></p>
	<p><a href="index.php/Close">Log Out</a></p>
</div>

</body>
</html>