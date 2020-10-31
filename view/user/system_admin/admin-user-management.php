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

            /* permission check */
            if(!isset($_SESSION["user"]["role_id"])) {
                $userObj->checkUser('0');
            }
            elseif(($_SESSION["user"]["role_id"]) != 1){
                $userObj->checkUser($_SESSION["user"]["role_id"]);
            }
            /* end permission check */
            
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
                                    <input type="text" id="fname" name="fname" class="form-control" placeholder="Search by first name" style="margin-top: 5px; width: 160px">
                                    <div class="input-group-append" >
                                        <button class="btn btn-success" type="submit" style="margin-top: 5px; padding: 10px" onclick="load_users('0')"><span class="fa fa-lg fa-search" ></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
               </div>
                <div>
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div align="center" id="loading_div" class="scroll" style="display: box; overflow-y:scroll;"> </div>
            </div>
        </div>

    </body>

    <script language="javascript">

        $(document).ready(function() {
            load_users('0');
        });

        function load_users(page) {
            var fname = $('#fname').val();
            // console.log(fname);

            $('#loading_div').html('<p><img src="../../../images/loading.gif"  /></p>');
            $('#loading_div').load("./loadings/users-table.php", {
                'fname': fname,
                'page': page
            });  
        }
    </script>

</html>
