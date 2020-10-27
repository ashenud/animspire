<?php

if(isset($_REQUEST["status"]))
{
    include '../model/customer_model.php';
    $customerObj = new Customer();
    
    $status = $_REQUEST["status"];
    
    switch($status)
    {
        case "add_customer":
            
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
                // Obtain temporary location
                $tmp = $_FILES["image"]["tmp_name"];
                $destination = "../images/Avatars/customer_images/$img";
                move_uploaded_file($tmp, $destination);
                
            }
            else 
            {
                $img = "defaultImage.png";
            }
            
            ///// Validating the existence of the email address
            
            $isValid = $customerObj->validateCustomerEmail($email);
            
            if($isValid==false)
            {
                throw new Exception("Email Address is already taken!");
            }
            
            $customerId = $customerObj->addCustomer($firstName, $lastName, $email, $country, $dob, $gender, $phone, $img, 1);
            
            if($customerId)
            {
             $pw = sha1($password); ///Encrypting the password
             
             $customerObj->addCustomerLogin($email, $pw, $customerId, 1);
             
             $msgSuccess = "Successfully Registered!";
             $msgSuccess = base64_encode($msgSuccess);
             
             ?>
              <script>window.location = "../view/customer/customer-login.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>
             <?php
            }
            
            
        }
        catch (Exception $ex)
        {
            $msg = $ex->getMessage();
            
            $msg = base64_encode($msg);
            
            ?>
              <script>window.location = "../view/customer/customer-signup.php?msg=<?php echo $msg; ?>" </script>
            <?php
        }
            
        break;
    }
}
