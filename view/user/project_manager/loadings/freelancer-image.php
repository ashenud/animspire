<?php
include '../../../../commons/session.php';
include '../../../../model/user_model.php';
include_once realpath(dirname(__FILE__)."/../commons/dbConnection.php");
$dbConnObj = new dbConnetion();

echo  getFreelancerImage($_POST['freelancer_id'])->fetch_assoc()['image'];


function getFreelancerImage($freelancer_id) {

    $con = $GLOBALS['con'];
    $query="SELECT
                f.freelancer_image AS image
            FROM
                freelancer f
            WHERE
                f.freelancer_id = '$freelancer_id'
            LIMIT 1";
    $results = $con->query($query);
    return $results;
}

?>