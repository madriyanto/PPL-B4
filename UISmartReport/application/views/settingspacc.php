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
	<?php echo $result; ?><br/>
	<?php echo form_open_multipart('Setting') ?>
		<label>Upload Profile Picture<label><br/>
		<input type="file" name="userfile" size="20" /><br/>
		<label>Contact Details</label><br/>
		<input type="text" name="contact" size="50" value=<?php echo '"'.$Contact.'"'; ?> /><br/>
		<label>Email<label><br/>
		<input type="email" name="email" size="50" value=<?php echo '"'.$Email.'"'; ?> /><br/>
		<label>Contact Details</label><br/>
		<textarea name="about" rows="5" cols="50" style="resize:none"><?php echo $About; ?></textarea><br/>
		<input type="submit" value="Save">
	</form>
</div>

</body>
</html>