<?php

if(isset($_REQUEST["status"]))
{
    include '../model/freelancer_model.php';
    include '../model/freelancer_login_model.php';
    $freelancerObj = new Freelancer();
    $freelancerLoginObj = new freelancerLogin();
    
    $status = $_REQUEST["status"];
    
    switch($status) {

        case "add_freelancer":
            
            $firstName = $_POST["fname"];
            
            $lastName = $_POST["lname"];
            
            $email = $_POST["email"];
            
            $password = $_POST["password"];
            
            $country = $_POST["country"];
            
            $dob = $_POST["dob"];
            
            $gender = $_POST["gender"];
            
            $phone = $_POST["phone"];
            
            try
            {
                if($firstName=="")
                {
                    throw new Exception("First Name cannot be Empty!");
                }
                if($lastName=="")
                {
                    throw new Exception("Last Name cannot be Empty!");
                }
                if($email=="")
                {
                    throw new Exception("Email cannot be Empty!");
                }
                if($password=="")
                {
                    throw new Exception("Password cannot be Empty!");
                }
                if($country=="")
                {
                    throw new Exception("Country cannot be Empty!");
                }
                if($dob=="")
                {
                    throw new Exception("DOB cannot be Empty!");
                }
                if($gender=="")
                {
                    throw new Exception("Gender cannot be Empty!");
                }
                if($phone=="")
                {
                    throw new Exception("Phone Number cannot be Empty!");
                }
                
                $patemail = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/";
                $patphone="/^[0-9]{10}$/";
                
                if(!preg_match($patemail, $email))
                {
                    throw new Exception("Invalid Email Addess");
                }
                if(!preg_match($patphone, $phone))
                {
                    throw new Exception("Invalid Phone Number");
                }
                
                if($_FILES["image"]["name"]!="")
                {
                    $img = $_FILES["image"]["name"];
                    $img = "".time()."_".$img;
                    // Obtaintemporary location
                    $tmp = $_FILES["image"]["tmp_name"];
                    $destination = "../images/Avatars/freelancer_images/$img";
                    move_uploaded_file($tmp, $destination);
                    
                }
                else 
                {
                    $img = "defaultImage.png";
                }
                
                ///// Validating the existence of the email address
                
                $isValid = $freelancerObj->validateFreelancerEmail($email);
                
                if($isValid==false)
                {
                    throw new Exception("Email Address is already taken!");
                }
                
                $freelancerId = $freelancerObj->addFreelancer($firstName, $lastName, $email, $country, $dob, $gender, $phone, $img, 1);
                
                if($freelancerId)
                {
                $pw = sha1($password);
                
                $freelancerObj->addFreelancerLogin($email, $pw, $freelancerId, 1);
                
                $msgSuccess = "Successfully Registered!";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                <script>window.location = "../view/freelancer/freelancer-login.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>
                <?php
                }
                
                
            }
            catch (Exception $ex)
            {
                $msg = $ex->getMessage();
                
                $msg = base64_encode($msg);
                
                ?>
                <script>window.location = "../view/freelancer/freelancer-signup.php?msg=<?php echo $msg; ?>" </script>
                <?php
            }
            
        break;

        case "change_password":
         
            $freelancerId = $_POST["freelancer_id"];  ///collecting freelancer id
           
            $current_pw = $_POST["current_pw"];  /// collect form data
            $new_pw = $_POST["new_pw"];
            $confirm_pw = $_POST["confirm_pw"];
            
            $current_pw_encode = sha1($current_pw);    //// encrypting posted passwords
            $new_pw_encode = sha1($new_pw);
            $confirm_pw_encode = sha1($confirm_pw);
            
            $result = $freelancerLoginObj->getFreelancerLoginDetails($freelancerId);
            $loginRow = $result->fetch_assoc();
            
            $existing_pw = $loginRow["freelancer_login_password"]; 
            
            if($existing_pw==$current_pw_encode)
            {
                if($current_pw_encode==$new_pw_encode)
                {
                     $msg="Please Enter different password!";
                     $msg=base64_encode($msg);
                    $freelancerId = base64_encode($freelancerId);  /// encoding freelancer id
               ?>
                   <script>window.location = "<?php echo $_POST["redirect"]; ?>?freelancer_id=<?php echo $freelancerId; ?>&msg=<?php echo $msg;?>" </script>
                <?php
                }
                else
                {
                    if($new_pw_encode==$confirm_pw_encode)
                    {
                        $freelancerLoginObj->updatePassword($freelancerId, $new_pw_encode);
                
                       $msgSuccess = "Password Successfully updated!";
                       $msgSuccess = base64_encode($msgSuccess);
                       $freelancerId = base64_encode($freelancerId);  /// encoding freelancer id
                   
                     ?>
                       <script>window.location = "<?php echo $_POST["redirect"]; ?>?freelancer_id=<?php echo $freelancerId; ?>&msgSuccess=<?php echo $msgSuccess; ?>" </script>
                     <?php
                       
                    }
                    else 
                    {
                         $msg="Confirm password is incorrect!";
                         $msg=base64_encode($msg);
                        $freelancerId = base64_encode($freelancerId);   /// encoding freelancer id
                    ?>
                       <script>window.location = "<?php echo $_POST["redirect"]; ?>?freelancer_id=<?php echo $freelancerId; ?>&msg=<?php echo $msg;?>" </script>
                    <?php
                    }
                }
                
            }
            else
            {
                 $msg="Current Password is incorret!";
                 $msg=base64_encode($msg);
                 $freelancerId = base64_encode($freelancerId);   /// encoding freelancer id
             ?> 
   
              <script>window.location = "<?php echo $_POST["redirect"]; ?>?freelancer_id=<?php echo $freelancerId; ?>&msg=<?php echo $msg;?>" </script>
              <?php  
            }
            
            
        break;

        case "edit_self":
        
            $freelancerId = $_POST["freelancer_id"];
        
            $firstName = $_POST["fname"];
            
            $lastName = $_POST["lname"];
            
            $email = $_POST["email"];
            
            $dob = $_POST["dob"];
            
            $phone = $_POST["phone"];
            
            try {

                if($firstName=="")
                {
                    throw new Exception("First Name cannot be Empty!");
                }
                if($lastName=="")
                {
                    throw new Exception("Last Name cannot be Empty!");
                }
                if($email=="")
                {
                    throw new Exception("Email cannot be Empty!");
                }
                if($dob=="")
                {
                    throw new Exception("DOB cannot be Empty!");
                }
                if($phone=="")
                {
                    throw new Exception("Phone Number cannot be Empty!");
                }
                
                $patemail = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/";  // validating email
                $patphone="/^[0-9]{10}$/";  /// validating phone number
                
                if(!preg_match($patemail, $email))
                {
                    throw new Exception("Invalid Email Addess");
                }
                if(!preg_match($patphone, $phone))
                {
                    throw new Exception("Invalid Phone Number");
                }
                
                if($_FILES["image"]["name"]!="")
                {
                    $img = $_FILES["image"]["name"];
                    $img = "".time()."_".$img;
                    // Obtain temporary location
                    $tmp = $_FILES["image"]["tmp_name"];
                    $destination = dirname(__FILE__) ."../../images/Avatars/freelancer_images/$img";
                    move_uploaded_file($tmp, $destination);                
                }
                else 
                {
                    $img = "defaultImage.png";
                }
                
                ///// Validating the existence of the email address
                
                $isValid = $freelancerObj->updateEmailValidation($freelancerId, $email);
                
                if($isValid==false)
                {
                    throw new Exception("Email Address is already taken!");
                }
                
                $freelancerObj->updateFreelancer($freelancerId, $firstName, $lastName, $email, $dob, $phone, $img, 1);
                
                if($freelancerId)
                {
                $msgSuccess = "Successfully Updated freelancer $firstName"." "."$lastName";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                <script>window.location = "<?php echo $_POST["redirect"]; ?>?freelancer_id=<?php echo base64_encode($freelancerId); ?>&msgSuccess=<?php echo $msgSuccess; ?>" </script>
                <?php
                }
            
            
            }
            catch (Exception $ex) {

                $msg = $ex->getMessage();
                
                $msg = base64_encode($msg);
                
                ?>
                <script>window.location = "<?php echo $_POST["redirect"]; ?>?freelancer_id=<?php echo base64_encode($freelancerId); ?>&msg=<?php echo $msg; ?>" </script>
                <?php
            }
            
        break;

        case "stage_task":
    
            $project_id = $_REQUEST["project_id"];
            $task_id = $_REQUEST["task_id"];
            
            $result = $freelancerObj->markTaskAsCompleted($task_id);
    
            if ($result == 1) {

                $msgSuccess = "Task Successfully Marked as Completed !";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                    <script>window.location = "../view/freelancer/freelancer-view-project.php?project_id=<?php echo $project_id; ?>&msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                <?php
            }
            else {
                $msg = "Task not Marked as Completed!";
                $msg = base64_encode($msg);
                
                ?>
                    <script>window.location = "../view/freelancer/freelancer-view-project.php?project_id=<?php echo $project_id; ?>&msg=<?php echo $msg; ?>" </script>  
                <?php
            }
            
        break;

    }
}
