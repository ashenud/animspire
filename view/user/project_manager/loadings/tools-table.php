
<?php
include '../../../../commons/session.php';
include '../../../../model/user_model.php';
$proManagerObj = new projectManager(); //must need for navbar

$cat_name ="";
if ($_REQUEST['cat_name'] != "") {
    $cat_name = "AND tc.category_name LIKE '".$_REQUEST['cat_name']."%'";
}
// echo($cat_name); die();

$toolResults = $proManagerObj->getAllToolsSearch($cat_name);

// echo($toolResults); die();
// print_r($toolResults); die();
if($_SESSION["user"]) {
?>

    <table class="tools-table" border="1" style="overflow-y:scroll;">
        <tr>
            <th width="40px"></th>
            <th width="80px">&nbsp;Tool ID</th>
            <th width="250px">&nbsp;Tool Name</th>
            <th width="200px">&nbsp;Website</th>
            <th width="230px">&nbsp;Category</th>
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
                <td style="text-align:center"><?php echo $toolRow["tool_id"]; ?></td>
                <td>&nbsp; <?php echo $toolRow["tool_name"]; ?></td>
                <td>&nbsp; <?php echo $toolRow["website"]; ?></td>
                <td>&nbsp; <?php echo $toolRow["category_name"]; ?></td>
                <td>&nbsp;
                    <?php 
                    if($toolRow["tool_status"]==0) {
                    ?>
                        Active
                    <?php
                    }
                    if($toolRow["tool_status"]==1) {
                    ?>
                        Inactive
                    <?php
                    }
                    ?>
                </td>
                <td>
                    <div class="btn-group d-flex">
                        <button type="button" id='tool-edit-btn' href='#tool-edit' data-toggle='modal' data-tool_id='<?php echo $toolRow["tool_id"];?>' data-tool_name='<?php echo $toolRow["tool_name"];?>' data-category_id='<?php echo $toolRow["category_id"];?>' data-image='<?php echo $toolRow["tool_image"];?>' data-website='<?php echo $toolRow["website"];?>' class="btn btn-info btn-sm" style="padding: 0; margin: 2px; width: 60px; font-size: 9px;" ><i class="fas fa-plus" style="font-size: 10px; color: white" ></i>&nbsp;Edit</button>
                        <?php
                        if($toolRow['tool_status'] == 0){
                            ?>
                                <button type="button" id='tool-delete-btn' href='#tool-delete' data-toggle='modal' data-tool_id='<?php echo $toolRow["tool_id"];?>' class="btn btn-danger btn-sm" style="padding: 0; margin: 2px; width: 60px; font-size: 9px;" ><i class="fas fa-fw fa-toggle-off" style="font-size: 22px; color: white" ></i></button>
                            <?php
                        }
                        else {
                            ?>
                                <button type="button" id='tool-activate-btn' href='#tool-activate' data-toggle='modal' data-tool_id='<?php echo $toolRow["tool_id"];?>' class="btn btn-secondary btn-sm" style="padding: 0; margin: 2px; width: 60px; font-size: 9px;" ><i class="fa fa-fw fa-toggle-on" style="font-size: 22px; color: white" ></i></button>
                            <?php
                        }
                        ?>
                    </div>
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