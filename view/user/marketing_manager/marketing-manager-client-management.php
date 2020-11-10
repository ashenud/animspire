<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
                
        <title>Quotation Management</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-client-details.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>
       
        <?php
         
            include '../../../model/user_model.php';
            
            $userObj = new User(); //must need for navbar
            $marketingManagerObj = new MarketingManager(); //must need for navbar
            
            /* permission check */
            if(!isset($_SESSION["user"]["role_id"])) {
                $userObj->checkUser('0');
            }
            elseif(($_SESSION["user"]["role_id"]) != 4){
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
            
            <div class="client-details">
               <div class="top-buttons">
                   <div class="row">
                     <div class="col-md-8" style="padding: 12px 50px 1px 350px;">
                             <h4>CUSTOMER DETAILS</h4>
                     </div>
                     <div class="col-md-4">
                            <div class="search" style="margin: 10px 25px 4px 4px">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search" style="margin-top: 5px; width: 50px">
                                    <div class="input-group-append" >
                                        <button class="btn btn-success" type="submit" style="margin-top: 5px; padding: 10px"><span class="fa fa-lg fa-search" ></span></button>
                                    </div>
                                </div>
                            </div>
                     </div>
                   </div>
               </div>
                
                <div>
                    <table class="client-table" border="1" >
                        <tr>
                            <th width="40px"></th>
                            <th width="30px">&nbsp;ID</th>
                            <th width="100px">&nbsp;First Name</th>
                            <th width="100px">&nbsp;Last Name</th>
                            <th width="190px">&nbsp;Email</th>
                            <th width="170px">&nbsp;Country</th>
                            <th width="100px">&nbsp;Phone</th>
                            <th width="110px">&nbsp;DOB</th>
                            <th width="90px">Gender</th>
                            <th width="30px"></th>
                        </tr>
                        <tr>
                            <td><img src="#"
                                style="height: 40px; width: 40px;"></td>
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
                                type="button" class="btn btn-danger" style="width: 30px; height: 30px;">
                                <span class="fa fa-fw fa-power-off"></span></button></a>
                            </td>
                        </tr>
                    </table>
                    
                </div>
               
              
            </div>
            
        </div>

       
        
        
    </body>

    
    
</html>
