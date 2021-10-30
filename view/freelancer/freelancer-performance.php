<?php
    include '../../commons/session.php';
?>
<html>
    <head>
        <title>Freelancer Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../css/style-individual-freelancer-performance.css"/>
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
           
            <div class="freelancer-performance">
                <div class="row" style="margin-left: 15px;">
                    <div class="row freelancer-info">
                        <div class="freelancer-image" style="margin: 20px 15px">
                            <img src="../../images/Avatars/freelancer_images/<?php echo $_SESSION["freelancer"]["freelancer_image"]?>" style="width: 120px; height: 120px;">
                        </div>
                        <div class="freelancer-details" style="margin: 60px 10px;">
                            <h6><?php echo $_SESSION["freelancer"]["firstname"]." ".$_SESSION["freelancer"]["lastname"]; ?></h6>
                            <p>Freelancer</p>
                        </div>
                    </div>
                    <div class="freelancer-rating">
                        <div class="row" style="padding: 15px 82.5px; width: 290px; margin-left: 0; background-color: grey">
                            <h5>USER RATING</h5>
                        </div>
                        <?php
                            $all_projects= $freelancerObj->getTotalProjectCount($freelancer_id)->num_rows;
                            $all_tasks= $freelancerObj->getTotalTaskCount($freelancer_id)->num_rows;
                            $delayed_tasks= $freelancerObj->getDelayedTaskCount($freelancer_id)->num_rows;
                            $top_urgent_tasks= $freelancerObj->getTopUrgentTaskCount($freelancer_id)->num_rows;
                            $pending_tasks= $freelancerObj->getPendingTaskCount($freelancer_id)->num_rows;
                            $completed_tasks= $freelancerObj->getCompletedTaskCount($freelancer_id)->num_rows;
                            $freelancer_rate = 100 - (($delayed_tasks/$all_tasks)*100);
                            $completed_rate =($completed_tasks/$all_tasks)*100;

                            if(100 == $freelancer_rate ) {
                                ?>
                                    <div class="row rating-stars" style="margin: 25px 24.5px  ">
                                        <img src="../../images/icons/star_1.png"/> &nbsp; <img src="../../images/icons/star_1.png"/> &nbsp; <img src="../../images/icons/star_1.png"/> &nbsp; <img src="../../images/icons/star_1.png"/> &nbsp; <img src="../../images/icons/star_dark.png"/>
                                    </div>
                                <?php
                            }
                            elseif(80 < $freelancer_rate) {
                                ?>
                                    <div class="row rating-stars" style="margin: 25px 24.5px  ">
                                    <img src="../../images/icons/star_1.png"/> &nbsp; <img src="../../images/icons/star_1.png"/> &nbsp; <img src="../../images/icons/star_1.png"/> &nbsp; <img src="../../images/icons/star_1.png"/> &nbsp; <img src="../../images/icons/star_dark.png"/>
                                    </div>
                                <?php
                            }
                            elseif(60 < $freelancer_rate) {
                                ?>
                                    <div class="row rating-stars" style="margin: 25px 24.5px  ">
                                        <img src="../../images/icons/star_1.png"/> &nbsp; <img src="../../images/icons/star_1.png"/> &nbsp; <img src="../../images/icons/star_1.png"/>  &nbsp; <img src="../../images/icons/star_dark.png"/>  &nbsp; <img src="../../images/icons/star_dark.png"/>
                                    </div>
                                <?php
                            }
                            elseif(40 < $freelancer_rate) {
                                ?>
                                    <div class="row rating-stars" style="margin: 25px 24.5px  ">
                                        <img src="../../images/icons/star_1.png"/> &nbsp; <img src="../../images/icons/star_1.png"/>  &nbsp; <img src="../../images/icons/star_dark.png"/>&nbsp; <img src="../../images/icons/star_dark.png"/>  &nbsp; <img src="../../images/icons/star_dark.png"/>
                                    </div>
                                <?php
                            }
                            elseif(20 < $freelancer_rate) {
                                ?>
                                    <div class="row rating-stars" style="margin: 25px 24.5px  ">
                                        <img src="../../images/icons/star_1.png"/>  &nbsp; <img src="../../images/icons/star_dark.png"/> &nbsp; <img src="../../images/icons/star_dark.png"/>  &nbsp; <img src="../../images/icons/star_dark.png"/>  &nbsp; <img src="../../images/icons/star_dark.png"/>
                                    </div>
                                <?php
                            }
                            else {
                                ?>
                                    <div class="row rating-stars" style="margin: 25px 24.5px  ">
                                        <img src="../../images/icons/star_dark.png"/>  &nbsp; <img src="../../images/icons/star_dark.png"/> &nbsp; <img src="../../images/icons/star_dark.png"/> &nbsp; <img src="../../images/icons/star_dark.png"/> &nbsp; <img src="../../images/icons/star_dark.png"/>
                                    </div>
                                <?php
                            }
                            
                        ?>                         
                    </div>
                    <div class="freelancer-awards">
                        <div class="row badge-block">
                            <?php
                                $all_marks= $freelancerObj->getTotalMarks($freelancer_id);
                                $freelancer_point = $all_marks->fetch_array()[0];
                                if(30 < $freelancer_point ) {
                                    ?>
                                        <img src="../../images/icons/first.png" style="width: 80px; height: 80px; margin: 10px 100px 5px auto;"/>
                                    <?php
                                }
                                elseif(20 < $freelancer_point) {
                                    ?>
                                        <img src="../../images/icons/second.png" style="width: 80px; height: 80px; margin: 10px 100px 5px auto;"/>
                                    <?php
                                }
                                elseif(10 < $freelancer_point) {
                                    ?>
                                        <img src="../../images/icons/third.png" style="width: 80px; height: 80px; margin: 10px 100px 5px auto;"/>
                                    <?php
                                }
                                else {
                                    ?>
                                        <img src="../../images/icons/fourth.png" style="width: 80px; height: 80px; margin: 10px 100px 5px auto;"/>
                                    <?php
                                }
                            ?>                           
                        </div>
                        <hr style="margin: 1px">
                        <div class="row points">
                            <div class="points-label" style="margin: 20px 20px 20px 75px">
                                <h6>POINTS</h6>
                            </div>
                            <div class="points-number">
                                <input type="text" name="points" value="<?php echo $freelancer_point;?>" style="height: 40px; width: 40px; margin: 10px; text-align: center" /> 
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row" style="margin-left: 15px;">
                    <div class="all-projects-block">
                        <div class="row" style="padding: 10px 11px; width: 120px; height: 35px;margin-left: 0; background-color: grey">
                            <h6 style="font-size: 14px;">ALL PROJECTS</h6>
                        </div>
                        <div class="project-count">
                            <h1 style="font-size: 50px; margin: 10px 30px"><?php echo $all_projects;?></h1>
                        </div>
                    </div>
                    <div class="all-task-block">
                        <div class="row" style="padding: 10px 24px; width: 120px; height: 35px;margin-left: 0; background-color: grey">
                            <h6 style="font-size: 14px;">ALL TASKS</h6>
                        </div>
                        <div class="project-count">
                            <h1 style="font-size: 50px; margin: 10px 30px"><?php echo $all_tasks;?></h1>
                        </div>
                    </div>
                    
                    <div class="task-block">
                        <div class="row top">
                            <div class="row pending-tasks" style="background-color: black; margin: 0 5px 10px 15px; width: 240px; height: 50px">
                                <div style="width: 170px; margin: 15px 0 10px 20px; color: white">
                                <h6>PENDING TASKS</h6>
                                </div>
                                <div style="width: 50px; height: 50px; background-color: dodgerblue; text-align: center">
                                    <h1><?php echo $pending_tasks;?></h1>
                                </div>
                            </div>
                            <div class="row delayed-tasks" style="background-color: black; margin: 0 0 10px 5px; width: 240px; height: 50px">
                                <div style="width: 170px; margin: 15px 0 10px 20px; color: white">
                                <h6>DELAYED TASKS</h6>
                                </div>
                                <div style="width: 50px; height: 50px; background-color: dodgerblue; text-align: center">
                                    <h1><?php echo $delayed_tasks;?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="row bottom">
                            <div class="row completed-tasks" style="background-color: black; margin: 10px 5px 0 15px; width: 240px; height: 50px">
                                <div style="width: 170px; margin: 15px 0 10px 20px; color: white">
                                <h6>COMPLETED TASKS</h6>
                                </div>
                                <div style="width: 50px; height: 50px; background-color: dodgerblue; text-align: center">
                                    <h1><?php echo $completed_tasks;?></h1>
                                </div>
                            </div>
                            <div class="row top-urgent-tasks" style="background-color: black; margin: 10px 0 0 5px; width: 240px; height: 50px">
                                <div style="width: 170px; margin: 15px 0 10px 20px; color: white">
                                <h6>TOP URGENT TASKS</h6>
                                </div>
                                <div style="width: 50px; height: 50px; background-color: dodgerblue; text-align: center">
                                    <h1><?php echo $top_urgent_tasks;?></h1>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="task-delay-rate-block">
                        
                    </div>
                </div>
                <div class="row" style="margin-left: 15px;">
                    <div class="row task-progressbar-block">
                        <div>
                            <h6 style="color: white; margin: 40px 30px 0 25px">TASK COMPLETION RATE</h6>
                        </div>
                        <div class="progress" style="width: 550px; height: 20px; margin-top: 40px">
                        <div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated" role="progressbar"
                             aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        </div>
                        </div>
                        <div class="progress-count">
                            <h1 style="font-size: 40px; margin: 25px 22px; color: white"><?php echo number_format($completed_rate);?>%</h1>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>        
        
    </body>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".progress-bar").animate({
                width: "<?php echo number_format($completed_rate);?>%"
            }, 2500);
        });
    </script>
    
</html>
