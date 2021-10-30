
<?php
include '../../../../commons/session.php';
include '../../../../model/user_model.php';
$marketingManagerObj = new MarketingManager();

$fname ="";
if ($_REQUEST['fname'] != "") {
    $fname = "WHERE c.customer_fname LIKE '".$_REQUEST['fname']."%'";
}

$customerResults = $marketingManagerObj->getAllCustomersSearch($fname);

// print_r($customerResults); die();
if($_SESSION["user"]) {
?>

    <table class="client-table" border="1" style="overflow-y:scroll;">
        <tr>
            <th width="40px"></th>
            <th width="30px">&nbsp;ID</th>
            <th width="120px">&nbsp;First Name</th>
            <th width="120px">&nbsp;Last Name</th>
            <th width="190px">&nbsp;Email</th>
            <th width="130px">&nbsp;Country</th>
            <th width="100px">&nbsp;Phone</th>
            <th width="110px">&nbsp;DOB</th>
            <th width="90px">Gender</th>
            <th width="30px"></th>
        </tr>
        <?php
        if($customerResults->num_rows >0) {
            while($customerRow = $customerResults->fetch_assoc()) {
            ?>
            <tr>
                <td><img src="../../../images/Avatars/customer_images/<?php echo $customerRow["customer_image"]; ?>"
                        style="height: 40px; width: 40px; "></td>
                <td style="text-align:center"><?php echo $customerRow["customer_id"]; ?></td>
                <td>&nbsp; <?php echo $customerRow["customer_fname"]; ?></td>
                <td>&nbsp; <?php echo $customerRow["customer_lname"]; ?></td>
                <td>&nbsp; <?php echo $customerRow["customer_email"]; ?></td>
                <td>&nbsp; <?php echo $customerRow["customer_country"]; ?></td>
                <td>&nbsp; <?php echo $customerRow["customer_phone"]; ?></td>
                <td> <?php echo $customerRow["customer_dob"]; ?></td>
                <td>&nbsp;
                    <?php 
                    if($customerRow["customer_gender"]==0) {
                    ?>
                        Male
                    <?php
                    }
                    if($customerRow["customer_gender"]==1) {
                    ?>
                        Female
                    <?php
                    }
                    ?>
                </td>
                <td>
                <?php
                if($customerRow['customer_status'] == 1){
                    ?>
                        <button type="button" id='customer-delete-btn' href='#customer-delete' data-toggle='modal' data-customer_id='<?php echo $customerRow["customer_id"];?>' class="btn btn-danger btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fas fa-fw fa-toggle-off" style="font-size: 22px; color: white" ></i></button>
                    <?php
                }
                else {
                    ?>
                        <button type="button" id='customer-activate-btn' href='#customer-activate' data-toggle='modal' data-customer_id='<?php echo $customerRow["customer_id"];?>' class="btn btn-secondary btn-sm" style="padding: 0; margin: 2px; width: 35px; font-size: 9px;" ><i class="fa fa-fw fa-toggle-on" style="font-size: 22px; color: white" ></i></button>
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
    echo 'Invalid customer';
}
?>