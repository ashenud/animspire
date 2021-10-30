<?php
    include '../../commons/session.php';
?>
<html>
    <head>
        <title>Freelancer Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../css/style-skill-upgrade.css"/>
        <?php include '../../includes/other_dashboard_includes_css.php';?>
        <?php include '../../includes/other_dashboard_includes_script.php'; ?>

        <?php
        
            include '../../model/freelancer_model.php';
            $freelancerObj = new Freelancer(); /// create feelancer object

            $freelancer_id = $_SESSION["freelancer"]["freelancer_id"];
            $freelancerId = base64_encode($freelancer_id); 
            
        ?>
        <style>
            .swal-icon--custom {
                height: 250px !important;
            }
        </style>
        
        
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">

        <div class="cont">
            <?php
                include './includes/dashboard-navbar.php';
            ?>
           
            <div class="skill-upgrade">
                <div class="topic" style="text-align: center; padding-top: 20px">
                    <h4>SKILLS UPGRADE</h4>
                </div>
                <hr>
              <div class="row">
                <div class="btn-group-vertical" >
                    <?php 
                        $question_groups = $freelancerObj->getQuestionGroups();
                        while ($group =$question_groups->fetch_assoc()) {
                            ?>
                                <button type="button" onclick="load_question_group('<?php echo $group['group_id']?>')" class="btn <?php echo $group['color_class']?>" style="color: white;"><?php echo $group['group_name']?></button>
                            <?php
                        }
                    ?>                    
                </div>

                <div class="quiz" id="loading_div">
                    <div>
                        <p>Select a quiz group to start</p>
                    </div>
                </div>
              </div>
              
            </div>
        </div>        
        
    </body>
    
    <script type="text/javascript">

        function load_question_group(group) {

            $('#loading_div').html('<p><img src="../../images/loading.gif"  /></p>');
            $('#loading_div').load("./loadings/question-group.php", {
                'group': group
            });  
        }

        function load_allowed_freelancers(type) {

            $('#loading_div').html('<p><img src="../../images/loading.gif"  /></p>');
            $('#loading_div').load("./loadings/tools-allowed-freelancers.php", {
                'type': type
            });  
        }

        $(document).on("click", "#tool-accept-btn", function () {
            var request_id= $(this).data('request_id');
            var freelancer_email= $(this).data('freelancer_email');
            var tool_name= $(this).data('tool_name');

            $("#request_id").val(request_id);
            $("#email").val(freelancer_email);
            $("#tool_name").val(tool_name);
        });

    </script>

    <?php
    if(isset($_SESSION["freelancer_marks"])) {
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                var marks = <?php echo $_SESSION["freelancer_marks"];?>;
                if (marks<50) {
                    var title = 'Try Again'
                }
                else {
                    var title = 'Good job !'
                }
                swal({
                    title: title,
                    text: `Your mark is ${marks}%`,
                    icon: "../../images/icons/trophy.png",
                    iconSize: '300x300'
                });
            });
        </script>
        <?php
        unset($_SESSION["freelancer_marks"]);
    }        
    ?>

    
</html>
