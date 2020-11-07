<?php
    include '../commons/session.php';
    include '../model/user_login_model.php';
    include '../model/user_model.php';
    require '../libraries/PHPMailer/PHPMailerAutoload.php';
    
    $userLoginObj = new userLogin();
    $userObj = new User();
    
    $status = $_REQUEST["status"];
    
    switch ($status){
        
    case "login":
        
        $uname = $_POST["username"];
        
        $pw = $_POST["password"];
        
        $pw = sha1($pw);
        
        $result = $userLoginObj->validateUserLogin($uname, $pw);
        
      if($result->num_rows==1)   /// valid user in the system
      {
          $userRow = $result->fetch_assoc();
          
          $role_id = $userRow["user_role"];  /// get user role id
          $firstname = $userRow["user_fname"];  /// get user first name
          $lastname = $userRow["user_lname"];  /// get user last name
          $user_image = $userRow["user_image"]; /// get user image
          $user_id = $userRow["user_id"]; /// get user id
          
          $userArray = array(
              "firstname"=>$firstname, 
              "lastname"=>$lastname, 
              "user_image"=>$user_image, 
              "user_id"=>$user_id, 
              "role_id"=>$role_id);
          
          $_SESSION["user"] = $userArray;
          
          if($role_id==1)
          {
        ?>
        <script>window.location = "../view/user/system_admin/admin-dashboard.php"</script>
        <?php
          }
          if($role_id==2)
          {
        ?>
        <script>window.location = "../view/user/project_manager/pro-manager-dashboard.php"</script>
        <?php
          }
          if($role_id==3)
          {
        ?>
        <script>window.location = "../view/user/finance_manager/finance-manager-dashboard.php"</script>
        <?php
          }
          if($role_id==4)
          {
        ?>
        <script>window.location = "../view/user/marketing_manager/marketing-manager-dashboard.php"</script>
        <?php
          }
      }
      else
      {
          $msg="Username & Password does not match!";
          
          $msg=base64_encode($msg);
          
          ?>
              <script> window.location="../view/user/user-login.php?msg=<?php echo $msg;  ?>"</script>
          <?php
      }
      
    break;
     
    case "change_password":
        
        $userId = $_POST["user_id"];  ///collecting user id
    
        $current_pw = $_POST["current_pw"];  /// collect form data
        $new_pw = $_POST["new_pw"];
        $confirm_pw = $_POST["confirm_pw"];
        
        $current_pw_encode = sha1($current_pw);    //// encrypting posted passwords
        $new_pw_encode = sha1($new_pw);
        $confirm_pw_encode = sha1($confirm_pw);
        
        $result = $userLoginObj->getUserLoginDetails($userId);
        $loginRow = $result->fetch_assoc();
        
        $existing_pw = $loginRow["user_login_password"]; 
        
        if($existing_pw==$current_pw_encode)
        {
            if($current_pw_encode==$new_pw_encode)
            {
                $msg="Please Enter different password!";
                $msg=base64_encode($msg);
                $userId = base64_encode($userId);  /// encoding user id
        ?>
            <script>window.location = "<?php echo $_POST["redirect"]; ?>?user_id=<?php echo $userId; ?>&msg=<?php echo $msg;?>" </script>
            <?php
            }
            else
            {
                if($new_pw_encode==$confirm_pw_encode)
                {
                    $userLoginObj->updatePassword($userId, $new_pw_encode);
            
                $msgSuccess = "Password Successfully updated!";
                $msgSuccess = base64_encode($msgSuccess);
                $userId = base64_encode($userId);  /// encoding user id
            
                ?>
                <script>window.location = "<?php echo $_POST["redirect"]; ?>?user_id=<?php echo $userId; ?>&msgSuccess=<?php echo $msgSuccess; ?>" </script>
                <?php
                
                }
                else 
                {
                    $msg="Confirm password is incorrect!";
                    $msg=base64_encode($msg);
                    $userId = base64_encode($userId);   /// encoding user id
                ?>
                <script>window.location = "<?php echo $_POST["redirect"]; ?>?user_id=<?php echo $userId; ?>&msg=<?php echo $msg;?>" </script>
                <?php
                }
            }
            
        }
        else
        {
            $msg="Current Password is incorret!";
            $msg=base64_encode($msg);
            $userId = base64_encode($userId);   /// encoding user id
        ?> 

        <script>window.location = "<?php echo $_POST["redirect"]; ?>?user_id=<?php echo $userId; ?>&msg=<?php echo $msg;?>" </script>
        <?php  
        }
        
        
    break;
     
    case "send_code_to_mail":

        $reset_email= $_POST['email'];

        $isValid = $userObj->validateUserEmail($reset_email);

        if($isValid==false) {
            
            $reset_code=md5(uniqid(true));
            
            $result = $userLoginObj->insertResetCode($reset_code, $reset_email);
            
            if($result == 0) {
                exit("error");
            }
            
            $mail = new PHPMailer;

            try {
                //Server settings
                

                $mail->SMTPDebug = 0;                       // Enable verbose debug output
                $mail->isSMTP();                            // Set mailer to use SMTP
                $mail->Host = 'smtp.mailtrap.io';             // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                     // Enable SMTP authentication
                $mail->Username = '5ca75b8fd9cb5f';     // SMTP username
                $mail->Password = 'ce6416b388d94a';            // SMTP password
                $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 2525;                          // TCP port to connect to

                //Recipients
                $mail->setFrom('privacy@animspire.com', 'animspire');
                $mail->addAddress($reset_email);
                $mail->addReplyTo('no-reply@ihms.com');

                // Content
                $url="http://".$_SERVER["HTTP_HOST"]."/animspire/view/user/user-change-pw.php?code=$reset_code";
                $mail->isHTML(true);
                $mail->Subject = 'Your Password Reset Link';
                $mail->Body    = "<h3>Your requested a password reset link</h3> </br>
                                click <a href='$url'>this link</a> to change password";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();

                $msgSuccess = "Successfully Send Code to Email";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                <script>window.location = "../view/user/user-login.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>
                <?php
            } 

            catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            exit();
        }
        
        else {
            $msg = "Please Enter Correct Email";
            $msg = base64_encode($msg);
            
            ?>
            <script>window.location = "../view/user/user-forgot-password.php?msg=<?php echo $msg; ?>" </script>
            <?php
        }
         
         
    break;
     
    case "change_froget_password":

        if(!isset($_SESSION['code'])) {
            exit("සබැඳිය කල් ඉකුත් වී ඇත");
        }
        
        $code=$_SESSION['code'];
        
        $result = $userLoginObj->checkResetCode($code);
        
        if($result->num_rows == 0) {
            exit("සබැඳිය කල් ඉකුත් වී ඇත");
        }
        
        if(isset($_POST['submit'])) {
                   
            $new_pw = $_POST["new_password"];
            $confirm_pw = $_POST["confirm_password"];
            
            $new_pw_encode = sha1($new_pw);
            $confirm_pw_encode = sha1($confirm_pw);

            $row=$result->fetch_assoc();
            $email=$row['reset_email'];
            
                
            if($new_pw_encode==$confirm_pw_encode) {

                //success
                //change password in database
                $result2 = $userLoginObj->updateFrogetPassword($email, $new_pw_encode);
                        
                if($result2) {
                    $userLoginObj->deleteRestCode($email);

                    session_destroy();

                    $msgSuccess = "Password Successfully updated!";
                    $msgSuccess = base64_encode($msgSuccess);
                    $userId = base64_encode($userId);  /// encoding user id
                
                    ?>
                    <script>window.location = "../view/home.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>
                    <?php
                }
                    
            }
            else {
                $msg="Confirm password is incorrect!";
                $msg=base64_encode($msg);
                $userId = base64_encode($userId);   /// encoding user id
                ?>
                <script>window.location = "../view/user/user-change-pw.php?code=<?php echo $code; ?>&msg=<?php echo $msg;?>" </script>
                <?php
                    
            }
                
        }
         
         
    break;
     
    case "logout":
         
         session_destroy();
         
         ?>
             <script>window.location = "../index.php"</script>
         <?php
         
    break;
 
    default: echo "Invalid Parameters";
     
 
        
 }
  


?>