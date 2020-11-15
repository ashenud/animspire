<?php
include '../../../../commons/session.php';
include '../../../../model/user_model.php';
include_once realpath(dirname(__FILE__)."/../commons/dbConnection.php");
$dbConnObj = new dbConnetion();

$project1_id=$_POST['project1_id'];
$project2_id=$_POST['project2_id'];

$task_count1 = getTotalTasks($project1_id)->fetch_assoc()['total'];
$task_count2 = getTotalTasks($project2_id)->fetch_assoc()['total'];
$completed_task_count1 = getCompletedTasks($project1_id)->fetch_assoc()['total'];
$completed_task_count2 = getCompletedTasks($project2_id)->fetch_assoc()['total'];
$pending_task_count1 = getPendingTasks($project1_id)->fetch_assoc()['total'];
$pending_task_count2 = getPendingTasks($project2_id)->fetch_assoc()['total'];

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


function getTotalTasks($project_id) {

    $con = $GLOBALS['con'];
    $query="SELECT
                COUNT(t.task_id) AS total
            FROM
                task t
            WHERE
                t.project_id = '$project_id'
                AND t.task_status = 0
            LIMIT 1";
    $results = $con->query($query);
    return $results;
}

function getCompletedTasks($project_id) {

    $con = $GLOBALS['con'];
    $query="SELECT
                COUNT(t.task_id) AS total
            FROM
                task t
            WHERE
                t.task_timeline = 1
                AND t.project_id = '$project_id'
                AND t.task_status = 0
            LIMIT 1";
    $results = $con->query($query);
    return $results;
}

function getPendingTasks($project_id) {

    $con = $GLOBALS['con'];
    $query="SELECT
                COUNT(t.task_id) AS total
            FROM
                task t
            WHERE
                t.task_timeline = 0
                AND t.project_id = '$project_id'
                AND t.task_status = 0
            LIMIT 1";
    $results = $con->query($query);
    return $results;
}

?>