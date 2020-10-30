<?php

    include '../commons/session.php';
    include '../model/freelancer_login_model.php';
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
                        "user_image"=>$user_image, 
                        "user_id"=>$user_id);
                    
                    $_SESSION["user"] = $userArray;

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
     
     case "logout":

        session_destroy();
         
         ?>
             <script>window.location = "../index.php"</script>
         <?php
         
     break;
 
    default:
     echo "Invalid Parameters";
     
 
        
 }
  


?>