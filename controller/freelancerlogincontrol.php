<?php

    include '../model/freelancer_login_model.php';
    $freelancerLoginObj = new freelancerLogin();
    
    $status = $_REQUEST["status"];
    
    switch ($status){
        
        case "login":
            
            $uname = $_POST["username"];
            
            $pw = $_POST["password"];
            
            $pw = sha1($pw);
            
           $result = $freelancerLoginObj->validateFreelancerLogin($uname, $pw);
            
          if($result->num_rows==1)
          {
            ?>
            <script>window.location = "../view/freelancer/freelancer-dashboard.php"</script>
            <?php
          }
        else
         {
            $msg="Username & Password does not match!";
            
            $msg=base64_encode($msg);
            
            ?>
                <script> window.location="../view/freelancer/freelancer-login.php?msg=<?php echo $msg;  ?>"</script>
            <?php
         }
         
     break;
     
     case "logout":
         
     break;
 
    default:
     echo "Invalid Parameters";
     
 
        
 }
  


?>