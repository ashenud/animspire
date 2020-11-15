<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        <title>Project Manager Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-project-management.css"/>
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
               <div class="top-buttons">
                   <div class="row">
                     <div class="col-md-12" style="padding: 10px; text-align: center">
                             <h4>ALL PROJECTS</h4>
                     </div>
                     </div>
               </div>
                
                <div>
                    <table class="project-table" border="1" >
                        <tr>
                            <th width="40px">&nbsp;Pro.ID</th>
                            <th width="120px">&nbsp;Pro.Name</th>
                            <th width="100px">&nbsp;Pro.Description</th>
                            <th width="130px">&nbsp;Project Manager</th>
                            <th width="60px">&nbsp;Start Date</th>
                            <th width="60px">&nbsp;End Date</th>
                            <th width="60px">&nbsp;Status</th>
                            <th width="120px"></th>
                        </tr>
                        <?php
                            $project_data = $proManagerObj->getAllProjectDetails($user_id);
                            if($project_data->num_rows > 0) {
                                while($project = $project_data->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td>&nbsp;<?php echo $project["project_id"]; ?></td>
                                        <td>&nbsp;<?php echo $project["project_name"]; ?></td>
                                        <td>&nbsp;<?php echo $project["description"]; ?></td>
                                        <td>&nbsp;<?php echo $project["pro_name"]; ?></td>
                                        <td>&nbsp;<?php echo $project["start_date"]; ?></td>
                                        <td>&nbsp;<?php echo $project["end_date"]; ?></td>
                                        <td>&nbsp;
                                            <?php 
                                                if($project["project_timeline"] == 0) {
                                                    echo 'Pending';
                                                }
                                                else {
                                                    echo 'Completed';
                                                }
                                            ?>
                                        </td>
                                        <?php

                                        if($project["freelancer_id"] == 0) {
                                            ?>
                                                <td>
                                                    <div class="btn-group d-flex">
                                                        <button type="button" id='project-assign-btn' href='#project-assign' data-toggle='modal' data-project_name='<?php echo $project["project_name"];?>' data-project_id='<?php echo $project["project_id"];?>' data-cus_name='<?php echo $project["cus_name"];?>' data-customer_image='<?php echo $project["customer_image"];?>' data-pro_name='<?php echo $project["pro_name"];?>' data-project_manager_id='<?php echo $project["project_manager_id"];?>' data-description='<?php echo $project["description"];?>' data-start_date='<?php echo $project["start_date"];?>' data-end_date='<?php echo $project["end_date"];?>' class="btn btn-info btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fas fa-plus" style="font-size: 10px; color: white" ></i>&nbsp;Asign</button>
                                                        <?php
                                                            if($project["project_timeline"]==0) {
                                                                ?>
                                                                    <button type="button" class="btn btn-danger btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fa fa-fw fa-power-off" style="font-size: 10px; color: white" ></i></button>
                                                                <?php
                                                            }
                                                            else {
                                                                ?>
                                                                    <button type="button" class="btn btn-success btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fa fa-fw fa-power-off" style="font-size: 10px; color: white" ></i></button>
                                                                <?php
                                                            } 
                                                        ?>
                                                        </div>
                                                </td>
                                            <?php
                                        }
                                        else {
                                            ?>
                                                <td>
                                                    <div class="btn-group d-flex">
                                                        <a id='project-view-btn' href='./pro-manager-view-project.php?project_id=<?php echo $project["project_id"]; ?>'  class="btn btn-info btn-sm" style="padding: 0; padding-top: 8px; margin: 2px; width: 35px; font-size: 9px;" ><i class="fas fa-external-link-alt" style="font-size: 10px; color: white" ></i>&nbsp;View</a>
                                                        <?php
                                                            if($project["project_timeline"] == 0) {
                                                                ?>
                                                                    <button type="button" id='project-stage-btn' href='#project-stage' data-toggle='modal' data-project_id='<?php echo $project["project_id"];?>' class="btn btn-warning btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fas fa-redo-alt" style="font-size: 10px; color: white" ></i></button>
                                                                <?php
                                                            }
                                                            else {
                                                                ?>
                                                                    <button type="button" class="btn btn-success btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fas fa-check" style="font-size: 10px; color: white" ></i></button>
                                                                <?php
                                                            } 
                                                        ?>
                                                        </div>
                                                </td>
                                            <?php
                                        }
                                    ?>
                                    </tr>
                                    <?php
                                }
                            }
                            else {
                                ?>
                                <tr>
                                    <td align="center" style="text-align:center; color:red" colspan="10">No result found</td>
                                </tr>
                                <?php
                            }
                        ?>
                    </table>
                    
                </div>
               
              
            </div>
         </div>
        
        <!-- project assign to freelancer modal --> 
        <div class="modal fade" id="project-assign" role="dialog">
            <div class="modal-dialog">
                <form action="../../../controller/proManagerController.php?status=assign_freelancer" method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">     
                            <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Start Project</h4>
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
                                    <select class="form-control" name="freelancer" id="freelancer" onchange="getFreelancerImage()" required>
                                        <option value="">Select Freelancer</option>
                                        <?php 
                                            $freelancers = $proManagerObj->getAllFreelancers();
                                            while ($freelancer=$freelancers->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $freelancer['id']; ?>"> <?php echo $freelancer['name']; ?> </option>
                                                <?php
                                            }   
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2" style="width: 30%">
                                  <img id="freelancer_img" src="../../../images/Avatars/freelancer_images/default.jpg"
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
                            <button type="submit" name="submit" class="btn btn-success" style="width: 200px; text-align: center; margin-right: 120px"> Start Project</button>
                        </div>    
                    </div>
                </form>
            
            </div>
        </div>

        <!-- mark as completed modal -->
        <div class="modal fade" id="project-stage" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Stage Project</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row d-flex justify-content-center">
                            <p> Are you sure?, You want to stage the project as completed ?</p>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <form action="../../../controller/proManagerController.php?status=stage_project" method="POST">
                            <input type="hidden" id="project_id1"  name="project_id">
                            <button name="submit" type="submit" class="btn btn-danger">Mark</button>
                        </form>
                    </div>    
                </div>            
            </div>
        </div>
        
    </body>

    <script language="javascript">

        function getFreelancerImage() {

            if ($("#freelancer").val() != ''){

                var freelancer_id = $("#freelancer").val();
                $.ajax({
                    type: 'POST',
                    url: 'loadings/freelancer-image.php',
                    data: {
                        'freelancer_id': freelancer_id
                    },
                    success: function (data) {
                        var freelancerImg = (data);
                        $('#freelancer_img').attr('src', '../../../images/Avatars/freelancer_images/'+freelancerImg);
                    }

                });
            }
            else {
                $('#freelancer_img').attr('src', '../../../images/Avatars/freelancer_images/default.jpg');
            }
            
        }

        // <!-- send data to modal scripts -->
        $(document).on("click", "#project-assign-btn", function () {
            var project_id= $(this).data('project_id');
            var project_name= $(this).data('project_name');
            var start_date= $(this).data('start_date');
            var end_date= $(this).data('end_date');
            
            $("#project_id").val(project_id);
            $("#project_name").val(project_name);
            $("#start_date").attr('min',start_date);
            $("#start_date").attr('max',end_date);
            $("#end_date").attr('min',start_date);
            $("#end_date").attr('max',end_date);
        });

        $(document).on("click", "#project-stage-btn", function () {
            var project_id= $(this).data('project_id');
            $("#project_id1").val(project_id);
        });
        // <!-- end of send data to modal scripts -->

    </script>

</html>
