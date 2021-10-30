<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>
      
        <?php
        
            include '../../../model/user_model.php';
            
            $userObj = new User(); //must need for navbar
            $adminObj = new Admin(); //must need for navbar

            /* permission check */
            if(!isset($_SESSION["user"]["role_id"])) {
                $userObj->checkUser('0');
            }
            elseif(($_SESSION["user"]["role_id"]) != 1){
                $userObj->checkUser($_SESSION["user"]["role_id"]);
            }
            /* end permission check */
            
            $userRoleResult = $userObj->getAllUsers();
            
            $user_id = $_SESSION["user"]["user_id"];
            $userId = base64_encode($user_id);
        
        ?>
        
        
    </head>
    
    <body  style="background-image: url('../../../images/background-image.png');">
        <div class="cont">
            <?php
                  include './includes/dashboard-navbar.php';
            ?>
            
            <div class="profile-info">
                <img src="../../../images/Avatars/user_images/<?php echo $_SESSION["user"]["user_image"]; ?>" alt="Avatar" style="width: 180px; height: 170px">
                <div class="info">
                    <h6><b><?php echo $_SESSION["user"]["firstname"]." ".$_SESSION["user"]["lastname"]; ?></b></h6>
                    <p>System Admin</p>
                </div>
            </div>
            <div class="welcome-message" style="background-image:url('../../../images/user-welcome-msg-bg.png');">
                <div class="welcome">
                    <h3><b>Hello,&nbsp; <?php echo $_SESSION["user"]["firstname"]." ".$_SESSION["user"]["lastname"]; ?></b></h3>
                    <h5>Welcome Home..</h5>
                </div>
            </div>
            <div class="users" >
              <div class="row">
                  <?php
                        while($userRoleRow = $userRoleResult->fetch_assoc())
                        {
                        if($userRoleRow["role_id"]==1)
                        {
                    ?>
                <div class="col-md-3">
                    <img src="../../../images/Avatars/user_images/<?php echo $userRoleRow["user_image"]; ?>" alt="Avatar" style="width: 100px; height: 100px; border-radius: 50px; margin: 18px 15px">
                    <h6><b><?php echo $userRoleRow["user_fname"]; ?></b></h6>
                    <p>System Admin</p>
                </div>
                  <?php
                        }
                        if($userRoleRow["role_id"]==2)
                        {
                  ?>
                <div class="col-md-3">
                    <img src="../../../images/Avatars/user_images/<?php echo $userRoleRow["user_image"]; ?>" alt="Avatar" style="width: 100px; height: 100px; border-radius: 50px; margin: 18px 15px">
                    <h6><b><?php echo $userRoleRow["user_fname"]; ?></b></h6>
                    <p>Project Manager</p>
                </div>
                  <?php
                        }
                        if($userRoleRow["role_id"]==3)
                        {
                  ?>
                <div class="col-md-3">
                    <img src="../../../images/Avatars/user_images/<?php echo $userRoleRow["user_image"]; ?>" alt="Avatar" style="width: 100px; height: 100px; border-radius: 50px; margin: 18px 15px">
                    <h6><b><?php echo $userRoleRow["user_fname"]; ?></b></h6>
                    <p>Finance Manager</p>
                </div>
                  <?php
                        }
                        if($userRoleRow["role_id"]==4)
                        {
                  ?>
                <div class="col-md-3">
                    <img src="../../../images/Avatars/user_images/<?php echo $userRoleRow["user_image"]; ?>" alt="Avatar" style="width: 100px; height: 100px; border-radius: 50px; margin: 18px 15px">
                    <h6><b><?php echo $userRoleRow["user_fname"]; ?></b></h6>
                    <p>Marketing Manager</p>
                </div>
                  <?php
                        }
                        }  
                  ?>
              </div>
            </div>
            
        </div>
        
        
    </body>
    
</html>
