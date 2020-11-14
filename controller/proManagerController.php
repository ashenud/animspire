<?php
    include '../commons/session.php';
    include '../model/user_model.php';
    
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

        case "stage_task":
    
            $project_id = $_REQUEST["project_id"];
            $task_id = $_REQUEST["task_id"];
            
            $result = $proManagerObj->markTaskAsCompleted($task_id);
    
            if ($result == 1) {

                $msgSuccess = "Task Successfully Marked as Completed !";
                $msgSuccess = base64_encode($msgSuccess);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-view-project.php?project_id=<?php echo $project_id; ?>&msgSuccess=<?php echo $msgSuccess; ?>" </script>  
                <?php
            }
            else {
                $msg = "Task not Marked as Completed!";
                $msg = base64_encode($msg);
                
                ?>
                    <script>window.location = "../view/user/project_manager/pro-manager-view-project.php?project_id=<?php echo $project_id; ?>&msg=<?php echo $msg; ?>" </script>  
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
     
        default:echo "Invalid Parameters";

    }