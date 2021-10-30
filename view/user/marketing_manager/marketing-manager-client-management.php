<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
                
        <title>Quotation Management</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-client-details.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>
       
        <?php
         
            include '../../../model/user_model.php';
            
            $userObj = new User(); //must need for navbar
            $marketingManagerObj = new MarketingManager(); //must need for navbar
            
            /* permission check */
            if(!isset($_SESSION["user"]["role_id"])) {
                $userObj->checkUser('0');
            }
            elseif(($_SESSION["user"]["role_id"]) != 4){
                $userObj->checkUser($_SESSION["user"]["role_id"]);
            }
            /* end permission check */

            $userRoleResult = $userObj->getAllUsers();
            
            $user_id = $_SESSION["user"]["user_id"];
            $userId = base64_encode($user_id);
        
        ?>
      
    </head>
    
    <body  style="background-image: url('../../../images/background-image.png');">
        <div class="cont">
            <?php
                  include './includes/dashboard-navbar.php';
            ?>
            
            <div class="client-details">
               <div class="top-buttons">
                   <div class="row">
                     <div class="col-md-8" style="padding: 12px 50px 1px 350px;">
                             <h4>CUSTOMER DETAILS</h4>
                     </div>
                     <div class="col-md-4">
                            <div class="search" style="margin: 10px 25px 4px 4px">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Search" style="margin-top: 5px; width: 50px">
                                    <div class="input-group-append" >
                                        <button class="btn btn-success" type="submit" onclick="load_users('0')" style="margin-top: 5px; padding: 10px"><span class="fa fa-lg fa-search" ></span></button>
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
        <div class="modal fade" id="customer-delete" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Inactivate Customer</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row d-flex justify-content-center">
                            <p> Are you sure?, You want to inactivate the customer ?</p>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <form action="../../../controller/marketingManagerController.php?status=delete_customer" method="POST">
                            <input type="hidden" id="customer_id1"  name="customer_id">
                            <button name="submit" type="submit" class="btn btn-danger">Inactivate</button>
                        </form>
                    </div>    
                </div>            
            </div>
        </div>

        <!-- mark as activate modal -->
        <div class="modal fade" id="customer-activate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Activate Customer</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row d-flex justify-content-center">
                            <p> Are you sure?, You want to activate the customer ?</p>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <form action="../../../controller/marketingManagerController.php?status=activate_customer" method="POST">
                            <input type="hidden" id="customer_id2"  name="customer_id">
                            <button name="submit" type="submit" class="btn btn-danger">Activate</button>
                        </form>
                    </div>    
                </div>            
            </div>
        </div>
        
        
    </body>

    <script language="javascript">

        $(document).ready(function() {
            load_users('0');
        });

        function load_users(page) {
            var fname = $('#fname').val();
            console.log(fname);

            $('#loading_div').html('<p><img src="../../../images/loading.gif"  /></p>');
            $('#loading_div').load("./loadings/client-table.php", {
                'fname': fname,
                'page': page
            });  
        }

        $(document).on("click", "#customer-delete-btn", function () {
            var customer_id= $(this).data('customer_id');
            $("#customer_id1").val(customer_id);
        });

        $(document).on("click", "#customer-activate-btn", function () {
            var customer_id= $(this).data('customer_id');
            $("#customer_id2").val(customer_id);
        });


    </script>
    
</html>
