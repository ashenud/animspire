
<?php
include '../../../../commons/session.php';
include '../../../../model/user_model.php';
$adminObj = new Admin();

$fname ="";
if ($_REQUEST['fname'] != "") {
    $fname = "AND f.freelancer_fname LIKE '".$_REQUEST['fname']."%'";
}

$freelancerResults = $adminObj->getFreelancersSearch($fname);

if($_SESSION["user"]["role_id"]==1) {
?>

    <table class="freelancer-table" border="1" style="overflow-y:scroll;">
        <tr>
            <th></th>
            <th width="30px">&nbsp;ID</th>
            <th width="90px">&nbsp;First Name</th>
            <th width="90px">&nbsp;Last Name</th>
            <th width="130px">&nbsp;Email</th>
            <th width="130px">&nbsp;Country</th>
            <th width="80px">&nbsp;Phone</th>
            <th width="90px">&nbsp;DOB</th>
            <th width="60px">Gender</th>
            <th width="50px"></th>
        </tr>
        <?php
        if($freelancerResults->num_rows >0) {
            while($freelancerRow = $freelancerResults->fetch_assoc()) {
            ?>
            <tr>
                <td><img src="../../../images/Avatars/freelancer_images/<?php echo $freelancerRow["freelancer_image"]; ?>"
                        style="height: 40px; width: 40px; "></td>
                <td style="text-align:center"><?php echo $freelancerRow["freelancer_id"]; ?></td>
                <td>&nbsp; <?php echo $freelancerRow["freelancer_fname"]; ?></td>
                <td>&nbsp; <?php echo $freelancerRow["freelancer_lname"]; ?></td>
                <td>&nbsp; <?php echo $freelancerRow["freelancer_email"]; ?></td>
                <td>&nbsp; <?php echo $freelancerRow["freelancer_country"]; ?></td>
                <td>&nbsp; <?php echo $freelancerRow["freelancer_phone"]; ?></td>
                <td> <?php echo $freelancerRow["freelancer_dob"]; ?></td>
                <td>&nbsp;
                    <?php 
                    if($freelancerRow["freelancer_gender"]==0) {
                    ?>
                        Male
                    <?php
                    }
                    if($freelancerRow["freelancer_gender"]==1) {
                    ?>
                        Female
                    <?php
                    }
                    ?>
                </td>
                <td style="text-align: center;">
                <?php
                if($freelancerRow['freelancer_status'] == 1){
                    ?>
                        <button type="button" id='freelancer-delete-btn' href='#freelancer-delete' data-toggle='modal' data-freelancer_id='<?php echo $freelancerRow["freelancer_id"];?>' class="btn btn-danger btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fas fa-fw fa-toggle-off" style="font-size: 22px; color: white" ></i></button>
                    <?php
                }
                else {
                    ?>
                        <button type="button" id='freelancer-activate-btn' href='#freelancer-activate' data-toggle='modal' data-freelancer_id='<?php echo $freelancerRow["freelancer_id"];?>' class="btn btn-secondary btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fa fa-fw fa-toggle-on" style="font-size: 22px; color: white" ></i></button>
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