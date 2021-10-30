
<?php
include '../../../commons/session.php';
include '../../../model/freelancer_model.php';
$freelancerObj = new Freelancer(); /// create feelancer object

$cat_name ="";

if($_REQUEST['type'] == "4"){
    if ($_REQUEST['cat_name'] != "") {
        $cat_name = "AND tc.category_name LIKE '".$_REQUEST['cat_name']."%'";
    }
}

$freelancer_id = $_SESSION["freelancer"]["freelancer_id"];

$toolResults = $freelancerObj->getAllActiveTools($freelancer_id,$cat_name);
// echo($cat_name); die();

// echo($toolResults); die();
// print_r($toolResults); die();
if($_SESSION["freelancer"]) {
?>

    <table class="tools-table" border="1" style="overflow-y:scroll;">
        <tr>
            <th width="40px"></th>
            <th width="250px">&nbsp;Tool Name</th>
            <th width="220px">&nbsp;Website</th>
            <th width="250px">&nbsp;Category</th>
            <th width="100px">&nbsp;Status</th>
            <th width="90px"></th>
        </tr>
        <?php
        if($toolResults->num_rows >0) {
            $count1 = 0;
            $count2 = 0;
            $count3 = 0;
            while($toolRow = $toolResults->fetch_assoc()) {

                if ($_REQUEST['type'] == "2") {
                    if ($toolRow["permission_id"] == 0) {
                        $count1++;
                        ?>
                        <tr>
                            <td><img src="../../images/icons/tool_images/<?php echo $toolRow["tool_image"]; ?>"
                                    style="height: 40px; width: 40px; "></td>
                            <td>&nbsp; <?php echo $toolRow["tool_name"]; ?></td>
                            <td>&nbsp; <?php echo $toolRow["website"]; ?></td>
                            <td>&nbsp; <?php echo $toolRow["category_name"]; ?></td>
                            <td>&nbsp; <?php echo $toolRow["permission"]; ?></td>
                            <td>
                                <div class="btn-group d-flex">
                                    <?php
                                    if($toolRow['permission_id'] == 2){
                                        ?>
                                            <button type="button" id='tool-request-btn' href='#tool-request' data-toggle='modal' data-tool_id='<?php echo $toolRow["tool_id"];?>' class="btn btn-danger btn-sm" style="padding: 0; margin: 2px; width: 60px; font-size: 12px;" ><i class="fas fa-fw fa-toggle-off" style="font-size: 12px; margin-right: 4px; color: white" ></i>Request</button>
                                        <?php
                                    }
                                    else {
                                        ?>
                                            <button type="button" class="btn btn-secondary btn-sm" style="padding: 0; margin: 2px; width: 60px; font-size: 9px;" ><i class="fa fa-fw fa-toggle-on" style="font-size: 22px; color: white" ></i></button>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                }
                elseif ($_REQUEST['type'] == "3") {
                    if ($toolRow["permission_id"] == 1) {
                        $count2++;
                        ?>
                        <tr>
                            <td><img src="../../images/icons/tool_images/<?php echo $toolRow["tool_image"]; ?>"
                                    style="height: 40px; width: 40px; "></td>
                            <td>&nbsp; <?php echo $toolRow["tool_name"]; ?></td>
                            <td>&nbsp; <?php echo $toolRow["website"]; ?></td>
                            <td>&nbsp; <?php echo $toolRow["category_name"]; ?></td>
                            <td>&nbsp; <?php echo $toolRow["permission"]; ?></td>
                            <td>
                                <div class="btn-group d-flex">
                                    <?php
                                    if($toolRow['permission_id'] == 2){
                                        ?>
                                            <button type="button" id='tool-request-btn' href='#tool-request' data-toggle='modal' data-tool_id='<?php echo $toolRow["tool_id"];?>' class="btn btn-danger btn-sm" style="padding: 0; margin: 2px; width: 60px; font-size: 12px;" ><i class="fas fa-fw fa-toggle-off" style="font-size: 12px; margin-right: 4px; color: white" ></i>Request</button>
                                        <?php
                                    }
                                    else {
                                        ?>
                                            <button type="button" class="btn btn-secondary btn-sm" style="padding: 0; margin: 2px; width: 60px; font-size: 9px;" ><i class="fa fa-fw fa-toggle-on" style="font-size: 22px; color: white" ></i></button>
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
                    $count3++;
                    ?>
                    <tr>
                        <td><img src="../../images/icons/tool_images/<?php echo $toolRow["tool_image"]; ?>"
                                style="height: 40px; width: 40px; "></td>
                        <td>&nbsp; <?php echo $toolRow["tool_name"]; ?></td>
                        <td>&nbsp; <?php echo $toolRow["website"]; ?></td>
                        <td>&nbsp; <?php echo $toolRow["category_name"]; ?></td>
                        <td>&nbsp; <?php echo $toolRow["permission"]; ?></td>
                        <td>
                            <div class="btn-group d-flex">
                                <?php
                                if($toolRow['permission_id'] == 2){
                                    ?>
                                        <button type="button" id='tool-request-btn' href='#tool-request' data-toggle='modal' data-tool_id='<?php echo $toolRow["tool_id"];?>' class="btn btn-danger btn-sm" style="padding: 0; margin: 2px; width: 60px; font-size: 12px;" ><i class="fas fa-fw fa-toggle-off" style="font-size: 12px; margin-right: 4px; color: white" ></i>Request</button>
                                    <?php
                                }
                                else {
                                    ?>
                                        <button type="button" class="btn btn-secondary btn-sm" style="padding: 0; margin: 2px; width: 60px; font-size: 9px;" ><i class="fa fa-fw fa-toggle-on" style="font-size: 22px; color: white" ></i></button>
                                    <?php
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                }

            }

            if($count1==0 && $count2==0 && $count3==0) {
                ?>
                <tr>
                    <td align="center" style="text-align:center; color:red" colspan="10">No result found</td>
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
    echo 'Invalid Freelancer';
}
?>