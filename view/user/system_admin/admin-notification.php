<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
                
        <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-notification-management.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>

        <?php
         
            include '../../../model/user_model.php';
            $userObj = new User(); //must need for navbar
            $adminObj = new Admin(); //must need for navbar
            $userResults = $userObj->getAllUsers();
            
            $user_id = $_SESSION["user"]["user_id"];
            $userId = base64_encode($user_id);
        
        ?>
      
    </head>
    
    <body  style="background-image: url('../../../images/background-image.png');">
        <div class="cont">
            <?php
                  include './includes/dashboard-navbar.php';
            ?>
            
            <div class="user-details">
                
              <div id="data_section" class="scroll" style="overflow-y:scroll;"> 
                <table id="notification-table" border="1"  >
                   <tr>
                        <th>Notifications</th>
                        <th width="50px"></th>
                    </tr>
                    
                    <?php
                    $request = $adminObj->freelancerRequest();
                    if ($request->num_rows > 0) {
                        while ($req = $request->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>&nbsp;New freelancer, <?php echo $req['freelancer_fname']?> wants to join to the system</td>
                                <td>
                                    <a href="../../../controller/adminController.php?status=activate_user&free_id=<?php echo base64_encode($req['freelancer_login_id']);?>"><button type="button" class="btn btn-success" style="width: 30px; height: 30px;" >
                                            <span class="fas fa-check-circle"></span></button></a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <tr>
                            <td colspan="2" align="center">&nbsp;No new Notifications</td>
                        </tr>
                        <?php
                    }
                    
                    ?>
                   
                </table>
              </div>
            </div>
            
        </div>
        
    </body>
    
</html>
