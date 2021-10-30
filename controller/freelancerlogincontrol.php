<?php

    include '../commons/session.php';
    include '../model/freelancer_login_model.php';
    include '../model/freelancer_model.php';
    require '../libraries/PHPMailer/PHPMailerAutoload.php';

    $freelancerObj = new Freelancer();
    $freelancerLoginObj = new freelancerLogin();
    
    $status = $_REQUEST["status"];
    
    switch ($status){
        
        case "login":
            
            $uname = $_POST["username"];
            
            $pw = $_POST["password"];
            
            $pw = sha1($pw);
            
            $result = $freelancerLoginObj->validateFreelancerLogin($uname, $pw);
            
            if($result->num_rows==1) {
                $feelancer = $result->fetch_assoc();
                if ($feelancer['freelancer_login_status'] == 1) {

                    $firstname = $feelancer["freelancer_fname"];  /// get freelancer first name
                    $lastname = $feelancer["freelancer_lname"];  /// get freelancer last name
                    $user_image = $feelancer["freelancer_image"]; /// get freelancer image
                    $user_id = $feelancer["freelancer_id"]; /// get freelancer id
                    
                    $userArray = array(
                        "firstname"=>$firstname, 
                        "lastname"=>$lastname, 
                        "freelancer_image"=>$user_image, 
                        "freelancer_id"=>$user_id);
                    
                    $_SESSION["freelancer"] = $userArray;

                    ?>
                    <script>window.location = "../view/freelancer/freelancer-dashboard.php"</script>
                    <?php
                }else {

                    $msg="Wait for your acount acctivation !";
                    $msg=base64_encode($msg);
                
                    ?>
                    <script> window.location="../view/freelancer/freelancer-login.php?msg=<?php echo $msg;  ?>"</script>
                    <?php
                }
    
            }
            else {
                $msg="Username & Password does not match!";
                
                $msg=base64_encode($msg);
            
                ?>
                <script> window.location="../view/freelancer/freelancer-login.php?msg=<?php echo $msg;  ?>"</script>
                <?php
             }
         
        break;

        case "send_code_to_mail":

            $reset_email= $_POST['email'];
    
            $isValid = $freelancerObj->validateFreelancerEmail($reset_email);
    
            if($isValid==false) {
                
                $reset_code=md5(uniqid(true)); //create unique code
                
                $result = $freelancerLoginObj->insertResetCode($reset_code, $reset_email);
                
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
                    $mail->addReplyTo('no-reply@animspire.com');
    
                    // Content
                    $url="http://".$_SERVER["HTTP_HOST"]."/animspire/view/freelancer/freelancer-change-pw.php?code=$reset_code";
                    $mail->isHTML(true);
                    $mail->Subject = 'Your Password Reset Link';
                    $mail->Body    = "<h3>Your requested a password reset link</h3> </br>
                                    click <a href='$url'>this link</a> to change password";
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
                    $mail->send();
    
                    $msgSuccess = "Successfully Send Code to Email";
                    $msgSuccess = base64_encode($msgSuccess);
                    
                    ?>
                    <script>window.location = "../view/freelancer/freelancer-login.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>
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
                <script>window.location = "../view/freelancer/freelancer-forgot-password.php?msg=<?php echo $msg; ?>" </script>
                <?php
            }
             
             
        break;
    
        case "change_froget_password":
    
            if(!isset($_SESSION['code'])) {
                exit("Link Has Expired");
            }
            
            $code=$_SESSION['code'];
            
            $result = $freelancerLoginObj->checkResetCode($code);
            
            if($result->num_rows == 0) {
                exit("Link Has Expired");
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
                    $result2 = $freelancerLoginObj->updateFrogetPassword($email, $new_pw_encode);
                            
                    if($result2) {
                        $freelancerLoginObj->deleteRestCode($email);
    
                        session_destroy();
    
                        $msgSuccess = "Password Successfully updated!";
                        $msgSuccess = base64_encode($msgSuccess);
                    
                        ?>
                        <script>window.location = "../view/home.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>
                        <?php
                    }
                        
                }
                else {
                    $msg="Confirm password is incorrect!";
                    $msg=base64_encode($msg);
                    ?>
                    <script>window.location = "../view/freelancer/freelancer-change-pw.php?code=<?php echo $code; ?>&msg=<?php echo $msg;?>" </script>
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