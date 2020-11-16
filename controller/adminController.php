<?php
    include '../commons/session.php';
    include '../model/user_login_model.php';
    include '../model/user_model.php';
    
    $userLoginObj = new userLogin();
    $userObj = new User();
    $adminObj = new Admin();
    
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
            <script>window.location = "../view/user/admin-dashboard.php"</script>
            <?php
              }
              if($role_id==2)
              {
            ?>
            <script>window.location = "../view/user/project-manager-dashoboard.php"</script>
            <?php
              }
              if($role_id==3)
              {
            ?>
            <script>window.location = "../view/user/finance-manager-dashoboard.php"</script>
            <?php
              }
              if($role_id==4)
              {
            ?>
            <script>window.location = "../view/user/marketing-manager-dashoboard.php"</script>
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
                <script>window.location = "../view/user/user-profile.php?user_id=<?php echo $userId; ?>" </script>
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
                    <script>window.location = "../view/user/user-profile.php?user_id=<?php echo $userId; ?>&msgSuccess=<?php echo $msgSuccess; ?>" </script>
                  <?php
                    
                 }
                 else 
                 {
                      // $msg="Confirm password is incorrect!";
                      // $msg=base64_encode($msg);
                     $userId = base64_encode($userId);   /// encoding user id
                 ?>
                    <script> alert("Confirm password is incorrect!");</script>
                    <script>window.location = "../view/user/user-profile.php?user_id=<?php echo $userId; ?>" </script>
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
           <script>window.location = "../view/user/user-profile.php?user_id=<?php echo $userId; ?>" </script>
           <?php  
         }
         
         
     break;
     
     
     case "logout":
         
         session_destroy();
         
         ?>
             <script>window.location = "../index.php"</script>
         <?php
         
     break;


    
    case "backup_db":

        $connect = new PDO("mysql:host=192.168.1.101;dbname=animspire", "root", "2486");
         
        $all_tables = $_POST['table'];  ///collecting tables from post
        $output = '';
    
        foreach($all_tables as $table) {
            $show_table_query = "SHOW CREATE TABLE " . $table . "";
            $statement = $connect->prepare($show_table_query);
            $statement->execute();
            $show_table_result = $statement->fetchAll();

            foreach($show_table_result as $show_table_row) {
                $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }

            $select_query = "SELECT * FROM " . $table . "";
            $statement = $connect->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();

            for($count=0; $count<$total_row; $count++) {
                $single_result = $statement->fetch(PDO::FETCH_ASSOC);
                $table_column_array = array_keys($single_result);
                $table_value_array = array_values($single_result);
                $output .= "\nINSERT INTO $table (";
                $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                $output .= "'" . implode("','", $table_value_array) . "');\n";
            }
        }


        $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_name));
        ob_clean();
        flush();
        readfile($file_name);
        unlink($file_name);


        /* keep backup history */
        $userId = $_SESSION["user"]["user_id"];
        $user_name = $_SESSION["user"]["firstname"]." ".$_SESSION["user"]["lastname"];
        $description = 'Backup done by '.$user_name;
        $backup_reference = rand(100000000000, 900000000000);

        $result = $adminObj->insertBackupData($userId,$description,$backup_reference);        
        
    break; 

    case "send_message":
    
        $receiver_id = $_REQUEST["receiver_id"];
        $sender_id = $_REQUEST["sender_id"];
        $message = $_REQUEST["message"];
        
        $result = $userObj->sendMessage($receiver_id,$sender_id,$message);

        if ($result == 1) {

            $msgSuccess = "Message Successfully Send!";
            $msgSuccess = base64_encode($msgSuccess);
            $chat_id = base64_encode($receiver_id);
            
            ?>
                <script>window.location = "../view/user/system_admin/admin-chat.php?user_id=<?php echo $chat_id; ?>&msgSuccess=<?php echo $msgSuccess; ?>" </script>  
            <?php

        }
        else {
            $msg = "Message not Send!";
            $msg = base64_encode($msg);
            $chat_id = base64_encode($receiver_id);
            
            ?>
                <script>window.location = "../view/user/system_admin/admin-chat.php?user_id=<?php echo $chat_id; ?>&msg=<?php echo $msg; ?>" </script>  
            <?php
        }
        
    break;

    case "activate_user":
    
        $free_id = $_REQUEST["free_id"];
        $freelancer_id = base64_decode($free_id);
        
        $result = $adminObj->acceptFreelancer($freelancer_id);

        if ($result == 1) {

            $msgSuccess = "Freelancer Successfully Accepted!";
            $msgSuccess = base64_encode($msgSuccess);
            
            ?>
                <script>window.location = "../view/user/system_admin/admin-notification.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>  
            <?php

        }
        else {
            $msg = "Error while Accepting";
            $msg = base64_encode($msg);
            
            ?>
                <script>window.location = "../view/user/system_admin/admin-notification.php?msg=<?php echo $msg; ?>" </script>  
            <?php
        }
        
    break;

 
    default:
     echo "Invalid Parameters";
        
 }


?>