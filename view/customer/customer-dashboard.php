<?php
    include '../../commons/session.php';
?>
<html>
    <head>
        <title>Customer Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include '../../includes/other_dashboard_includes_css.php';?>
        <?php include '../../includes/other_dashboard_includes_script.php'; ?>
      
      <?php
      
     include '../../includes/bootstrap_includes_css.php';
     
     $customerId = $_SESSION["customer"]["customer_id"];
     $customerId = base64_encode($customerId);
     
      ?>
        
        
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">
        <div class="cont">
            <div class="sidebar">
                <a><img src="../../images/Animspire-Logo.png" id="logo"></a>
                <a href="../login.php"><i class="fas fa-file-invoice"></i><br>Quotations</a>
                <hr>
                <a href="#services"><i class="fas fa-file-invoice-dollar"></i><br>Payments</a>
                <hr>
                <a href="#clients"><i class="fas fa-laptop"></i><br>Projects</a>
                <hr>
<!--                <a href="#contact"><i class="fa fa-fw fa-envelope"></i><br>Chat</a>-->
                <hr>
                <a href="#logout"><img src="../../images/icons/logout.png" alt="Logout" style="width:50px;height:50px;margin-top: 205px; margin-left: 5px"></a>
            </div>
            <div class="top-navbar">
                <a href="#User Profile"><img src="../../images/profile-pic.png" id="prfile-pic" style="height: 50px; width: 50px; border: 2px solid white; border-radius: 50px;"/></a>
                <button href="#Home" name="home" class="btn btn-primary">Home</button>
                <a href="#Notification"><i class="fa fa-fw fa-bell" ></i></a>
                <a href="#Chat"><i class="fa fa-fw fa-envelope" style="margin: 25px auto 20px 30px;"></i></a>
                
            </div>
            <div class="profile-info">
                <img src="../../images/Avatars/customer_images/<?php echo $_SESSION["customer"]["customer_image"]; ?>" alt="Avatar" style="width: 180px; height: 170px">
                <div class="info">
                    <h6><b><?php echo $_SESSION["customer"]["firstname"]." ".$_SESSION["customer"]["lastname"]; ?></b></h6>
                    <p>System Admin</p>
                </div>
            </div>
            <div class="welcome-message" style="background-image:url('../../images/user-welcome-msg-bg.png');">
                <div class="welcome">
                    <h3><b>Hello,&nbsp; <?php echo $_SESSION["customer"]["firstname"]." ".$_SESSION["customer"]["lastname"]; ?></b></h3>
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
