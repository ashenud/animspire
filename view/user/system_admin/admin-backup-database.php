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

            $dbTables = $adminObj->getAllDbTables();
            $num_of_tables = count($dbTables);

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
                <form method="post" id="export_form" action="../../../controller/adminController.php?status=backup_db">
                    <h5>Select Tables for Export</h5>
                    <div class="row ml-2">
                        
                        <?php
                        for($i=0; $i<=$num_of_tables; $i++) {
                            ?>
                            <div id="ckeckboxdiv" class="col-md-3">
                                    <div class="checkbox ">
                                        <label>
                                            <input type="checkbox" class="checkbox_table" name="table[]" value="<?php echo $dbTables[$i]["Tables_in_animspire"]; ?>"> <?php echo $dbTables[$i]["Tables_in_animspire"]; ?>
                                        </label>
                                    </div>
                            </div>
                            <?php
                        }
                    ?>

                    </div> 
                    <div class="form-group">
                        <input type="button" id="check-toggle" class="check btn btn-secondary" style="padding: 2px; font-size: 10px; background: #535659 !important;" value="check all" />
                        <button type="submit" name="generate-sql" id="generate-sql" class="btn btn-danger" >Backup Database</button>
                    </div>
                </form>            
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

                $('#check-toggle').click(function(e){
                    $(this).toggleClass('clicked');
                    $('input[type="checkbox"]').prop('checked', $(this).hasClass('clicked'))
                });

            });

        </script>

    </body>    
</html>
