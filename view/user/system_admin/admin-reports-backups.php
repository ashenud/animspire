<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        
        <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-report-management.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>

        <?php
         
            include '../../../model/user_model.php';
            $userObj = new User(); //must need for navbar
            $adminObj = new Admin(); //must need for navbar

            /* permission check */
            if(!isset($_SESSION["user"]["role_id"])) {
                $userObj->checkUser('0');
            }
            elseif(($_SESSION["user"]["role_id"]) != 1){
                $userObj->checkUser($_SESSION["user"]["role_id"]);
            }
            /* end permission check */

            
            $admins = $userObj->getAllAdmins();
            
            $userId = $_SESSION["user"]["user_id"];
            $userId = base64_encode($userId);
        
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
                           <select id="admin_id" class="form-control admin-name" required="required">
                               <option value="">All Admins</option>
                               <?php
                                while($admin = $admins->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $admin["user_id"]; ?>"><?php echo $admin["user_fname"].' '.$admin["user_lname"]; ?></option>
                                <?php
                                }
                                ?>
                           </select>
                        </div>
                        <div class="col-md-4">
                            <button name="report-generate-2" class="btn btn-success" id="report-generate-2" onclick="generate_report('0')">Generate Report</button>
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

    <script language="javascript">

        function generate_report(page) {
            var admin_name = $('#admin_id :selected').text();
            var admin_id = $('#admin_id').val();
            // console.log(admin_name+'-'+admin_id);

            $('#loading_div').html('<p><img src="../../../images/loading.gif"  /></p>');
            $('#loading_div').load("./loadings/report-backup-history.php", {
                'admin_name': admin_name,
                'admin_id': admin_id,
                'page': page
            });  
        }
    </script>

</html>
