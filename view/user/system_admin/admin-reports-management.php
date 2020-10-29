<?php
    include '../../../commons/session.php';
?>
<html>
    <head>       
        <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-report-management.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>

        <?php
         
            include '../../../model/user_model.php';
            $userObj = new User();
            $userResults = $userObj->getAllUsers();
            
            $userId = $_SESSION["user"]["user_id"];
            $userId = base64_encode($userId);
        
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
                            <a href="./admin-reports-backups.php"><button name="report-generate-1" class="btn btn-success" id="report-generate">Report of Backup Details</button></a>
                        </div>
                       <div class="col-md-6">
                           <a href="./admin-reports-users.php"><button name="report-generate-2" class="btn btn-success" id="report-generate">Report of System Users</button></a>
                        </div>
                   </div>
               </div>
              
            </div>
        </div>
    </body>    
</html>
