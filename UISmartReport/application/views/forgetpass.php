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
	<p><?php echo $result; ?></p>
	<?php echo form_open('ForgetPassword'); ?>

	<h5>Email</h5>
	<input type="email" name="email" value="" size="50" />

	<div><input type="submit" value="Submit" /></div>

	</form>
</div>

</body>
</html>