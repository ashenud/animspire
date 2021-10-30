<?php
    include '../../../commons/session.php';
    if(!isset($_REQUEST['project_id'])) {
        $msg = base64_encode('You have no permission!');
        header('location: ./pro-manager-project-management.php?msg='.$msg);
    }

?>
<html>
    <head>
        <title>Project Manager Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-view-project.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>
        
        <style>
            .modal-dialog{
                display: inline-block;
                vertical-align: middle;
            }
            .modal-dialog .modal-content{
                width: 850px;
                margin:30px 200px auto 245px;
            }
            .modal-content .modal-header{
                border-bottom: none;
                text-align: center;
                background-image: linear-gradient(180deg, #834d9b, #d04ed6);
                height: 80px;
                color: white;
                
            }
            
        </style>
        
      
        <?php
        
            include '../../../model/user_model.php';
            $userObj = new User(); //must need for navbar
            $proManagerObj = new projectManager(); //must need for navbar

            /* permission check */
            if(!isset($_SESSION["user"]["role_id"])) {
                $userObj->checkUser('0');
            }
            elseif(($_SESSION["user"]["role_id"]) != 2){
                $userObj->checkUser($_SESSION["user"]["role_id"]);
            }
            /* end permission check */

            $project_id = $_REQUEST['project_id'];
            $user_id = $_SESSION["user"]["user_id"];
            $userId = base64_encode($user_id);
        
        ?>
        
        
    </head>
    
    <body  style="background-image: url('../../../images/background-image.png');">
        <div class="cont">
            <?php
                include './includes/dashboard-navbar.php';
            ?>
            <div class="project-details">
               <div class="first-row">
                    <div class="form-inline">
                        <div class="form-group">
                            <?php
                                $current_project = $proManagerObj->getProjectDetails($project_id);
                                $project = $current_project->fetch_assoc();
                            ?>
                            <label class="view1" for="email">Project ID:</label>
                            <input type="text" class="form-control" id="project-id" value="<?php echo $project['project_id']; ?>" name="project-id" style="width:40px" disabled>
                        </div>
                        <div class="form-group" style="margin-left: 20px">
                            <label class="view1" for="pwd">Project Name:</label>
                            <input type="text" class="form-control" id="project-name" value="<?php echo $project['project_name']; ?>" name="project-name" style="width: 180px" disabled>
                        </div>
                        <div class="form-group" style="margin-left: 20px">
                            <label class="view1" for="pwd">Freelancer:</label>
                            <input type="text" class="form-control" id="freelancer-name" value="<?php echo $project['free_name']; ?>" name="freelancer-name" style="width: 160px" disabled>
                        </div>
                        <button type="button" id='view-quote-btn' href='#view-quote' data-toggle='modal' data-subject='<?php echo $project['subject']; ?>' data-requirements='<?php echo $project['requirements']; ?>' data-remarks='<?php echo $project['remarks']; ?>' data-status='<?php echo $project['status']; ?>'
                            class="btn btn-info" style="margin-left: 45px; font-size: 12px; margin-top: 10px;">
                            <i class="fas fa-external-link-alt"></i> &nbsp;View Quote
                        </button>
                    </div>
               </div>
                
               <div class="second-row">
                   <div class="row">
                       <div class="col-md-4">
                            <button type="button" id="task-add-btn" href='#task-add' data-toggle='modal' data-start_date='<?php echo $project["start_date"];?>' data-end_date='<?php echo $project["end_date"];?>' data-project_id='<?php echo $project["project_id"];?>' data-project_name='<?php echo $project["project_name"];?>' data-freelancer_name='<?php echo $project["free_name"];?>' data-freelancer_image='<?php echo $project["freelancer_image"];?>'
                                class="btn btn-primary" style="width: 130px; height: 40px;" >
                                <i class="fas fa-plus"></i> &nbsp;Add Task
                            </button>
                       </div>
                     <div class="col-md-4" style="padding: 12px 70px 1px 70px;">
                             <h4>TASKS</h4>
                        </div>
                        <div class="col-md-4">

                        </div>
                     </div>
               </div>
                
                <div>
                    <table class="project-table" border="1" >
                        <tr>
                            <th width="240px">&nbsp;Task</th>
                            <th width="130px">&nbsp;Start Date</th>
                            <th width="130px">&nbsp;End Date</th>
                            <th width="140px">&nbsp;Priority</th>
                            <th width="120px">&nbsp;Status</th>
                            <th width="190px"></th>
                        </tr>
                        <?php
                            $task_data = $proManagerObj->getAllProjectTasks($project_id);
                            if($task_data->num_rows > 0) {
                                while($task = $task_data->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td>&nbsp;<?php echo $task["task_name"]; ?></td>
                                        <td>&nbsp;<?php echo $task["t_start_date"]; ?></td>
                                        <td>&nbsp;<?php echo $task["t_end_date"]; ?></td>
                                        <td>&nbsp;<?php echo $task["priority_level"]; ?></td>
                                        <td>&nbsp;
                                            <?php 
                                                if($project["task_timeline"] == 0) {
                                                    echo 'Pending';
                                                }
                                                else {
                                                    echo 'Completed';
                                                }
                                            ?>
                                        </td>
                                   
                                        <td>
                                            <div class="btn-group d-flex">
                                                <button type="button" id='task-view-btn' href='#task-view' data-toggle='modal' data-task_id='<?php echo $task["task_id"];?>' data-task_name='<?php echo $task["task_name"];?>' data-priority_id='<?php echo $task["priority_id"];?>' data-start_date='<?php echo $task["start_date"];?>' data-end_date='<?php echo $task["end_date"];?>' data-t_start_date='<?php echo $task["t_start_date"];?>' data-t_end_date='<?php echo $task["t_end_date"];?>' data-project_id='<?php echo $task["project_id"];?>' data-project_name='<?php echo $task["project_name"];?>' data-freelancer_id='<?php echo $task["freelancer_id"];?>' data-freelancer_name='<?php echo $task["freelancer_name"];?>' data-freelancer_image='<?php echo $task["freelancer_image"];?>' class="btn btn-info btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fas fa-plus" style="font-size: 10px; color: white" ></i>&nbsp;View</button>
                                                <button type="button" id='task-edit-btn' href='#task-edit' data-toggle='modal' data-task_id='<?php echo $task["task_id"];?>' data-task_name='<?php echo $task["task_name"];?>' data-priority_id='<?php echo $task["priority_id"];?>' data-start_date='<?php echo $task["start_date"];?>' data-end_date='<?php echo $task["end_date"];?>' data-t_start_date='<?php echo $task["t_start_date"];?>' data-t_end_date='<?php echo $task["t_end_date"];?>' data-project_id='<?php echo $task["project_id"];?>' data-project_name='<?php echo $task["project_name"];?>' data-freelancer_id='<?php echo $task["freelancer_id"];?>' data-freelancer_name='<?php echo $task["freelancer_name"];?>' data-freelancer_image='<?php echo $task["freelancer_image"];?>' class="btn btn-warning btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fas fa-plus" style="font-size: 10px; color: white" ></i>&nbsp;Edit</button>
                                                <?php
                                                if($task['task_status'] == 0){
                                                    ?>
                                                        <button type="button" id='task-delete-btn' href='#task-delete' data-toggle='modal' data-task_id='<?php echo $task["task_id"];?>' data-project_id='<?php echo $task["project_id"];?>' class="btn btn-danger btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fa fa-fw fa-toggle-off" style="font-size: 22px; color: white" ></i></button>
                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                        <button type="button" id='task-activate-btn' href='#task-activate' data-toggle='modal' data-task_id='<?php echo $task["task_id"];?>' data-project_id='<?php echo $task["project_id"];?>' class="btn btn-secondary btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fa fa-fw fa-toggle-on" style="font-size: 22px; color: white" ></i></button>
                                                    <?php
                                                }
                                                ?>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }   
                                        
                            }
                        ?>

                    </table>
                    
                </div>
               
            </div>
         </div>
        

        <!-- view quote modal -->
        <div class="modal fade" id="view-quote" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">View Quote</h4>
                    </div>
                    <div class="modal-body">                        
                        <div class="row">
                            <div class="form-group" style="margin-top: 2px; margin-left: 35px; width: 85%">
                                <label for="view-subject">Subject :</label>
                                <input type="text" class="form-control" id="view-subject" name="subject" placeholder="Enter Subject" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group" style="margin-top: 8px; margin-left: 35px; width: 85%">
                                <label for="view-requirements">What are your requirements?</label>
                                <textarea class="form-control" rows="4" cols="30" id="view-requirements" name="requirements" placeholder="Enter your requirements" disabled>
                                    
                                </textarea>
                            </div>
                        </div>
                            <div class="row">
                                <div class="form-group" style="margin-top: 8px; margin-left: 35px; width: 85%">
                                    <label for="view-remarks">Remarks</label>
                                    <textarea class="form-control" rows="3" cols="30" id="view-remarks" name="remarks" disabled></textarea>
                                </div>
                            </div>
                        <div class="row">
                            <div class="form-group" style="margin-top: 2px; margin-left: 35px; width: 85%">
                                <label for="status">Status :</label>
                                <input type="text" class="form-control" id="view-status" name="status" placeholder="Enter Subject" disabled/>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                    </div>    
                </div>
            </div>
        </div>

        <!-- add task modal --> 
        <div class="modal fade" id="task-add" role="dialog">
            <div class="modal-dialog">
                <form action="../../../controller/proManagerController.php?status=add_task" method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">     
                            <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Add New Task</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2" style="margin-left: 20px; width: 20%">
                                    <label for="project_id">Project ID :</label>
                                    <input type="text" class="form-control" id="project_id"  name="project_id" readonly>
                                </div>
                                <div class="col-md-4" style="margin-left: 50px; width: 45%">
                                  <label for="project_name">Project Name :</label>
                                  <input type="text" class="form-control" id="project_name"  name="project_name" readonly>
                                </div>
                                <div class="col-md-3" style="margin-left: 0px; width: 30%">
                                    <label for="freelancer">Assign Freelancer :</label>
                                    <input class="form-control" type="text" name="freelancer" id="freelancer" readonly>
                                </div>
                                <div class="col-md-2" style="width: 30%">
                                  <img id="freelancer_img"
                                    style="width: 50px; height: 50px; margin-top: 20px " />
                                </div>
                                
                            </div>
                            
                            <div class="row" style="padding-top: 15px">
                                <div class="col-md-6" style="margin-left: 20px; width: 45%">
                                  <label for="task_name">Task :</label>
                                  <input type="text" class="form-control" id="task_name"  name="task_name" required>
                                </div>
                                <div class="col-md-4" style="width: 250px;">
                                  <label for="priority_level">Priority Level :</label>
                                  <select id="priority_level" name="priority_level" class="form-control priority-level" required>
                                    <option value="1">Normal</option>
                                    <option value="2">Urgent</option>
                                    <option value="3">Top Urgent</option>
                                  </select>
                                </div>
                            </div>
                            
                            <div class="row" style="padding-top: 15px">
                                <div class="col-md-4" style="margin-left: 25px; width: 30%">
                                  
                                </div>
                                <!-- must be validate against overall project start date-->
                                <div class="col-md-3" style="width: 30%">
                                  <label for="email">Start Date :</label>
                                  <input type="date" name="start_date" class="form-control" id="start_date" required/>
                                </div>
                                <!-- must be validate against overall project end date-->
                                <div class="col-md-3" style="width: 30%">
                                  <label for="email">End Date :</label>
                                  <input type="date" name="end_date" class="form-control" id="end_date" required/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-success" style="width: 200px; text-align: center; margin-right: 120px"> Add Task</button>
                        </div>    
                    </div>
                </form>
            
            </div>
        </div>

        <!-- edit task modal --> 
        <div class="modal fade" id="task-edit" role="dialog">
            <div class="modal-dialog">
                <form action="../../../controller/proManagerController.php?status=edit_task" method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">     
                            <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Edit Task</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2" style="margin-left: 20px; width: 20%">
                                    <label for="project_id2">Project ID :</label>
                                    <input type="text" class="form-control" id="project_id2"  name="project_id" readonly>
                                </div>
                                <div class="col-md-4" style="margin-left: 50px; width: 45%">
                                  <label for="project_name2">Project Name :</label>
                                  <input type="text" class="form-control" id="project_name2"  name="project_name" readonly>
                                </div>
                                <div class="col-md-3" style="margin-left: 0px; width: 30%">
                                    <label for="freelancer2">Assign Freelancer :</label>
                                    <input class="form-control" type="text" name="freelancer" id="freelancer2" readonly>
                                </div>
                                <div class="col-md-2" style="width: 30%">
                                  <img id="freelancer_img2"
                                    style="width: 50px; height: 50px; margin-top: 20px " />
                                </div>
                                
                            </div>
                            
                            <div class="row" style="padding-top: 15px">
                                <div class="col-md-6" style="margin-left: 20px; width: 45%">
                                  <label for="task_name2">Task :</label>
                                  <input type="text" class="form-control" id="task_name2"  name="task_name" required>
                                </div>
                                <div class="col-md-4" style="width: 250px;">
                                  <label for="priority_level2">Priority Level :</label>
                                  <select id="priority_level2" name="priority_level" class="form-control priority-level" required>
                                    <option value="1">Normal</option>
                                    <option value="2">Urgent</option>
                                    <option value="3">Top Urgent</option>
                                  </select>
                                </div>
                            </div>
                            
                            <div class="row" style="padding-top: 15px">
                                <div class="col-md-4" style="margin-left: 25px; width: 30%">
                                  
                                </div>
                                <!-- must be validate against overall project start date-->
                                <div class="col-md-3" style="width: 30%">
                                  <label for="start_date2">Start Date :</label>
                                  <input type="date" name="start_date" class="form-control" id="start_date2" required/>
                                </div>
                                <!-- must be validate against overall project end date-->
                                <div class="col-md-3" style="width: 30%">
                                  <label for="end_date2">End Date :</label>
                                  <input type="date" name="end_date" class="form-control" id="end_date2" required/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="task_id" id="task_id2">
                            <button type="submit" name="submit" class="btn btn-success" style="width: 200px; text-align: center; margin-right: 120px"> Edit Task</button>
                        </div>    
                    </div>
                </form>
            
            </div>
        </div>

        <!-- view task modal --> 
        <div class="modal fade" id="task-view" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">View Task</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2" style="margin-left: 20px; width: 20%">
                                <label for="project_id3">Project ID :</label>
                                <input type="text" class="form-control" id="project_id3"  name="project_id" disabled>
                            </div>
                            <div class="col-md-4" style="margin-left: 50px; width: 45%">
                                <label for="project_name3">Project Name :</label>
                                <input type="text" class="form-control" id="project_name3"  name="project_name" disabled>
                            </div>
                            <div class="col-md-3" style="margin-left: 0px; width: 30%">
                                <label for="freelancer3">Assign Freelancer :</label>
                                <input class="form-control" type="text" name="freelancer" id="freelancer3" disabled>
                            </div>
                            <div class="col-md-2" style="width: 30%">
                                <img id="freelancer_img3"
                                style="width: 50px; height: 50px; margin-top: 20px " />
                            </div>
                            
                        </div>
                        
                        <div class="row" style="padding-top: 15px">
                            <div class="col-md-6" style="margin-left: 20px; width: 45%">
                                <label for="task_name3">Task :</label>
                                <input type="text" class="form-control" id="task_name3"  name="task_name" disabled>
                            </div>
                            <div class="col-md-4" style="width: 250px;">
                                <label for="priority_level3">Priority Level :</label>
                                <select id="priority_level3" name="priority_level" class="form-control priority-level" disabled>
                                <option value="1">Normal</option>
                                <option value="2">Urgent</option>
                                <option value="3">Top Urgent</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row" style="padding-top: 15px">
                            <div class="col-md-4" style="margin-left: 25px; width: 30%">
                                
                            </div>
                            <!-- must be validate against overall project start date-->
                            <div class="col-md-3" style="width: 30%">
                                <label for="start_date3">Start Date :</label>
                                <input type="date" name="start_date" class="form-control" id="start_date3" disabled/>
                            </div>
                            <!-- must be validate against overall project end date-->
                            <div class="col-md-3" style="width: 30%">
                                <label for="end_date3">End Date :</label>
                                <input type="date" name="end_date" class="form-control" id="end_date3" disabled/>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <!-- mark as delete modal -->
        <div class="modal fade" id="task-delete" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Delete Task</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row d-flex justify-content-center">
                            <p> Are you sure?, You want to delete the task ?</p>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <form action="../../../controller/proManagerController.php?status=delete_task" method="POST">
                            <input type="hidden" name="task_id" id="task_id4">
                            <input type="hidden" id="project_id4"  name="project_id">
                            <button name="submit" type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>    
                </div>            
            </div>
        </div>

        <!-- mark as activate modal -->
        <div class="modal fade" id="task-activate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Activate Task</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row d-flex justify-content-center">
                            <p> Are you sure?, You want to activate the task ?</p>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <form action="../../../controller/proManagerController.php?status=activate_task" method="POST">
                            <input type="hidden" name="task_id" id="task_id5">
                            <input type="hidden" id="project_id5"  name="project_id">
                            <button name="submit" type="submit" class="btn btn-danger">Activate</button>
                        </form>
                    </div>    
                </div>            
            </div>
        </div>
        
    </body>

    <script language="javascript">

        // <!-- send data to modal scripts -->
        $(document).on("click", "#view-quote-btn", function () {
            var subject= $(this).data('subject');
            var requirements= $(this).data('requirements');
            var remarks= $(this).data('remarks');
            var status= $(this).data('status');
            
            $("#view-subject").val(subject);
            $("#view-remarks").val(remarks);
            $("#view-requirements").val(requirements);
            $("#view-status").val(status);
        });

        $(document).on("click", "#task-add-btn", function () {
            var image= $(this).data('freelancer_image');
            var freelancer_name= $(this).data('freelancer_name');
            var project_id= $(this).data('project_id');
            var project_name= $(this).data('project_name');
            var start_date= $(this).data('start_date');
            var end_date= $(this).data('end_date');
            
            $("#project_id").val(project_id);
            $("#project_name").val(project_name);
            $("#freelancer").val(freelancer_name);
            $("#start_date").attr('min',start_date);
            $("#start_date").attr('max',end_date);
            $("#end_date").attr('min',start_date);
            $("#end_date").attr('max',end_date);
            $('#freelancer_img').attr('src', '../../../images/Avatars/freelancer_images/'+image);
        });

        $(document).on("click", "#task-edit-btn", function () {
            var image= $(this).data('freelancer_image');
            var freelancer_name= $(this).data('freelancer_name');
            var project_id= $(this).data('project_id');
            var project_name= $(this).data('project_name');
            var start_date= $(this).data('start_date');
            var end_date= $(this).data('end_date');
            var task_id= $(this).data('task_id');
            var task_name= $(this).data('task_name');
            var priority_id= $(this).data('priority_id');
            var t_start_date= $(this).data('t_start_date');
            var t_end_date= $(this).data('t_end_date');
            
            $("#project_id2").val(project_id);
            $("#project_name2").val(project_name);
            $("#freelancer2").val(freelancer_name);
            $("#task_id2").val(task_id);
            $("#task_name2").val(task_name);
            $("#start_date2").attr('min',start_date);
            $("#start_date2").attr('max',end_date);
            $("#end_date2").attr('min',start_date);
            $("#end_date2").attr('max',end_date);
            $("#start_date2").val(t_start_date);
            $("#end_date2").val(t_end_date);
            $('#freelancer_img2').attr('src', '../../../images/Avatars/freelancer_images/'+image);
            $('#priority_level2').val(priority_id).trigger('change');
        });

        $(document).on("click", "#task-view-btn", function () {
            var image= $(this).data('freelancer_image');
            var freelancer_name= $(this).data('freelancer_name');
            var project_id= $(this).data('project_id');
            var project_name= $(this).data('project_name');
            var start_date= $(this).data('start_date');
            var end_date= $(this).data('end_date');
            var task_id= $(this).data('task_id');
            var task_name= $(this).data('task_name');
            var priority_id= $(this).data('priority_id');
            var t_start_date= $(this).data('t_start_date');
            var t_end_date= $(this).data('t_end_date');
            
            $("#project_id3").val(project_id);
            $("#project_name3").val(project_name);
            $("#freelancer3").val(freelancer_name);
            $("#task_id3").val(task_id);
            $("#task_name3").val(task_name);
            $("#start_date3").val(t_start_date);
            $("#end_date3").val(t_end_date);
            $('#freelancer_img3').attr('src', '../../../images/Avatars/freelancer_images/'+image);
            $('#priority_level3').val(priority_id).trigger('change');
        });

        $(document).on("click", "#task-delete-btn", function () {
            var task_id= $(this).data('task_id');
            var project_id= $(this).data('project_id');
            
            $("#task_id4").val(task_id);
            $("#project_id4").val(project_id);
        });

        $(document).on("click", "#task-activate-btn", function () {
            var task_id= $(this).data('task_id');
            var project_id= $(this).data('project_id');
            
            $("#task_id5").val(task_id);
            $("#project_id5").val(project_id);
        });
        // <!-- end of send data to modal scripts -->

    </script>

</html>
