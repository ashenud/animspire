<?php
    include '../../commons/session.php';
?>
<html>
    <head>
        <title>Freelancer Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include '../../includes/freelancer_dashboard_includes_css.php';?>
        <?php include '../../includes/freelancer_dashboard_includes_script.php'; ?>

        <?php
        
            include '../../../model/freelancer_model.php';
            
            //$freelancerObj = new Freelancer(); /// create feelancer object
            
            if(!isset($_SESSION["user"]["user_id"]))
            {
                ?>
                  <script> window.location = "../../index.php"</script>
               <?php
            }

            $user_id = $_SESSION["user"]["user_id"];
            $userId = base64_encode($user_id); 
            
        ?>
        
        
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">

        <div class="cont">
            <?php
                include './includes/dashboard-navbar.php';
            ?>
        </div>        
        
    </body>
    
    
</html>
