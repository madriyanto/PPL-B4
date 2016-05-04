	
	<style>
		body {
			background-color: #E4E4E4;
			
		}
		
		.divText {
			font-family: Verdana, Geneva, sans-serif;
			font-size: 18px;
		}

		#mynavbar a{
			color: #dfdbdb;
		}
		
		.waktu {
			margin-right: 30px;
			text-align: right;
		}
		
		.tombol {
			text-align: right;
		}
		
		.profpic {
			margin-left: 20px; 
		}
		
		.post {
			margin-left: 30px;
		}

		.navbar-bottom {
		    margin-bottom: 0px;
		    bottom: 0;
		    width: 100%;
	  	}

	  	.comment {
	  		margin-bottom: 10px;
	  	}
	</style>
	<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();  
			$("#deletePost").click(function(){
				$("#deleteModal").modal();
			});
			$("#pinPost").click(function(){
				$("#pinModal").modal();
			});
			$("#unpinPost").click(function(){
				$("#unpinModal").modal();
			});
			$("#closePost").click(function(){
				$("#closeModal").modal();
			});
		});
		
	</script>
</head>
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
				<li><span class="navbar-brand"><a href="<?php echo base_url('notifications'); ?>">Notifications <?php if ($count_notif > 0) { ?><span class="label label-warning"><?php echo $count_notif; ?></span><?php } ?></a></span></li>
				<li><span class="navbar-brand"><a href="#" data-toggle="modal" data-target="#myModal">Logout</a></span></li>
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
<div class="container">
	<div class="well">
		<div class="row">
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
			?>
			<div class="col-sm-2 profpic">
				<img src="<?php echo $PictLink; ?>" class="img-rounded" alt="Cinque Terre" width="150" height="150"> 
			</div>
			<div class="col-sm-7">
				<div class="row">
					<div class="col-sm-12 divText"><?php echo $Name; ?></div>
				</div>
				<div class="row">
					<div class="col-sm-12 divText"><?php echo "<img src=\"".base_url('assets/images/people.png')."\" class=\"img-rounded\" width=\"15px\" height=\"15px\">"; ?> 
					<?php
					$post_mentions = $this->Post_model->get_mentions($Id);
					$is_mentioned = false;
					$is_first = true;
					foreach ($post_mentions as $row){
						if(!$is_first) {
							echo ", ".$row->Name;
						} else {
							$is_first = false;
							echo $row->Name;
						}
						if ($this->session->userdata('username') == $row->Username) {
							$is_mentioned = true;
						}
					}
					?>
		</div>
				</div>
				<div class="row">
					<div class="col-sm-12 divText">
						<?php echo "<img src=\"".base_url('assets/images/tool(2).png')."\" class=\"img-rounded\" width=\"15px\" height=\"15px\">"; ?> <?php echo $Title; ?>
					</div>
				</div>
			</div>
			<div class="col-sm-2 text-right waktu divText"><?php echo $timespan; ?></div>
		</div>
		<br>
		<?php if ($Attachments != null) { ?>
		<div class="row">
			<div class="col-sm-offset-3 col-sm-6">
				<img src="<?php echo $Attachments; ?>" class="img-rounded img-responsive"/>
			</div>
		</div>
		<?php } ?>
		<div class="row post divText">
			<?php echo $Data; ?>
		</div>
		<div class="row tombol">
			<div class="col-sm-offset-7 col-sm-4 text-right tombol">
				<?php if($is_editable && $Status) { ?>
				<a href="<?php echo base_url('post/edit/'.$Id); ?>"><button type="button" id="editPost" class="btn btn-default btn-lg" title="Edit This Post"><?php echo "<img src=\"".base_url('assets/images/edit.png')."\" class=\"img-rounded\" width=\"15px\" height=\"15px\">"; ?></button></a>
				<button type="button" id="deletePost" class="btn btn-default btn-lg" data-toggle="tooltip" title="Delete This Post"><?php echo "<img src=\"".base_url('assets/images/delete.png')."\" class=\"img-rounded\" width=\"15px\" height=\"15px\">"; ?></button>
				<div id="deleteModal" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header" style="text-align: center;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Confirmation</h4>
							</div>
							<div class="modal-body" style="text-align: left;">
								<form role="form" action="<?php echo base_url('post/delete/'.$Id); ?>" method="post" accept-charset="utf-8">
									<div class="form-group">
										<label for="textarea">Are you sure you want to delete this post ?</label>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg" value="Yes">Yes</button>
										<button type="button" class="btn btn-danger btn-lg active" value="No" data-dismiss="modal">No</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php if($is_mentioned && !$IsPinned && $Status) { ?>
				<button type="button" id="pinPost" class="btn btn-default btn-lg" data-toggle="tooltip" title="Pin This Post"><?php echo "<img src=\"".base_url('assets/images/office-material.png')."\" class=\"img-rounded\" width=\"15px\" height=\"15px\">"; ?></button>
				<div id="pinModal" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header" style="text-align: center;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Confirmation</h4>
							</div>
							<div class="modal-body" style="text-align: left;">
								<form role="form" action="<?php echo base_url('post/pin/'.$Id); ?>" method="post" accept-charset="utf-8">
									<div class="form-group">
										<label for="textarea">Are you sure you want to pin this post ?</label>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg" value="Yes">Yes</button>
										<button type="button" class="btn btn-danger btn-lg active" value="No" data-dismiss="modal">No</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php } else if ($is_mentioned && $IsPinned && $Status) { ?>
				<button type="button" id="unpinPost" class="btn btn-default btn-lg" data-toggle="tooltip" title="Unpin This Post"><?php echo "<img src=\"".base_url('assets/images/office-material.png')."\" class=\"img img-rounded\" width=\"15px\" height=\"15px\">"; ?></button>
				<div id="unpinModal" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header" style="text-align: center;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Confirmation</h4>
							</div>
							<div class="modal-body" style="text-align: left;">
								<form role="form" action="<?php echo base_url('post/unpin/'.$Id); ?>" method="post" accept-charset="utf-8">
									<div class="form-group">
										<label for="textarea">Are you sure you want to unpin this post ?</label>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg" value="Yes">Yes</button>
										<button type="button" class="btn btn-danger btn-lg active" value="No" data-dismiss="modal">No</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php if ($is_mentioned && $Status) { ?>
				<button type="button" id="closePost" class="btn btn-default btn-lg" data-toggle="tooltip" title="Close This Post"><?php echo "<img src=\"".base_url('assets/images/tool.png')."\" class=\"img img-rounded\" width=\"15px\" height=\"15px\">"; ?></button>
				<div id="closeModal" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header" style="text-align: center;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Confirmation</h4>
							</div>
							<div class="modal-body" style="text-align: left;">
								<form role="form" action="<?php echo base_url('post/close/'.$Id); ?>" method="post" accept-charset="utf-8">
									<div class="form-group">
										<label for="textarea">Are you sure you want to close this post?</label>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg" value="Yes">Yes</button>
										<button type="button" class="btn btn-danger btn-lg active" value="No" data-dismiss="modal">No</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="well">
		<?php if ($Status) { ?>
		<form role="form" action="<?php echo base_url('post/view/'.$Id); ?>" method="post" accept-charset="utf-8">
			<div class="form-group divText">
				<label for="comment">Your Comment</label>
				<textarea class="form-control" rows="4" id="comment" name="comment" required></textarea>
				<br>
				<button type="submit" class="btn btn-warning">Post Comment</button>
			</div>
		</form>
		<?php } else { ?>
		<div class="form-group divText">
			This post has been closed.
		</div>
		<?php } ?>
		<hr width="100%">
		<p class="divText"><b>Last Comments</b></p>
		<?php
		$comments = $this->Post_model->get_comments($Id);
		foreach ($comments as $row) {
			$timestamp = mysql_to_unix($row->Timestamp);
			$timespan = timespan($timestamp)." Ago";

			if ((now() - $timestamp) >= (24*60*60)) {
				$timespan = date('F d, Y', $timestamp);
			}
		?>
		<div class="row comment">
			<div class="col-sm-2 profpic">
				<img src="<?php echo $row->PictLink; ?>" class="img-rounded" alt="Cinque Terre" width="150" height="150"> 
			</div>
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-12 lead"><?php echo $row->Name; ?></div>
				</div>
				<div class="row">
					<div class="col-sm-12 divText"><?php echo $row->Data; ?></div>
				</div>
			</div>
			<div class="col-sm-3 text-right waktu divText"><?php echo $timespan; ?></div>
		</div>
		<?php } ?>
	</div>
</div>