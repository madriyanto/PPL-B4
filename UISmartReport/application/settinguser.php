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
		<input type="submit" value="Save">
	</form>
</div>

</body>
</html>