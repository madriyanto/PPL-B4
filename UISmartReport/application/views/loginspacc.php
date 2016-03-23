<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Example</title>
</head>
<body>

<div id="container">
	<?php echo validation_errors(); ?>

	<?php echo form_open('http://madriyanto.com/UISmartReport/index.php/Loginsp'); ?>

	<h5>Username</h5>
	<input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" />

	<h5>Password</h5>
	<input type="text" name="password" value="<?php echo set_value('password'); ?>" size="50" />

	<div><input type="submit" value="Submit" /></div>

	</form>
</div>

</body>
</html>