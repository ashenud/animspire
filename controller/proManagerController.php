<?php
    include '../commons/session.php';
    include '../model/user_model.php';
    require '../libraries/PHPMailer/PHPMailerAutoload.php';
    
    $userObj = new User();
    $proManagerObj = new projectManager();

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

        case "assign_freelancer":
    
            $project_id = $_REQUEST["project_id"];
            $freelancer = $_REQUEST["freelancer"];
            $task_name = $_REQUEST["task_name"];
            $priority_level = $_REQUEST["priority_level"];
            $start_date = $_REQUEST["start_date"];
            $end_date = $_REQUEST["end_date"];
            
            $result = $proManagerObj->assignFreelancerToProject($project_id,$freelancer);
    
            if ($result == 1) {

                $result2 = $proManagerObj->addTaskToProject($project_id,$task_name,$priority_level,$start_date,$end_date);
    
                if ($result2 == 1) {

                    $msgSuccess = "Freelancer Successfully Assigned and Task added !";
                    $msgSuccess = base64_encode($msgSuccess);
                    
                    ?>
                        <script>window.location = "../view/user/project_manager/pro-manager-project-management.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                    <?php
                }
                else {
                    $msg = "Task not Added!";
                    $msg = base64_encode($msg);
                    
                    ?>
                        <script>window.location = "../view/user/project_manager/pro-manager-project-management.php?msg=<?php echo $msg; ?>" </script>  
                    <?php
                }
    
            }
            else {
                $msg = "Freelanser not Assigned!";
                $msg = base64_encode($msg);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-project-management.php?msg=<?php echo $msg; ?>" </script>  
                <?php
            }
            
        break;

        case "add_task":
    
            $project_id = $_REQUEST["project_id"];
            $task_name = $_REQUEST["task_name"];
            $priority_level = $_REQUEST["priority_level"];
            $start_date = $_REQUEST["start_date"];
            $end_date = $_REQUEST["end_date"];
            
            $result = $proManagerObj->addTaskToProject($project_id,$task_name,$priority_level,$start_date,$end_date);
    
            if ($result == 1) {

                $msgSuccess = "Task Successfully Added !";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-view-project.php?project_id=<?php echo $project_id; ?>&msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                <?php
            }
            else {
                $msg = "Task not Added!";
                $msg = base64_encode($msg);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-view-project.php?project_id=<?php echo $project_id; ?>&msg=<?php echo $msg; ?>" </script>  
                <?php
            }
            
        break;

        case "edit_task":
    
            $project_id = $_REQUEST["project_id"];
            $task_id = $_REQUEST["task_id"];
            $task_name = $_REQUEST["task_name"];
            $priority_level = $_REQUEST["priority_level"];
            $start_date = $_REQUEST["start_date"];
            $end_date = $_REQUEST["end_date"];
            
            $result = $proManagerObj->editTaskInProject($task_id,$task_name,$priority_level,$start_date,$end_date);
    
            if ($result == 1) {

                $msgSuccess = "Task Successfully Edited !";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-view-project.php?project_id=<?php echo $project_id; ?>&msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                <?php
            }
            else {
                $msg = "Task not Edited!";
                $msg = base64_encode($msg);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-view-project.php?project_id=<?php echo $project_id; ?>&msg=<?php echo $msg; ?>" </script>  
                <?php
            }
            
        break;

        case "delete_task":
    
            $project_id = $_REQUEST["project_id"];
            $task_id = $_REQUEST["task_id"];
            
            $result = $proManagerObj->deleteTask($task_id);
    
            if ($result == 1) {

                $msgSuccess = "Task Successfully Deleted !";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-view-project.php?project_id=<?php echo $project_id; ?>&msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                <?php
            }
            else {
                $msg = "Task not Deleted!";
                $msg = base64_encode($msg);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-view-project.php?project_id=<?php echo $project_id; ?>&msg=<?php echo $msg; ?>" </script>  
                <?php
            }
            
        break;

        case "activate_task":
    
            $project_id = $_REQUEST["project_id"];
            $task_id = $_REQUEST["task_id"];
            
            $result = $proManagerObj->activateTask($task_id);
    
            if ($result == 1) {

                $msgSuccess = "Task Successfully Activated !";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-view-project.php?project_id=<?php echo $project_id; ?>&msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                <?php
            }
            else {
                $msg = "Task not Activated!";
                $msg = base64_encode($msg);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-view-project.php?project_id=<?php echo $project_id; ?>&msg=<?php echo $msg; ?>" </script>  
                <?php
            }
            
        break;

        case "delete_tool":
    
            $tool_id = $_REQUEST["tool_id"];
            
            $result = $proManagerObj->deleteTool($tool_id);
    
            if ($result == 1) {

                $msgSuccess = "Tool Successfully Deleted !";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-tools-management.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                <?php
            }
            else {
                $msg = "tool not Deleted!";
                $msg = base64_encode($msg);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-tools-management.php?msg=<?php echo $msg; ?>" </script>  
                <?php
            }
            
        break;

        case "activate_tool":
    
            $project_id = $_REQUEST["project_id"];
            $tool_id = $_REQUEST["tool_id"];
            
            $result = $proManagerObj->activateTool($tool_id);
    
            if ($result == 1) {

                $msgSuccess = "Tool Successfully Activated !";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-tools-management.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                <?php
            }
            else {
                $msg = "Tool not Activated!";
                $msg = base64_encode($msg);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-tools-management.php?msg=<?php echo $msg; ?>" </script>  
                <?php
            }
            
        break;   

        case "stage_project":
    
            $project_id = $_REQUEST["project_id"];
            
            $result = $proManagerObj->markProjectAsCompleted($project_id);
    
            if ($result == 1) {

                $msgSuccess = "Project Successfully Marked as Completed !";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-project-management.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                <?php
            }
            else {
                $msg = "Project not Marked as Completed!";
                $msg = base64_encode($msg);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-project-management.php?msg=<?php echo $msg; ?>" </script>  
                <?php
            }
            
        break;  

        case "give_tool_access":
    
            $request_id = $_REQUEST["request_id"];
            $email = $_REQUEST["email"];
            $username = $_REQUEST["username"];
            $password = $_REQUEST["password"];
            $tool_name = $_REQUEST["tool_name"];
            $emailSend = "";
            
            $mail = new PHPMailer;

            try {
                //Server settings
                $mail->SMTPDebug = 0;                       // Enable verbose debug output
                $mail->isSMTP();                            // Set mailer to use SMTP
                $mail->Host = 'smtp.mailtrap.io';             // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                     // Enable SMTP authentication
                $mail->Username = '5ca75b8fd9cb5f';     // SMTP username
                $mail->Password = 'ce6416b388d94a';            // SMTP password
                $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 2525;                          // TCP port to connect to

                //Recipients
                $mail->setFrom('privacy@animspire.com', 'animspire');
                $mail->addAddress($email);
                $mail->addReplyTo('no-reply@ihms.com');

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Access Details of Requested Tool';
                $mail->Body    = "<h3>This is login details of tool $tool_name </h3> </br>
                                <p>User Name :- <b>$username</b> </p>
                                <p>Password  :- <b>$password</b> </p>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                
            } 

            catch (Exception $e) {
                $emailSend = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            if ($emailSend == "") {

                $result = $proManagerObj->giveToolAccess($request_id,$username,$password);

                if ($result == 1) {
                    $msgSuccess = "Tool Accessed!";
                    $msgSuccess = base64_encode($msgSuccess);
                    
                    ?>
                        <script>window.location = "../view/user/project_manager/pro-manager-tools-requested.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                    <?php
                }
                else {
                    $msg = "Database Store Error";
                    $msg = base64_encode($msg);
                    
                    ?>
                        <script>window.location = "../view/user/project_manager/pro-manager-tools-requested.php?msg=<?php echo $msg; ?>" </script>  
                    <?php
                }
            }
            else {
                $msg = $emailSend;
                $msg = base64_encode($msg);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-tools-requested.php?msg=<?php echo $msg; ?>" </script>  
                <?php
            }
            
        break;    

        case "add_tool":
            
            $tool_name = $_POST["tool_name"];
            
            $website = $_POST["website"];
            
            $category_id = $_POST["category_id"];
            
            try
            {
                if($tool_name=="")
                {
                    throw new Exception("First Name cannot be Empty!");
                }
                if($website=="")
                {
                    throw new Exception("Last Name cannot be Empty!");
                }
                if($category_id=="")
                {
                    throw new Exception("Email cannot be Empty!");
                }
                
                $patwebsite = "%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i";  // validating url
                
                if(!preg_match($patwebsite, $website))
                {
                    throw new Exception("Invalid Web Addess");
                }
                
                if($_FILES["image"]["name"]!="")
                {
                    $img = $_FILES["image"]["name"];
                    $img = "".time()."_".$img;
                    // Obtain temporary location
                    $tmp = $_FILES["image"]["tmp_name"];
                    $destination = dirname(__FILE__) ."../../images/icons/tool_images/$img";
                    move_uploaded_file($tmp, $destination);
                    
                }
                else 
                {
                    $img = "defaultImage.png";
                }
                
                $insert_tool = $proManagerObj->addTool($tool_name, $category_id, $website, $img);
                
                if($insert_tool == 1)
                {
                
                    $msgSuccess = "Tool Added Successfully!";
                    $msgSuccess = base64_encode($msgSuccess);
                    
                    ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-tools-management.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>
                    <?php
                } {
                    // echo $insert_tool; die();
                    $msg = "Tool not Added!";
                    $msg = base64_encode($msg);
                    
                    ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-tools-management.php?msg=<?php echo $msg; ?>" </script>
                    <?php
                }
                
                
            }
            catch (Exception $ex)
            {
                $msg = $ex->getMessage();
                
                $msg = base64_encode($msg);
                
                ?>
                <script>window.location = "../view/user/project_manager/pro-manager-tools-management.php?msg=<?php echo $msg; ?>" </script>
                <?php
            }
            
        break; 

        case "edit_tool":
            
            $tool_id = $_POST["tool_id"];

            $tool_name = $_POST["tool_name"];
            
            $website = $_POST["website"];
            
            $category_id = $_POST["category_id"];

            $tool_image = $_POST["tool_image"];
            
            try
            {
                if($tool_name=="")
                {
                    throw new Exception("First Name cannot be Empty!");
                }
                if($website=="")
                {
                    throw new Exception("Last Name cannot be Empty!");
                }
                if($category_id=="")
                {
                    throw new Exception("Email cannot be Empty!");
                }
                
                $patwebsite = "%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i";  // validating url
                
                if(!preg_match($patwebsite, $website))
                {
                    throw new Exception("Invalid Web Addess");
                }
                
                if($_FILES["image"]["name"]!="")
                {
                    $img = $_FILES["image"]["name"];
                    $img = "".time()."_".$img;
                    // Obtain temporary location
                    $tmp = $_FILES["image"]["tmp_name"];
                    $destination = dirname(__FILE__) ."../../images/icons/tool_images/$img";
                    move_uploaded_file($tmp, $destination);
                    
                }
                else 
                {
                    $img = $tool_image;
                }
                
                $edit_tool = $proManagerObj->editTool($tool_id,$tool_name, $category_id, $website, $img);
                
                if($edit_tool == 1)
                {
                
                    $msgSuccess = "Tool Edited Successfully!";
                    $msgSuccess = base64_encode($msgSuccess);
                    
                    ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-tools-management.php?msgSuccess=<?php echo $msgSuccess; ?>" </script>
                    <?php
                } {
                    // echo $edit_tool; die();
                    $msg = "Tool not Edited!";
                    $msg = base64_encode($msg);
                    
                    ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-tools-management.php?msg=<?php echo $msg; ?>" </script>
                    <?php
                }
                
                
            }
            catch (Exception $ex)
            {
                $msg = $ex->getMessage();
                
                $msg = base64_encode($msg);
                
                ?>
                <script>window.location = "../view/user/project_manager/pro-manager-tools-management.php?msg=<?php echo $msg; ?>" </script>
                <?php
            }
            
        break;
     
        default:echo "Invalid Parameters";

    }