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
            $userResults = $userObj->getAllUsers();
            
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
                           <select id="role_id" class="form-control admin-name" required="required">
                               <option value="1">Select System Admin</option>
                           </select>
                        </div>
                        <div class="col-md-4">
                            <button name="report-generate-2" class="btn btn-success" id="report-generate-2" onclick="generate_report('0')">Generate Report</button>
                        </div>
                   </div>
               </div> 
               <div align="center" id="loading_div"> </div>             
            </div>            
        </div>

    </body>

    <script language="javascript">

        function generate_report(page) {
            var role_name = $('#role_id :selected').text();
            var role_id = $('#role_id').val();
            console.log(role_id+'-'+role_name);

            $('#loading_div').html('<p><img src="../../../images/loading.gif"  /></p>');
            $('#loading_div').load("./loadings/report-backup-history.php", {
                'role_name': role_name,
                'role_id': role_id,
                'page': page
            });  
        }
    </script>

</html>
