<?php
    include '../../../commons/session.php';
?>
<html>
    <head>
                
        <title>Project Management</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type="text/css" href="../../../css/style-marketingMangr-project-details.css"/>
        <style>
            .modal-dialog{
                display: inline-block;
                vertical-align: middle;
            }
            .modal-dialog .modal-content{
                width: 800px;
                margin:30px 220px auto 260px;
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
            
            <div class="approved-quote-details">
               <div class="top-buttons">
                   <div class="row" >
                       <div class="col-md-12" style="text-align: center">
                           <h4>APPROVED & PAID QUOTES</h4>
                       </div>
                     </div>
               </div>
               
                <div>
                    <table class="approved-quote-table" border="1" >
                        <tr>
                            <th width="80px">&nbsp;Quote ID</th>
                            <th width="150px">&nbsp;Customer</th>
                            <th width="200px">&nbsp;Subject</th>
                            <th width="250px">&nbsp;Requirements</th>
                            <th width="200px">&nbsp;Remarks</th>
                            <th width="180px"></th>
                        </tr>
                        <?php
                            $paid_quote = $marketingManagerObj->getPaidQuote();
                            while ($quotation = $paid_quote->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td>&nbsp;<?php echo $quotation['quotation_id']?></td>
                                    <td>&nbsp;<?php echo $quotation['name']?></td>
                                    <td>&nbsp;<?php echo $quotation['subject']?></td>
                                    <td>&nbsp;<?php echo $quotation['subject']?></td>
                                    <td>&nbsp;<?php echo $quotation['remarks']?></td>
                                    <td>
                                        <div class="btn-group d-flex">
                                            <button type="button" id='view-quote-btn' href='#view-quote' data-toggle='modal' data-subject='<?php echo $quotation["subject"];?>' data-requirements='<?php echo $quotation["requirements"];?>' data-remarks='<?php echo $quotation["remarks"];?>' data-status='<?php echo $quotation["status"];?>' class="btn btn-info btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fas fa-external-link-alt" style="font-size: 10px" ></i>&nbsp;View</button>
                                            <button type="button" id='project-add-btn' href='#project-add' data-toggle='modal' data-subject='<?php echo $quotation["subject"];?>' data-id='<?php echo $quotation["quotation_id"];?>' data-payment_id='<?php echo $quotation["payment_id"];?>' data-image='<?php echo $quotation["customer_image"];?>' data-name='<?php echo $quotation["name"];?>' data-customer_id='<?php echo $quotation["customer_id"];?>' class="btn btn-success btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fas fa-plus" style="font-size: 10px; color: white" ></i>&nbsp;Add Project</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        ?> 
                    </table>
                </div>
            </div>
            <div class="project-details">
               <div class="top-buttons">
                   <div class="row" >
                       <div class="col-md-12" style="text-align: center">
                           <h4>CURRENT PROJECTS</h4>
                       </div>
                     </div>
               </div>
               
                <div>
                    <table class="project-table" border="1" >
                        <tr>
                            <th width="50px">&nbsp;Pro.ID</th>
                            <th width="150px">&nbsp;Project Name</th>
                            <th width="200px">&nbsp;Project Description</th>
                            <th width="180px">&nbsp;Project Manager</th>
                            <th width="110px">&nbsp;Start Date</th>
                            <th width="110px">&nbsp;End Date</th>
                            <th width="160px"></th>
                        </tr>
                        <?php
                            $assigned_projects = $marketingManagerObj->getAssignedProjects();
                            while ($project = $assigned_projects->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td>&nbsp;<?php echo $project['project_id']?></td>
                                    <td>&nbsp;<?php echo $project['project_name']?></td>
                                    <td>&nbsp;<?php echo $project['description']?></td>
                                    <td>&nbsp;<?php echo $project['pro_name']?></td>
                                    <td>&nbsp;<?php echo $project['start_date']?></td>
                                    <td>&nbsp;<?php echo $project['end_date']?></td>
                                    <td>
                                        <div class="btn-group d-flex">
                                            <button type="button" id='project-view-btn' href='#project-view' data-toggle='modal' data-project_name='<?php echo $project["project_name"];?>' data-project_id='<?php echo $project["project_id"];?>' data-cus_name='<?php echo $project["cus_name"];?>' data-customer_image='<?php echo $project["customer_image"];?>' data-pro_name='<?php echo $project["pro_name"];?>' data-description='<?php echo $project["description"];?>' data-start_date='<?php echo $project["start_date"];?>' data-end_date='<?php echo $project["end_date"];?>' class="btn btn-info btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fas fa-external-link-alt" style="font-size: 10px" ></i>&nbsp;View</button>
                                            <button type="button" id='project-edit-btn' href='#project-edit' data-toggle='modal' data-project_name='<?php echo $project["project_name"];?>' data-project_id='<?php echo $project["project_id"];?>' data-cus_name='<?php echo $project["cus_name"];?>' data-customer_image='<?php echo $project["customer_image"];?>' data-pro_name='<?php echo $project["pro_name"];?>' data-project_manager_id='<?php echo $project["project_manager_id"];?>' data-description='<?php echo $project["description"];?>' data-start_date='<?php echo $project["start_date"];?>' data-end_date='<?php echo $project["end_date"];?>' class="btn btn-warning btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fas fa-plus" style="font-size: 10px; color: white" ></i>&nbsp;Edit</button>
                                            <button type="button" id='project-edit-btn' href='#project-edit' data-toggle='modal' data-project_id='<?php echo $project["project_id"];?>' class="btn btn-danger btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fa fa-fw fa-power-off" style="font-size: 10px; color: white" ></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <?php
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

        <!-- add project modal -->
        <div class="modal fade" id="project-add" role="dialog">
            <div class="modal-dialog">
                <form action="../../../controller/marketingManagerController.php?status=assign_project" method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">     
                            <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Project Assign</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2" style="margin-left: 50px; width: 30%">
                                  <label for="quotation_id">Quotation ID :</label>
                                  <input type="text" class="form-control" id="quotation_id"  name="quotation_id" readonly>
                                  <input type="hidden" name="payment_id" id="payment_id">
                                </div>
                                <div class="col-md-4" style="margin-left: 25px; width: 30%">
                                  <label for="customer">Customer :</label>
                                  <input type="text" class="form-control" id="customer"  name="customer" disabled>
                                  <input type="hidden" id="customer_id"  name="customer_id">
                                </div>
                                <div class="col-md-2" style="margin-left:0px; width: 30%">
                                  <img id="customer_img"
                                    style="width: 50px; height: 50px; margin-top: 20px " />
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            
                            <div class="row" style="padding-top: 15px">
                                <div class="col-md-6" style="margin-left: 50px; width: 45%">
                                  <label for="project_name">Project Name :</label>
                                  <input type="text" class="form-control" id="project_name"  name="project_name" readonly>
                                </div>
                                <div class="col-md-4" style="margin-left: 10px; width: 250px;">
                                    <label for="project_manager">Project Manager :</label>
                                    <!-- <input type="text" class="form-control" id="project_manager"  name="project_manager"> -->
                                    <select class="form-control" name="project_manager" id="project_manager" required>
                                        <option value="">Select a Project Manager</option>
                                        <?php 
                                            $pro_role = "AND ur.role_id = 2";
                                            $pro_managers = $userObj->getUsersForRole($pro_role);
                                            while ($pro_manager=$pro_managers->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $pro_manager['id']; ?>"> <?php echo $pro_manager['name']; ?> </option>
                                                <?php
                                            }   
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group" style="margin-top: 8px; margin-left:65px; width: 85%">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" cols="30" id="description" name="description" required></textarea>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-4" style="margin-left: 55px; width: 30%">
                                  
                                </div>
                                <div class="col-md-3" style="margin-left: 20px; width: 30%">
                                  <label for="start_date">Start Date :</label>
                                  <input type="date" name="start_date" min="<?php echo date('Y-m-d');?>" class="form-control" id="start_date" required/>
                                </div>
                                <div class="col-md-3" style="margin-left: 20px; width: 30%">
                                  <label for="end_date">End Date :</label>
                                  <input type="date" name="end_date" min="<?php echo date('Y-m-d');?>" class="form-control" id="end_date" required/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-success" 
                                    style="width: 200px; text-align: center; margin-right: 40px">
                            Assign Project</button>
                        </div>    
                    </div>
                </form>
            
            </div>
        </div>

        <!-- edit project modal -->
        <div class="modal fade" id="project-edit" role="dialog">
            <div class="modal-dialog">
                <form action="../../../controller/marketingManagerController.php?status=edit_project" method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">     
                            <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Project Edit</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2" style="margin-left: 50px; width: 30%">
                                  <label for="project_id2">Quotation ID :</label>
                                  <input type="text" class="form-control" id="project_id2"  name="project_id" readonly>
                                  <input type="hidden" name="payment_id" id="payment_id2">
                                </div>
                                <div class="col-md-4" style="margin-left: 25px; width: 30%">
                                  <label for="customer2">Customer :</label>
                                  <input type="text" class="form-control" id="customer2"  name="customer" disabled>
                                </div>
                                <div class="col-md-2" style="margin-left:0px; width: 30%">
                                  <img id="customer_img2"
                                    style="width: 50px; height: 50px; margin-top: 20px " />
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            
                            <div class="row" style="padding-top: 15px">
                                <div class="col-md-6" style="margin-left: 50px; width: 45%">
                                  <label for="project_name2">Project Name :</label>
                                  <input type="text" class="form-control" id="project_name2"  name="project_name" disabled>
                                </div>
                                <div class="col-md-4" style="margin-left: 10px; width: 250px;">
                                    <label for="project_manager2">Project Manager :</label>
                                    <select class="form-control" name="project_manager" id="project_manager2" required>
                                        <option value="">Select a Project Manager</option>
                                        <?php 
                                            $pro_role = "AND ur.role_id = 2";
                                            $pro_managers = $userObj->getUsersForRole($pro_role);
                                            while ($pro_manager=$pro_managers->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $pro_manager['id']; ?>"> <?php echo $pro_manager['name']; ?> </option>
                                                <?php
                                            }   
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group" style="margin-top: 8px; margin-left:65px; width: 85%">
                                    <label for="description2">Description</label>
                                    <textarea class="form-control" rows="3" cols="30" id="description2" name="description" required></textarea>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-4" style="margin-left: 55px; width: 30%">
                                  
                                </div>
                                <div class="col-md-3" style="margin-left: 20px; width: 30%">
                                  <label for="start_date2">Start Date :</label>
                                  <input type="date" name="start_date" class="form-control" id="start_date2" required/>
                                </div>
                                <div class="col-md-3" style="margin-left: 20px; width: 30%">
                                  <label for="end_date2">End Date :</label>
                                  <input type="date" name="end_date" class="form-control" id="end_date2" required/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-success" 
                                    style="width: 200px; text-align: center; margin-right: 40px">
                            Edit Project</button>
                        </div>    
                    </div>
                </form>
            
            </div>
        </div>

        <!-- view project modal -->
        <div class="modal fade" id="project-view" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">     
                        <h4 class="col-12 modal-title text-center" style="padding-top: 10px">Project View</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2" style="margin-left: 50px; width: 30%">
                                <label for="project_id3">Quotation ID :</label>
                                <input type="text" class="form-control" id="project_id3"  name="project_id" disabled>
                            </div>
                            <div class="col-md-4" style="margin-left: 25px; width: 30%">
                                <label for="customer3">Customer :</label>
                                <input type="text" class="form-control" id="customer3"  name="customer" disabled>
                            </div>
                            <div class="col-md-2" style="margin-left:0px; width: 30%">
                                <img id="customer_img3"
                                style="width: 50px; height: 50px; margin-top: 20px " />
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        
                        <div class="row" style="padding-top: 15px">
                            <div class="col-md-6" style="margin-left: 50px; width: 45%">
                                <label for="project_name3">Project Name :</label>
                                <input type="text" class="form-control" id="project_name3"  name="project_name" disabled>
                            </div>
                            <div class="col-md-4" style="margin-left: 10px; width: 250px;">
                                <label for="project_manager3">Project Manager :</label>
                                <input type="text" class="form-control" id="project_manager3"  name="project_manager" disabled>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group" style="margin-top: 8px; margin-left:65px; width: 85%">
                                <label for="description3">Description</label>
                                <textarea class="form-control" rows="3" cols="30" id="description3" name="description" disabled></textarea>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-4" style="margin-left: 55px; width: 30%">
                                
                            </div>
                            <div class="col-md-3" style="margin-left: 20px; width: 30%">
                                <label for="start_date3">Start Date :</label>
                                <input type="date" name="start_date" min="<?php echo date('Y-m-d');?>" class="form-control" id="start_date3" disabled/>
                            </div>
                            <div class="col-md-3" style="margin-left: 20px; width: 30%">
                                <label for="end_date3">End Date :</label>
                                <input type="date" name="end_date" min="<?php echo date('Y-m-d');?>" class="form-control" id="end_date3" disabled/>
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

        $(document).on("click", "#project-add-btn", function () {
            var customer= $(this).data('name');
            var subject= $(this).data('subject');
            var quotation_id= $(this).data('id');
            var payment_id= $(this).data('payment_id');
            var image= $(this).data('image');
            var customer_id= $(this).data('customer_id');
            
            $("#customer").val(customer);
            $("#project_name").val(subject);
            $("#quotation_id").val(quotation_id);
            $("#payment_id").val(payment_id);
            $("#customer_id").val(customer_id);
            $('#customer_img').attr('src', '../../../images/Avatars/customer_images/'+image);
        });

        $(document).on("click", "#project-edit-btn", function () {
            var project_id= $(this).data('project_id');
            var project_name= $(this).data('project_name');
            var cus_name= $(this).data('cus_name');
            var customer_image= $(this).data('customer_image');
            var project_manager_id= $(this).data('project_manager_id');
            var pro_name= $(this).data('pro_name');
            var description= $(this).data('description');
            var start_date= $(this).data('start_date');
            var end_date= $(this).data('end_date');
            
            $("#customer2").val(cus_name);
            $("#project_name2").val(project_name);
            $("#project_id2").val(project_id);
            $("#description2").val(description);
            $('#customer_img2').attr('src', '../../../images/Avatars/customer_images/'+customer_image);
            $("#start_date2").val(start_date);
            $("#end_date2").val(end_date);
            $('#project_manager2').val(project_manager_id).trigger('change');
        });

        $(document).on("click", "#project-view-btn", function () {
            var project_id= $(this).data('project_id');
            var project_name= $(this).data('project_name');
            var cus_name= $(this).data('cus_name');
            var customer_image= $(this).data('customer_image');
            var pro_name= $(this).data('pro_name');
            var description= $(this).data('description');
            var start_date= $(this).data('start_date');
            var end_date= $(this).data('end_date');
            
            $("#customer3").val(cus_name);
            $("#project_name3").val(project_name);
            $("#project_id3").val(project_id);
            $("#project_manager3").val(pro_name);
            $("#description3").val(description);
            $('#customer_img3').attr('src', '../../../images/Avatars/customer_images/'+customer_image);
            $("#start_date3").val(start_date);
            $("#end_date3").val(end_date);
        });
        // <!-- end of send data to modal scripts -->

    </script>

</html>
