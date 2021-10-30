<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        
        <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-freelancer-details.css"/>
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
            
            $user_id = $_SESSION["user"]["user_id"];
            $userId = base64_encode($user_id);
        
        ?>
      
    </head>
    
    <body  style="background-image: url('../../../images/background-image.png');">
        <div class="cont">
            <?php
                include './includes/dashboard-navbar.php';
            ?>
            
            <div class="freelancer-details">
               <div class="top-buttons">
                   <div class="row">
                     <div class="col-md-8" style="padding: 12px 50px 1px 300px;">
                             <h4>FREELANCER DETAILS</h4>
                     </div>
                     <div class="col-md-4">
                            <div class="search" style="margin: 10px 25px 4px 4px">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Type First Name toSearch" style="margin-top: 5px; width: 50px">
                                    <div class="input-group-append" >
                                        <button class="btn btn-success" type="submit" onclick="load_freelancers('0')" style="margin-top: 5px; padding: 10px"><span class="fa fa-lg fa-search" ></span></button>
                                    </div>
                                </div>
                            </div>
                     </div>
                   </div>
               </div>
                
               <div>
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div align="center" id="loading_div"> </div>
               
            </div>

        </div>

        <!-- mark as delete modal -->
        <div class="modal fade" id="freelancer-delete" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Inactivate Freelancer</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row d-flex justify-content-center">
                            <p> Are you sure?, You want to inactivate the freelancer ?</p>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <form action="../../../controller/adminController.php?status=delete_freelancer" method="POST">
                            <input type="hidden" id="freelancer_id1"  name="freelancer_id">
                            <button name="submit" type="submit" class="btn btn-danger">Inactivate</button>
                        </form>
                    </div>    
                </div>            
            </div>
        </div>

        <!-- mark as activate modal -->
        <div class="modal fade" id="freelancer-activate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Activate Freelancer</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row d-flex justify-content-center">
                            <p> Are you sure?, You want to activate the freelancer ?</p>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <form action="../../../controller/adminController.php?status=activate_freelancer" method="POST">
                            <input type="hidden" id="freelancer_id2"  name="freelancer_id">
                            <button name="submit" type="submit" class="btn btn-danger">Activate</button>
                        </form>
                    </div>    
                </div>            
            </div>
        </div>

    </body>


    <script language="javascript">

        $(document).ready(function() {
            load_freelancers('0');
        });

        function load_freelancers(page) {
            var fname = $('#fname').val();
            // console.log(fname);

            $('#loading_div').html('<p><img src="../../../images/loading.gif"  /></p>');
            $('#loading_div').load("./loadings/freelancers-table.php", {
                'fname': fname,
                'page': page
            });  
        }

        $(document).on("click", "#freelancer-delete-btn", function () {
            var freelancer_id= $(this).data('freelancer_id');
            $("#freelancer_id1").val(freelancer_id);
        });

        $(document).on("click", "#freelancer-activate-btn", function () {
            var freelancer_id= $(this).data('freelancer_id');
            $("#freelancer_id2").val(freelancer_id);
        });
    </script>
    

</html>
