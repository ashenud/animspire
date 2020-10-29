<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        
      <title>Edit User</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">  
      <link rel='stylesheet' type="text/css" href="../../../css/style-signup-form.css"/>
      <?php include '../../../includes/dashboard_includes_css.php';?>
      <?php include '../../../includes/dashboard_includes_script.php'; ?>
        
      <?php
      
        include '../../../model/user_model.php';
        $userObj = new User(); /// Create User Object
        $roleResult = $userObj->getUserRoles(); 
        
        if(!isset($_REQUEST["user_id"]))
        {
            ?>
              <script> window.location = "../../../index.php"</script>
            <?php
        }
        
        $userId = $_REQUEST["user_id"];
        $userId = base64_decode($userId);
        
        $userResult = $userObj->viewUser($userId);
        
        $userRow = $userResult->fetch_assoc();
      
      ?>
        
    </head>
    
    <body  style="background-image: url('../../../images/background-image.png');">
        
        <div class="cont">
            <?php
                include './includes/dashboard-navbar.php';
            ?>
            <div class="user-details">
                <form id="editUser" enctype="multipart/form-data" method="post"
                    action="../../../controller/usercontroller.php?status=edit_user">
                    <input type="hidden" name="user_id" value="<?php echo $userId ?>" />
                    <div class="row">
                        <div class="col-md-4">
                            <h3>Edit User</h3>
                            <h6>Update User Information</h6>
                        </div>
                        <div class="col-md-8">
                            <!-- Alert message -->
                            <?php
                            if(isset($_GET["msg"]))
                            {
                                $msg=  base64_decode($_GET["msg"]);
                            ?>
                            <div class="alert alert-danger" style="padding: 15px; height: 55px; margin-top: 5px">
                                <p><?php
                                        echo $msg;
                                        ?>
                                </p>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-7">
                            <div id="alertDiv"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="email">Name :</label>
                        <div class="form-inline">
                            <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname"
                                value="<?php echo $userRow["user_fname"]; ?>" style="margin-right: 14px; width: 48.5%">
                            <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname"
                                value="<?php echo $userRow["user_lname"]; ?>" style="margin-left: 13px; width: 48.5%">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" style="margin-top: 8px; margin-left: 15px; width: 47%"">
                    <label for=" email">Email :</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
                                value="<?php echo $userRow["user_email"]; ?>" readonly="readonly" />
                        </div>
                        <div class="form-group" style="margin-top: 8px; margin-left: 27px; width: 47%"">
                    <label for=" role">User Role :</label>
                            <select id="role" name="role" class="form-control">
                                <?php
                                    while($role_row=$roleResult->fetch_assoc())
                                    {
                                ?>
                                <option value="<?php  echo $role_row["role_id"]; ?>" <?php  
                                if($role_row["role_id"]==$userRow["role_id"])
                                {
                                ?> selected="selected" <?php    
                                }
                                
                                ?>>
                                    <?php  echo $role_row["role_name"]; ?></option>
                                <?php
                                    }
                                
                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" style="margin-top: 8px; margin-left: 15px; width: 47%"">
                        <label for=" email">Date Of Birth :</label>
                            <input type="date" name="dob" class="form-control" id="dob"
                                value="<?php echo $userRow["user_dob"]; ?>" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <div class="form-group" style="margin-top: 8px; margin-left: 27px; width: 47%"">
                        <label for=" gender" style="margin-left:8px">Gender :</label>
                            <div class="row" style="margin-top:8px; margin-left: 10px;">
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="male">
                                        <input type="radio" class="form-check-input" id="male" name="gender" value="0" <?php
                                if($userRow["user_gender"]==0)
                                {
                                ?> checked="checked" <?php
                                }
                                ?> />Male</label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="female">
                                        <input type="radio" class="form-check-input" id="female" name="gender" value="1" <?php
                                if($userRow["user_gender"]==1)
                                {
                                ?> checked="checked" <?php
                                }
                                ?> />Female</label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="other">
                                        <input type="radio" class="form-check-input" id="Other" name="gender" value="2" <?php
                                if($userRow["user_gender"]==2)
                                {
                                ?> checked="checked" <?php
                                }
                                ?> />Other</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" style="margin-left: 15px; width: 47%">
                            <label for="phone">Contact No :</label>
                            <input type="text" class="form-control" id="phone" placeholder="Phone Number" name="phone"
                                value="<?php echo $userRow["user_phone"]; ?>">
                        </div>
                        <div class="form-group" style="margin-left: 27px; width: 39%">
                            <label for="image">Image :</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" style="margin-top:3px"
                                    onchange="readURL(this)">

                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group" style="margin-left: 27px; width: 6%">
                            <img id="prev_img"
                                src="../../../images/Avatars/user_images/<?php echo $userRow["user_image"]; ?>"
                                style="width: 50px; height: 50px; margin-top: 20px " />
                        </div>
                    </div>
                    <div class="clearfix">
                        <button onclick="document.location='admin-user-management.php'" type="button" class="btn btn-danger"
                            style="width: 440px">Cancel</button>&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-success" style="width: 440px">Update</button>
                    </div>
                </form>
            </div>
       
        </div>
        
    </body>

    <script src="../../js/user_validation.js"></script>
    <script type="text/javascript">
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              $('#prev_img')
                .attr('src', e.target.result)
                .height(50)
                .width(50);
            };

            reader.readAsDataURL(input.files[0]);
          }
        }
    </script>
</html>
