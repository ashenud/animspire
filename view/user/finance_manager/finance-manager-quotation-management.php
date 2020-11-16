<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        <title>Finance Manager Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-quote-details.css"/>
        <style>
            .modal-dialog{
                padding-top: 30px;
            }
            .modal-content .modal-header{
                border-bottom: none;
                text-align: center;
                background-image: linear-gradient(180deg, #834d9b, #d04ed6);
                height: 80px;
                color: white;
                
            }
            
        </style>
        
        
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>
      
        <?php
        
            include '../../../model/user_model.php';
            
            $userObj = new User();
            $financeManagerObj = new FinanceManager(); //must need for navbar

            /* permission check */
            if(!isset($_SESSION["user"]["role_id"])) {
                $userObj->checkUser('0');
            }
            elseif(($_SESSION["user"]["role_id"]) != 3){
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
            <div class="quote-details">
               <div class="top-buttons">
                   <div class="row">
                        <div class="col-md-3">
                        </div>
                       <div class="col-md-4" style="text-align: center">
                             <h4>QUOTE DETAILS</h4>
                        </div>
                       <div class="col-md-5">
                            <div class="btn-group" id="btngroup">
                                <button type="button" class="btn btn-success btn-sm" onclick="load_quotations('0','3')" style="width: 85px; padding: 6px; font-size: 13px">Approved</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="load_quotations('0','4')" style="width: 85px; padding: 6px; font-size: 13px">Rejected</button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="load_quotations('0','1')" style="width: 85px; padding: 6px; font-size: 13px">Pending</button>
                                <button type="button" class="btn btn-info btn-sm" onclick="load_quotations('0','2')" style="width: 85px; padding: 6px; font-size: 13px">Submitted</button>
                            </div>
                        </div>
                   </div>
               </div>
               <div>
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div align="center" id="loading_div" class="scroll mt-3"> </div>  
            </div>
            
        </div>

        <!-- view quote modal -->
        <div class="modal fade" id="view-quote" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">View Quote</h4>
                    </div>
                    <div class="modal-body">
                    
                        <div class="row">
                            <!-- Alert message -->
                                <div id="alertDiv" style="margin-left: 35px; width: 420px; height: 45px"></div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="form-group" style="margin-top: 2px; margin-left: 35px; width: 85%">
                                <label for="view-subject">Subject :</label>
                                <input type="text" class="form-control" id="view-subject" name="subject" placeholder="Enter Subject" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group" style="margin-top: 8px; margin-left: 35px; width: 85%">
                                <label for="view-requirements">What are your requirements?</label>
                                <textarea class="form-control" rows="4" cols="30" id="view-requirements" name="requirements" placeholder="Enter your requirements" disabled>
                                    
                                </textarea>
                            </div>
                        </div>
                            <div class="row">
                                <div class="form-group" style="margin-top: 8px; margin-left: 35px; width: 85%">
                                    <label for="view-remarks">Remarks</label>
                                    <textarea class="form-control" rows="3" cols="30" id="view-remarks" name="remarks" disabled></textarea>
                                </div>
                            </div>
                        <div class="row">
                            <div class="form-group" style="margin-top: 2px; margin-left: 35px; width: 85%">
                                <label for="status">Status :</label>
                                <input type="text" class="form-control" id="view-status" name="status" placeholder="Enter Subject" disabled/>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                    </div>    
                </div>
            </div>
        </div>
            
            
        </div>
        
        
    </body>

</html>
