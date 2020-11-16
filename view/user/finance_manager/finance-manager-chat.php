<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        
        <title>Communication</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-user-communication.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>


        <?php
         
            include '../../../model/user_model.php';
            $userObj = new User();
            $financeManagerObj = new FinanceManager(); //must need for navbar

            /* permission check */
            if(!isset($_SESSION["user"]["role_id"])) {
                $userObj->checkUser('0');
            }
            elseif(($_SESSION["user"]["role_id"]) != 3){
                $userObj->checkUser($_SESSION["user"]["role_id"]);
            }
            /* end permission check */

            $userResults = $userObj->getAllUsers();
            
            $user_id = $_SESSION["user"]["user_id"];
            $userId = base64_encode($user_id);

            if (isset($_GET['msg_ids'])) {
                $msg_ids=  base64_decode($_GET["msg_ids"]);
            }

            if(isset($_GET["user_id"])) {
                $chat_id=  base64_decode($_GET["user_id"]);
                $userObj->messageMarkAsReaded($user_id,$chat_id);
            }
        
        ?>
      
    </head>
    
    <body  style="background-image: url('../../../images/background-image.png');">
        <div class="cont">
            <?php
                    include './includes/dashboard-navbar.php';
            ?>
            
            <div class="user-communication">
                   <div class="row">
                       <div class="col-md-12" style="padding: 18px 70px 1px 70px; text-align: center">
                             <h4>User Communication</h4>
                        </div>
                   </div>
                <div class="user-list">
                    <!--- for Every user the p block will loop -->
                    <?php
                    while($userRow = $userResults->fetch_assoc()) {
                        if($userRow["user_id"] != $user_id){

                    ?>
                        <p>
                            <img src="../../../images/Avatars/user_images/<?php echo $userRow["user_image"]; ?>" style="width: 25px; height: 25px">&nbsp;
                            <a href="?user_id=<?php echo base64_encode($userRow["user_id"]); ?>" style="color: white"><?php echo $userRow["user_fname"]; ?></a>
                            <?php
                                if(isset($_GET["user_id"])) {
                                    if ($userRow["user_id"]==$chat_id) {
                                        echo "(Chatting)";
                                    }
                                }
                            ?>
                        </p>
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="chat-section">
                    <form method="post" id="msg-form" action="../../../controller/financeManagerController.php?status=send_message">
                        <?php
                            if(isset($_GET["user_id"])) {
                                $contact_details = $userObj->getUserDetails($chat_id)->fetch_assoc();
                                $contact_name = $contact_details['user_fname'];
                                $messages = $userObj->getMessages($user_id,$chat_id);
                            ?>
                                <div class="chat">
                                    <!--  value of this input must be the placeholder text-->
                                    <input name="sender" type="text" placeholder="Chatting: '<?php echo $_SESSION["user"]["firstname"]; ?>' with '<?php echo $contact_name; ?>'" disabled>
                                    <input name="receiver_id" type="hidden" value="<?php echo $chat_id; ?>">
                                    <input name="sender_id" type="hidden" value="<?php echo $user_id; ?>">
                                </div>
                                <div class="chat-history">
                                    <?php
                                    while($dataRow = $messages->fetch_assoc()) {
                                    ?>
                                        <p><span>'<?php echo $dataRow['sender']; ?>' To '<?php echo $dataRow['receiver']; ?>' :</span> <?php echo $dataRow['message']; ?></p>   
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="message">
                                    <input name="message" id="message-text" value="" type="text" placeholder="Type your message...">
                                    <button type="submit" id="send-msg" class="btn btn-primary">Send</button>
                                </div>
                            <?php
                            } else {
                                
                            ?>
                                <div class="chat">
                                    <!--  value of this input must be the placeholder text-->
                                    <input type="text" placeholder="Select a contact for start conversation..." disabled>
                                </div>
                                <div class="chat-history">

                                </div>
                                <div class="message">
                                    <input type="text" placeholder="Select a contact for start conversation..." disabled>
                                    <button type="submit" class="btn btn-secondary disabled">Send</button>
                                </div>
                            <?php

                            }
                        ?>
                    </form>
                </div>
               </div>
              
            </div>
            
        </div>
        
        
    </body>

    <script>
        $(document).ready(function () {
            $('#send-msg').click(function () {
                
                if ($('#message-text').val() != '') {
                    console.log($('#message-text').val());
                    // $('#msg-form').submit();
                } else {
                    swal("You got a error!", "Please type a message!", "error");
                    return false;
                }
            });
        });
        $('.chat-history').scrollTop($('.chat-history').height()); 
    </script>
    
</html>
