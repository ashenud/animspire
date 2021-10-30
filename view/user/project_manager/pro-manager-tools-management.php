<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
        <title>Project Manager Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-tools-management.css"/>
        <?php include '../../../includes/dashboard_includes_css.php';?>
        <?php include '../../../includes/dashboard_includes_script.php'; ?>
        
        <style>
            .modal-dialog{
                display: inline-block;
                vertical-align: middle;
            }
            .modal-dialog .modal-content{
                width: 800px;
                margin:30px 200px auto 245px;
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
            $proManagerObj = new projectManager(); //must need for navbar

            /* permission check */
            if(!isset($_SESSION["user"]["role_id"])) {
                $userObj->checkUser('0');
            }
            elseif(($_SESSION["user"]["role_id"]) != 2){
                $userObj->checkUser($_SESSION["user"]["role_id"]);
            }
            /* end permission check */
            
            $user_id = $_SESSION["user"]["user_id"];
            $userId = base64_encode($user_id);
        
        ?>
        
        
    </head>
    
    <body  style="background-image: url('../../../images/background-image.png');">
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
                                        <button class="btn btn-success" type="submit" style="margin-top: 5px; padding: 10px" onclick="load_tools('0')"><span class="fa fa-lg fa-search" ></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="col-md-4" style="text-align: center">
                             <h4>TOOLS</h4>
                        </div>
                       <div class="col-md-4">
                           <div class="btn-group" id="btngroup" style="margin:5px 10px auto 90px">
                                <a href="pro-manager-tools-requested.php"><button type="button" class="btn btn-warning btn-sm" style="width: 90px; padding: 6px;font-size: 13px">Requests</button></a>
                                <button type="button" class="btn btn-success btn-sm" href='#addTool' data-toggle='modal' data-id='#' data-customer='#' data-name='#' style="width: 90px; padding: 6px; margin-right: 10px;font-size: 13px">Add Tools</button>
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
        
        <!-- Add tool Modal -->
        <div class="modal fade" id="addTool" role="dialog">
            <div class="modal-dialog">
                <form enctype="multipart/form-data" method="POST" action="../../../controller/proManagerController.php?status=add_tool"> 
                    <div class="modal-content">
                        <div class="modal-header">     
                            <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Add New Tool</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group" style="margin-left: 35px; width: 44%">
                                  <label for="tool_name">Tool Name :</label>
                                  <input type="text" name="tool_name" class="form-control" id="tool_name"/>
                                </div>
                                <div class="form-group" style="margin-left: 25px; width: 44%">
                                  <label for="website">Website :</label>
                                  <input type="text" class="form-control" id="website"  name="website"/>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group" style="margin-left: 35px; width: 44%">
                                  <label for="category_id">Category :</label>
                                  <select id="category_id" name="category_id" class="form-control priority-level" required>
                                    <option value="1">Graphic Design</option>
                                    <option value="2">Video & Animation</option>
                                    <option value="3">Search Engine Optimization</option>
                                    <option value="4">Social Media Marketing</option>
                                    <option value="5">Email Marketing</option>
                                    <option value="6">Photography Services</option>
                                  </select>
                                </div>
                                <div class="form-group" style="margin-left: 25px; width: 36.5%">
                                    <label for="image">Tool Image :</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image"
                                            style="margin-top:3px" onchange="readURL(this)">

                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-left: 10px; width: 6%">
                                    <img id="prev_img" src="../../../images/icons/tool_images/defaultImage.png"
                                        style="width: 50px; height: 50px; margin-top: 20px " />
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-success" style="width: 200px; text-align: center; margin:15px 280px 5px auto">
                                Add Tool</button>
                            </div>
                        </div>    
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Edit tool Modal -->
        <div class="modal fade" id="tool-edit" role="dialog">
            <div class="modal-dialog">
                <form enctype="multipart/form-data" method="POST" action="../../../controller/proManagerController.php?status=edit_tool"> 
                    <div class="modal-content">
                        <div class="modal-header">     
                            <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Edit Tool</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group" style="margin-left: 35px; width: 44%">
                                  <label for="tool_name1">Tool Name :</label>
                                  <input type="text" name="tool_name" class="form-control" id="tool_name1"/>
                                  <input type="hidden" name="tool_id" class="form-control" id="tool_id1"/>
                                </div>
                                <div class="form-group" style="margin-left: 25px; width: 44%">
                                  <label for="website1">Website :</label>
                                  <input type="text" class="form-control" id="website1"  name="website"/>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group" style="margin-left: 35px; width: 44%">
                                  <label for="category_id1">Category :</label>
                                  <select id="category_id1" name="category_id" class="form-control priority-level" required>
                                    <option value="1">Graphic Design</option>
                                    <option value="2">Video & Animation</option>
                                    <option value="3">Search Engine Optimization</option>
                                    <option value="4">Social Media Marketing</option>
                                    <option value="5">Email Marketing</option>
                                    <option value="6">Photography Services</option>
                                  </select>
                                </div>
                                <div class="form-group" style="margin-left: 25px; width: 36.5%">
                                    <label for="image">Tool Image :</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="tool_image" class="form-control" id="tool_image1"/>
                                        <input type="file" class="custom-file-input" id="image1" name="image"
                                            style="margin-top:3px" onchange="readURL1(this)">

                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-left: 10px; width: 6%">
                                    <img id="prev_img1" src="../../../images/icons/tool_images/defaultImage.png"
                                        style="width: 50px; height: 50px; margin-top: 20px " />
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-success" style="width: 200px; text-align: center; margin:15px 280px 5px auto">
                                Edit Tool</button>
                            </div>
                        </div>    
                    </div>
                </form>
            </div>
        </div>

        <!-- mark as delete modal -->
        <div class="modal fade" id="tool-delete" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Inactivate Tool</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row d-flex justify-content-center">
                            <p> Are you sure?, You want to inactivate the tool ?</p>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <form action="../../../controller/proManagerController.php?status=delete_tool" method="POST">
                            <input type="hidden" id="tool_id2"  name="tool_id">
                            <button name="submit" type="submit" class="btn btn-danger">Inactivate</button>
                        </form>
                    </div>    
                </div>            
            </div>
        </div>

        <!-- mark as activate modal -->
        <div class="modal fade" id="tool-activate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Activate tool</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row d-flex justify-content-center">
                            <p> Are you sure?, You want to activate the tool ?</p>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <form action="../../../controller/proManagerController.php?status=activate_tool" method="POST">
                            <input type="hidden" id="tool_id3"  name="tool_id">
                            <button name="submit" type="submit" class="btn btn-danger">Activate</button>
                        </form>
                    </div>    
                </div>            
            </div>
        </div>
        
        
    </body>
    
    <script type="text/javascript">

        function readURL(input) {
            if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#prev_img')
                .attr('src', e.target.result)
                .height(50)
                .width(50);
            };

            reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL1(input) {
            if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#prev_img1')
                .attr('src', e.target.result)
                .height(50)
                .width(50);
            };

            reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {
            load_tools('0');
        });

        function load_tools(page) {
            var cat_name = $('#category').val();
            console.log(cat_name);

            $('#loading_div').html('<p><img src="../../../images/loading.gif"  /></p>');
            $('#loading_div').load("./loadings/tools-table.php", {
                'cat_name': cat_name,
                'page': page
            });  
        }

        $(document).on("click", "#tool-edit-btn", function () {
            var tool_id= $(this).data('tool_id');
            var tool_name= $(this).data('tool_name');
            var category_id= $(this).data('category_id');
            var website= $(this).data('website');
            var image= $(this).data('image');
            
            $("#tool_id1").val(tool_id);
            $("#tool_name1").val(tool_name);
            $("#category_id1").val(category_id).trigger('change');
            $("#prev_img1").attr('src','../../../images/icons/tool_images/'+image);
            $("#website1").val(website);
            $("#tool_image1").val(image);
        });

        $(document).on("click", "#tool-delete-btn", function () {
            var tool_id= $(this).data('tool_id');
            $("#tool_id2").val(tool_id);
        });

        $(document).on("click", "#tool-activate-btn", function () {
            var tool_id= $(this).data('tool_id');
            $("#tool_id3").val(tool_id);
        });

    </script>

    
</html>
