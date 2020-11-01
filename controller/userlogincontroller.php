<?php
    include '../commons/session.php';
    include '../model/user_login_model.php';
    include '../model/user_model.php';
    
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
                // $msg="Please Enter different password!";
                // $msg=base64_encode($msg);
                 $userId = base64_encode($userId);  /// encoding user id
            ?>
                <script> alert("Please Enter different password!");</script>
                <script>window.location = "<?php echo $_POST["redirect"]; ?>?user_id=<?php echo $userId; ?>" </script>
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
                      // $msg="Confirm password is incorrect!";
                      // $msg=base64_encode($msg);
                     $userId = base64_encode($userId);   /// encoding user id
                 ?>
                    <script> alert("Confirm password is incorrect!");</script>
                    <script>window.location = "<?php echo $_POST["redirect"]; ?>?user_id=<?php echo $userId; ?>" </script>
                 <?php
                 }
             }
             
         }
         else
         {
              // $msg="Current Password is incorret!";
              // $msg=base64_encode($msg);
             $userId = base64_encode($userId);   /// encoding user id
          ?>   
           <script> alert("Current Password is incorret!"); </script>    
           <script>window.location = "<?php echo $_POST["redirect"]; ?>?user_id=<?php echo $userId; ?>" </script>
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