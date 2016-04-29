<!--	
	<style>
		body {
			background-color: #E4E4E4;
			font-family: Verdana, Geneva, sans-serif;
			font-size: 18px;
		}
	
		.navbar-bottom {
			margin-bottom: 0px;
			bottom: 0;
			position: fixed;
			width: 100%;
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
	</style>
	<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();  
			$("#editPost").click(function(){
				$("#postModal").modal();
			});
			$("#deletePost").click(function(){
				$("#deleteModal").modal();
			});
			$("#pinPost").click(function(){
				$("#pinModal").modal();
			});
			$("#closePost").click(function(){
				$("#closeModal").modal();
			});
		});
		
	</script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
       		 <div class="navbar-brand">UI Smart Report</div>
       		 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>                        
      		 </button>
		</div>		
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				<a href="#"><li class="navbar-brand">Login SSO</li></a>
				<li class="navbar-brand">About Us</li>
			</ul>
		</div>
	</div>
</nav>

<br><br><br>
<div class="container">
	<div class="well">
		<div class="row">
			<div class="col-sm-2 profpic">
				<img src="assets/images/makara.png" class="img-rounded" alt="Cinque Terre" width="150" height="150"> 
			</div>
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-12">Haryanto Rio</div>
				</div>
				<div class="row">
					<div class="col-sm-12">to BemPacil, FUKIPacil</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<button type="button" class="btn btn-default btn-sm"></button>&nbsp Mentorship
					</div>
				</div>
			</div>
			<div class="col-sm-1 waktu">3 s</div>
		</div>
		<br>
		<div class="row post">
			keren banget acaranya ini. Nggak ada kekurangannya sama sekali. Fix tahun depan dateng lagi :)
		</div>
		<div class="row tombol">
			<div class="col-sm-2 profpic"></div>
			<div class="col-sm-7"></div>
			<div class="col-sm-2 tombol">
				<button type="button" id="editPost" class="btn btn-default btn-lg" data-toggle="tooltip" title="Edit This Post"></button>
				<div id="postModal" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header" style="text-align: center;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Edit This Post</h4>
							</div>
							<div class="modal-body" style="text-align: left;">
								<form role="form">
									<div class="form-group">
										<label for="textarea">Description:</label>
										<textarea class="form-control" id="post" name="post" rows="6" placeholder="Description of Post" required></textarea>
									</div>
									<div class="form-group">
										<label for="text">To:</label>
										<input type="text" class="form-control" id="mention" name="mention" placeholder="To Organization" required>
									</div>
									<div class="form-group">
										<label for="text">Event:</label>
										<input type="text" class="form-control" id="title" name="title" placeholder="An Event" required>
									</div>
									<div class="form-group">
										<div class="checkbox">
											<label><input type="checkbox" id="anonymous" name="anonymous" value="true">Anonymous</label>
										</div>
									</div>
									<div class="form-group">
										<input type="file" id="userfile" name="userfile">
									</div>
									<button type="submit" class="btn btn-primary btn-lg" value="Submit">Edit Post</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<button type="button" id="deletePost" class="btn btn-default btn-lg" data-toggle="tooltip" title="Delete This Post"></button>
				<div id="deleteModal" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header" style="text-align: center;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Confirmation</h4>
							</div>
							<div class="modal-body" style="text-align: left;">
								<form role="form">
									<div class="form-group">
										<label for="textarea">Are you sure you want to delete this post ?</label>
									</div>
									<div class="form-group">
										<button type="button" class="btn btn-primary btn-lg" value="Yes">Yes</button>
										<button type="button" class="btn btn-danger btn-lg active" value="No" data-dismiss="modal">No</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<button type="button" id="pinPost" class="btn btn-default btn-lg" data-toggle="tooltip" title="Pin This Post"></button>
				<div id="pinModal" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header" style="text-align: center;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Confirmation</h4>
							</div>
							<div class="modal-body" style="text-align: left;">
								<form role="form">
									<div class="form-group">
										<label for="textarea">Are you sure you want to pin this post ?</label>
									</div>
									<div class="form-group">
										<button type="button" class="btn btn-primary btn-lg" value="Yes">Yes</button>
										<button type="button" class="btn btn-danger btn-lg active" value="No" data-dismiss="modal">No</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<button type="button" id="closePost" class="btn btn-default btn-lg" data-toggle="tooltip" title="Close This Post (Thread)"></button>
				<div id="closeModal" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header" style="text-align: center;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Confirmation</h4>
							</div>
							<div class="modal-body" style="text-align: left;">
								<form role="form">
									<div class="form-group">
										<label for="textarea">Are you sure you want to close this post (thread) ?</label>
									</div>
									<div class="form-group">
										<button type="button" class="btn btn-primary btn-lg" value="Yes">Yes</button>
										<button type="button" class="btn btn-danger btn-lg active" value="No" data-dismiss="modal">No</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="well">
		<form role="form">
			<div class="form-group">
				<label for="comment">Your Comment</label>
				<textarea class="form-control" rows="4" id="comment"></textarea>
				<br>
				<button type="submit" class="btn btn-warning">Post Comment</button>
			</div>
		</form>
		<hr width="100%">
		<p><b>Last Comment</b></p>
		<div class="row">
			<div class="col-sm-2 profpic">
				<img src="assets/images/makara.png" class="img-rounded" alt="Cinque Terre" width="150" height="150"> 
			</div>
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-12 lead">Dzulfikar</div>
				</div>
				<div class="row">
					<div class="col-sm-12">Wew, Haryanto komentarnya. Gils gils.</div>
				</div>
			</div>
			<div class="col-sm-1 waktu">1 s</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2 profpic">
				<img src="assets/images/makara.png" class="img-rounded" alt="Cinque Terre" width="150" height="150"> 
			</div>
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-12 lead">Dzulfikar</div>
				</div>
				<div class="row">
					<div class="col-sm-12">Wew, Haryanto komentarnya. Gils gils.</div>
				</div>
			</div>
			<div class="col-sm-1 waktu">1 s</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2 profpic">
				<img src="assets/images/makara.png" class="img-rounded" alt="Cinque Terre" width="150" height="150"> 
			</div>
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-12 lead">Dzulfikar</div>
				</div>
				<div class="row">
					<div class="col-sm-12">Wew, Haryanto komentarnya. Gils gils.</div>
				</div>
			</div>
			<div class="col-sm-1 waktu">1 s</div>
		</div>
	</div>
</div>
<br><br>
-->
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
