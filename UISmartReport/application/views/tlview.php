<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Example</title>
</head>
<body>

<div id="container">
	<?php echo validation_errors(); ?>

	<?php echo form_open('http://madriyanto.com/UISmartReport/index.php/Timeline'); ?>

	<h5>Post</h5>
	<input type="text" name="post" size="50" />
	<p>Post as anonymous
	<input type="checkbox" name="anonymous" value="true" />
	</p>
	<div><input type="submit" value="Submit" /></div>

	</form>

	<?php foreach ($timeline as $row):
		echo "<div>";
		if($row->IsAnonymous){
			echo "<p>Posted by ".$row->OwnerId." (Anonymous) On ".$row->Timestamp."</p>";
		}else{
			echo "<p>Posted by ".$row->OwnerId." On ".$row->Timestamp."</p>";
		}
		if($row->Status){
			echo "<p>Status: Open</p>";
		}else{
			echo "<p>Status: Closed</p>";
		}
		echo "<p>Post: ".$row->Data."</p>";
		echo "<p>Attachments: ".$row->Attachments."</p>";
		if($row->IsPinned){
			echo "<p>Status: Pinned</p>";
		}else{
			echo "<p>Status: Not Pinned</p>";
		}
		echo "<div>";
	endforeach;
	?>
</div>

</body>
</html>