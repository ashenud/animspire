<?php
    include '../../commons/session.php';
    if(!isset($_REQUEST['project_id'])) {
        $msg = base64_encode('You have no permission!');
        header('location: ./freelancer-projects.php?msg='.$msg);
    }
?>
<html>
    <head>
        <title>Freelancer Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../css/style-freelancer-projects.css"/>
        <?php include '../../includes/other_dashboard_includes_css.php';?>
        <?php include '../../includes/other_dashboard_includes_script.php'; ?>

        <?php
        
            include '../../model/freelancer_model.php';
            $freelancerObj = new Freelancer(); /// create feelancer object

            $project_id = $_REQUEST['project_id'];
            $freelancer_id = $_SESSION["freelancer"]["freelancer_id"];
            $freelancerId = base64_encode($freelancer_id); 
            
        ?>
        
        
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">

        <div class="cont">
            <?php
                include './includes/dashboard-navbar.php';
            ?>
           
            <div class="project-details">
               <div class="top-buttons">
                   <div class="row">
                     <div class="col-md-6" style="padding: 10px; text-align: center">
                     <?php
                        $current_project = $freelancerObj->getProjectDetails($project_id);
                        $project = $current_project->fetch_assoc();
                     ?>
                            <h4><?php echo $project['project_name']?></h4>
                     </div>
                       <div class="col-md-5">
                            <div class="btn-group" id="btngroup">
                                <button type="button" class="btn btn-danger btn-sm" onclick="load_quotations('<?php echo $project_id; ?>','1')" style="width: 100px; padding: 6px; font-size: 13px">Top Urgent</button>
                                <button type="button" class="btn btn-info btn-sm" onclick="load_quotations('<?php echo $project_id; ?>','2')" style="width: 100px; padding: 6px; font-size: 13px">Urgent</button>
                                <button type="button" class="btn btn-success btn-sm" onclick="load_quotations('<?php echo $project_id; ?>','3')" style="width: 100px; padding: 6px; font-size: 13px">Completed</button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="load_quotations('<?php echo $project_id; ?>','4')" style="width: 100px; padding: 6px; font-size: 13px">pending</button>
                            </div>
                        </div>
                     </div>
               </div>
                
                <div>
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div align="center" id="loading_div" class="scroll mt-3" style="overflow-y:scroll;"> </div> 
               
              
            </div>

        </div> 
        
        <!-- mark as completed modal -->
        <div class="modal fade" id="task-stage" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Stage Task</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row d-flex justify-content-center">
                            <p> Are you sure?, You want to stage the task as completed ?</p>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <form action="../../controller/freelancercontroller.php?status=stage_task" method="POST">
                            <input type="hidden" name="task_id" id="task_id">
                            <input type="hidden" id="project_id"  name="project_id">
                            <button name="submit" type="submit" class="btn btn-danger">Stage</button>
                        </form>
                    </div>    
                </div>            
            </div>
        </div>
        
    </body>

    <script language="javascript">

        $(document).ready(function() {
            load_quotations('<?php echo $project_id; ?>','0');
        });

        function load_quotations(project_id,type) {

            $('#loading_div').html('<p><img src="../../images/loading.gif"  /></p>');
            $('#loading_div').load("./loadings/tasks.php", {
                'project_id': project_id,
                'type': type
            });  
        }

        $(document).on("click", "#task-stage-btn", function () {
            var task_id= $(this).data('task_id');
            var project_id= $(this).data('project_id');
            
            $("#task_id").val(task_id);
            $("#project_id").val(project_id);
        });

    </script>
    
    
</html>
