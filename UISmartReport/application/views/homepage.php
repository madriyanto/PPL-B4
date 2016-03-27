<style>
	.btn-primary {
		background: #FFFF00;
		color: black;
		border-style: none;
		font-size: 35px;
		pointer-events: none;
	}
	.jumbotron {
		background: white;
	}
</style>
<script>
$(document).ready(function(){
	$('#check').click(function(){
		if($(this).attr('checked') == false){
			$('.btn-primary').css("pointer-events", "none");
			$('.btn-primary').attr('disabled','disabled');
		}
		else {
			$('.btn-primary').css("pointer-events", "auto");
			$('.btn-primary').removeAttr('disabled');
		}
	});
});
</script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<div class="navbar-brand"><img src="<?php echo base_url('assets/images/makara.png'); ?>" class="img-rounded" alt="Cinque Terre" width="30" height="30"></div>
			<div class="navbar-brand">UI Smart Report</div>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<div class="navbar-brand">About Us</div>
		</ul>
	</div>
</nav>
<br><br><br><br>
<div class="jumbotron">
	<div class="row">
		<div class="col-md-6">
			<h1 class="text-center">The place that you</h1>
			<h1 class="text-center">can report anything</h1>
			<h1 class="text-center">about UI's event</h1>
		</div>
		<div class="col-md-6"> 
			<form role="form" name="agree">
				<p class="text-center"><a href="<?php echo base_url('index.php/login/index'); ?>" class="btn btn-primary btn-lg" role="button" disabled="true">Login SSO</a></p>
				<p><h1 class="text-center">or</h1></p>
				<p class="text-center"><a href="<?php echo base_url('index.php/loginsp/index'); ?>" class="btn btn-primary btn-lg" role="button" disabled="true">Login SA*</a></p>
				<div class="checkbox text-center">
					<label><input type="checkbox" id="check">Please read the Agreement <a data-toggle="modal" data-target="#TermsAndConditions">here</a> before login here</label>
				</div>
				<div class="modal fade" id="TermsAndConditions" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title text-center">Terms and Conditions</h4>
							</div>
							<div class="modal-body">
								<p>Lorem ipsum dolor sit amet, veniam numquam has te. No suas nonumes recusabo mea, est ut graeci definitiones. His ne melius vituperata scriptorem, cum paulo copiosae conclusionemque at. Facer inermis ius in, ad brute nominati referrentur vis. Dicat erant sit ex. Phaedrum imperdiet scribentur vix no, ad latine similique forensibus vel.</p>
								<p>Dolore populo vivendum vis eu, mei quaestio liberavisse ex. Electram necessitatibus ut vel, quo at probatus oportere, molestie conclusionemque pri cu. Brute augue tincidunt vim id, ne munere fierent rationibus mei. Ut pro volutpat praesent qualisque, an iisque scripta intellegebat eam.</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>
						</div> 
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
