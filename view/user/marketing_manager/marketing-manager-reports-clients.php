<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
                
        <title>Quotation Management</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-report-management.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>

        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.svg.js"></script>
       
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

            $customers = $userObj->getAllCustomers();
            
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
                           <select id="customer_id" class="form-control admin-name">
                                <option value="">Select Customer</option>
                                <?php
                                    while($customer = $customers->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $customer["customer_id"]; ?>"><?php echo $customer["customer_fname"].' '.$customer["customer_lname"]; ?></option>
                                    <?php
                                    }
                                ?>
                           </select>
                        </div>
                        <div class="col-md-4">
                            <button name="report-generate-2" class="btn btn-success" id="report-generate-2" onclick="generate_report()">Generate Report</button>
                        </div>
                   </div>
               </div> 
               <div>
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div align="left" id="chart_div" class="scroll mt-3" style="margin-left:20%;margin-right:20%;overflow-y:scroll;"> </div>
            </div>
        </div>
   
    </body>

    <script language="javascript">

        function generate_report() {

            if($('#customer_id').val() != '') {
                var customer_name = $('#customer_id :selected').text();
                var customer_id = $('#customer_id').val();

                $('#chart_div').html('<p><img src="../../../images/loading.gif"  /></p>');
                $('#chart_div').load("./loadings/report-customer-analysis.php", {
                    'customer_name': customer_name,
                    'customer_id': customer_id
                });
            }
            else {
                swal("Someting went wrong!", "Please Select a customer!", "error");
            }
              
        }

    </script>
</html>
