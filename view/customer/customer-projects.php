<?php
    include '../../commons/session.php';
?>
<html>
    <head>
                
        <title>Customer Quotations</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../css/style-cutomer-projects.css"/>
        <?php include '../../includes/other_dashboard_includes_css.php';?>
        <?php include '../../includes/other_dashboard_includes_script.php'; ?>
        
        

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
            
            <div class="project-details">
               <div class="top-buttons">
                   <div class="row" >
                       <div class="col-md-12" style="text-align: center">
                           <h4>PROJECTS/ORDERS</h4>
                       </div>
                     </div>
               </div>
               
                <div>
                    <table class="project-table" border="1" >
                        <tr>
                            <th width="100px">&nbsp;Quote ID</th>
                            <th width="100px">&nbsp;Project ID</th>
                            <th width="200px">&nbsp;Name</th>
                            <th width="130px">&nbsp;Order Value</th>
                            <th width="180px">&nbsp;Expected Delivery</th>
                            <th width="180px">&nbsp;Project Manager</th>
                            <th style="width:100px; text-align: center">Progress</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: center">50%</td>
                        </tr>
                    </table>
                    
                </div>
               
            </div>
            
        </div>
        
    </body>

</html>
