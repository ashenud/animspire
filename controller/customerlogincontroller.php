<?php
include '../commons/session.php';
include '../model/customer_login_model.php';

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
     
     case "logout":
         
     break;
 
    default:
     echo "Invalid Parameters";
     
 }
?>

