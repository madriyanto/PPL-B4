<style>
	.postButton{
		background: #FFFF00;
		color: black;
		border-style: none;
	}
	.finalPost{
		background: #FFFF00;
		color: black;
		border-style: none;
		margin-left: 100px;
		margin-right: 100px;
	}
	.anonim{
		margin-left: 100px;
	}
</style>
<script>
$(document).ready(function(){
	$('#mention').tokenfield({
		autocomplete: {
			source: ['Organisasi1', 'Organisasi2', 'Organisasi3', 'Organisasi4', 'Organisasi5'],
			delay: 100
		},
		showAutocompleteOnFocus: true
	})
});
</script>
<body>
<nav class="navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<div class="navbar-brand"><img src="<?php echo base_url('assets/images/makara.png'); ?>" class="img-rounded" alt="Cinque Terre" width="30" height="30"></div>
			<div class="navbar-brand">UI Smart Report</div>
			<div class="navbar-brand">About Us</div>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				<li><span class="navbar-brand"><a href="Welcome">Timeline</a></span></li>
				<li><span class="navbar-brand"><a href="Profile">Profile</a></span></li>
				<li><span class="navbar-brand"><a href="Close">Logout</a></span></li>
			</ul>
		</div>
	</div>
</nav>
<br><br><br><br>
<div id="row">
	<div class="col-md-1"></div>
	<div class="col-md-4">
		<h1>Timeline</h1>
		<button type="button" class="btn btn-info btn-primary btn-lg postButton" data-toggle="modal" data-target="#myModal">Post</button>
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title "><b>Post</b></h4>
					</div>
					
					<div class="modal-body">
					<form role="form" action="<?php echo base_url('index.php/Timeline'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
						<div id="row">
							<div class="col-md-7">
								<div class="form-group">
									<input type="text" name="mention" class="form-control" id="mention" placeholder="To Organization" />
								</div>
								<div class="form-group">
									<input type="text" name="title" class="form-control" id="title" placeholder="An Event" />
								</div>
								<div class="form-group">
									<textarea name="post" class="form-control" rows="8" id="comment" placeholder="Description"></textarea>
								</div>
								<div class="form-group">
									Gambar<input type="file" name="userfile" class="form-control" id="userfile" />
								</div>
							</div>
							<div class="col-md-4">
								<button type="submit" data-dismiss="modal" class="btn btn-info btn-primary btn-lg finalPost"><h3>Post!</h3></button>
								<div class="checkbox anonim">
									<label><input type="checkbox" name="anonymous" value=""/>Anonim Post</label>
								</div>
							</div>
						</div>
					</form>
					</div>
					<div class="modal-footer">
						
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<?php if (!$isSPAcc) { ?>
		<h3 class="text-right"><?php echo $Name; ?></h3>
		<h3 class="text-right"><?php echo $NPM; ?></h3>
		<h3 class="text-right"><?php echo ucwords(strtolower($Role.' '.$Faculty)); ?></h3>
		<?php } else { ?>
		<h3 class="text-right"><?php echo $Name; ?></h3>
		<h3 class="text-right"><?php echo $Email; ?></h3>
		<h3 class="text-right"><?php echo $Contact; ?></h3>
		<?php } ?>
	</div>
	<div class="col-md-3">
		<?php if ($PictLink == null) { ?>
		<img src="<?php echo base_url('assets/images/makara.png'); ?>" class="img-rounded" alt="Cinque Terre" width="150" height="150"> 
		<?php } else { ?>
		<img src="<?php echo $PictLink; ?>" class="img-rounded" alt="Cinque Terre" width="150" height="150">
		<?php } ?>
	</div>
</div>
	
<!--
	<?php echo validation_errors(); ?>
	<?php echo $error; ?>

	<?php echo form_open_multipart('Timeline'); ?>

	<label>Title</label>
	<input type="text" name="title" size="50" />
	<br/><label>Post</label><br/>
	<textarea name="post" rows="5" cols="50" style="resize:none"></textarea>
	<br/><label>To: </label>
	<?php foreach ($mention as $row){
		echo "<input type=\"checkbox\" name=\"mention[]\" value=\"".$row->Username."\">".$row->Name;
	} ?>
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

			if ($row->IsPinned) {
				echo "<h2> <a href=\"./Post/view/".$row->Id."\">".$row->Title." (Pinned)</a></h2>";
			} else {
				echo "<h2> <a href=\"./Post/view/".$row->Id."\">".$row->Title."</a></h2>";
			}
			
			if ($row->IsAnonymous && $isSPAcc) {
				echo "<p>Posted by <a href=\"./People/view/".$row->OwnerId."\">".$row->OwnerId."</a> (Anonymous) On ".$timespan."</p>";
			} else if($row->IsAnonymous && !$isSPAcc) {
				echo "<p>Posted by Anonymous On ".$timespan."</p>";
			} else {
				echo "<p>Posted by <a href=\"./People/view/".$row->OwnerId."\">".$row->OwnerId."</a> On ".$timespan."</p>";
			}
			echo "<p>To: ";
			$post_mentions = $this->Post_model->get_mentions($row->Id);
			foreach ($post_mentions as $row2){
				echo "<br/>".$row2->Name;
			}
			echo "</p>";
			echo "<img src=\"".$row->Attachments."\"/>";
			echo "<p>".$row->Data."</p>";
			$count = $this->Post_model->count_comment($row->Id);
			foreach ($count as $row2) {
				echo $row2->comment.' Comments';	
			}
			echo "<br/><a href=\"./Post/view/".$row->Id."\">Show details</a>";
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
-->