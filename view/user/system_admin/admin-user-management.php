<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        
        <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-user-management.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>
        <?php
         
            include '../../../model/user_model.php';
            $userObj = new User(); //must need for navbar
            $adminObj = new Admin(); //must need for navbar
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
            
            <div class="user-details">
               <div class="top-buttons">
                   <div class="row">
                        <div class="col-md-4">
                             <a href="admin-user-add.php"><button name="adduser" class="btn btn-danger" id="adduser">Add User</button></a>
                        </div>
                       <div class="col-md-4" style="padding: 12px 70px 1px 70px;">
                             <h4>USER DETAILS</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="search" style="margin: 4px 15px 4px 4px">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search" style="margin-top: 5px; width: 160px">
                                    <div class="input-group-append" >
                                        <button class="btn btn-success" type="submit" style="margin-top: 5px; padding: 10px"><span class="fa fa-lg fa-search" ></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
               </div>
                <div>
                    <div class="col-md-12">&nbsp;</div>
                </div>
              <div id="data_section" class="scroll" style="display: box; overflow-y:scroll;"> 
                <table id="user-table" border="1" style="overflow-y:scroll;">
                    <tr>
                    <th ></th>
                    <th width="30px">&nbsp;ID</th>
                    <th width="90px">&nbsp;First Name</th>
                    <th width="90px">&nbsp;Last Name</th>
                    <th width="180px">&nbsp;Email</th>
                    <th width="165px">&nbsp;Role</th>
                    <th width="80px">&nbsp;Phone</th>
                    <th width="90px">&nbsp;DOB</th>
                    <th width="60px">Gender</th>
                    <th width="100px"></th>
                    </tr>
                    <?php
                       while($userRow = $userResults->fetch_assoc())
                       {
                    ?>
                    <tr>
                    <td><img src="../../../images/Avatars/user_images/<?php echo $userRow["user_image"]; ?>" style="height: 40px; width: 40px; "></td>
                    <td style="text-align:center"><?php echo $userRow["user_id"]; ?></td>
                    <td>&nbsp; <?php echo $userRow["user_fname"]; ?></td>
                    <td>&nbsp; <?php echo $userRow["user_lname"]; ?></td>
                    <td>&nbsp; <?php echo $userRow["user_email"]; ?></td>
                    <td>&nbsp; <?php echo $userRow["role_name"]; ?></td>
                    <td>&nbsp; <?php echo $userRow["user_phone"]; ?></td>
                    <td>       <?php echo $userRow["user_dob"]; ?></td>
                    <td>&nbsp;
                        <?php 
                        if($userRow["user_gender"]==0)
                        {
                        ?>
                        Male
                        <?php
                        }
                        if($userRow["user_gender"]==1)
                        {
                        ?>
                        Female
                        <?php
                        }
                        ?>
                    </td>
                    <td>
                        <a href="admin-user-edit.php?user_id=<?php echo base64_encode($userRow["user_id"]); ?>"><button type="button" class="btn btn-warning" style="color:white">
                                <span class="fa fa-fw fa-edit"></span>Edit</button>
                        </a>
                        <?php
                            if($userRow["user_status"]==0)
                            {
                        ?>
                        <a href="../../../controller/usercontroller.php?status=activateUser&user_id=<?php echo base64_encode($userRow["user_id"]); ?>"><button type="button" class="btn btn-success" style="width: 30px; height: 30px;" >
                        <span class="fa fa-fw fa-toggle-on"></span></button></a>
                        <?php
                            }        
                        ?>
                        <?php
                            if($userRow["user_status"]==1)
                            {
                        ?>
                        <a href="../../../controller/usercontroller.php?status=deactivateUser&user_id=<?php echo base64_encode($userRow["user_id"]); ?>"><button type="button" class="btn btn-danger" style="width: 30px; height: 30px;" >
                        <span class="fa fa-fw fa-power-off"></span></button></a>
                        <?php
                            }        
                        ?>
                        
                    
                    </td>
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
