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

  .text-left{
    margin-top: 10px;
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
</style>
<script>
$(document).ready(function(){
  $('#mention').tokenfield(function(){
    autocomplete: {
      source: ['Organisasi1', 'Organisasi2', 'Organisasi3', 'Organisasi4', 'Organisasi5'];
      delay: 100
    }
    showAutocompleteOnFocus: true
  })
});
</script>
<body>
<nav class="navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
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

<div class="row">
  <div class="col-md-offset-1 col-md-2" id="profpic">
    <img id="pic" src="<?php echo base_url('assets/images/makara.png'); ?>" class="img-rounded" alt="Cinque Terre" width="165px" height="165px"> 
  </div>

  <div class="col-md-8" id="finalPost">
    <div class="col-md-9" id="datadiri">
      <h3 class="text-left">Name</h3>
      <h3 class="text-left">Email</h3>
      <h3 class="text-left">Contact</h3>
    </div>

    <div class="col-md-3" id="coba">
      <br>
      <h4 class="text-left">Jumlah Post : 120</h4>
      <h4 class="text-left">Close Thread : 100</h4>
    </div>
  </div>

  <div class="col-md-offset-1 col-md-10" id="navbarbawah">
    <div class="col-md-4" id="subnavbar"><p id="tujuan">Post</p></div>
    <div class="col-md-4" id="subnavbar"><a href="#">Pinned</a></div>
    <div class="col-md-4" id="subnavbar"><a href="#">Mention</a></div>
  </div>

</div>

<div class="bagian-bawah">
  
</div>

</body>
</html>