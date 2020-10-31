<?php
    include '../../../commons/session.php';
?>
<html>
    <head>        
        <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-user-profile.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>

        <?php
            include '../../../model/user_model.php';
            
            $userObj = new User(); //must need for navbar
            $adminObj = new Admin(); //must need for navbar
            
            if(!isset($_REQUEST["user_id"]))
            {
                ?>
                  <script> window.location = "../../../index.php"</script>
               <?php
            }
            
            $user_id = $_REQUEST["user_id"];
            $user_id = base64_decode($user_id);
            $userId = base64_encode($user_id);
            
            /// get the specific user information
            $userResult = $userObj->viewUser($user_id);
            ///convert into an assosiative arry
            $userRow = $userResult->fetch_assoc();
        ?>
        
        
    </head>
    
    <body  style="background-image: url('../../../images/background-image.png');">
        <div class="cont">

            <?php
                include './includes/dashboard-navbar.php';
            ?>
                        
            <div class="profile" style="color: #777378">
                <div class="profile-image">
                    <img src="../../../images/Avatars/user_images/<?php echo $userRow["user_image"]; ?>" alt="Profile Image" style="height: 180px; width: 180px">
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
                    <a href="admin-profile-update.php?user_id=<?php echo base64_encode($userRow["user_id"]); ?>" type="button" class="btn btn-success" style="width: 220px; text-align: center">
                        <span class="fa fa-fw fa-user"></span>&nbsp;&nbsp;UPDATE PROFILE</a>&nbsp;&nbsp;&nbsp;
                        <button type="button" data-toggle="modal" data-target="#passwordChangeModal" class="btn btn-danger" style="width: 220px">
                      <span class="fa fa-fw fa-pencil"></span>&nbsp;&nbsp;CHANGE PASSWORD</button>
                </div>
                    
            </div>
            
        </div>
        
        <!--- Edit password modal -->
                    
        <div class="modal fade" id="passwordChangeModal" role="dialog">
            <div class="modal-dialog">
                <form action="../../../controller/userlogincontroller.php?status=change_password" method="post" name="pw_change" id="pw_change"> 
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
                                <input type="hidden" value="<?php echo $user_id; ?>" id="user_id" name="user_id">
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
   
    <script src="../../../js/pw_change_validation.js"></script>
    
</html>
