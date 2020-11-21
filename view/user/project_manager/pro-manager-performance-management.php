<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        <title>Project Manager Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-performance.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>
       
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
            
            <div class="freelancer-performance">
                
                <div class="row freelancer-select" style="height: 50px; margin: 5px 25px 0 25px">
                    <div style="margin: 15px 25px auto 20px">
                        <h6>SELECT FREELANCER</h6>
                    </div>
                    <div class="search">
                        <!--display freelancer id and name together-->
                        <div class="input-group mb-3">
                            <select id="freelancer" class="form-control freelancer" required="required" style="width:350px; margin-top: 6px">
                                <option value="">Select Freelancer</option>
                                <?php
                                        $freelancers1 = $proManagerObj->getAllFreelancers();
                                        while($freelancer1 = $freelancers1->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $freelancer1["id"]; ?>"><?php echo $freelancer1["id"]; ?> - <?php echo $freelancer1["name"]; ?></option>
                                            <?php
                                        }
                                    ?>
                            </select>
                            <div class="input-group-append" >
                                 <button class="btn btn-success" type="submit" onclick="generate_performance()" style="margin-top: 6px; padding: 10px"><span class="fa fa-lg fa-search" ></span></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div align="left" id="loading_div">
                    
                </div>
            </div>
        
    </body>

    <script type="text/javascript">

        function generate_performance() {

            if($('#freelancer').val() != '') {

                var freelancer_name = $('#freelancer :selected').text();
                var freelancer_id = $('#freelancer').val();
                $('#loading_div').html('<p><img src="../../../images/loading.gif"  /></p>');
                $('#loading_div').load("./loadings/freelancer-performance.php", {
                    'freelancer_name': freelancer_name,
                    'freelancer_id': freelancer_id
                });  

            }
            else {
                swal("Someting went wrong!", "Please Select a Freelancer!", "error");
            }
        }

    </script>


</html>
