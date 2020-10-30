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
    z-index: 2;
    background-image: linear-gradient(90deg, #834d9b, #d04ed6); 
}
.top-navbar img{
    margin: 20px 30px 20px 30px;
    float: right;
}
.top-navbar button{
    float: right;
    color: white;
}
.top-navbar .notify-btn{
    background: none;
    border: none;
    padding: 0;
}
.top-navbar .notify-btn:focus{
    outline: none;
}

.top-navbar .home-btn{
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
    color: tomato;
}
.top-navbar button:hover{
    color: white;
}

.dropdown .dropdown-menu{
    margin: -10px 47px;    
}

.dropdown-toggle::after {
    display: none;
}

.top-navbar .alert{
    margin: 23px 120px 25px 25px;
    float: right;
    width: 450px;
}
</style>
<div class="sidebar">
    <a href="./admin-dashboard.php"><img src="../../../images/Animspire-Logo.png" id="logo"></a>
    <!--- Admin functions  --->
    <a href="./admin-user-management.php"><i class="fa fa-fw fa-home"></i><br>User Mng</a>
    <hr>
    <a href="./admin-reports-management.php"><i class="fa fa-fw fa-file-alt"></i><br>Reports</a>
    <hr>
    <a href="./admin-backup-database.php"><i class="fa fa-fw fa-user"></i><br>Backup</a>
    <hr>
    <a href="./admin-chat.php"><i class="fa fa-fw fa-envelope"></i><br>Chat</a>
    <hr>
    <a href="../../../controller/userlogincontroller.php?status=logout"><img src="../../../images/icons/logout.png"
            alt="Logout" style="width:50px;height:50px;margin-top: 140px; margin-left: 5px"></a>

</div>
<div class="top-navbar">
    <a href="./admin-profile.php?user_id=<?php echo $userId; ?>"><img
            src="../../../images/Avatars/user_images/<?php echo $_SESSION["user"]["user_image"]; ?>" id="prfile-pic"
            style="height: 50px; width: 50px; border: 2px solid white; border-radius: 50px;" /></a>
    <a href="./admin-dashboard.php" name="home" class="btn btn-primary home-btn">Home</a>
    <div class="dropdown">
        <button id="notiyf-menu" class="dropdown-toggle notify-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="notiyf-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">View All Notifications</a>
        </div>
    </div>
    <a href="#Chat"><i class="fa fa-fw fa-envelope" style="margin: 25px auto 20px 30px;"></i></a>

    <!-- Success message -->
    <?php
        if(isset($_GET["msgSuccess"]))
        {
        $msgSuccess=  base64_decode($_GET["msgSuccess"]);
        ?>
        <div class="alert alert-success" style="padding: 10px; height: 45px;">
            <p><?php
                echo $msgSuccess;
                ?>
            </p>
        </div>
        <?php
        }
    ?>
    <!-- Danger message -->
    <?php
        if(isset($_GET["msg"]))
        {
            $msg=  base64_decode($_GET["msg"]);
        ?>
            <div class="alert alert-danger" style="padding: 5px; height: 35px;">
                <p><?php
                    echo $msg;
                    ?>
                </p>
            </div>
        <?php
        }
    ?>
</div>
