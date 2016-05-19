<style>
		body {
			background-color: #E4E4E4;
			font-family: Verdana, Geneva, sans-serif;
			font-size: 18px;
		}
	
		#mynavbar a{
			color: #dfdbdb;
		}
		
		.tombol {
			text-align: center;
		}
		
		.logout {
			border-style: solid;
			border-color: yellow;
			margin-right: 30px;
			padding-top: 10px;
			padding-bottom: 10px;
		}

		.navbar-bottom {
		    margin-bottom: 0px;
		    bottom: 0;
		    width: 100%;
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

			$('#mention').tokenfield('setTokens', [
			<?php
				foreach ($post_mentions as $row){
					echo "{value: \"".$row->Username."\", label: \"".$row->Name."\"}, ";
			} ?>
			]);

			$('#mention').on('tokenfield:createtoken', function (event) {
				var existingTokens = $(this).tokenfield('getTokens');
				$.each(existingTokens, function(index, token) {
					if (token.value === event.attrs.value)
						event.preventDefault();
					});
				});
			});	
	</script>
</head>
<body>
<nav class="navbar-inverse navbar-fixed-top">
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
		<h2 style="text-align: center;">Edit Post</h2>
		<?php echo validation_errors(); ?>
		<?php echo $error; ?>

		<?php echo form_open_multipart('post/edit/'.$Id); ?>
		<form role="form">
			<div class="form-group">
				<label for="text">Event:</label>
				<input type="text" class="form-control" id="title" name="title" placeholder="Enter event" value="<?php echo $Title; ?>" required>
			</div>
			<div class="form-group">
				<label for="textarea">Description:</label>
				<textarea class="form-control" id="post" name="post" rows="6" placeholder="Enter your post description" required><?php echo $Data; ?></textarea>
			</div>
			<div class="form-group">
				<label for="text">To:</label>
				<input type="text" class="form-control" id="mention" name="mention" placeholder="To Organization" required>
			</div>
			<div class="form group">
				<input type="checkbox" id="anonymous" name="anonymous" value="true" <?php if($IsAnonymous) echo "checked"; ?>> Anonymous
			</div>
			<br>
			<div class="form group">
				<input type="file" id="userfile" name="userfile" value="<?php echo $Attachments; ?>">
			</div><br>
			<div class="form group tombol">
				<button type="submit" class="btn btn-primary btn-lg" value="Submit">Edit Post</button>
				<a href="<?php echo base_url('post/view/'.$Id); ?>"><button type="button" class="btn btn-danger btn-lg" value="Batal">Kembali ke Halaman Sebelumnya</button></a>
			</div>
		</form>
	</div>
</div>
