<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        <title>Project Manager Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-report-management-pro.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.svg.js"></script>
      
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
            <div class="report-generation">
                <div class="top-buttons">
                    <div class="row">
                       <div class="col-md-4">
                           <select id="project1" class="form-control project" required="required">
                               <option value="">Select Project 1</option>
                               <?php
                                    $projects1 = $proManagerObj->getAllProjectDetails($user_id);
                                    while($project1 = $projects1->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $project1["project_id"]; ?>"><?php echo $project1["project_name"]; ?></option>
                                    <?php
                                    }
                                ?>
                           </select>
                        </div>
                        <div class="col-md-4">
                           <select id="project2" class="form-control project" required="required">
                               <option value="">Select Project 2</option>
                               <?php
                                    $projects2 = $proManagerObj->getAllProjectDetails($user_id);
                                    while($project2 = $projects2->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $project2["project_id"]; ?>"><?php echo $project2["project_name"]; ?></option>
                                    <?php
                                    }
                                ?>
                           </select>
                        </div>
                        <div class="col-md-4">
                            <button name="report-generate-2" class="btn btn-success" id="report-generate-2" onclick="generate_report()">Generate Report</button>
                        </div>
                   </div>
               </div> 
               <div>
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div align="left" id="chart_div" class="scroll mt-3" style="margin-left:20%;margin-right:20%;overflow-y:scroll;"> </div>           
            </div>
         </div>
        
    </body>

    <script language="javascript">

        function generate_report() {

            if($('#project1').val() != '' && $('#project2').val() != '' ) {

                if($('#project1').val() != $('#project2').val()) {

                    var project1_name = $('#project1 :selected').text();
                    var project1_id = $('#project1').val();
                    var project2_name = $('#project2 :selected').text();
                    var project2_id = $('#project2').val();
                    // console.log(project1_name,project2_name,project1_id,project2_id)

                    $('#chart_div').html('<p><img src="../../../images/loading.gif"  /></p>');
                    $('#chart_div').load("./loadings/report-projects-analysis.php", {
                        'project1_id': project1_id,
                        'project2_id': project2_id,
                        'project1_name': project1_name,
                        'project2_name': project2_name
                    });

                }
                else {
                    swal("Someting went wrong!", "Please Select two diffrent projects!", "error");
                }
            }
            else {
                swal("Someting went wrong!", "Please Select projects!", "error");
            }
              
        }

    </script>

</html>
