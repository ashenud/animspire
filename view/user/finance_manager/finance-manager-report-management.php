<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        <title>Finance Manager Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-report-management.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>
      
        <?php
        
            include '../../../model/user_model.php';
            
            $userObj = new User();
            $financeManagerObj = new FinanceManager(); //must need for navbar

            /* permission check */
            if(!isset($_SESSION["user"]["role_id"])) {
                $userObj->checkUser('0');
            }
            elseif(($_SESSION["user"]["role_id"]) != 3){
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
                        <div class="col-md-6">
                            <a href="./finance-manager-reports-client-orders.php"><button name="report-generate-1" class="btn btn-success" id="report-generate">Report of Customer Orders</button></a>
                        </div>
                   </div>
               </div>
              
            </div>
        </div>
    </body>

</html>
