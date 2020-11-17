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
                                        <button class="btn btn-success" type="submit" style="margin-top: 5px; padding: 10px" onclick="load_tools('4')"><span class="fa fa-lg fa-search" ></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="col-md-4" style="text-align: center">
                             <h4>TOOLS</h4>
                        </div>
                       <div class="col-md-4">
                           <div class="btn-group" id="btngroup" style="padding-top: 6px">
                                <button type="button" class="btn btn-danger btn-sm" onclick="load_tools('1')" style="width: 90px; padding: 6px; font-size: 13px">All Tools</button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="load_tools('2')" style="width: 90px; padding: 6px; font-size: 13px">Requested</button>
                                <button type="button" class="btn btn-info btn-sm" onclick="load_tools('3')" style="width: 90px; padding: 6px; font-size: 13px">My Tools</button>
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

        <!-- tool request modal -->
        <div class="modal fade" id="tool-request" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Request Tool</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row d-flex justify-content-center">
                            <p> Are you sure?, You want to request the tool ?</p>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <form action="../../controller/freelancercontroller.php?status=request_tool" method="POST">
                            <input type="hidden" id="tool_id"  name="tool_id">
                            <button name="submit" type="submit" class="btn btn-danger">Request</button>
                        </form>
                    </div>    
                </div>            
            </div>
        </div>

    </body>
    
    <script type="text/javascript">

        $(document).ready(function() {
            load_tools('1');
        });

        function load_tools(type) {
            var cat_name = $('#category').val();
            console.log(type);
        
            if (type == 4) {

            }

            $('#loading_div').html('<p><img src="../../images/loading.gif"  /></p>');
            $('#loading_div').load("./loadings/tools-table.php", {
                'type': type,
                'cat_name': cat_name
            });  
        }

        $(document).on("click", "#tool-request-btn", function () {
            var tool_id= $(this).data('tool_id');
            $("#tool_id").val(tool_id);
        });
    
    </script>

</html>
