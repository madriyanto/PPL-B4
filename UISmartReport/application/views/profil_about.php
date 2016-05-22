<style>

  body {
    background-color: #E4E4E4;
  }

  .box-post {
    background-color: white;
    border-radius: 20px;
    margin-bottom: 10px;
  }

  #mynavbar a{
    color: #dfdbdb;
  }

  .row{
    margin-right: 0px;
  }

  #profpic{
    margin-right: -15px;
  }

  #special{
    background-color: grey;
  }

  #navbarbawah a{
    color: black;
  }

  #navbarbawah div{
    margin-top: 3%;
  }
  
  #navbarbawah{
    margin-top: 20px;
    margin-bottom : 30px;
  }
  
  #special{
  	background-color: #8D8D8D;
  }
  
  #tujuan{
  	color: white;
  	text-decoration: underline;
  }

  .subnavbar{
    text-align: center;
    padding-top: 5px;
    font-size: 22px;
    margin-top: 20px;
    border: 2px solid white;
    background-color: white;
    height: 45px;
  }

  .postButton{
    background: #FFFF00;
    color: black;
    border-style: none;
  }


  #dataAtas{
    border: 5px solid;
    height: 250px;
  }

  #about-content {
    background-color: white;
    padding-top: 10px;
    padding-bottom: 10px;
    border-radius: 8px;
    margin-left: 9.4%;
    width: 81%;
  }
  
  #finalPost{
    background-color: white;
    color: black;
    border-style: none;
    height: 165px;
    border-radius: 10px;
  }

  #kotakBO{
    top: 25px;
  }

  .anonim{
    margin-left: 100px;
  }

  .bagian-bawah{
    margin-bottom: 5%;
  }

  #kotak-search{
    margin-top: 30px;
    margin-bottom: 30px;
  }

  #search-content{

  }

  #totalMention{
    top: 2px;
    font-size: 25px;
  }

  .navbar-bottom {
    margin-bottom: 0px;
    bottom: 0;
    width: 100%;
    position: absolute;
  }
  
  @media screen and (min-width:768px){
    .row{
      margin-right: 0px;
    }
  }

  @media screen and (max-width:1000px){

    #profpic img{
      display: block;
        margin-left: auto;
        margin-right: auto
    }

    #kotak-search{
      left: 10%;
    }

    #datadiri{
      margin-top: 25px;
      padding: 10px 5px 10px 5px;
    }

    #datadiri h3{
      text-align: center;
      font-size: 15px;
    }

    #kotakBO{
      top: 20px;
      margin-bottom: 30px;
    }

    #kotakBO h4{
      text-align: center;
      font-size: 15px;
    }
    
    .bagian-bawah{
      margin-bottom: 15%; 
    }

    #finalPost{
      width: 80%;
      margin-left: 10%;
      margin-bottom: 10px;
      height: 250px;
    }

    .subnavbar{
      width: 85%;
      left: 8%;
      border-radius: 5px;
      height : 40px;
      font-size: 16px;
    }

    #navbarbawah{
      margin-top: 10px;
      margin-bottom: 30px;
    }

    #totalMention{
      font-size: 20px;
    }

    .form-control{
      width: 90%;
    }
  }
</style>
<body>
<nav class="navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <div class="navbar-brand"><a href="<?php echo base_url(); ?>">UI Smart Report</a></span></div>
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
<div class="row">
  <div class="col-md-offset-1 col-md-2" id="profpic">
    <?php if ($PictLink == null) { ?>
    <img id ="pic" src="<?php echo base_url('assets/images/makara.png'); ?>" class="img img-rounded" alt="Cinque Terre" width="165px" height="165px"> 
    <?php } else { ?>
    <img id ="pic" src="<?php echo $PictLink; ?>" class="img img-rounded" alt="Cinque Terre" width="165px" height="165px">
    <?php } ?>
  </div>

  <div class="col-md-8" id="finalPost">
    <div class="col-md-9" id="datadiri">
      <h3 class="text-left"><?php echo $Name; ?></h3>
      <h3 class="text-left"><?php echo $Email; ?></h3>
      <h3 class="text-left"><?php echo $Contact; ?></h3>
    </div>

    <div class="col-md-3" id="kotakBO">
      <br>
      <h4 class="text-left">Total Posts : <?php echo $count_posts; ?></h4>
      <h4 class="text-left">Closed Posts : <?php echo $count_closed_posts; ?></h4>
    </div>
  </div>

  <div class="col-md-offset-1 col-md-10" id="navbarbawah">
    <?php
    if($Username == $this->session->userdata('username')) {
      $post_url = base_url('profile/posts/');
    } else {
      $post_url = base_url('people/posts/'.$Username);
    }
    ?>
    <div class="col-md-3 subnavbar"><a href="<?php echo $post_url; ?>">Post</a></div>	
  
    <div class="col-md-3 subnavbar" id="special"><p id="tujuan">About</p></div>
    
    <?php if($Username == $this->session->userdata('username') || $this->session->userdata('admin')) { ?>
    <?php
    if($Username == $this->session->userdata('username')) {
      $pinned_url = base_url('profile/pinned');
    } else {
      $pinned_url = base_url('people/pinned/'.$Username);
    }
    ?>
    <div class="col-md-3 subnavbar"><a href="<?php echo $pinned_url; ?>">Pinned</a></div>
    
    <?php
    if($Username == $this->session->userdata('username')) {
      $mention_url = base_url('profile/mention');
    } else {
      $mention_url = base_url('people/mention/'.$Username);
    }
    ?>
    <div class="col-md-3 subnavbar"><a href="<?php echo $mention_url; ?>">Mention</a></div>
    <?php } ?>
  </div>

</div>

<div class="row">
	<div class="col-md-offset-1 col-md-10" id="about-content">
		<?php echo nl2br($About); ?>
	</div>
</div>

<div class="bagian-bawah">
  
</div>
