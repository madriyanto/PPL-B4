<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Example</title>
</head>
<body>

<div id="container">
	<?php echo validation_errors(); ?>
	<?php echo $result; ?>

	<?php echo form_open('UpdatePassword'); ?>

	<h5>Old Password</h5>
	<input type="password" name="oldpass" value="" size="50" />

	<h5>New Password</h5>
	<input type="password" name="newpass" value="" size="50" />

	<h5>New Password Confirmation</h5>
	<input type="password" name="passconf" value="" size="50" />

	<div><input type="submit" value="Submit" /></div>

	</form>
</div>

</body>
</html>