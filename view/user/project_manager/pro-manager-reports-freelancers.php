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
                           <select id="freelancer1" class="form-control freelancer" required="required">
                               <option value="">Select Freelancer 1</option>
                               <?php
                                    $freelancers1 = $proManagerObj->getAllFreelancers();
                                    while($freelancer1 = $freelancers1->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $freelancer1["id"]; ?>"><?php echo $freelancer1["name"]; ?></option>
                                        <?php
                                    }
                                ?>
                           </select>
                        </div>
                        <div class="col-md-4">
                           <select id="freelancer2" class="form-control freelancer" required="required">
                               <option value="">Select Freelancer 2</option>
                               <?php
                                    $freelancers2 = $proManagerObj->getAllFreelancers();
                                    while($freelancer2 = $freelancers2->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $freelancer2["id"]; ?>"><?php echo $freelancer2["name"]; ?></option>
                                        <?php
                                    }
                                ?>
                           </select>
                        </div>
                        <div class="col-md-4">
                            <button name="report-generate-2" class="btn btn-success" id="report-generate-2">Generate Report</button>
                        </div>
                   </div>
               </div> 
               <div>
                    <div class="col-md-12">&nbsp;</div>
                </div>
               <div align="center" id="loading_div" class="scroll mt-3" style="overflow-y:scroll;"> </div>             
            </div>
         </div>
        
    </body>

</html>
