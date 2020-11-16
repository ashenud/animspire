<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        <title>Finance Manager Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-finance-management.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>
      
        <?php
        
            include '../../../model/user_model.php';
            
            $userObj = new User();

            /* permission check */
            if(!isset($_SESSION["user"]["role_id"])) {
                $userObj->checkUser('0');
            }
            elseif(($_SESSION["user"]["role_id"]) != 3){
                $userObj->checkUser($_SESSION["user"]["role_id"]);
            }
            /* end permission check */

            $userRoleResult = $userObj->getAllUsers();
            
            $userId = $_SESSION["user"]["user_id"];
            $userId = base64_encode($userId);
        
        ?>
        
        
    </head>
    
    <body  style="background-image: url('../../../images/background-image.png');">
        <div class="cont">
            <?php
                include './includes/dashboard-navbar.php';
            ?>
            <div class="finance-details">
               <div class="top-buttons">
                   <div class="row">
                     <div class="col-md-8" style="padding: 12px 50px 1px 350px;">
                             <h4>FINANCE DETAILS</h4>
                     </div>
                     <div class="col-md-4" style="padding: 12px 20px 1px 100px;">
                        <button type="button" class="btn btn-success btn-sm" onclick="#" style="width: 80px; padding: 4px; font-size: 15px">Paid</button>
                        <button type="button" class="btn btn-warning btn-sm" onclick="#" style="width: 80px; padding: 4px; font-size: 15px; color: white">Pending</button>
                     </div>
                   </div>
               </div>
                
                <div>
                    <table class="finance-table" border="1" >
                        <tr>
                            <th width="80px">&nbsp;Quote ID</th>
                            <th width="60px">&nbsp;Pro.ID</th>
                            <th width="219px">&nbsp;Project Name</th>
                            <th width="130px">&nbsp;Pro.Manager</th>
                            <th width="120px">&nbsp;Start Date</th>
                            <th width="120px">&nbsp;End Date</th>
                            <th width="100px">&nbsp;Amount</th>
                            <th width="100px">&nbsp;Status</th>
                            <th width="60px"></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a
                                href=""><button
                                type="button" class="btn btn-info" style="width: 60px; height: 30px;">
                                        <span class="fas fa-dollar-sign"></span>&nbsp;View</button></a>
                            </td>
                        </tr>
                    </table>
                    
                </div>
               
              
            </div>
            
            
        </div>
        
        
    </body>

</html>
