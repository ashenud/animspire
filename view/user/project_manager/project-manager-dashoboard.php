<?php
    include '../../commons/session.php';
?>
<html>
    <head>
        <title>Project Manager Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../css/style-user-dasboard.css"/>
        <link rel='stylesheet' type="text/css" href="../../bootstrap/css/mdb.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
      
      <?php
      
     include '../../includes/bootstrap_includes_css.php';
     include '../../model/user_model.php';
     
     $userObj = new User();
     $userRoleResult = $userObj->getAllUsers();
     
     $userId = $_SESSION["user"]["user_id"];
     $userId = base64_encode($userId);
     
      ?>
        
        
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">
        <div class="cont">
            <div class="sidebar">
                <a><img src="../../images/Animspire-Logo.png" id="logo"></a>
                <a href="project-management.php"><i class="fa fa-fw fa-briefcase"></i><br>User Mng</a>
                <hr>
                <a href="#reports"><i class="fa fa-fw fa-file-text"></i><br>Reports</a>
                <hr>
                <a href="#perfomance"><i class="fa fa-fw fa-line-chart"></i><br>Performance</a>
                <hr>
                <a href="#contact"><i class="fa fa-fw fa-envelope"></i><br>Chat</a>
                <hr>
                <a href="../../controller/userlogincontroller.php?status=logout"><img src="../../images/icons/logout.png" alt="Logout" style="width:50px;height:50px;margin-top: 140px; margin-left: 5px"></a>
                
            </div>
            <div class="top-navbar">
                <a href="user-profile.php?user_id=<?php echo $userId; ?>"><img src="../../images/Avatars/user_images/<?php echo $_SESSION["user"]["user_image"]; ?>" id="prfile-pic" style="height: 50px; width: 50px; border: 2px solid white; border-radius: 50px;"/></a>
                <button href="#Home" name="home" class="btn btn-primary">Home</button>
                <a href="#Notification"><i class="fa fa-fw fa-bell" ></i></a>
                <a href="#Chat"><i class="fa fa-fw fa-envelope" style="margin: 25px auto 20px 30px;"></i></a>
            </div>
            <div class="profile-info">
                <img src="../../images/Avatars/user_images/<?php echo $_SESSION["user"]["user_image"]; ?>" alt="Avatar" style="width: 180px; height: 170px">
                <div class="info">
                    <h6><b><?php echo $_SESSION["user"]["firstname"]." ".$_SESSION["user"]["lastname"]; ?></b></h6>
                    <p>Project Manager</p>
                </div>
            </div>
            <div class="welcome-message" style="background-image:url('../../images/user-welcome-msg-bg-2.png');">
                <div class="welcome">
                    <h3><b>Hello,&nbsp; <?php echo $_SESSION["user"]["firstname"]." ".$_SESSION["user"]["lastname"]; ?></b></h3>
                    <h5>Welcome Home..</h5>
                </div>
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
