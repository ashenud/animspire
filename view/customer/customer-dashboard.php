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
     
        include '../../model/customer_model.php';
        $customerObj = new Customer(); //must need for navbar
     
        $customerId = $_SESSION["customer"]["customer_id"];
        $customerId = base64_encode($customerId);
     
      ?>
        
        
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">
        <div class="cont">

            <?php
                include './includes/dashboard-navbar.php';
            ?>

            <div class="profile-info">
                <img src="../../images/Avatars/customer_images/<?php echo $_SESSION["customer"]["customer_image"]; ?>" alt="Avatar" style="width: 180px; height: 170px">
                <div class="info">
                    <h6><b><?php echo $_SESSION["customer"]["firstname"]." ".$_SESSION["customer"]["lastname"]; ?></b></h6>
                    <p>Customer</p>
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
    
</html>
