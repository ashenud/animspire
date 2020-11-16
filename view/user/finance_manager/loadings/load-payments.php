
<?php
include '../../../../commons/session.php';
include '../../../../model/user_model.php';
$financeManagerObj = new FinanceManager(); //must need for navbar

$status ="";
if ($_REQUEST['status'] != "") {
    $status = "AND p.status = '".$_REQUEST['status']."'";
}

if(isset($_SESSION["user"])) {
?>

    <table class="finance-table" border="1" >
        <tr>
            <th width="80px">&nbsp;Quote ID</th>
            <th width="60px">&nbsp;Pro.ID</th>
            <th width="219px">&nbsp;Project Name</th>
            <th width="130px">&nbsp;Pro.Manager</th>
            <th width="120px">&nbsp;Start Date</th>
            <th width="120px">&nbsp;End Date</th>
            <th width="100px">&nbsp;Amount</th>
            <th width="100px">&nbsp;Status</th>
            <th width="60px"></th>
        </tr>

        <?php
        $payment_data = $financeManagerObj->getAllPaymentsDetailsSearch($status);
        if($payment_data->num_rows > 0) {
            while($payment = $payment_data->fetch_assoc()) {
                ?>
                <tr>
                    <td>&nbsp;<?php echo $payment["quotation_id"]; ?></td>
                    <td>&nbsp;<?php echo $payment["project_id"]; ?></td>
                    <td>&nbsp;<?php echo $payment["project_name"]; ?></td>
                    <td>&nbsp;<?php echo $payment["pro_man_name"]; ?></td>
                    <td>&nbsp;<?php echo $payment["start_date"]; ?></td>
                    <td>&nbsp;<?php echo $payment["end_date"]; ?></td>
                    <td>&nbsp;<?php echo $payment["amount"]; ?></td>
                <?php

                if($payment["status"] == 1) {
                    ?>
                        <td>&nbsp; Unpaid</td>
                        <td>
                            <div class="btn-group d-flex">
                                <button type="button" id='payment-btn1' href='#payment1' data-toggle='modal' data-id='<?php echo $payment["payment_id"];?>' data-name='<?php echo $payment["name"];?>' data-date='<?php echo $payment["requested_date"];?>' data-description='<?php echo $payment["payment_description"];?>' data-total='<?php echo $payment["amount"];?>' class="btn btn-warning btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="fas fa-dollar-sign" style="font-size: 18px; color: white" ></i></button>
                            </div>
                        </td>
                    <?php
                }
                else {
                    ?>
                        <td>&nbsp; Paid</td>
                        <td>
                            <div class="btn-group d-flex">
                                <button type="button" id='payment-btn2' href='#payment2' data-toggle='modal' data-id='<?php echo $payment["payment_id"];?>' data-subject='<?php echo $quotation["subject"];?>' data-name='<?php echo $payment["name"];?>' data-date='<?php echo $payment["paid_date"];?>' data-description='<?php echo $payment["payment_description"];?>' data-total='<?php echo $payment["amount"];?>' data-method='<?php echo $payment["payment_method"];?>' data-address='<?php echo $payment["address"];?>' class="btn btn-success btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="fas fa-dollar-sign" style="font-size: 18px; color: white" ></i></button>
                            </div>
                        </td>
                    <?php
                }
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