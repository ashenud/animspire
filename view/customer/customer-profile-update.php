<?php
    include '../../commons/session.php';
?>
<html>
    <head>            
      <title>Customer Update Profile</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">  
      <link rel='stylesheet' type="text/css" href="../../css/style-signup-form.css"/>
        <?php include '../../includes/other_dashboard_includes_css.php';?>
        <?php include '../../includes/other_dashboard_includes_script.php'; ?>
        
        <?php
            
            include '../../model/customer_model.php';
            $customerObj = new Customer(); //must need for navbar

            $customerId = $_REQUEST["customer_id"];
            $customerId = base64_decode($customerId);
            
            $customerResult = $customerObj->viewCustomer($customerId);
            
            $customerRow = $customerResult->fetch_assoc();
     
        ?>        
        
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">
        
        <form id="editCustomer" enctype="multipart/form-data" method="post" action="../../controller/customercontroller.php?status=edit_self">
              <div class="cont">
                  <input type="hidden" name="customer_id" value="<?php echo $customerId ?>"/>
                  <input type="hidden" value="../view/customer/customer-profile-update.php" id="redirect" name="redirect">
               <div class="row">
                    <div class="col-md-4">
                    <h3>Update</h3>
                    <h6>Update Your Profile Information</h6>
                    </div>
                   <div class="col-md-8">
                       <!-- Alert message -->
                       <div id="alertDiv"></div>
                        <?php
                        if(isset($_GET["msg"]))
                        {
                            $msg=  base64_decode($_GET["msg"]);
                        ?>
                            <div class="alert alert-danger" style="padding: 15px; height: 55px; margin-top: 5px">
                                <p><?php
                                    echo $msg;
                                    ?>
                                </p>
                            </div>
                        <?php
                        }
                        if(isset($_GET["msgSuccess"]))
                        {
                            $msgSuccess=  base64_decode($_GET["msgSuccess"]);
                        ?>
                            <div class="alert alert-success" style="padding: 15px; height: 55px; margin-top: 5px">
                                <p><?php
                                    echo $msgSuccess;
                                    ?>
                                </p>
                            </div>
                        <?php
                        }
                        ?>
                   </div>
               </div>
             <hr>
                <div class="form-group">
                  <label for="email">Name :</label>
                  <div class="form-inline">
                  <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" value="<?php echo $customerRow["customer_fname"]; ?>" style="margin-right: 14px; width: 48.5%">
                  <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" value="<?php echo $customerRow["customer_lname"]; ?>" style="margin-left: 13px; width: 48.5%">
                  </div>
                </div>
             
                <div class="row">
                    <div class="form-group" style="margin-top: 8px; margin-left: 15px; width: 47%">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" id="email" value="<?php echo $customerRow["customer_email"]; ?>" name="email" readonly="readonly">
                    </div>
                </div>  
             
                <div class="row">
                  <div class="form-group" style="margin-top: 8px; margin-left: 15px; width: 47%">
                    <label for="email">Date Of Birth :</label>
                    <input type="date" name="dob" class="form-control" id="dob" value="<?php echo $customerRow["customer_dob"]; ?>"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                  </div>
                </div>
                
                <div class="row">
                   <div class="form-group" style="margin-left: 15px; width: 47%">
                    <label for="phone">Contact No :</label>
                    <input type="text" class="form-control" id="phone" placeholder="Phone Number" name="phone" value="<?php echo $customerRow["customer_phone"]; ?>" >
                   </div>
                   <div class="form-group" style="margin-left: 27px; width: 39%" >
                    <label for="image">Image :</label>
                    <div class="custom-file">
                     <input type="file" class="custom-file-input" id="image" name="image" style="margin-top:3px" onchange="readURL(this)" >
                     
                    <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                   </div>
                    <div class="form-group" style="margin-left: 27px; width: 6%" >
                    <img id="prev_img" src="../../images/Avatars/customer_images/<?php echo $customerRow["customer_image"]; ?>" style="width: 50px; height: 50px; margin-top: 20px " />
                   </div>
                </div>
             <div class="clearfix">
                 <button onclick="document.location='customer-dashboard.php'" type="button" class="btn btn-danger" style="width: 440px">Cancel</button>&nbsp;&nbsp;&nbsp;
                 <button type="submit" class="btn btn-success" style="width: 440px">Update</button>
             </div>
              </div>
              </form>
       
        
        
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
    </script>
</html>
