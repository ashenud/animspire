<html>
    <head>
        <title>Freelancer Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../css/style-user-dasboard.css"/>
        <link rel='stylesheet' type="text/css" href="../../bootstrap/css/mdb.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
      
      <?php
      
     include '../../includes/bootstrap_includes_css.php';
     
      ?>
        
        
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">
        <div class="cont">
            <div class="sidebar">
                <a><img src="../../images/Animspire-Logo.png" id="logo"></a>
                <a href="../login.php"><i class="fa fa-fw fa-home"></i><br>User Mng</a>
                <hr>
                <a href="#services"><i class="fa fa-fw fa-wrench"></i><br>Reports</a>
                <hr>
                <a href="#clients"><i class="fa fa-fw fa-user"></i><br>Backup</a>
                <hr>
                <a href="#contact"><i class="fa fa-fw fa-envelope"></i><br>Chat</a>
                <hr>
                <a href="#Logout"><span class="glyphicon glyphicon-log-out"></span></a>
            </div>
            <div class="top-navbar">
                <a href="#User Profile"><img src="../../images/profile-pic.png" id="prfile-pic" style="height: 50px; width: 50px;"/></a>
                <button href="#Home" name="home" class="btn btn-deep-orange">Home</button>
            </div>
            
        </div>
        
        
    </body>
   <?php
     include '../../includes/bootstrap_script_includes.php';
   
   ?>
    
    
    
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</html>
