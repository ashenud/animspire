<?php
include '../../../../commons/session.php';
include '../../../../model/user_model.php';
include_once realpath(dirname(__FILE__)."/../commons/dbConnection.php");
$dbConnObj = new dbConnetion();

$freelancer1_id=$_POST['freelancer1_id'];
$freelancer2_id=$_POST['freelancer2_id'];

$task_count1 = getTotalTasks($freelancer1_id)->fetch_assoc()['total'];
$task_count2 = getTotalTasks($freelancer2_id)->fetch_assoc()['total'];
$completed_task_count1 = getCompletedTasks($freelancer1_id)->fetch_assoc()['total'];
$completed_task_count2 = getCompletedTasks($freelancer2_id)->fetch_assoc()['total'];
$pending_task_count1 = getPendingTasks($freelancer1_id)->fetch_assoc()['total'];
$pending_task_count2 = getPendingTasks($freelancer2_id)->fetch_assoc()['total'];

$result = array();
$series = array();

$series[0]['name'] = 'Total Task';
$series[0]['data'][] = (float)$task_count1;
array_push($series[0]['data'],(float)$task_count2);

$series[1]['name'] = 'Completed Task';
$series[1]['data'][] = (float)$completed_task_count1;
array_push($series[1]['data'],(float)$completed_task_count2);

$series[2]['name'] = 'Pending Task';
$series[2]['data'][] = (float)$pending_task_count1;
array_push($series[2]['data'],(float)$pending_task_count2);

$result['series'] = $series;

echo json_encode($result);


function getTotalTasks($freelancer_id) {

    $con = $GLOBALS['con'];
    $query="SELECT
                COUNT(t.task_id) AS total
            FROM
                task t
                    INNER JOIN
                project p ON p.project_id = t.project_id
            WHERE
                p.freelancer_id = '$freelancer_id'
                AND p.project_manager_id = '".$_SESSION['user']['user_id']."'
                AND p.project_status = 0
                AND t.task_status = 0
            LIMIT 1";
    $results = $con->query($query);
    return $results;
}

function getCompletedTasks($freelancer_id) {

    $con = $GLOBALS['con'];
    $query="SELECT
                COUNT(t.task_id) AS total
            FROM
                task t
                    INNER JOIN
                project p ON p.project_id = t.project_id
            WHERE
                p.freelancer_id = '$freelancer_id'
                AND t.task_timeline = 1
                AND p.project_manager_id = '".$_SESSION['user']['user_id']."'
                AND p.project_status = 0
                AND t.task_status = 0
            LIMIT 1";
    $results = $con->query($query);
    return $results;
}

function getPendingTasks($freelancer_id) {

    $con = $GLOBALS['con'];
    $query="SELECT
                COUNT(t.task_id) AS total
            FROM
                task t
                    INNER JOIN
                project p ON p.project_id = t.project_id
            WHERE
                p.freelancer_id = '$freelancer_id'
                AND t.task_timeline = 0
                AND p.project_manager_id = '".$_SESSION['user']['user_id']."'
                AND p.project_status = 0
                AND t.task_status = 0
            LIMIT 1";
    $results = $con->query($query);
    return $results;
}

?>