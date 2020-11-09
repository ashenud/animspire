<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
                
        <title>Customer Quotations</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-quote-details.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>
        
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
            
            $userId = $_SESSION["user"]["user_id"];
            $userId = base64_encode($userId);
        
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
               <div align="center" id="loading_div" class="scroll mt-3" style="overflow-y:scroll;"> </div>  
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

        <!-- send quote modal -->
        <div class="modal fade" id="send-quote" role="dialog">
            <div class="modal-dialog">
                <form action="../../../controller/marketingManagerController.php?status=send_quote" method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">     
                            <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Send Quote</h4>
                        </div>
                        <div class="modal-body">
                       
                            <div class="row">
                                <!-- Alert message -->
                                 <div id="alertDiv" style="margin-left: 35px; width: 420px; height: 45px"></div>
                               
                            </div>
                            <div class="row">
                                <div class="form-group" style="margin-top: 8px; margin-left: 35px; width: 85%">
                                    <label for="send-remarks">Remarks</label>
                                    <textarea class="form-control" rows="3" cols="30" id="send-remarks" name="remarks" required></textarea>
                                </div>
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="quotation_id" id="send-id">
                            <button type="submit" name="submit" class="btn btn-success" style="width: 200px; text-align: center; margin-right: 135px">
                            Send Quote</button>
                        </div>    
                    </div>
                </form>
            
            </div>
        </div>

        <!-- payment modal1 (view only) -->
        <div class="modal fade" id="payment1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Payment Request</h4>
                    </div>
                    <div class="modal-body">

                        <!-- <div class="row">
                            <button type="submit" name="view-quote" class="btn btn-info btn-sm" style="width: 90px; padding: 4px; text-align: center; margin-left: 370px">
                            View Quote
                            </button>
                        </div> -->
                        
                        <div class="row">
                            <div class="form-group" style="margin-left: 35px; width: 40%">
                                <label for="date1">Date :</label>
                                <input type="date" name="date1" class="form-control" id="date1" disabled/>
                            </div>
                            <div class="form-group" style="margin-left: 25px; width: 40%">
                                <label for="customer1">Customer :</label>
                                <input type="text" class="form-control" id="customer1"  name="customer1" disabled>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group" style="margin-top: 8px; margin-left: 35px; width: 85%">
                                <label for="description1">Description</label>
                                <textarea class="form-control" rows="3" cols="30" id="description1" name="description1" disabled></textarea>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="form-group" style="margin-left: 35px; width: 40%">
                                <img src="../../../images/icons/unpaid.png" style=" height: 60px; width: 120px; margin: 10px 20px 10px 20px;">
                            </div>
                            <div class="form-group" style="margin-left: 25px; width: 40%">
                                <label for="total1">Total :</label>
                                <input type="text" class="form-control" id="total1"  name="total1" disabled>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>

        <!-- payment modal2 (view only) -->
        <div class="modal fade" id="payment2" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Payment Request</h4>
                    </div>
                    <div class="modal-body">

                        <!-- <div class="row">
                            <button type="submit" name="view-quote" class="btn btn-info btn-sm" style="width: 90px; padding: 4px; text-align: center; margin-left: 370px">
                            View Quote
                            </button>
                        </div> -->
                        
                        <div class="row">
                            <div class="form-group" style="margin-left: 35px; width: 40%">
                                <label for="date2">Date :</label>
                                <input type="date2" name="date2" class="form-control" id="date2" disabled>
                            </div>
                            <div class="form-group" style="margin-left: 25px; width: 40%">
                                <label for="customer2">Customer :</label>
                                <input type="text" class="form-control" id="customer2"  name="customer2" disabled>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group" style="margin-top: 8px; margin-left: 35px; width: 85%">
                                <label for="description2">Description</label>
                                <textarea class="form-control" rows="3" cols="30" id="description2" name="description2" disabled></textarea>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="form-group" style="margin-left: 35px; width: 40%">
                                <img src="../../../images/icons/unpaid.png" style=" height: 60px; width: 120px; margin: 10px 20px 10px 20px;">
                            </div>
                            <div class="form-group" style="margin-left: 25px; width: 40%">
                                <label for="total2">Total :</label>
                                <input type="text" class="form-control" id="total2"  name="total2" disabled>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>

        <!-- payment modal3 (request payment) -->
        <div class="modal fade" id="payment3" role="dialog">
            <div class="modal-dialog">
                <form action="../../../controller/marketingManagerController.php?status=payment_request" method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">     
                            <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Payment Request</h4>
                        </div>
                        <div class="modal-body">

                            <!-- <div class="row">
                                <button type="submit" name="view-quote" class="btn btn-info btn-sm" style="width: 90px; padding: 4px; text-align: center; margin-left: 370px">
                                View Quote
                                </button>
                            </div> -->
                            
                            <div class="row">
                                <div class="form-group" style="margin-left: 35px; width: 40%">
                                  <label for="date3">Date :</label>
                                  <input type="date" name="date" class="form-control" id="date" value="<?php echo date('Y-m-d')?>" disabled/>
                                </div>
                                <div class="form-group" style="margin-left: 25px; width: 40%">
                                  <label for="customer">Customer :</label>
                                  <input type="text" class="form-control" id="customer"  name="customer" disabled>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group" style="margin-top: 8px; margin-left: 35px; width: 85%">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" cols="30" id="description" name="description" required></textarea>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="form-group" style="margin-left: 35px; width: 40%">
                                    <img src="../../../images/icons/unpaid.png" style=" height: 60px; width: 120px; margin: 10px 20px 10px 20px;">
                                </div>
                                <div class="form-group" style="margin-left: 25px; width: 40%">
                                  <label for="total">Total :</label>
                                  <input type="number" class="form-control" min="0" id="total"  name="total" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="quote_id" id="quote_id">
                                <input type="hidden" name="customer_id" id="customer_id">
                                <button type="submit" name="submit" class="btn btn-success" style="width: 200px; text-align: center; margin-right: 135px">
                                Request Payment</button>
                            </div>
                        </div>    
                    </div>
                </form>
            </div>
        </div>
        
    </body>

    <script language="javascript">

        $(document).ready(function() {
            load_quotations('0','1');
        });

        function load_quotations(page,type) {
            var status = type;
            // console.log(status);

            $('#loading_div').html('<p><img src="../../../images/loading.gif"  /></p>');
            $('#loading_div').load("./loadings/quotations.php", {
                'status': status,
                'page': page
            });  
        }

        // <!-- send data to modal scripts -->
        $(document).on("click", "#view-quote-btn", function () {
            var subject= $(this).data('subject');
            var requirements= $(this).data('requirements');
            var remarks= $(this).data('remarks');
            var status= $(this).data('status');
            
            $("#view-subject").val(subject);
            $("#view-remarks").val(remarks);
            $("#view-requirements").val(requirements);
            $("#view-status").val(status);
        });

        $(document).on("click", "#send-quote-btn", function () {
            var id= $(this).data('id');
            var remarks= $(this).data('remarks');
            
            $("#send-id").val(id);
            $("#send-remarks").val(remarks);
        });

        $(document).on("click", "#payment-btn1", function () {
            var customer1= $(this).data('name');
            var date1= $(this).data('date');
            var description1= $(this).data('description');
            var total1= $(this).data('total');
            
            $("#customer1").val(customer1);
            $("#date1").val(date1);
            $("#description1").val(description1);
            $("#total1").val(total1);
        });

        $(document).on("click", "#payment-btn2", function () {
            var customer2= $(this).data('name');
            var date2= $(this).data('date');
            var description2= $(this).data('description');
            var total2= $(this).data('total');
            
            $("#customer2").val(customer2);
            $("#date2").val(date2);
            $("#description2").val(description2);
            $("#total2").val(total2);
        });

        $(document).on("click", "#payment-btn3", function () {
            var customer= $(this).data('name');
            var customerID= $(this).data('customer');
            var quoteID= $(this).data('id');
            
            $("#customer").val(customer);
            $("#customer_id").val(customerID);
            $("#quote_id").val(quoteID);
        });
        // <!-- end of send data to modal scripts -->


    </script>
    
</html>
