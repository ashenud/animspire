<html>
    <head>
        <title>Login Form</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">      
        <link rel='stylesheet' type="text/css" href="../../bootstrap/css/mdb.min.css"/>    
        <?php include '../../includes/dashboard_includes_css.php';?>
        <?php include '../../includes/dashboard_includes_script.php'; ?>
        <link rel='stylesheet' type="text/css" href="../../css/style-login.css"/>
        
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">
        <div class="cont">
            <form method="post" action="../../controller/userlogincontroller.php?status=login"  id="user_loginform">
              <div class="form">
                <h3 style="font-size: 45px;"><b>Hello!</b></h3>
                <p style="font-size: 20px;">Sign in to your account</p>
                
                <!-- Danger message -->
                <?php
                if(isset($_GET["msg"]))
                {
                    $msg=  base64_decode($_GET["msg"]);
                ?>
                    <div class="alert alert-danger" style="padding: 5px; height: 35px;">
                        <p><?php
                            echo $msg;
                            ?>
                        </p>
                    </div>
                <?php
                }
                ?>
                <!-- Success message -->
                <?php
                if(isset($_GET["msgSuccess"]))
                {
                    $msgSuccess=  base64_decode($_GET["msgSuccess"]);
                ?>
                    <div class="alert alert-success" style="padding: 5px; height: 35px;">
                        <p><?php
                            echo $msgSuccess;
                            ?>
                        </p>
                    </div>
                <?php
                }
                ?>
                <div class="input-data">
                    <label>
                        <span>Username:</span>
                        <input type="text" class="form-control" name="username" id="username" required="required"/>
                    </label>
                    <label>
                        <span>Password:</span>
                        <input type="password" class="form-control" name="password" id="password" required="required"/>
                    </label>
                    <button type="submit" class="btn btn-success" style="width: 220px; margin: 30px 62px 15px 62px">Sign In</button>
                </div>
                
            </div>  
           </form>
            
            <div class="sub-cont">
                <div class="img" style="background-image: url('../../images/user-login.jpg');"></div>
            </div>
            
        </div>
       
    </body>
    
    <script src="../../js/user_login_validation.js"></script>
    
</html>