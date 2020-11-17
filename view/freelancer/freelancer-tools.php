<?php
    include '../../commons/session.php';
?>
<html>
    <head>
        <title>Freelancer Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../css/style-tools-management.css"/>
        <?php include '../../includes/other_dashboard_includes_css.php';?>
        <?php include '../../includes/other_dashboard_includes_script.php'; ?>

        <?php
        
            include '../../model/freelancer_model.php';
            $freelancerObj = new Freelancer(); /// create feelancer object

            $freelancer_id = $_SESSION["freelancer"]["freelancer_id"];
            $freelancerId = base64_encode($freelancer_id); 
            
        ?>
        
        
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">

        <div class="cont">
            <?php
                include './includes/dashboard-navbar.php';
            ?>
           
            <div class="tools-details">
               <div class="top-buttons">
                   <div class="row">
                        <div class="col-md-4">
                            <div class="search" style="margin: 4px 4px 4px 15px">
                                <div class="input-group mb-3">
                                    <input type="text" id="category" name="category" class="form-control" placeholder="Search by category" style="margin-top: 5px; width: 140px">
                                    <div class="input-group-append" >
                                        <button class="btn btn-success" type="submit" style="margin-top: 5px; padding: 10px" onclick="#"><span class="fa fa-lg fa-search" ></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="col-md-4" style="text-align: center">
                             <h4>TOOLS</h4>
                        </div>
                       <div class="col-md-4">
                           <div class="btn-group" id="btngroup" style="padding-top: 6px">
                                <button type="button" class="btn btn-danger btn-sm" onclick="#" style="width: 90px; padding: 6px; font-size: 13px">All Tools</button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="#" style="width: 90px; padding: 6px; font-size: 13px">Requested</button>
                                <button type="button" class="btn btn-info btn-sm" onclick="#" style="width: 90px; padding: 6px; font-size: 13px">My Tools</button>
                            </div>
                        </div>
                   </div>
               </div>
               <table class="tools-table" border="1" >
                        <tr>
                            <th width="40px"></th>
                            <th width="250px">&nbsp;Tool Name</th>
                            <th width="220px">&nbsp;Website</th>
                            <th width="250px">&nbsp;Category</th>
                            <th width="100px">&nbsp;Status</th>
                            <th width="90px"></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a
                                href=""><button
                                type="button" class="btn btn-info" style="width: 90px; height: 30px;">
                                        <span class="fas fa-dollar-sign"></span>&nbsp;Request</button></a>
                            </td>
                        </tr>
                    </table>
            </div>
            

        </div>        
        
    </body>
    
    
</html>
