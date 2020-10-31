
<?php
include '../../../../commons/session.php';
include '../../../../model/user_model.php';
$adminObj = new Admin();

$fname ="";
if ($_REQUEST['fname'] != "") {
    $fname = "AND u.user_fname LIKE '".$_REQUEST['fname']."%'";
}

$current_user_id = $_SESSION["user"]["user_id"];

$userResults = $adminObj->getUsersForAdmin($current_user_id,$fname);

if($_SESSION["user"]["role_id"]==1) {
?>

    <table class="user-table" border="1" style="overflow-y:scroll;">
        <tr>
            <th></th>
            <th width="30px">&nbsp;ID</th>
            <th width="90px">&nbsp;First Name</th>
            <th width="90px">&nbsp;Last Name</th>
            <th width="180px">&nbsp;Email</th>
            <th width="165px">&nbsp;Role</th>
            <th width="80px">&nbsp;Phone</th>
            <th width="90px">&nbsp;DOB</th>
            <th width="60px">Gender</th>
            <th width="100px"></th>
        </tr>
        <?php
        if($userResults->num_rows >0) {
            while($userRow = $userResults->fetch_assoc()) {
            ?>
            <tr>
                <td><img src="../../../images/Avatars/user_images/<?php echo $userRow["user_image"]; ?>"
                        style="height: 40px; width: 40px; "></td>
                <td style="text-align:center"><?php echo $userRow["user_id"]; ?></td>
                <td>&nbsp; <?php echo $userRow["user_fname"]; ?></td>
                <td>&nbsp; <?php echo $userRow["user_lname"]; ?></td>
                <td>&nbsp; <?php echo $userRow["user_email"]; ?></td>
                <td>&nbsp; <?php echo $userRow["role_name"]; ?></td>
                <td>&nbsp; <?php echo $userRow["user_phone"]; ?></td>
                <td> <?php echo $userRow["user_dob"]; ?></td>
                <td>&nbsp;
                    <?php 
                    if($userRow["user_gender"]==0) {
                    ?>
                        Male
                    <?php
                    }
                    if($userRow["user_gender"]==1) {
                    ?>
                        Female
                    <?php
                    }
                    ?>
                </td>
                <td>
                    <a href="admin-user-edit.php?user_id=<?php echo base64_encode($userRow["user_id"]); ?>"><button
                            type="button" class="btn btn-warning" style="color:white">
                            <span class="fa fa-fw fa-edit"></span>Edit</button>
                    </a>
                    <?php
                    if($userRow["user_status"]==0) {
                    ?>
                    <a
                        href="../../../controller/usercontroller.php?status=activateUser&user_id=<?php echo base64_encode($userRow["user_id"]); ?>"><button
                            type="button" class="btn btn-success" style="width: 30px; height: 30px;">
                            <span class="fa fa-fw fa-toggle-on"></span></button></a>
                    <?php
                    }        
                    ?>
                    <?php
                    if($userRow["user_status"]==1) {
                    ?>
                    <a
                        href="../../../controller/usercontroller.php?status=deactivateUser&user_id=<?php echo base64_encode($userRow["user_id"]); ?>"><button
                            type="button" class="btn btn-danger" style="width: 30px; height: 30px;">
                            <span class="fa fa-fw fa-power-off"></span></button></a>
                    <?php
                    }        
                    ?>


                </td>
            </tr>
            <?php
            }
        }
        else {
            ?>
            <tr>
                <td align="center" style="text-align:center; color:red" colspan="10">No result found</td>
            </tr>
            <?php
        }
        ?>
    </table>

<?php
} else {
    echo 'Invalid User';
}
?>