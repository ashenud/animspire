<?php
    include '../../commons/session.php';
?>
<html>
    <head>
        <?php
         
        include '../../model/user_model.php';
        $userObj = new User();
        $userResults = $userObj->getAllUsers();
        
        $userId = $_SESSION["user"]["user_id"];
        $userId = base64_encode($userId);
        
        ?>
        
        <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../css/style-user-dasboard.css"/>
        <link rel='stylesheet' type="text/css" href="../../css/style-user-management.css"/>
        <link rel='stylesheet' type="text/css" href="../../bootstrap/css/mdb.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
      
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">
        <div class="cont">
            <div class="sidebar">
                <a><img src="../../images/Animspire-Logo.png" id="logo"></a>
                <a href="user-management.php"><i class="fa fa-fw fa-home"></i><br>User Mng</a>
                <hr>
                <a href="admin-reports-management.php"><i class="fa fa-fw fa-wrench"></i><br>Reports</a>
                <hr>
                <a href="#clients"><i class="fa fa-fw fa-user"></i><br>Backup</a>
                <hr>
                <a href="#contact"><i class="fa fa-fw fa-envelope"></i><br>Chat</a>
                <hr>
                <a href="../../controller/userlogincontroller.php?status=logout"><img src="../../images/icons/logout.png" alt="Logout" style="width:50px;height:50px;margin-top: 140px; margin-left: 5px"></a>
                
            </div>
            <div class="top-navbar">
                <a href="user-profile.php?user_id=<?php echo $userId; ?>"><img src="../../images/Avatars/user_images/M5.png" id="prfile-pic" style="height: 50px; width: 50px; border: 2px solid white; border-radius: 50px;"/></a>
                <button onclick="document.location='admin-dashboard.php'" name="home" class="btn btn-primary">Home</button>
                <a href="#Notification"><i class="fa fa-fw fa-bell" ></i></a>
                <a href="#Chat"><i class="fa fa-fw fa-envelope" style="margin: 25px auto 20px 30px;"></i></a>
                
                <!-- Success message -->
                <?php
                if(isset($_GET["msgSuccess"]))
                {
                $msgSuccess=  base64_decode($_GET["msgSuccess"]);
                ?>
                <div class="alert alert-success" style="padding: 10px; height: 45px;">
                    <p><?php
                        echo $msgSuccess;
                        ?>
                    </p>
                </div>
                <?php
                }
                ?>
                
            </div>
            
            <div class="user-details">
               <div class="top-buttons">
                   <div class="row">
                        <div class="col-md-4">
                             <a href="add-user.php"><button name="adduser" class="btn btn-danger" id="adduser">Add User</button></a>
                        </div>
                       <div class="col-md-4" style="padding: 12px 70px 1px 70px;">
                             <h4>USER DETAILS</h4>
                        </div>
                        <div class="col-md-4" id="search">
                            <div id="search" style="margin: 5px 25px auto auto">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search" style="margin-top: 3px">
                                    <div class="input-group-append" >
                                        <button class="btn btn-success" type="submit" style="margin-top: 3px; padding: 10px"><span class="fa fa-lg fa-search" ></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
               </div>
              <div id="data_section" class="scroll" style="overflow-y:scroll;"> 
                <table id="user-table" border="1"  >
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
                    <td><img src="../../images/Avatars/user_images/<?php echo $userRow["user_image"]; ?>" style="height: 40px; width: 40px; "></td>
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
                        <a href="edit-user.php?user_id=<?php echo base64_encode($userRow["user_id"]); ?>"><button type="button" class="btn btn-warning" style="color:white">
                                <span class="fa fa-fw fa-edit"></span>Edit</button></a>
                                <?php
                                    if($userRow["user_status"]==0)
                                    {
                                ?>
                                <a href="../../controller/usercontroller.php?status=activateUser&user_id=<?php echo base64_encode($userRow["user_id"]); ?>"><button type="button" class="btn btn-success" style="width: 30px; height: 30px;" >
                                <span class="fa fa-fw fa-power-off"></span></button></a>
                                <?php
                                    }        
                                ?>
                                <?php
                                    if($userRow["user_status"]==1)
                                    {
                                ?>
                                <a href="../../controller/usercontroller.php?status=deactivateUser&user_id=<?php echo base64_encode($userRow["user_id"]); ?>"><button type="button" class="btn btn-danger" style="width: 30px; height: 30px;" >
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
   <?php
     include '../../includes/bootstrap_script_includes.php';
   
   ?>
    
    
    
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</html>
