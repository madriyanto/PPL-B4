<style>
  body {
    background-color: #E4E4E4;
  }
  .btn-lg {
    background: #FFFF00;
    color: black;
    border-style: none;
    font-size: 40px;
    pointer-events: none;
  }
  .btn-small {
  	font-size: 20px;
  }
  .row{
    margin-right: 0px;
  }
  #loginsp {
    text-align: center;
    font-size: 15px;
    margin-top: 10px;
  }
  #font1{
    text-align: center;
    font-size: 60px;
  }
  .navbar-header{
    font-size: 25px
  }

  #kotak1{
  	margin-top: 8%;
  }

  #kotak2{
  	margin-top: 5%;
  }

  #kotak3{
  	margin-top: 5%;
  	margin-bottom: 5%; 
  }

  @media screen and (max-width:768px){

  		#font1{
  			font-size: 40px;
  		}


		#kotak1{
  			margin-top: 20%;
  		}

	    #kotak2{
  			margin-top: 5%;
  		}

  		#kotak3{
  			margin-top: 5%;
  			margin-bottom: 15%; 
  		}
		.text-center{
			font-size: 18px;
		}
  }

</style>
<script>
  $(document).ready(function(){
    $('.btn-primary').css("pointer-events", "auto");
    $('.btn-primary').removeAttr('disabled');
  });
</script>
</head>
<body>
  
  <nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
       		 <div class="navbar-brand">UI Smart Report
       		 </div>

       		 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>                        
      		 </button>
		</div>		
		
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				<li class="navbar-brand">About Us</li>
			</ul>
		</div>
	</div>
  </nav>
  
  <div id="kotak1">
  	<p id="font1"> 
  		UI SMART REPORT 
  	</p>
  </div>
  
  <div id="kotak2">
	 <h2 class="text-center">The place that you can report 
  	 </h2>
  	 <h2 class="text-center">anything about UI's event
  	</h2>
  </div>

  <div id="kotak3">
  	<h6 class="text-center">
    	<a href="<?php echo base_url('index.php/Login/index'); ?>" class="btn btn-primary btn-lg" role="button">Login SSO
    	</a>
  	</h6>
  	<p id="loginsp">Are you BSO / BO? Login 
    	<a data-toggle="modal" data-target="#TermsAndConditions">here
    	</a>
  	</p>
  	
  	<div class="modal fade" id="TermsAndConditions" role="dialog">
    	<div class="modal-dialog">
      <!-- Modal content-->
      		<div class="modal-content">
        		<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal">&times;
          		</button>
          		<h4 class="modal-title text-center">Terms and Conditions
          		</h4>
        	</div>
        
        	<div class="modal-body">
          		<p>Are you sure that you are BO / BSO?
          		</p>
        	</div>
        
        	<div class="modal-footer">
          		<p class="text-center">
            		<a href="<?php echo base_url('index.php/Loginsp/index'); ?>" class="btn btn-primary btn-sm" role="button">Yes, I'am BO/BSO
            		</a>
          		</p>
        	</div>
      	</div> 
    </div>
  </div>
