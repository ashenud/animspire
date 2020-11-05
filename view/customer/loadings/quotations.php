
<?php
include '../../../commons/session.php';
include '../../../model/customer_model.php';

$customerObj = new Customer();

$status ="";
if ($_REQUEST['status'] != "") {
    $status = "AND q.status = '".$_REQUEST['status']."'";
}

$customer_id = $_SESSION["customer"]["customer_id"];
// echo $status.'----'.$customer_id;die();
$quotations = $customerObj->getQuoteForStatus($status,$customer_id);

if(isset($_SESSION["customer"])) {
?>

    <table class="quote-table" border="1">
        <tr>
            <th width="150px">&nbsp;Subject</th>
            <th width="250px">&nbsp;Requirements</th>
            <th width="170px">&nbsp;Remarks</th>
            <th width="120px">&nbsp;Status</th>
            <th style="text-align: center;" width="120px">&nbsp;Actions</th>
        </tr>

        <?php
        if($quotations->num_rows >0) {
            while($quotation = $quotations->fetch_assoc()) {
            ?>
            <tr>
                <td>&nbsp; <?php echo $quotation["subject"]; ?></td>
                <td>&nbsp; <?php echo $quotation["requirements"]; ?></td>
                <td>&nbsp; <?php echo $quotation["remarks"]; ?></td>
                <td>&nbsp; <?php echo $quotation["status"]; ?></td>
                <?php
                if($quotation["status_id"] == 2) {
                    ?>
                    <td>
                        <div class="btn-group d-flex">
                            <button type="button" id='view-quote-btn' href='#view-quote' data-toggle='modal' data-subject='<?php echo $quotation["subject"];?>' data-requirements='<?php echo $quotation["requirements"];?>' data-remarks='<?php echo $quotation["remarks"];?>' data-status='<?php echo $quotation["status"];?>' class="btn btn-info btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="far fa-eye" style="font-size: 18px" ></i></button>
                            <button type="button" id='approve-quote-btn' href='#approve-quote' data-toggle='modal' data-id='<?php echo $quotation["quotation_id"];?>' class="btn btn-success btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="far fa-check-circle" style="font-size: 18px" ></i></button>
                            <button type="button" id='edit-quote-btn' href='#edit-quote' data-toggle='modal' data-id='<?php echo $quotation["quotation_id"];?>' data-subject='<?php echo $quotation["subject"];?>' data-requirements='<?php echo $quotation["requirements"];?>' data-remarks='<?php echo $quotation["remarks"];?>' data-status='<?php echo $quotation["status"];?>' class="btn btn-warning btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="far fa-edit" style="font-size: 18px" ></i></button>
                            <button type="button" id='reject-quote-btn' href='#reject-quote' data-toggle='modal' data-id='<?php echo $quotation["quotation_id"];?>' class="btn btn-danger btn-sm" style="padding: 0; margin: 2px; width: 35px;" ><i class="far fa-times-circle" style="font-size: 18px" ></i></button>
                        </div>
                    </td>
                    <?php
                }
                else {
                    ?>
                    <td>No actions needed</td>
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