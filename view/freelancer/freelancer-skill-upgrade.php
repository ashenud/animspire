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
                    <button type="button" onclick="load_question_group('1')" class="btn btn-pink" style="color: white;">Graphic & Design</button>
                    <button type="button" onclick="load_question_group('2')" class="btn btn-primary">Social Media Marketing</button>
                    <button type="button" onclick="load_question_group('3')" class="btn btn-danger">SEO</button>
                    <button type="button" onclick="load_question_group('4')" class="btn btn-purple" style="color: white;">Video & Animation</button>
                    <button type="button" onclick="load_question_group('5')" class="btn btn-success">Music & Audio</button>
                    <button type="button" onclick="load_question_group('6')" class="btn btn-warning" style="color: white;">Programming</button>
                    <button type="button" onclick="load_question_group('7')" class="btn btn-brown" style="color: white;">E-commerce</button>
                    <button type="button" onclick="load_question_group('8')" class="btn btn-info">Word/Excel</button>
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

        $(document).ready(function() {
            // load_question_group('1');
        });

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
                swal("Good job!", `Your mark is ${marks}%`, "success");
            });
        </script>
        <?php
        unset($_SESSION["freelancer_marks"]);
    }        
    ?>

    
</html>
