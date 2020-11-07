<?php
    include '../../commons/session.php';
?>
<html>
    <head>
        <title>Freelancer Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include '../../includes/other_dashboard_includes_css.php';?>
        <?php include '../../includes/other_dashboard_includes_script.php'; ?>

        <?php
        
            include '../../model/freelancer_model.php';
            $freelancerObj = new Freelancer(); /// create feelancer object

            $freelancer_id = $_SESSION["freelancer"]["freelancer_id"];
            $freelancerId = base64_encode($freelancer_id); 
            
        ?>
        
        
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">

        <div class="cont">
            <?php
                include './includes/dashboard-navbar.php';
            ?>

            <div class="profile-info">
                <img src="../../images/Avatars/freelancer_images/<?php echo $_SESSION["freelancer"]["freelancer_image"]; ?>" alt="Avatar" style="width: 180px; height: 170px">
                <div class="info">
                    <h6><b><?php echo $_SESSION["freelancer"]["firstname"]." ".$_SESSION["freelancer"]["lastname"]; ?></b></h6>
                    <p>Freelancer</p>
                </div>
            </div>
            <div class="welcome-message" style="background-image:url('../../images/user-welcome-msg-bg.png');">
                <div class="welcome">
                    <h3><b>Hello,&nbsp; <?php echo $_SESSION["freelancer"]["firstname"]." ".$_SESSION["freelancer"]["lastname"]; ?></b></h3>
                    <h5>Welcome Home..</h5>
                </div>
            </div>

        </div>        
        
    </body>
    
    
</html>
