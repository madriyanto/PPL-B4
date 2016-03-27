<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Example</title>
</head>
<body>

<div id="container">
	<a href=<?php echo "\"".base_url()."index.php\""; ?>><h3>Homepage</h3></a>
	<a href=<?php echo "\"".base_url()."index.php/Profile\""; ?>><h3>Profile</h3></a>
	<a href=<?php echo "\"".base_url()."index.php/Close\""; ?>><h3>Log Out</h3></a>

	<?php echo validation_errors(); ?>
	<?php echo $error; ?>

	<?php echo form_open_multipart('Post/edit/'.$Id); ?>

	<label>Title</label>
	<input type="text" name="title" value=<?php echo "\"$Title\""; ?> size="50" />
	<br/><label>Post</label><br/>
	<textarea name="post" rows="5" cols="50" style="resize:none"><?php echo $Data; ?></textarea>
	<br/><label>To: </label>
	<?php
		foreach ($mention as $row) {
			if($this->Post_model->is_mentioned($Id, $row->Username))
			{
				echo "<input type=\"checkbox\" name=\"mention[]\" value=\"".$row->Username."\" checked>".$row->Name;
			}
			else
			{
				echo "<input type=\"checkbox\" name=\"mention[]\" value=\"".$row->Username."\">".$row->Name;
			}
		}
	?>
	<br/><label>Attachment</label>
	<input type="file" name="userfile" value="<?php echo "\"$Attachments\""; ?>" size="20" />
	<label>Post as Anonymous</label>
	<input type="checkbox" name="anonymous" value="true" <?php if($IsAnonymous) echo "checked"; ?>/>
	<div><input type="submit" value="Submit" /></div>

	</form>
</div>

</body>
</html>