<?php
    include '../../commons/session.php';
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
                     <div class="col-md-12" style="padding: 10px; text-align: center">
                             <h4>ALL PROJECTS</h4>
                     </div>
                     </div>
               </div>
                
                <div>
                    <table class="project-table" border="1" >
                        <tr>
                            <th width="40px">&nbsp;Pro.ID</th>
                            <th width="140px">&nbsp;Pro.Name</th>
                            <th width="150px">&nbsp;Pro.Description</th>
                            <th width="110px">&nbsp;Project Manager</th>
                            <th width="100px">&nbsp;Start Date</th>
                            <th width="100px">&nbsp;End Date</th>
                            <th width="100px">&nbsp;Status</th>
                            <th width="73px"></th>
                        </tr>
                        <?php
                            $project_data = $freelancerObj->getAllProjectDetails($freelancer_id);
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
                                        <td>
                                            <div class="btn-group d-flex">
                                                <a id='project-view-btn' href='./freelancer-view-project.php?project_id=<?php echo $project["project_id"]; ?>'  class="btn btn-info btn-sm" style="padding: 0; padding-top: 6px; margin: 2px; width: 35px; height: 30px; font-size: 12px;" ><i class="fas fa-external-link-alt" style="font-size: 10px; color: white" ></i>&nbsp;View</a>
                        
                                            </div>
                                        </td>
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
        
    </body>
    
    
</html>
