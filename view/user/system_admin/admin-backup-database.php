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
            $adminObj = new Admin();
            $userObj = new User();
            $dbTables = $adminObj->getAllDbTables();

            $user_id = $_SESSION["user"]["user_id"];
            $userId = base64_encode($user_id);

            /* echo '<pre>';
            print_r($dbTables);
            echo '</pre>'; die(); */
        
        ?>
      
    </head>
    
    <body  style="background-image: url('../../../images/background-image.png');">
        <div class="cont">
            <?php
                include './includes/dashboard-navbar.php';
            ?>
            
            <div class="report-generation">
                <div class="row">
                    <div class="col-md-12" style="padding: 18px 70px 1px 70px; text-align: center">
                            <h3>Backup Database</h3>
                    </div>
                </div>
                <div class="row ml-2">
                    <div class="col-md-12">
                        <form method="post" id="export_form" action="../../../controller/adminController.php?status=backup_db">
                            <h5>Select Tables for Export</h5>
                                <?php
                                foreach($dbTables as $table) {
                                ?>
                                    <div class="checkbox ml-2">
                                        <label>
                                            <input type="checkbox" class="checkbox_table" name="table[]" value="<?php echo $table["Tables_in_animspire"]; ?>"> <?php echo $table["Tables_in_animspire"]; ?>
                                        </label>
                                    </div>
                                <?php
                                }
                            ?>
                            <div class="form-group">
                                <button type="submit" name="generate-sql" id="generate-sql" class="btn btn-danger" >Backup Database</button>
                            </div>
                        </form>
                    </div>
                </div>              
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('#generate-sql').click(function () {
                    var count = 0;
                    $('.checkbox_table').each(function () {
                        if ($(this).is(':checked')) {
                            count = count + 1;
                        }
                    });
                    if (count > 0) {
                        $('#export_form').submit();
                    } else {
                        swal("You got a error!", "Please Select Atleast one table for Export!", "error");
                        return false;
                    }
                });
            });
        </script>

    </body>    
</html>
