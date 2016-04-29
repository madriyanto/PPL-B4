<style>
  
  body {
    background-color: #E4E4E4;
  }

  #coba{
    top: 50px;
  }

  #mynavbar a{
    color: #dfdbdb;
  }

  #navbarbawah a{
    color: black;
  }

  #navbarbawah div{
    margin-top: 3%;
  }

  .postButton{
    background: #FFFF00;
    color: black;
    border-style: none;
  }

  #pic{
    border: 5px solid white;
  }

  #tujuan{
    text-decoration: underline;
  }

  .inipos{
    border: 5px solid;
  }

  #profpic{
    width: 15%;
    height: 25%;
  }

  #finalPost{
    background: white;
    color: black;
    border-style: none;
    height: 165px;
  }

  .anonim{
    margin-left: 100px;
  }

  .bagian-bawah{
    margin-bottom: 5%;
  }

  #navbar{
    border: 1px solid blue;
    margin-top: 3%;
  }

  #subnavbar{
    text-align: center;
    font-size: 25px;
    margin-top: 1%;
    border: 2px solid white;
    background-color: white;
    height: 45px;
  }

  @media screen and (max-width:1000px){
    .row{
      margin-right: 0px;
    }

    .form-control{
      width: 90%;
    }

    #datadiri {
      margin-top: 50px;
      border: 1px solid white;
    }

    #datadiri h3{
      text-align: center;
    }

    #coba h4{
      text-align: center;
    }

    #finalPost{
      height: 300px;
      width: 84%;
      left: 9%;
      border-radius: 5px;
    }


    #navbarbawah{
      margin-top: 10px;
      margin-bottom: 10px;
    }

    .bagian-bawah{
      margin-bottom: 15%;
    }

    #coba{
      margin-top: 20px; 
    }

    #subnavbar{
      width: 90%;
      left: 6%;
      border-radius: 5px;
    }

    
    #profpic img{
      margin: auto;
    }

  }

  .navbar-bottom {
      margin-bottom: 0px;
      bottom: 0;
      width: 100%;
    }

    .box-post {
    background-color: white;
      border-radius: 20px;
      margin-bottom: 10px;
  }

  .image {
    position: relative;
    overflow: hidden;
    padding-bottom:100%;
  }
  
  .image img {
    position: absolute;
    max-width: 100%;
    max-height: 100%;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
  }

  @media screen and (min-width:768px){
    .row{
      margin-right: 0px;
    }
  }
</style>
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

    <div class="col-md-3" id="coba">
      <br>
      <h4 class="text-left">Total Posts : <?php echo $count_posts; ?></h4>
      <h4 class="text-left">Closed Posts : <?php echo $count_closed_posts; ?></h4>
    </div>
  </div>

  <div class="col-md-offset-1 col-md-10" id="navbarbawah">
    <div class="col-md-4" id="subnavbar"><a href="#">Post</a></div>
    <div class="col-md-4" id="subnavbar"><p id="tujuan">Pinned</p></div>
    <div class="col-md-4" id="subnavbar"><a href="#">Mention</a></div>
  </div>

</div>

<div class="bagian-bawah">
  
</div>
<?php
  $i = 1;
  $last_page = false;
  foreach ($timeline as $row) {
    if ($row->Status) {
      date_default_timezone_set("Asia/Jakarta");
      $timestamp = mysql_to_unix($row->Timestamp);
      $timespan = timespan($timestamp)." Ago";

      if ((now() - $timestamp) >= (24*60*60)) {
        $timespan = date('F d, Y', $timestamp);
      }
    
      if ($i % 3 == 1) {
        echo "<div class=\"row\">";
        echo "<div class=\"col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-md-4\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-xs-12 col-sm-12 col-md-12 box-post\">";
      } else {
        echo "<div class=\"col-md-4\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-xs-12 col-sm-12 col-md-12 box-post\">";
      }
?>
      <div class="row">
        <div class="col-xs-offset-4 col-xs-8">
          <h5 class="text-right"><?php echo $timespan; ?></h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="image">
            <?php if ($row->PictLink == null || ($row->IsAnonymous && !$isSPAcc)) { ?>
            <img src="<?php echo base_url('assets/images/makara.png'); ?>" class="img img-rounded img-responsive" alt="Cinque Terre"> 
            <?php } else { ?>
            <img src="<?php echo $row->PictLink; ?>" class="img img-rounded img-responsive" alt="Cinque Terre">
            <?php } ?>
          </div>
        </div>
        <div class="col-md-8">
          <?php if ($row->IsAnonymous && ($this->session->userdata['admin'] || $row->OwnerId == $this->session->userdata['username'])) { ?>
          <h5><a href="<?php echo base_url('people/view/'.$row->Username); ?>"><?php echo $row->Name; ?> (Anonymous)</a></h5>
          <?php } else if ($row->IsAnonymous) { ?>
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
        <div class="col-md-offset-1 col-md-10">
          <?php if ($row->Attachments != null) { ?>
          <img src="<?php echo $row->Attachments; ?>" class="img-rounded center-block img-responsive" alt="Cinque Terre">
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
      </div>
      <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
          <h5><?php if ($this->Post_model->count_comment($row->Id) > 1) { echo $this->Post_model->count_comment($row->Id); ?> Comments<?php } else { echo $this->Post_model->count_comment($row->Id); ?> Comment<?php } ?></h5>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
          <h5 class="text-right"><a href="<?php echo base_url('post/view/'.$row->Id); ?>">View Details</a></h5>
        </div>
      </div>
    </div>
    </div>
    </div>
<?php 
      if ($i % 3 == 0) {
        echo "</div>";
        echo "</div>";
        echo "</div>";
      }
      
      if ($row->Id == $this->Post_model->get_first_post_id()) {
        $last_page = true;
      }
      $i++;
    }
  }
  if ($i-1 % 3 != 0) {
    echo "</div>";
    echo "</div>";
    echo "</div>";
  }
  if($i-1 <= 3) {
    echo "</div>";
  }
?>