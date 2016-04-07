<style>
	body {
	   background-color: #E4E4E4;
	}
	
	#postAndProfil{
	   height: 300px;
	}
	
	.box-post {
    	   background-color: white;
    	   border-radius: 20px;
    	   margin-bottom: 10px;
	}

	@media screen and (max-width:768px){
	   #profpic img{
		display: block;
 		margin-left: auto;
    		margin-right: auto
	   }
	   
	   #datadiri h3{
		text-align: center;
	   }
	   
	   .form-control{
		width: 90%;
	   }
	   
	   #postAndProfil{
	   	height: 500px;
	   }
	   
	}
</style>
<script>
$(document).ready(function(){
	$('#mention').tokenfield({
		autocomplete: {
			<?php
				echo "source: [";
				foreach ($mention as $row){
					echo '{label: \''.$row->Name.'\', value: \''.$row->Username.'\'}, ';
				}
				echo "],";
			?>
			delay: 100
		},
		showAutocompleteOnFocus: true
	});
	
	$('#mention').on('tokenfield:createtoken', function (event) {
		var existingTokens = $(this).tokenfield('getTokens');
		$.each(existingTokens, function(index, token) {
			if (token.value === event.attrs.value)
				event.preventDefault();
		});
	});
	
	$('#post').focusin(function() {
		$('#formPost').collapse('show');
		$('#post').prop('rows', 3);
		$('#post').prop('placeholder', 'Description');
	});
	
});
</script>
<body>
<nav class="navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<div class="navbar-brand"><img src="<?php echo base_url('assets/images/makara.png'); ?>" class="img-rounded" alt="Cinque Terre" width="30" height="30"></div>
			<div class="navbar-brand">UI Smart Report</div>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
        		<li><a href="#">About Us</a></li>
        	</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><span class="navbar-brand"><a href="<?php echo base_url(); ?>">Timeline</a></span></li>
				<li><span class="navbar-brand"><a href="<?php echo base_url('profile'); ?>">Profile</a></span></li>
				<li><span class="navbar-brand"><a href="<?php echo base_url('setting'); ?>">Setting</a></span></li>
				<li><span class="navbar-brand"><a href="<?php echo base_url('Notifications'); ?>">Notifications</a></span></li>
				<li><span class="navbar-brand"><a data-toggle="modal" data-target="#myModal">Logout</a></span></li>
			</ul>
		</div>
	</div>
</nav>
<br><br><br><br>
<!-- Logout Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you sure you want to log out?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <a href="<?php echo base_url('logout'); ?>" class="btn btn-primary" role="button">Yes</a>
      </div>
    </div>
  </div>
</div>
<!-- End of Logout Modal-->
<div class="row" id="postAndProfil">
	<div class="col-md-offset-1 col-md-4">
		<?php if ($error != '') { ?>
		<div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
		<?php } ?>
		<form role="form" class="form-horizontal" action="<?php echo base_url('timeline'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<div class="form-group">
		    	<div class="col-sm-12">
		    	<textarea class="form-control" id="post" name="post" rows="1" placeholder="What's happening?" required></textarea>
				</div>
		  	</div>
			<div id="formPost" class="collapse">
				<div class="form-group">
					<div class="col-sm-12">
					<input type="text" class="form-control" id="mention" name="mention" placeholder="To Organization" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
					<input type="text" class="form-control" id="title" name="title" placeholder="An Event" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<div class="checkbox">
						<label>
						<input type="checkbox" id="anonymous" name="anonymous" value="true"> Anonymous
						</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="file" id="userfile" name="userfile">
					</div>
					<div class="col-sm-3">
						<button type="submit" class="btn btn-primary btn-lg" value="Submit">Post</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-4" id="datadiri">
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
	<div class="col-md-3" id="profpic">
		<?php if ($PictLink == null) { ?>
		<img src="<?php echo base_url('assets/images/makara.png'); ?>" class="img-rounded" alt="Cinque Terre" width="150" height="150"> 
		<?php } else { ?>
		<img src="<?php echo $PictLink; ?>" class="img-rounded" alt="Cinque Terre" width="150" height="150">
		<?php } ?>
	</div>
</div>
<?php
	$i = 1;
	foreach ($timeline as $row) {
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
			
		if ($row->Status) {
			if ($i % 3 == 1) {
				echo "<div class=\"row\">";
			}
?>
		<div class="col-md-offset-1 col-md-3 box-post">
			<div class="row">
				<h5 class="text-right"><?php echo $timespan; ?></h5>
			</div>
			<div class="row">
				<div class="col-md-4">
					<?php if ($row->PictLink == null || ($row->IsAnonymous && !$isSPAcc)) { ?>
					<img src="<?php echo base_url('assets/images/makara.png'); ?>" class="img-rounded" alt="Cinque Terre" width="100" height="100"> 
					<?php } else { ?>
					<img src="<?php echo $row->PictLink; ?>" class="img-rounded" alt="Cinque Terre" width="100" height="100">
					<?php } ?>
				</div>
				<div class="col-md-8">
					<?php if ($row->IsAnonymous && ($isSPAcc || $row->OwnerId == $this->session->userdata['username'])) { ?>
					<h5><a href="<?php echo base_url('people/view/'.$row->Username); ?>"><?php echo $row->Name; ?> (Anonymous)</a></h5>
					<?php } else if ($row->IsAnonymous && !$isSPAcc) { ?>
					<h5>Anonymous</h5>
					<?php } else { ?>
					<h5><a href="<?php echo base_url('people/view/'.$row->Username); ?>"><?php echo $row->Name; ?></a></h5>
					<?php } ?>
					<p>To:<br/>
					<?php $post_mentions = $this->Post_model->get_mentions($row->Id);
					foreach ($post_mentions as $row2){
						echo "<a href=\"".base_url('people/view/'.$row2->Username)."\">".$row2->Name."</a><br/>";
					} ?></p>
					<p><?php echo $row->Title; ?></p>
				</div>
			</div>
			<div class="row">
				<?php if ($row->Attachments != null) { ?>
				<img src="<?php echo $row->Attachments; ?>" class="img-rounded center-block" alt="Cinque Terre" height="150">
				<?php } ?>
				<p>
					<?php
						if (strlen($row->Data) <= 200) {
							echo $row->Data;
						} else {
							echo substr($row->Data, 0, 200).'... <a href="'.base_url('post/view/'.$row->Id).'">see more</a>';
						}
					?>
				</p>
			</div>
			<div class="row">
				<h5 class="text-right"><a href="<?php echo base_url('post/view/'.$row->Id); ?>">View Comments</a></h5>
			</div>
		</div>
<?php	
			if ($i % 3 == 0) {
				echo "</div>";
			}
			$i++;
		}
	}
?>
	
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
