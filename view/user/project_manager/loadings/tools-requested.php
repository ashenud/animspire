
<?php
include '../../../../commons/session.php';
include '../../../../model/user_model.php';
$proManagerObj = new projectManager(); //must need for navbar

$toolResults = $proManagerObj->getAllToolRequest();

if($_SESSION["user"]) {
?>

    <table class="tools-table" border="1" style="overflow-y:scroll;">
        <tr>
            <th width="40px"></th>
            <th width="110px">&nbsp;Freelancer ID</th>
            <th width="220px">&nbsp;Freelancer Name</th>
            <th width="220px">&nbsp;Tool Name</th>
            <th width="200px">&nbsp;Category</th>
            <th width="100px">&nbsp;Status</th>
            <th width="70px"></th>
        </tr>
        <?php
        if($toolResults->num_rows >0) {
            while($toolRow = $toolResults->fetch_assoc()) {
            ?>
            <tr>
                <td><img src="../../../images/icons/tool_images/<?php echo $toolRow["tool_image"]; ?>"
                        style="height: 40px; width: 40px; "></td>
                <td style="text-align:center"><?php echo $toolRow["freelancer_id"]; ?></td>
                <td>&nbsp; <?php echo $toolRow["freelancer"]; ?></td>
                <td>&nbsp; <?php echo $toolRow["tool_name"]; ?></td>
                <td>&nbsp; <?php echo $toolRow["category_name"]; ?></td>
                <td>&nbsp; Requested </td>
                <td>                    
                    <button type="button" id='tool-accept-btn' href='#tool-accept' data-toggle='modal' data-request_id='<?php echo $toolRow["request_id"];?>' data-freelancer_email='<?php echo $toolRow["freelancer_email"];?>' data-tool_name='<?php echo $toolRow["tool_name"];?>' class="btn btn-info btn-sm" style="padding: 0; margin: 2px; width: 60px; font-size: 9px;" ><i class="fas fa-paper-plane" style="font-size: 10px; color: white" ></i>&nbsp;Accept</button>
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