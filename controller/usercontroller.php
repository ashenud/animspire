<?php

if(isset($_REQUEST["status"]))
{
    include '../model/user_model.php';
    $userObj = new User();
    
    $status = $_REQUEST["status"];
    
    switch($status)
    {
    
        case "add_user":
            
            $firstName = $_POST["fname"];
            
            $lastName = $_POST["lname"];
            
            $email = $_POST["email"];
            
            $password = $_POST["password"];
            
            $role = $_POST["role"];
            
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
                if($role=="")
                {
                    throw new Exception("Role cannot be Empty!");
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
                    $destination = dirname(__FILE__) ."../../images/Avatars/user_images/$img";
                    move_uploaded_file($tmp, $destination);
                    
                }
                else 
                {
                    $img = "defaultImage.png";
                }
                
                ///// Validating the existence of the email address
                
                $isValid = $userObj->validateUserEmail($email);
                
                if($isValid==false)
                {
                    throw new Exception("Email Address is already taken!");
                }
                
                $userId = $userObj->addUser($firstName, $lastName, $email, $role, $dob, $gender, $phone, $img, 1);
                
                if($userId)
                {
                $pw = sha1($password); ///Encrypting the password
                
                $userObj->addUserLogin($email, $pw, $userId, 1);
                
                $msgSuccess = "User Added Successfully!";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                <script>window.location = "../view/user/system_admin/admin-user-management.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>
                <?php
                }
                
                
            }
            catch (Exception $ex)
            {
                $msg = $ex->getMessage();
                
                $msg = base64_encode($msg);
                
                ?>
                <script>window.location = "../view/user/system_admin/admin-user-add.php?msg=<?php echo $msg; ?>" </script>
                <?php
            }
            
        break;
        
        case "deactivateUser":
            
            $userId = $_REQUEST["user_id"];
            /// decode the encoded user id to the normal numeric form
            $userId = base64_decode($userId);
            
            $userObj->deactivateUser($userId);
            
            $msgSuccess = "User Successfully Deactivated!";
            $msgSuccess = base64_encode($msgSuccess);
            
            ?>
                <script>window.location = "../view/user/system_admin/admin-user-management.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>  
            <?php
            
        break;
    
        case "activateUser":
            
            $userId = $_REQUEST["user_id"];
            /// decode the encoded user id to the normal numeric form
            $userId = base64_decode($userId);
            
            $userObj->activateUser($userId);
            
            $msgSuccess = "User Successfully Activated!";
            $msgSuccess = base64_encode($msgSuccess);
            
            ?>
                <script>window.location = "../view/user/system_admin/admin-user-management.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>  
            <?php
            
        break;
    
        case "edit_user":
        
            $userId = $_POST["user_id"];
        
            $firstName = $_POST["fname"];
            
            $lastName = $_POST["lname"];
            
            $email = $_POST["email"];
            
            $role = $_POST["role"];
            
            $dob = $_POST["dob"];
            
            $gender = $_POST["gender"];
            
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
                if($role=="")
                {
                    throw new Exception("Role cannot be Empty!");
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
                    $destination = dirname(__FILE__) ."../../images/Avatars/user_images/$img";
                    move_uploaded_file($tmp, $destination);                
                }
                else 
                {
                    $img = "defaultImage.png";
                }
                
                ///// Validating the existence of the email address
                
                $isValid = $userObj->updateEmailValidation($userId, $email);
                
                if($isValid==false)
                {
                    throw new Exception("Email Address is already taken!");
                }
                
                $userObj->updateUser($userId, $firstName, $lastName, $email, $role, $dob, $gender, $phone, $img, 1);
                
                if($userId)
                {
                $msgSuccess = "Successfully Updated User $firstName"." "."$lastName";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                <script>window.location = "../view/user/system_admin/admin-user-management.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>
                <?php
                }
            
            
            }
            catch (Exception $ex) {

                $msg = $ex->getMessage();
                
                $msg = base64_encode($msg);
                
                ?>
                <script>window.location = "../view/user/system_admin/admin-user-edit.php?user_id=<?php echo base64_encode($userId); ?>&msg=<?php echo $msg; ?>" </script>
                <?php
            }
            
        break;
    
        case "edit_self":
        
            $userId = $_POST["user_id"];
        
            $firstName = $_POST["fname"];
            
            $lastName = $_POST["lname"];
            
            $email = $_POST["email"];
            
            $role = $_POST["role"];
            
            $dob = $_POST["dob"];
            
            $gender = $_POST["gender"];
            
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
                if($role=="")
                {
                    throw new Exception("Role cannot be Empty!");
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
                    $destination = dirname(__FILE__) ."../../images/Avatars/user_images/$img";
                    move_uploaded_file($tmp, $destination);                
                }
                else 
                {
                    $img = "defaultImage.png";
                }
                
                ///// Validating the existence of the email address
                
                $isValid = $userObj->updateEmailValidation($userId, $email);
                
                if($isValid==false)
                {
                    throw new Exception("Email Address is already taken!");
                }
                
                $userObj->updateUser($userId, $firstName, $lastName, $email, $role, $dob, $gender, $phone, $img, 1);
                
                if($userId)
                {
                $msgSuccess = "Successfully Updated User $firstName"." "."$lastName";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                <script>window.location = "<?php echo $_POST["redirect"]; ?>?user_id=<?php echo base64_encode($userId); ?>&msgSuccess=<?php echo $msgSuccess; ?>" </script>
                <?php
                }
            
            
            }
            catch (Exception $ex) {

                $msg = $ex->getMessage();
                
                $msg = base64_encode($msg);
                
                ?>
                <script>window.location = "<?php echo $_POST["redirect"]; ?>?user_id=<?php echo base64_encode($userId); ?>&msg=<?php echo $msg; ?>" </script>
                <?php
            }
            
        break;
        
    }
}
