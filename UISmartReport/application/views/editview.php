<!--
<style>
		body {
			background-color: #E4E4E4;
			font-family: Verdana, Geneva, sans-serif;
			font-size: 18px;
		}
	
		#mynavbar a{
			color: #dfdbdb;
		}
		
		.navbar-bottom {
			margin-bottom: 0px;
			bottom: 0;
			position: fixed;
			width: 100%;
		}
	</style>
</head>
<body>
<nav class="navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<div class="navbar-brand"><img src="assets/images/makara.png" class="img-rounded" alt="Cinque Terre" width="30" height="30"></div>
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
				<li><span class="navbar-brand"><a href="#" data-toggle="modal" data-target="#myModal">Logout</a></span></li>
			</ul>
		</div>
	</div>
</nav>
<br><br><br>
<div class="container">
	<div class="well">
		<h2 style="text-align: center;">Edit Post</h2>
		<form role="form">
			<div class="form-group">
				<label for="text">Event:</label>
				<input type="text" class="form-control" id="title" name="title" placeholder="Enter event" required>
			</div>
			<div class="form-group">
				<label for="textarea">Description:</label>
				<textarea class="form-control" id="post" name="post" rows="6" placeholder="Enter your post description" required></textarea>
			</div>
			<div class="form-group">
				<label for="text">To:</label>
				<input type="text" class="form-control" id="mention" name="mention" placeholder="To Organization" required>
			</div>
			<div class="form group">
				<input type="checkbox" id="anonymous" name="anonymous" value="true"> Anonymous
			</div>
			<br>
			<div class="form group">
				<input type="file" id="userfile" name="userfile">
			</div><br>
			<button type="submit" class="btn btn-primary btn-lg" value="Submit">Edit Post</button>
			<a href="postview.html"><button type="submit" class="btn btn-danger btn-lg" value="Batal">Kembali ke Halaman Sebelumnya</button></a>
		</form>
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

	<?php echo validation_errors(); ?>
	<?php echo $error; ?>

	<?php echo form_open_multipart('Post/edit/'.$Id); ?>

	<label>Title</label>
	<input type="text" name="title" value=<?php echo "\"$Title\""; ?> size="50" />
	<br/><label>Post</label><br/>
	<textarea name="post" rows="5" cols="50" style="resize:none"><?php echo $Data; ?></textarea>
	<br/><label>To: </label>
	<?php
		foreach ($mention as $row) {
			if($this->Post_model->is_mentioned($Id, $row->Username))
			{
				echo "<input type=\"checkbox\" name=\"mention[]\" value=\"".$row->Username."\" checked>".$row->Name;
			}
			else
			{
				echo "<input type=\"checkbox\" name=\"mention[]\" value=\"".$row->Username."\">".$row->Name;
			}
		}
	?>
	<br/><label>Attachment</label>
	<input type="file" name="userfile" value="<?php echo "\"$Attachments\""; ?>" size="20" />
	<label>Post as Anonymous</label>
	<input type="checkbox" name="anonymous" value="true" <?php if($IsAnonymous) echo "checked"; ?>/>
	<div><input type="submit" value="Submit" /></div>

	</form>
</div>
