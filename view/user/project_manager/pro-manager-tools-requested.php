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
            .modal-dialog .modal-content{
               margin-top: 100px;
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
                                    <input type="text" id="freelancer" name="freelancer" class="form-control" placeholder="Search by freelancer" style="margin-top: 5px; width: 140px">
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
                           <div class="btn-group" id="btngroup" style="margin:5px 10px auto 5px">
                                <button type="button" class="btn btn-primary btn-sm" onclick="#" style="width: 180px; padding: 6px; font-size: 13px">Allowed Freelancers</button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="#" style="width: 90px; padding: 6px; font-size: 13px">Requested</button></div>
                        </div>
                   </div>
               </div>
               <table class="tools-table" border="1" >
                        <tr>
                            <th width="40px"></th>
                            <th width="110px">&nbsp;Freelancer ID</th>
                            <th width="220px">&nbsp;Freelancer Name</th>
                            <th width="220px">&nbsp;Tool Name</th>
                            <th width="200px">&nbsp;Category</th>
                            <th width="100px">&nbsp;Status</th>
                            <th width="70px"></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button
                                type="button" class="btn btn-info" href='#giveAccess' data-toggle='modal' data-id='#' data-customer='#' data-name='#' style="width: 30px; height: 30px;">
                                <span class="fas fa-paper-plane"></span></button>
                                <a
                                href=""><button
                                type="button" class="btn btn-danger" style="width: 30px; height: 30px;">
                                <span class="fa fa-fw fa-power-off"></span></button></a>
                            </td>
                        </tr>
                    </table>
            </div>
         </div>
        
        <!--- give access modal -->
                    
        <div class="modal fade" id="giveAccess" role="dialog">
            <div class="modal-dialog">
                <form action="#" method="post" name="pw_change" id=""> 
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="col-12 modal-title text-center" style="padding-top: 10px">CHANGE PASSWORD</h4>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row">
                                <div class="form-group" style="margin-top: 2px; margin-left: 35px; width: 85%">
                                    <label for="current_password">Freelancer Email :</label>
                                    <input type="password" class="form-control" id="email" name="email" required="required"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="margin-top: 8px; margin-left: 35px; width: 85%">
                                    <label for="username">Username for Tool :</label>
                                    <input type="text" class="form-control" id="username" name="username" required="required"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="margin-top: 8px; margin-left: 35px; width: 85%">
                                    <label for="password">Password for Tool:</label>
                                    <input type="password" class="form-control" id="password" name="password" required="required"/>
                                </div>
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-success" style="width: 200px; text-align: center; margin-right: 135px">
                            <i class="fas fa-paper-plane"></i>&nbsp;&nbsp;GIVE ACCESS</button>
                        </div>    
                    </div>
                </form>
            
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
    </script>

    
</html>
