<?php
include '../commons/session.php';
include '../model/customer_login_model.php';
include '../model/customer_model.php';
require '../libraries/PHPMailer/PHPMailerAutoload.php';

$customerObj = new Customer();
$customerLoginObj = new customerLogin();  // creating the cutomerLogin object using cutomerLogin class

$status=$_REQUEST["status"];
 
switch ($status){
     
    case "login":
        
        $uname=$_POST["username"];
        
        $pw=$_POST["password"];
        
        $pw=  sha1($pw);
        
       $result= $customerLoginObj->validateCustomerLogin($uname, $pw);
       
        if($result->num_rows==1)
        {
           $customerRow = $result->fetch_assoc();
              
              $firstname = $customerRow["customer_fname"];  /// get customer first name
              $lastname = $customerRow["customer_lname"];  /// get customer last name
              $customer_image = $customerRow["customer_image"]; /// get customer image
              $customer_id = $customerRow["customer_id"]; /// get customer id
              
              $customerArray = array(
                  "firstname"=>$firstname, 
                  "lastname"=>$lastname, 
                  "customer_image"=>$customer_image, 
                  "customer_id"=>$customer_id);
              
              $_SESSION["customer"] = $customerArray;
            
            ?>
            <script>window.location = "../view/customer/customer-dashboard.php"</script>
            <?php
        }
        else
         {
            $msg="Username and Password does not match!";
            
            $msg=base64_encode($msg);
            
           ?>
            
            <script> window.location="../view/customer/customer-login.php?msg=<?php echo $msg;  ?>"</script>

           <?php
         }
         
    break;
     
    case "send_code_to_mail":

        $reset_email= $_POST['email'];

        $isValid = $customerObj->validateCustomerEmail($reset_email);

        if($isValid==false) {
            
            $reset_code=md5(uniqid(true)); //create unique code
            
            $result = $customerLoginObj->insertResetCode($reset_code, $reset_email);
            
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
                $url="http://".$_SERVER["HTTP_HOST"]."/animspire/view/customer/customer-change-pw.php?code=$reset_code";
                $mail->isHTML(true);
                $mail->Subject = 'Your Password Reset Link';
                $mail->Body    = "<h3>Your requested a password reset link</h3> </br>
                                click <a href='$url'>this link</a> to change password";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();

                $msgSuccess = "Successfully Send Code to Email";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                <script>window.location = "../view/customer/customer-login.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>
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
            <script>window.location = "../view/customer/customer-forgot-password.php?msg=<?php echo $msg; ?>" </script>
            <?php
        }
         
         
    break;

    case "change_froget_password":

        if(!isset($_SESSION['code'])) {
            exit("Link Has Expired");
        }
        
        $code=$_SESSION['code'];
        
        $result = $customerLoginObj->checkResetCode($code);
        
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
                $result2 = $customerLoginObj->updateFrogetPassword($email, $new_pw_encode);
                        
                if($result2) {
                    $customerLoginObj->deleteRestCode($email);

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
                <script>window.location = "../view/customer/customer-change-pw.php?code=<?php echo $code; ?>&msg=<?php echo $msg;?>" </script>
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

