<?php
    include '../../commons/session.php';
?>
<html>
    <head>
                
        <title>Customer Quotations</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../css/style-quote-details.css"/>
        <?php include '../../includes/other_dashboard_includes_css.php';?>
        <?php include '../../includes/other_dashboard_includes_script.php'; ?>
        
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
         
            // include '../../../model/customer_model.php';
            // $customerObj = new Customer();

            $customer_id = $_SESSION["customer"]["customer_id"];
            $customerId = base64_encode($customer_id); 
        
        ?>
      
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">
        <div class="cont">
            <?php
                  include './includes/dashboard-navbar.php';
            ?>
            
            <div class="quote-details">
               <div class="top-buttons">
                   <div class="row">
                        <div class="col-md-3">
                             <a href="#"><button name="req-quote" class="btn btn-primary btn-sm" id="req-quote" data-toggle="modal" data-target="#requestQuoteModal" style="width: 130px; padding: 6px; font-size: 13px">
                                     Request Quote</button></a>
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
        
        <!--- Request Quote modal -->
                    
        <div class="modal fade" id="requestQuoteModal" role="dialog">
            <div class="modal-dialog">
                <form action="../../controller/customercontroller.php?status=request_quote" method="post" name="req-quote" id="req-quote"> 
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Request Quote</h4>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row">
                                <!-- Alert message -->
                                 <div id="alertDiv" style="margin-left: 35px; width: 420px; height: 45px">
                                       
                                    </div>
                               
                            </div>
                            
                            <div class="row">
                                <div class="form-group" style="margin-top: 2px; margin-left: 35px; width: 85%">
                                    <label for="subject">Subject :</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject" required="required"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="margin-top: 8px; margin-left: 35px; width: 85%">
                                    <label for="requirements">What are your requirements?</label>
                                    <textarea class="form-control" rows="6" cols="30" id="requirements" name="requirements" placeholder="Enter your requirements" required="required">
                                        
                                    </textarea>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                            <button type="submit" name="submit" class="btn btn-success" style="width: 200px; text-align: center; margin-right: 135px">
                            Request Quote</button>
                        </div>    
                    </div>
                </form>
            
            </div>
        </div>
        
    </body>

    <script language="javascript">

        $(document).ready(function() {
            // load_quotations('0','1');
        });

        function load_quotations(page,type) {
            var status = type;
            // console.log(status);

            $('#loading_div').html('<p><img src="../../images/loading.gif"  /></p>');
            $('#loading_div').load("./loadings/quotations.php", {
                'status': status,
                'page': page
            });  
        }
    </script>
    
</html>
