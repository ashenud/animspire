<?php
    include '../../commons/session.php';
?>
<html>
    <head>
        <?php
            include '../../model/user_model.php';
            
            $userObj = new User(); /// create user   object
            
            if(!isset($_REQUEST["user_id"]))
            {
                ?>
                  <script> window.location = "../../../index.php"</script>
               <?php
            }
            
            $userId = $_REQUEST["user_id"];
            $userId = base64_decode($userId);
            
            /// get the specific user information
            $userResult = $userObj->viewUser($userId);
            ///convert into an assosiative arry
            $userRow = $userResult->fetch_assoc();
            
     
        ?>
        
        <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../css/style-user-dasboard.css"/>
        <link rel='stylesheet' type="text/css" href="../../css/style-user-profile.css"/>
        <link rel='stylesheet' type="text/css" href="../../bootstrap/css/mdb.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
      <style>
            .modal-dialog{
                padding-top: 50px;
            }
            .modal-content .modal-header{
                border-bottom: none;
                text-align: center;
                background-image: linear-gradient(180deg, #834d9b, #d04ed6);
                height: 80px;
                color: white;
                
            }
            
        </style>
      
        
        
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">
        <div class="cont">
            <div class="sidebar">
                <a><img src="../../images/Animspire-Logo.png" id="logo"></a>
                <a href="user-management.php"><i class="fa fa-fw fa-home"></i><br>User Mng</a>
                <hr>
                <a href="#Reports"><i class="fa fa-fw fa-wrench"></i><br>Reports</a>
                <hr>
                <a href="#Backup"><i class="fa fa-fw fa-user"></i><br>Backup</a>
                <hr>
                <a href="#Chat"><i class="fa fa-fw fa-envelope"></i><br>Chat</a>
                <hr>
                <a href="#logout"><img src="../../images/icons/logout.png" alt="Logout" style="width:50px;height:50px;margin-top: 140px; margin-left: 5px"></a>
                
            </div>
            <div class="top-navbar">
                <a href="user-profile.php"><img src="../../images/Avatars/user_images/<?php echo $_SESSION["user"]["user_image"]; ?>" id="prfile-pic" style="height: 50px; width: 50px; border: 2px solid white; border-radius: 50px;"/></a>
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
            
            <div class="profile" style="color: #777378">
                <div class="profile-image">
                    <img src="../../images/Avatars/user_images/<?php echo $userRow["user_image"]; ?>" alt="Profile Image" style="height: 180px; width: 180px">
                </div>
                
                <div class="v1"></div>  <!---Vertical Line-->
                
                <div class="name">
                    <h5><span class="fa fa-fw fa-user" style="padding-right: 35px" ></span><?php echo $userRow["user_fname"]." ".$userRow["user_lname"]; ?></h5>
                </div>
                <div class="email">
                    <h5><span class="fa fa-fw fa-envelope" style="padding-right: 35px"></span><?php echo $userRow["user_email"]; ?></h5>
                </div>
                <div class="role">
                    <h5><span class="fa fa-fw fa-briefcase" style="padding-right: 35px"></span><?php echo $userRow["role_name"]; ?></h5>
                </div>
                <div class="dob">
                    <h5><span class="fa fa-fw fa-birthday-cake" style="padding-right: 35px"></span><?php echo $userRow["user_dob"]; ?></h5>
                </div>
                <div class="phone">
                    <h5><span class="fa fa-fw fa-phone" style="padding-right: 35px"></span><?php echo $userRow["user_phone"]; ?></h5>
                </div>
                <div class="gender">
                    <h5><span class="fa fa-fw fa-transgender-alt" style="padding-right: 35px"></span><?php echo $gender=($userRow["user_gender"]==0)?"Male":"Female" ?></h5>
                </div>
                <hr>
                <div class="button">
                    <a href="user-update-profile.php?user_id=<?php echo base64_encode($userRow["user_id"]); ?>" type="button" class="btn btn-success" style="width: 220px; text-align: center">
                        <span class="fa fa-fw fa-user"></span>&nbsp;&nbsp;UPDATE PROFILE</a>&nbsp;&nbsp;&nbsp;
                        <button type="button" data-toggle="modal" data-target="#passwordChangeModal" class="btn btn-danger" style="width: 220px">
                      <span class="fa fa-fw fa-pencil"></span>&nbsp;&nbsp;CHANGE PASSWORD</button>
                </div>
                    
            </div>
            
        </div>
        
        <!--- Edit password modal -->
                    
        <div class="modal fade" id="passwordChangeModal" role="dialog">
            <div class="modal-dialog">
                <form action="../../controller/userlogincontroller.php?status=change_password" method="post" name="pw_change" id="pw_change"> 
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="col-12 modal-title text-center" style="padding-top: 10px">CHANGE PASSWORD</h4>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row">
                                <!-- Alert message -->
                                 <div id="alertDiv" style="margin-left: 35px; width: 420px; height: 45px">
                                       
                                    </div>
                               
                            </div>
                            
                            <div class="row">
                                <div class="form-group" style="margin-top: 2px; margin-left: 35px; width: 85%">
                                    <label for="current_password">Current Password :</label>
                                    <input type="password" class="form-control" id="current_pw" name="current_pw" placeholder="Enter Current Password" required="required"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="margin-top: 8px; margin-left: 35px; width: 85%">
                                    <label for="new_password">New Password :</label>
                                    <input type="password" class="form-control" id="new_pw" name="new_pw" placeholder="Enter New Password" required="required"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="margin-top: 8px; margin-left: 35px; width: 85%">
                                    <label for="confirm_password">Confirm Password :</label>
                                    <input type="password" class="form-control" id="confirm_pw" name="confirm_pw" placeholder="Confirm New Password" required="required"/>
                                </div>
                                <input type="hidden" value="<?php echo $userId; ?>" id="user_id" name="user_id">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-success" style="width: 200px; text-align: center; margin-right: 135px">
                            <span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;SAVE</button>
                        </div>    
                    </div>
                </form>
            
            </div>
        </div>
        
        
    </body>
   <?php
     include '../../includes/bootstrap_script_includes.php';
   
   ?>
    <script src="../../js/pw_change_validation.js"></script>
    
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</html>
