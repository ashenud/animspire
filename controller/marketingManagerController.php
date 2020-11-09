<?php
    include '../commons/session.php';
    include '../model/user_model.php';
    
    $userObj = new User();
    $marketingManagerObj = new MarketingManager();
    
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
                    <script>window.location = "../view/user/marketing_manager/marketing-manager-chat.php?user_id=<?php echo $chat_id; ?>&msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                <?php
    
            }
            else {
                $msg = "Message not Send!";
                $msg = base64_encode($msg);
                $chat_id = base64_encode($receiver_id);
                
                ?>
                    <script>window.location = "../view/user/marketing_manager/marketing-manager-chat.php?user_id=<?php echo $chat_id; ?>&msg=<?php echo $msg; ?>" </script>  
                <?php
            }
            
        break;
    
        case "send_quote":
    
            $quotation_id = $_REQUEST["quotation_id"];
            $remarks = $_REQUEST["remarks"];
            
            $result = $marketingManagerObj->sendQuote($quotation_id,$remarks);
    
            if ($result == 1) {
    
                $msgSuccess = "Quotation Successfully Send!";
                $msgSuccess = base64_encode($msgSuccess);
                $chat_id = base64_encode($receiver_id);
                
                ?>
                    <script>window.location = "../view/user/marketing_manager/marketing-manager-quotations.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                <?php
    
            }
            else {
                $msg = "Quotation not Send!";
                $msg = base64_encode($msg);
                $chat_id = base64_encode($receiver_id);
                
                ?>
                    <script>window.location = "../view/user/marketing_manager/marketing-manager-quotations.php?msg=<?php echo $msg; ?>" </script>  
                <?php
            }
            
        break;
    
        case "payment_request":
    
            $quote_id = $_REQUEST["quote_id"];
            $customer_id = $_REQUEST["customer_id"];
            $description = $_REQUEST["description"];
            $total = $_REQUEST["total"];
            
            $result = $marketingManagerObj->requestPayment($quote_id,$customer_id,$description,$total);
    
            if ($result == 1) {
    
                $msgSuccess = "Payment Request Successfully Send!";
                $msgSuccess = base64_encode($msgSuccess);
                $chat_id = base64_encode($receiver_id);
                
                ?>
                    <script>window.location = "../view/user/marketing_manager/marketing-manager-quotations.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                <?php
    
            }
            else {
                $msg = "Payment Request not Send!";
                $msg = base64_encode($msg);
                $chat_id = base64_encode($receiver_id);
                
                ?>
                    <script>window.location = "../view/user/marketing_manager/marketing-manager-quotations.php?msg=<?php echo $msg; ?>" </script>  
                <?php
            }
            
        break;

        default: echo "Invalid Parameters";

    }