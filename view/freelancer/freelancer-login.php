<html>
    <head>
        <title>Login Form</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../css/style-login.css"/>
        <link rel='stylesheet' type="text/css" href="../../bootstrap/css/mdb.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">
        <div class="cont">
            <form method="post" action="../../controller/freelancerlogincontrol.php?status=login"  id="freelancer_loginform">
              <div class="form">
                <h3 style="font-size: 45px;"><b>Hello!</b></h3>
                <p style="font-size: 20px;">Sign in to your account</p>
                
                <!-- Alert message -->
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
                    <a href="freelancer-forgot-password.php" style="margin-left: 113px">Forgot Password</a>
                </div>
                
            </div>  
           </form> 
            
            <div class="sub-cont">
                <div class="img" style="background-image: url('../../images/freelancer-login.jpg');"></div>
            </div>
            
        </div>
        
        
    </body>
   
    <script src="../../js/freelancer_login_validation.js"></script>
    

</html>