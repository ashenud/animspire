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
        <link rel='stylesheet' type="text/css" href="../../css/style-report-management.css"/>
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
            
            <div class="report-generation">
                <div class="top-buttons">
                    <div class="row">
                       <div class="col-md-4">
                           <select id="admin-name" class="form-control admin-name" required="required">
                               <option value="">Select System Admin</option>
                               <option>----</option>
                           </select>
                        </div>
                       <div class="col-md-4">
                             <button name="report-generate-2" class="btn btn-success" id="report-generate-2">Generate Report</button>
                        </div>
                   </div>
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
