
<?php
include '../../../../commons/session.php';
include '../../../../model/user_model.php';

$marketingManagerObj = new MarketingManager();

$status ="";
if ($_REQUEST['status'] != "") {
    $status = "AND q.status = '".$_REQUEST['status']."'";
}

$quotations = $marketingManagerObj->getQuoteForStatus($status);

if(isset($_SESSION["user"])) {
?>

    <table class="quote-table" border="1">
        <tr>
            <th width="180px">&nbsp;Customer</th>
            <th width="130px">&nbsp;Subject</th>
            <th width="210px">&nbsp;Requirements</th>
            <th width="160px">&nbsp;Remarks</th>
            <th width="120px">&nbsp;Status</th>
            <th style="text-align: center;" width="120px">&nbsp;Actions</th>
        </tr>

        <?php
        if($quotations->num_rows >0) {
            while($quotation = $quotations->fetch_assoc()) {
            ?>
            <tr>
                <td>&nbsp;<?php echo $quotation["name"]; ?></td>
                <td>&nbsp;<?php echo $quotation["subject"]; ?></td>
                <td>&nbsp;<?php echo $quotation["requirements"]; ?></td>
                <td>&nbsp;<?php echo $quotation["remarks"]; ?></td>
                <td>&nbsp;<?php echo $quotation["status"]; ?></td>
                <?php
                if($quotation["status_id"] == 1) {
                    ?>
                    <td>
                        <div class="btn-group d-flex">
                            <button type="button" id='view-quote-btn' href='#view-quote' data-toggle='modal' data-subject='<?php echo $quotation["subject"];?>' data-requirements='<?php echo $quotation["requirements"];?>' data-remarks='<?php echo $quotation["remarks"];?>' data-status='<?php echo $quotation["status"];?>' class="btn btn-info btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="far fa-eye" style="font-size: 18px" ></i></button>
                            <button type="button" id='send-quote-btn' href='#send-quote' data-toggle='modal' data-id='<?php echo $quotation["quotation_id"];?>' data-remarks='<?php echo $quotation["remarks"];?>' class="btn btn-success btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="far fa-check-circle" style="font-size: 18px" ></i></button>
                        </div>
                    </td>
                    <?php
                }
                elseif($quotation["status_id"] == 3) {

                    $payment_data = $marketingManagerObj->getPaymentForQuoteId($quotation["quotation_id"]);
                    $payment = $payment_data->fetch_assoc();
                    
                    if($payment_data->num_rows > 0) {
                        if($payment['status'] == 1) {
                            ?>
                            <td>
                                <div class="btn-group d-flex">
                                    <button type="button" id='view-quote-btn' href='#view-quote' data-toggle='modal' data-subject='<?php echo $quotation["subject"];?>' data-requirements='<?php echo $quotation["requirements"];?>' data-remarks='<?php echo $quotation["remarks"];?>' data-status='<?php echo $quotation["status"];?>' class="btn btn-info btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="far fa-eye" style="font-size: 18px" ></i></button>
                                    <button type="button" id='payment-btn1' href='#payment1' data-toggle='modal' data-name='<?php echo $payment["name"];?>' data-date='<?php echo $payment["requested_date"];?>' data-description='<?php echo $payment["payment_description"];?>' data-total='<?php echo $payment["amount"];?>' class="btn btn-warning btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="fas fa-dollar-sign" style="font-size: 18px; color: white" ></i></button>
                                </div>
                            </td>
                            <?php
                        }
                        else {
                            ?>
                            <td>
                                <div class="btn-group d-flex">
                                    <button type="button" id='view-quote-btn' href='#view-quote' data-toggle='modal' data-subject='<?php echo $quotation["subject"];?>' data-requirements='<?php echo $quotation["requirements"];?>' data-remarks='<?php echo $quotation["remarks"];?>' data-status='<?php echo $quotation["status"];?>' class="btn btn-info btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="far fa-eye" style="font-size: 18px" ></i></button>
                                    <button type="button" id='payment-btn2' href='#payment2' data-toggle='modal' data-name='<?php echo $payment["name"];?>' data-date='<?php echo $payment["paid_date"];?>' data-description='<?php echo $payment["payment_description"];?>' data-total='<?php echo $payment["paid_amount"];?>' class="btn btn-success btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="fas fa-dollar-sign" style="font-size: 18px; color: white" ></i></button>
                                </div>
                            </td>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <td>
                            <div class="btn-group d-flex">
                                <button type="button" id='view-quote-btn' href='#view-quote' data-toggle='modal' data-subject='<?php echo $quotation["subject"];?>' data-requirements='<?php echo $quotation["requirements"];?>' data-remarks='<?php echo $quotation["remarks"];?>' data-status='<?php echo $quotation["status"];?>' class="btn btn-info btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="far fa-eye" style="font-size: 18px" ></i></button>
                                <button type="button" id='payment-btn3' href='#payment3' data-toggle='modal' data-id='<?php echo $quotation["quotation_id"];?>' data-customer='<?php echo $quotation["customer_id"];?>' data-name='<?php echo $quotation["name"];?>' class="btn btn-danger btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="fas fa-dollar-sign" style="font-size: 18px; color: white" ></i></button>
                            </div>
                        </td>
                        <?php
                    }
                }
                else {
                    ?>
                    <td style="text-align: center;">
                        <div class="btn-group">
                            <button type="button" id='view-quote-btn' href='#view-quote' data-toggle='modal' data-subject='<?php echo $quotation["subject"];?>' data-requirements='<?php echo $quotation["requirements"];?>' data-remarks='<?php echo $quotation["remarks"];?>' data-status='<?php echo $quotation["status"];?>' class="btn btn-info btn-sm" style="padding: 0; margin: 2px; width: 45px;" ><i class="far fa-eye" style="font-size: 18px" ></i></button>
                        </div>
                    </td>
                    <?php
                }
                ?>
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