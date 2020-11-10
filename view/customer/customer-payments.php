<?php
    include '../../commons/session.php';
?>
<html>
    <head>
                
        <title>Customer Quotations</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../css/style-cutomer-payments.css"/>
        <?php include '../../includes/other_dashboard_includes_css.php';?>
        <?php include '../../includes/other_dashboard_includes_script.php'; ?>
        
        <style>
            
            .modal-content .modal-header{
                border-bottom: none;
                text-align: center;
                background-image: linear-gradient(180deg, #834d9b, #d04ed6);
                height: 80px;
                color: white;
                
            }
            
        </style>

        <?php
         
            include '../../model/customer_model.php';
            $customerObj = new Customer(); //must need for navbar

            $customer_id = $_SESSION["customer"]["customer_id"];
            $customerId = base64_encode($customer_id); 
        
        ?>
      
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">
        <div class="cont">
            <?php
                  include './includes/dashboard-navbar.php';
            ?>
            
            <div class="payment-details">
               <div class="top-buttons">
                   <div class="row" >
                       <div class="col-md-12" style="text-align: center">
                           <h4>PAYMENTS DETAILS</h4>
                       </div>
                     </div>
               </div>
               
                <div>
                    <table class="payment-table" border="1" >
                        <tr>
                            <th width="100px">&nbsp;Payment ID</th>
                            <th width="100px">&nbsp;Quote ID</th>
                            <th width="250px">&nbsp;Description</th>
                            <th width="170px">&nbsp;Total</th>
                            <th width="130px">&nbsp;Date</th>
                            <th width="140px">&nbsp;Status</th>
                            <th style="text-align: center;" width="120px">&nbsp;Actions</th>
                        </tr>
                        <?php
                            $payment_data = $customerObj->getPaymentDetails($customer_id);
                            if($payment_data->num_rows > 0) {
                                while($payment = $payment_data->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td>&nbsp;<?php echo $payment["payment_id"]; ?></td>
                                        <td>&nbsp;<?php echo $payment["quotation_id"]; ?></td>
                                        <td>&nbsp;<?php echo $payment["payment_description"]; ?></td>
                                        <td>&nbsp;<?php echo $payment["amount"]; ?></td>
                                        <td>&nbsp;<?php echo $payment["requested_date"]; ?></td>
                                    <?php

                                    $quote_data = $customerObj->getQuoteForPaymentId($payment["payment_id"]);
                                    $quotation = $quote_data->fetch_assoc();

                                    if($payment["status"] == 1) {
                                        ?>
                                            <td>&nbsp; Unpaid</td>
                                            <td>
                                                <div class="btn-group d-flex">
                                                    <button type="button" id='view-quote-btn' href='#view-quote' data-toggle='modal' data-subject='<?php echo $quotation["subject"];?>' data-requirements='<?php echo $quotation["requirements"];?>' data-remarks='<?php echo $quotation["remarks"];?>' data-status='<?php echo $quotation["status"];?>' class="btn btn-info btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="far fa-eye" style="font-size: 18px" ></i></button>
                                                    <button type="button" id='payment-btn1' href='#payment1' data-toggle='modal' data-id='<?php echo $payment["payment_id"];?>' data-name='<?php echo $payment["name"];?>' data-date='<?php echo $payment["requested_date"];?>' data-description='<?php echo $payment["payment_description"];?>' data-total='<?php echo $payment["amount"];?>' class="btn btn-warning btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="fas fa-dollar-sign" style="font-size: 18px; color: white" ></i></button>
                                                </div>
                                            </td>
                                        <?php
                                    }
                                    else {
                                        ?>
                                            <td>&nbsp; Paid</td>
                                            <td>
                                                <div class="btn-group d-flex">
                                                    <button type="button" id='view-quote-btn' href='#view-quote' data-toggle='modal' data-subject='<?php echo $quotation["subject"];?>' data-requirements='<?php echo $quotation["requirements"];?>' data-remarks='<?php echo $quotation["remarks"];?>' data-status='<?php echo $quotation["status"];?>' class="btn btn-info btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="far fa-eye" style="font-size: 18px" ></i></button>
                                                    <button type="button" id='payment-btn2' href='#payment2' data-toggle='modal' data-name='<?php echo $payment["name"];?>' data-date='<?php echo $payment["paid_date"];?>' data-description='<?php echo $payment["payment_description"];?>' data-total='<?php echo $payment["amount"];?>' class="btn btn-success btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="fas fa-dollar-sign" style="font-size: 18px; color: white" ></i></button>
                                                </div>
                                            </td>
                                        <?php
                                    }
                                }
                            }
                        ?>
                    </table>
                </div>
               
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
        
        <!-- payment modal1 (make payment) -->
        <div class="modal fade" id="payment1" role="dialog">
            <div class="modal-dialog">
                <form action="../../controller/customercontroller.php?status=settle_payment" method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">     
                            <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Payment Settle</h4>
                        </div>
                        <div class="modal-body">

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
                                    <img src="../../images/icons/unpaid.png" style=" height: 60px; width: 120px; margin: 10px 20px 10px 20px;">
                                </div>
                                <div class="form-group" style="margin-left: 25px; width: 40%">
                                    <label for="total">Total :</label>
                                    <input type="text" class="form-control" id="total"  name="total" readonly>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="payment_id" id="payment_id">
                                <button type="submit" name="submit" class="btn btn-success" style="width: 200px; text-align: center; margin-right: 135px">
                                Settle Payment</button>
                            </div>
                        </div>    
                    </div>
                </form>
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
                        
                        <div class="row">
                            <div class="form-group" style="margin-left: 35px; width: 40%">
                                <label for="date2">Paid Date :</label>
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
                                <img src="../../images/icons/paid.png" style=" height: 60px; width: 120px; margin: 10px 20px 10px 20px;">
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
        
    </body>

     <script language="javascript">

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

        $(document).on("click", "#payment-btn1", function () {
            var id= $(this).data('id');
            var customer1= $(this).data('name');
            var date1= $(this).data('date');
            var description1= $(this).data('description');
            var total= $(this).data('total');
            
            $("#payment_id").val(id);
            $("#customer1").val(customer1);
            $("#date1").val(date1);
            $("#description1").val(description1);
            $("#total").val(total);
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
        // <!-- end of send data to modal scripts -->


    </script>

</html>
