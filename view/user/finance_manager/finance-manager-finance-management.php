<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        <title>Finance Manager Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-finance-management.css"/>
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
            <div class="finance-details">
                <div class="top-buttons">
                   <div class="row">
                     <div class="col-md-8" style="padding: 12px 50px 1px 350px;">
                             <h4>FINANCE DETAILS</h4>
                     </div>
                     <div class="col-md-4" style="padding: 12px 20px 1px 100px;">
                        <button type="button" class="btn btn-success btn-sm" onclick="load_payments('0','2')" style="width: 80px; padding: 6px; font-size: 13px">Paid</button>
                        <button type="button" class="btn btn-warning btn-sm" onclick="load_payments('0','1')" style="width: 80px; padding: 6px; font-size: 13px">Pending</button>
                     </div>
                   </div>
                 </div>
                <div>
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div align="center" id="loading_div" class="scroll mt-3" style="overflow-y:scroll;"> </div>           
              
            </div>
            
        </div>

        <!-- payment modal1 (payment not settled) -->
        <div class="modal fade" id="payment1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Payment Not Settled</h4>
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
                                <img src="../../../images/icons/unpaid.png" style=" height: 60px; width: 120px; margin: 10px 20px 10px 20px;">
                            </div>
                            <div class="form-group" style="margin-left: 25px; width: 40%">
                                <label for="total">Total :</label>
                                <input type="text" class="form-control" id="total"  name="total" readonly>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>

        <!-- payment modal2 (payment not settled) -->
        <div class="modal fade" id="payment2" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Payment Settled</h4>
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
                                <img src="../../../images/icons/paid.png" style=" height: 60px; width: 120px; margin: 10px 20px 10px 20px;">
                            </div>
                            <div class="form-group" style="margin-left: 25px; width: 40%">
                                <label for="total2">Total :</label>
                                <input type="text" class="form-control" id="total2"  name="total2" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="print-btn" class="btn btn-info"><i class="fas fa-print"></i>Print Reciept</button>
                    </div>    
                </div>
            </div>
        </div>
        
    </body>

    <script language="javascript">

        $(document).ready(function() {
            load_payments('0','');
        });

        function load_payments(page,type) {

            $('#loading_div').html('<p><img src="../../../images/loading.gif"  /></p>');
            $('#loading_div').load("./loadings/load-payments.php", {
                'page': page,
                'status': type
            });  
        }

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
            var id= $(this).data('id');
            var subject= $(this).data('subject');
            var method= $(this).data('method');
            var address= $(this).data('address');
            
            $("#customer2").val(customer2);
            $("#date2").val(date2);
            $("#description2").val(description2);
            $("#total2").val(total2);
            $('#print-btn').attr('data-date', date2);
            $('#print-btn').attr('data-id', id);
            $('#print-btn').attr('data-name', customer2);
            $('#print-btn').attr('data-address', address);
            $('#print-btn').attr('data-method', method);
            $('#print-btn').attr('data-subject', subject);
            $('#print-btn').attr('data-total', total2);
        });

        // print receipt
        $(document).on("click", "#print-btn", function () {

            var date= $(this).data('date');
            var id= $(this).data('id');
            var name= $(this).data('name');
            var address= $(this).data('address');
            var method= $(this).data('method');
            var subject= $(this).data('subject');
            var total= $(this).data('total');

            var filters =  '<div class="receipt" style="width: 350px; padding: 20px; border: 4px solid black;">'+
                                '<div class="header">'+
                                    '<div class="h-text">'+
                                        '<h1>Receipt</h1>'+
                                    '</div>'+
                                    '<br>'+
                                    '<div class="h-details" style="text-align: right; margin-top: -70px;">'+
                                        '<p style="margin: 0 0 5px 0;">Payment Date : '+date+'</p>'+
                                        '<p style="margin: 0 0 5px 0;">Payment ID : '+id+'</p>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="address" style="margin: 50px 0 35px 0;">'+
                                    '<p style="margin: 0 0 5px 0;">'+name+'</p>'+
                                    '<p style="margin: 0 0 5px 0;">'+address+'</p>'+
                                '</div>'+
                                '<table style="width: 350px;">'+
                                    '<tr style="background: #5eb7f5; height: 30px;">'+
                                        '<th style="text-align: left; padding-left: 10px;">Payment Method</th>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td style="text-align: left; padding-left: 10px;">'+method+'</td>'+
                                    '</tr>'+
                                '</table>'+
                                '<table style="width: 350px; margin: 30px 0 26px 0;">'+
                                    '<tr style="background: #5eb7f5; height: 30px;">'+
                                        '<th style="text-align: left; padding-left: 10px;">Product</th>'+
                                        '<th style="text-align: right; padding-right: 10px;">Price</th>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td style="text-align: left; padding-left: 10px;">'+subject+'</td>'+
                                        '<td style="text-align: right; padding-right: 10px;">Rs '+total+'</td>'+
                                    '</tr>'+
                                '</table>'+
                            '</div>'

            var pdf_name = "payment receipt.pdf";

            var layout = "A4";


            var mapForm = document.createElement("form");
            mapForm.target = "Map";
            mapForm.method = "POST"; 
            mapForm.action = "./loadings/reciept_template.php";

            /* var mapInput = document.createElement("input");
            mapInput.type = "hidden";
            mapInput.name = "x";
            mapInput.value = print_area;
            mapForm.appendChild(mapInput); */

            var mapInput2 = document.createElement("input");
            mapInput2.type = "hidden";
            mapInput2.name = "y";
            mapInput2.value = filters;
            mapForm.appendChild(mapInput2);

            var mapInput3 = document.createElement("input");
            mapInput3.type = "hidden";
            mapInput3.name = "z";
            mapInput3.value = pdf_name;
            mapForm.appendChild(mapInput3);

            var mapInput4 = document.createElement("input");
            mapInput4.type = "hidden";
            mapInput4.name = "layout";
            mapInput4.value = layout;
            mapForm.appendChild(mapInput4);

            document.body.appendChild(mapForm);

            map = window.open("", "Map", "status=0,title=0,height=1600,width=1800,scrollbars=1");

            if (map) {
                mapForm.submit();
            } else {
                alert('Please Retry.');
            }

        });

    </script>

</html>
