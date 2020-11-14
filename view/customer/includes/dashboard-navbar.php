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
    margin: 25px 20px 25px 20px;
    float: right;
    color: white;
}
.top-navbar i{
    font-size: 40px;
    float: right;
    color: white;
    text-shadow: 1.5px 1.5px 2px #000000;
    margin: 25px 20px 20px 20px;
    
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

.badge.msg-label {
    position: relative;
    padding: 5px 5px;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    font-size: 15px;
    top: 20px;
    right: -50px;
    margin-right: -30px;
}

</style>
<div class="sidebar">
    <a href="./customer-dashboard.php" ><img src="../../images/Animspire-Logo.png" id="logo"></a>
    <hr>
    <a href="./customer-quotations.php"><i class="fas fa-file-invoice"></i><br>Quotations</a>
    <hr>
    <a href="./customer-payments.php"><i class="fas fa-file-invoice-dollar"></i><br>Payments</a>
    <hr>
    <a href="./customer-projects.php"><i class="fas fa-laptop"></i><br>Projects</a>
    <hr>
    <a href="#contact"><i class="fa fa-fw fa-wrench"></i><br>Reports</a>
    <hr>
    <a href="../../controller/customerlogincontroller.php?status=logout"><img src="../../images/icons/logout.png"
            alt="Logout" style="width:50px;height:50px;margin-top: 140px; margin-left: 5px"></a></a>
</div>
<div class="top-navbar">
    <a href="./customer-profile.php?customer_id=<?php echo $customerId; ?>"><img
            src="../../images/Avatars/customer_images/<?php echo $_SESSION["customer"]["customer_image"]; ?>" id="prfile-pic"
            style="height: 50px; width: 50px; border: 2px solid white; border-radius: 50px;" /></a>
    <a href="./customer-dashboard.php" name="home" class="btn btn-primary home-btn">Home</a>
    <div class="dropdown">
        <button id="notiyf-menu" class="dropdown-toggle notify-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php

                $notifyCount = 0;
                $paymentReqCount = $customerObj->paymentReqCount($_SESSION["customer"]["customer_id"])->num_rows;
                $qouteCount = $customerObj->qouteCount($_SESSION["customer"]["customer_id"])->num_rows;
                $notifyCount = $paymentReqCount + $qouteCount;

                if(0<$notifyCount && $notifyCount<5) {
                    echo "<span class='badge badge-danger msg-label'>";
                    echo $notifyCount;
                    echo "</span>";
                }
                else if($notifyCount>=5) {
                    echo "<span class='badge badge-danger msg-label'>";
                    echo "5+";
                    echo "</span>";
                }
            ?>
            <i class="fa fa-fw fa-bell"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="notiyf-menu">
            <?php
                if ($qouteCount > 0) {
                    ?>
                        <a class="dropdown-item" href="./customer-quotations.php">View Quotations</a>
                    <?php
                }
                if ($paymentReqCount > 0) {
                    ?>
                        <a class="dropdown-item" href="./customer-payments.php">View Payments</a>
                    <?php
                }
                if ($qouteCount == 0 && $paymentReqCount == 0) {
                    ?>
                        <a class="dropdown-item" href="#">No New Notifications</a>
                    <?php
                }
            ?>
        </div>
    </div>
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
