<?php
    include '../commons/session.php';
    include '../model/user_login_model.php';
    include '../model/user_model.php';
    
    $userLoginObj = new userLogin();
    $userObj = new User();
    
    $status = $_REQUEST["status"];

    switch ($status) {

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
                    <script>window.location = "../view/user/project_manager/pro-manager-chat.php?user_id=<?php echo $chat_id; ?>&msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                <?php
    
            }
            else {
                $msg = "Message not Send!";
                $msg = base64_encode($msg);
                $chat_id = base64_encode($receiver_id);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-chat.php?user_id=<?php echo $chat_id; ?>&msg=<?php echo $msg; ?>" </script>  
                <?php
            }
            
            break;
    
     
        default:

            echo "Invalid Parameters";

    }