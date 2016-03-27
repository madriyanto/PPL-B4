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
	
	<h2><?php echo $Title; ?></h2>
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
		echo "<p>Posted by <a href=\"./People/view/".$OwnerId."\">".$OwnerId."</a> (Anonymous) On ".$timespan."</p>";
		} else if($IsAnonymous && !$isSPAcc) {
		echo "<p>Posted by Anonymous On ".$timespan."</p>";
		} else {
		echo "<p>Posted by <a href=\"./People/view/".$OwnerId."\">".$OwnerId."</a> On ".$timespan."</p>";
		}
		echo "<p>To: ";
		$post_mentions = $this->Timeline_model->get_mentions($Id);
		foreach ($post_mentions as $row){
			echo "<br/>".$row->Name;
		}
		echo "</p>";
		echo "<p>Post: ".$Data."</p>";
		echo "<img src=\"".$Attachments."\"/>";
		if ($IsPinned) {
			echo "<p>Status: Pinned</p>";
		} else {
			echo "<p>Status: Not Pinned</p>";
		}
		if ($isSPAcc && !$row->IsPinned) {
		echo "<br/><a href=\"Timeline/pin/".$row->Id."\">Pin this post</a>";
		} else if ($isSPAcc && $row->IsPinned) {
			echo "<br/><a href=\"Timeline/unpin/".$row->Id."\">Unpin this post</a>";
		}
		if ($is_editable) {
			echo "<br/>Edit";
			echo "<br/>Close";
		}
		echo "<h3>Comments</h3>";
		$comments = $this->Timeline_model->get_comments($Id);
		foreach ($comments as $row) {
			echo "<p><b>".$row->OwnerId."</b></p>";
			echo "<p>".$row->Data."</p>";	
		}
	?>
</div>

</body>
</html>