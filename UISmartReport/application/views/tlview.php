<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Example</title>
</head>
<body>

<div id="container">
	<a href="Welcome"><h3>Homepage</h3></a>
	<a href="Profile"><h3>Profile</h3></a>
	<a href="Close"><h3>Log Out</h3></a>

	<?php echo validation_errors(); ?>
	<?php echo $error; ?>

	<?php echo form_open_multipart('Timeline'); ?>

	<label>Title</label>
	<input type="text" name="title" size="50" />
	<br/><label>Post</label><br/>
	<textarea name="post" rows="5" cols="50" style="resize:none"></textarea>
	<br/><label>To: </label>
	<select name="mention">
	<?php foreach ($mention as $row){
		echo "<option value=\"".$row->Username."\">".$row->Name."</option>";
	} ?>
	</select>
	<br/><label>Attachment</label>
	<input type="file" name="userfile" size="20" />
	<label>Post as Anonymous</label>
	<input type="checkbox" name="anonymous" value="true" />
	<div><input type="submit" value="Submit" /></div>

	</form>

	<?php foreach ($timeline as $row){
		if ($row->Status) {
			echo "<div>";
			date_default_timezone_set("Asia/Jakarta");
			$timestamp = mysql_to_unix($row->Timestamp);
			$timespan = timespan($timestamp)." Ago";

			if ((now() - $timestamp) >= (24*60*60)) {
				$timespan = date('F d, Y', $timestamp);
			}

			$is_editable = false;
			if ($this->session->userdata('username') == $row->OwnerId) {
				if (substr_count($timespan, "Day") == 0 && substr_count($timespan, "Days") == 0) {
					if (substr_count($timespan, "Hour") == 0 && substr_count($timespan, "Hours") == 0) {
						if ((substr_count($timespan, "Minutes") == 1 || substr_count($timespan, "Minute") == 1) && (intval(substr($timespan, 0, 2)) <= 30)) {
							$is_editable = true;
						} else if (substr_count($timespan, "Seconds") == 1 || substr_count($timespan, "Second") == 1) {
							$is_editable = true;
						}
					}
				}
			}

			echo "<h2> <a href=\"./Post/view/".$row->Id."\">".$row->Title."</a></h2>";
			if ($row->IsAnonymous && $isSPAcc) {
				echo "<p>Posted by <a href=\"./People/view/".$row->OwnerId."\">".$row->OwnerId."</a> (Anonymous) On ".$timespan."</p>";
			} else if($row->IsAnonymous && !$isSPAcc) {
				echo "<p>Posted by Anonymous On ".$timespan."</p>";
			} else {
				echo "<p>Posted by <a href=\"./People/view/".$row->OwnerId."\">".$row->OwnerId."</a> On ".$timespan."</p>";
			}
			echo "<p>To: ";
			$post_mentions = $this->Timeline_model->get_mentions($row->Id);
			foreach ($post_mentions as $row2){
				echo "<br/>".$row2->Name;
			}
			echo "</p>";
			echo "<p>Post: ".$row->Data."</p>";
			echo "<img src=\"".$row->Attachments."\"/>";
			if ($row->IsPinned) {
				echo "<p>Status: Pinned</p>";
			} else {
				echo "<p>Status: Not Pinned</p>";
			}
			$count = $this->Timeline_model->count_comment($row->Id);
			foreach ($count as $row2) {
				echo $row2->comment.' Comments';	
			}
			if ($isSPAcc && !$row->IsPinned) {
				echo "<br/><a href=\"Timeline/pin/".$row->Id."\">Pin this post</a>";
			} else if ($isSPAcc && $row->IsPinned) {
				echo "<br/><a href=\"Timeline/unpin/".$row->Id."\">Unpin this post</a>";
			}
			if ($is_editable) {
				echo "<br/><a href=\"Post/edit/".$row->Id."\">Edit</a>";
				echo "<br/>Close";
			}
			echo "<div>";
			echo "<br/><br/>";
		}
	}
	?>
</div>

</body>
</html>