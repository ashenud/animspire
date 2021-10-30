
<?php
include '../../../commons/session.php';
include '../../../model/freelancer_model.php';
$freelancerObj = new Freelancer(); /// create feelancer object

$type ="";
if ($_REQUEST['type'] == "0") {
    $type = "";
}
elseif ($_REQUEST['type'] == "1") {
    $type = "AND t.priority_level = '3'";
}
elseif ($_REQUEST['type'] == "2") {
    $type = "AND t.priority_level = '2'";
}
elseif ($_REQUEST['type'] == "3") {
    $type = "AND t.task_timeline = '1'";
}
elseif ($_REQUEST['type'] == "4") {
    $type = "AND t.task_timeline = '0'";
}

$project_id = $_REQUEST['project_id'];
$freelancer_id = $_SESSION["freelancer"]["freelancer_id"];
$tasks = $freelancerObj->getAllTaskDetailsSearch($freelancer_id,$project_id,$type);

if(isset($_SESSION["freelancer"])) {
?>

    <table class="project-table" border="1" >
        <tr>
            <th width="35px"></th>
            <th width="500px">&nbsp;Task Name</th>
            <th width="160px">&nbsp;Start Date</th>
            <th width="160px">&nbsp;End Date</th>
            <th width="35px"></th>
        </tr>

        <?php
        if($tasks->num_rows >0) {
            while($task = $tasks->fetch_assoc()) {
            ?>
            <tr>
                <td>
                    <?php
                    if($task["priority_id"] == 1) {
                        ?>
                        <button type="button" class="btn btn-info" style="width: 30px; height: 30px; font-size: 18px">  <span class="fas fa-bolt"></span></button>
                        <?php
                    }
                    elseif($task["priority_id"] == 2) {
                        ?>
                        <button type="button" class="btn btn-warning" style="width: 30px; height: 30px; font-size: 18px">  <span class="fas fa-bolt"></span></button>
                        <?php
                    }
                    elseif($task["priority_id"] == 3) {
                        ?>
                        <button type="button" class="btn btn-danger" style="width: 30px; height: 30px; font-size: 18px">  <span class="fas fa-bolt"></span></button>
                        <?php
                    }      
                    ?>    
                </td>
                <td>&nbsp; <?php echo $task["task_name"]; ?></td>
                <td>&nbsp; <?php echo $task["t_start_date"]; ?></td>
                <td>&nbsp; <?php echo $task["t_end_date"]; ?></td>
                <?php
                if($task["task_timeline"] == 0) {
                    ?>
                    <td>
                        <button type="button" id='task-stage-btn' href='#task-stage' data-toggle='modal' data-task_id='<?php echo $task["task_id"];?>' data-project_id='<?php echo $task["project_id"];?>'
                        class="btn btn-warning" style="width: 30px; height: 30px; font-size: 18px">
                            <span class="fas fa-redo-alt"></span>
                        </button>
                    </td>
                    <?php
                }
                else {
                    ?>
                    <td>
                        <button type="button" class="btn btn-success" style="width: 30px; height: 30px; font-size: 18px">
                            <span class="fas fa-check"></span>
                        </button>
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