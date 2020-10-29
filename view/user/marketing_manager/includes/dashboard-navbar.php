<style>
.sidebar {
  height: 100%;
  width: 90px;
  position: absolute;
  z-index: 1;
  top: 0;
  left: 0;
  background-image: linear-gradient(180deg, #834d9b, #d04ed6);
  overflow-x: hidden;
}
.sidebar #logo{
    display: block;
    height: 90px;
    width: 90px;
    top: 0;
    left: 0;
    margin-bottom: 20px;
}

.sidebar a {
  text-decoration: none;
  font-size: 14px;
  color: white;
  display: block;
  align-items: center;
  text-align:center;
  margin-bottom: 5px;
}
.sidebar i{
  font-size: 25px;
  padding-bottom: 2px;
  text-align: center;
  text-shadow: 1.5px 1.5px 2px #000000;
}
.sidebar a:hover {
  color: tomato;
}
 hr{
  border: 1px solid purple;
  margin-bottom: 10px;
}
.top-navbar{
    top: 0;
    right: 0;
    height: 90px;
    width: 1010px;
    position: absolute;
    z-index: 1;
    background-image: linear-gradient(90deg, #834d9b, #d04ed6); 
}
.top-navbar img{
    margin: 20px 30px 20px 30px;
    float: right;
}
.top-navbar button{
    margin: 25px auto 25px auto;
    float: right;
    color: white;
}
.top-navbar i{
    font-size: 40px;
    float: right;
    color: white;
    text-shadow: 1.5px 1.5px 2px #000000;
    margin: 25px 50px 20px 30px;
    
}
.top-navbar i:hover{
    font-size: 42px;
    color: tomato;
    
}
.top-navbar button:hover{
    color: white;
}

.dropdown dropdown-menu{
    font-size: 15px;
    float: right;
    margin: 50px 50px 20px 30px;
    position: relative;
    z-index: 1;
    
}
.top-navbar .alert{
    margin: 23px 120px 25px 25px;
    float: right;
    width: 450px;
}
</style>
<div class="sidebar">
                <a><img src="../../../images/Animspire-Logo.png" id="logo"></a>
                <!--- Admin functions  --->
                <a href="user-management.php"><i class="fa fa-fw fa-home"></i><br>User Mng</a>
                <hr>
                <a href="admin-reports-management.php"><i class="fa fa-fw fa-file-alt"></i><br>Reports</a>
                <hr>
                <a href="#Backup"><i class="fa fa-fw fa-user"></i><br>Backup</a>
                <hr>
                <a href="#Chat"><i class="fa fa-fw fa-envelope"></i><br>Chat</a>
                <hr>
                <!--- Project Manager functions  --->
                <a href="user-management.php"><i class="fa fa-fw fa-tasks"></i><br>Projects</a>
                <hr>
                <a href="admin-reports-management.php"><i class="fa fa-fw fa-file-alt"></i><br>Reports</a>
                <hr>
                <a href="#Backup"><i class="fa fa-fw fa-user"></i><br>Performance</a>
                <hr>
                <a href="#Chat"><i class="fa fa-fw fa-tools"></i><br>Tools</a>
                <hr>
                <!--- Marketing Manager functions  --->
                <a href="user-management.php"><i class="fa fa-fw fa-user"></i><br>Clients</a>
                <hr>
                <a href="admin-reports-management.php"><i class="fa fa-fw fa-clipboard-list"></i><br>Quotation</a>
                <hr>
                <a href="#Backup"><i class="fa fa-fw fa-tasks"></i><br>Projects</a>
                <hr>
                <a href="#Chat"><i class="fa fa-fw fa-file-alt"></i><br>Reports</a>
                <hr>
                <!--- Finance Manager functions  --->
                <a href="user-management.php"><i class="fa fa-fw  fa-file-invoice-dollar"></i><br>Finance</a>
                <hr>
                <a href="admin-reports-management.php"><i class="fa fa-fw fa-clipboard-list"></i><br>Quotation</a>
                <hr>
                <a href="#Chat"><i class="fa fa-fw fa-file-alt"></i><br>Reports</a>
                <hr>
                <a href="../../../controller/userlogincontroller.php?status=logout"><img src="../../../images/icons/logout.png" alt="Logout" style="width:50px;height:50px;margin-top: 140px; margin-left: 5px"></a>
                
            </div>
            <div class="top-navbar">
                <a href="user-profile.php?user_id=<?php echo $userId; ?>"><img src="../../../images/Avatars/user_images/<?php echo $_SESSION["user"]["user_image"]; ?>" id="prfile-pic" style="height: 50px; width: 50px; border: 2px solid white; border-radius: 50px;"/></a>
                <button href="#Home" name="home" class="btn btn-primary">Home</button>
                <div class="dropdown">
                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-bell" ></i></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item active" href="#">View All Notifications</a>
                  </div>
                </div>
                <a href="#Chat"><i class="fa fa-fw fa-envelope" style="margin: 25px auto 20px 30px;"></i></a>
            </div>
