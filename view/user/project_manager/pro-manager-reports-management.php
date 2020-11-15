<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        <title>Project Manager Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-report-management-pro.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>
      
        <?php
        
            include '../../../model/user_model.php';
            $userObj = new User(); //must need for navbar
            $proManagerObj = new projectManager(); //must need for navbar

            /* permission check */
            if(!isset($_SESSION["user"]["role_id"])) {
                $userObj->checkUser('0');
            }
            elseif(($_SESSION["user"]["role_id"]) != 2){
                $userObj->checkUser($_SESSION["user"]["role_id"]);
            }
            /* end permission check */
            
            $user_id = $_SESSION["user"]["user_id"];
            $userId = base64_encode($user_id);
        
        ?>
        
        
    </head>
    
    <body  style="background-image: url('../../../images/background-image.png');">
        <div class="cont">
            <?php
                include './includes/dashboard-navbar.php';
            ?>
            <div class="report-generation">
                   <div class="row">
                       <div class="col-md-12" style="padding: 18px 70px 1px 70px; text-align: center">
                             <h4>Report Generation</h4>
                        </div>
                   </div>
                   <div class="row">
                        <div class="col-md-12">
                             &nbsp;
                        </div>
                   </div>
                <div class="top-buttons">
                   <div class="row">
                        <div class="col-md-4">
                            <a href="./pro-manager-reports-projects.php"><button name="report-generate-1" class="btn btn-success" id="report-generate" style="width: 330px; margin-left: 50px">Report of 2 Projects Comparison</button></a>
                        </div>
                       <div class="col-md-8">
                           <a href="./pro-manager-reports-freelancers.php"><button name="report-generate-2" class="btn btn-success" id="report-generate" style="width: 460px; margin-left: 130px">Report of 2 Freelancers Performance Comparison</button></a>
                        </div>
                   </div>
               </div>
              
            </div>
         </div>
        
    </body>

</html>