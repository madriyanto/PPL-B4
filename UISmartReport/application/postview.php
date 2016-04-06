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
	<a href=<?php echo "\"".base_url()."index.php\""; ?>><h3>Homepage</h3></a>
	<a href=<?php echo "\"".base_url()."index.php/Profile\""; ?>><h3>Profile</h3></a>
	<a href=<?php echo "\"".base_url()."index.php/Close\""; ?>><h3>Log Out</h3></a>
	
	<h2>
	<?php
		if ($IsPinned) {
			echo $Title." (Pinned)";
		} else {
			echo $Title;
		}
	?>
	</h2>
	<?php 
		date_default_timezone_set("Asia/Jakarta");
		$timestamp = mysql_to_unix($Timestamp);
		$timespan = timespan($timestamp)." Ago";

		if ((now() - $timestamp) >= (24*60*60)) {
			$timespan = date('F d, Y', $timestamp);
		}

		$is_editable = false;
		if ($this->session->userdata('username') == $OwnerId) {
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

		if ($IsAnonymous && $isSPAcc) {
		echo "<p>Posted by <a href=\"".base_url()."index.php/People/view/".$OwnerId."\">".$OwnerId."</a> (Anonymous) On ".$timespan."</p>";
		} else if($IsAnonymous && !$isSPAcc) {
		echo "<p>Posted by Anonymous On ".$timespan."</p>";
		} else {
		echo "<p>Posted by <a href=\"".base_url()."index.php/People/view/".$OwnerId."\">".$OwnerId."</a> On ".$timespan."</p>";
		}
		echo "<p>To: ";
		$post_mentions = $this->Post_model->get_mentions($Id);
		$is_mentioned = false;
		foreach ($post_mentions as $row){
			echo "<br/>".$row->Name;
			if ($this->session->userdata('username') == $row->Username) {
				$is_mentioned = true;
			}
		}
		echo "</p>";
		echo "<img src=\"".$Attachments."\"/>";
		echo "<p>".$Data."</p>";
		if ($isSPAcc && !$IsPinned) {
			if($this->session->userdata('username') == $OwnerId || $is_mentioned) {
				echo "<br/><a href=\"".base_url()."index.php/Post/pin/".$Id."\">Pin this post</a>";
			}
		} else if ($isSPAcc && $IsPinned) {
			if($this->session->userdata('username') == $OwnerId || $is_mentioned) {
				echo "<br/><a href=\"".base_url()."index.php/Post/unpin/".$Id."\">Unpin this post</a>";
			}
		}
		if ($is_editable) {
			echo "<br/>Edit";
			echo "<br/>Close";
		}
		echo "<h3>Comments</h3>";
		$comments = $this->Post_model->get_comments($Id);
		foreach ($comments as $row) {
			$timestamp = mysql_to_unix($row->Timestamp);
			$timespan = timespan($timestamp)." Ago";

			if ((now() - $timestamp) >= (24*60*60)) {
				$timespan = date('F d, Y', $timestamp);
			}

			echo "<p><b><a href=".base_url()."People/view/".$row->Username.">".$row->Name."<a> On ".$timespan."</b></p>";
			echo "<p>".$row->Data."</p>";	
		}
	?>
	<?php echo form_open('Post/view/'.$Id); ?>
		<label>Comment: </label><br/>
		<input type="text" name="comment" size="50" /><br/>
		<input type="submit" value="Submit" />
	</form>
</div>

</body>
</html>