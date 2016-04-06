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
	<?php
		foreach($notif as $row) {
			echo '<a href="'.base_url().'post/view/'.$row->PostId.'">'.$row->Name.' '.$row->Notes.'</a> '.$row->Timestamps.'<br/>';
			if ($row->Status) {
				echo ' (unread)<br/>';
			}
		}
	?>
</div>
</body>
</html>