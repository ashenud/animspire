<?php
    include '../../commons/session.php';
?>
<html>
    <head>
      <title>Customer Sign Up</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">  
      <link rel='stylesheet' type="text/css" href="../../css/style-signup-form.css"/>
      <link rel='stylesheet' type="text/css" href="../../bootstrap/css/mdb.min.css"/>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
      <!-- Google Fonts Roboto -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        
    </head>
    
    <body  style="background-image: url('../../images/background-image.png');">
        
        <form id="addCustomer" enctype="multipart/form-data" method="post" action="../../controller/customercontroller.php?status=add_customer">
              <div class="cont">
               <div class="row">
                    <div class="col-md-4">
                    <h3>Sign Up</h3>
                    <h6>Fill the form to create an account</h6>
                    </div>
                   <div class="col-md-8">
                       <!-- Alert message -->
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
                        ?>
                   </div>
                   <div class="col-md-7">
                       <div id="alertDiv"></div>
                   </div>
               </div>
             <hr>
                <div class="form-group">
                  <label for="email">Name :</label>
                  <div class="form-inline">
                  <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" style="margin-right: 14px; width: 48.5%">
                  <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" style="margin-left: 13px; width: 48.5%">
                  </div>
                </div>
             
                <div class="row">
                <div class="form-group" style="margin-top: 8px; margin-left: 15px; width: 47%"">
                  <label for="email">Email :</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="form-group" style="margin-top: 8px; margin-left: 27px; width: 47%"">
                  <label for="email">Password :</label>
                  <input type="password" class="form-control" id="password" placeholder="Enter Any Password" name="password">
                </div>
                </div>  
             
                <div class="row">
                <div class="form-group" style="margin-left: 15px; margin-right: 6px; width: 30%">
                  <label for="country">Country :</label>
                  <select id="country" name="country" class="form-control">
                      <?php include '../../includes/country_list.php'; ?>
                  </select>
                </div>
                  <div class="form-group" style="margin-left: 25px; width: 30%">
                    <label for="email">Date Of Birth :</label>
                    <input type="date" name="dob" class="form-control" id="dob" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                  </div>
                    <div class="form-group" style="margin-left: 25px; margin-right:15px; width: 30%">
                    <label for="gender" style="margin-left:8px">Gender :</label>
                    <div class="row" style="margin-top:8px; margin-left: 10px;">
                      <div class="form-check-inline">
                    <label class="form-check-label" for="male">
                    <input type="radio" class="form-check-input" id="male" name="gender" value="0" checked>Male
                    </label>
                      </div>
                      <div class="form-check-inline">
                    <label class="form-check-label" for="female">
                    <input type="radio" class="form-check-input" id="female" name="gender" value="1">Female
                    </label>
                      </div>
                      <div class="form-check-inline">
                    <label class="form-check-label" for="other">
                    <input type="radio" class="form-check-input" id="Other" name="gender" value="2">Other
                    </label>
                      </div>
                    </div>
                   </div>
                </div>
                
                <div class="row">
                   <div class="form-group" style="margin-left: 15px; width: 47%">
                    <label for="phone">Contact No :</label>
                    <input type="text" class="form-control" id="phone" placeholder="Phone Number" name="phone" >
                   </div>
                   <div class="form-group" style="margin-left: 27px; width: 47%" >
                    <label for="image">Image :</label>
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image" style="margin-top:3px" >
                    <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                   </div>
                </div>
             <div class="clearfix">
                 <button onclick="document.location='../home.php'" type="submit" class="btn btn-danger" style="width: 440px">Cancel</button>&nbsp;&nbsp;&nbsp;
                 <button type="submit" class="btn btn-success" style="width: 440px">Sign Up</button>
             </div>
              </div>
              </form>
        
    </body>

    <script src="../../js/customer_validation.js"></script>
    
</html>
