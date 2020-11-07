<?php

include_once realpath(dirname(__FILE__)."/../commons/dbConnection.php");
$dbConnObj = new dbConnetion();

class freelancerLogin{
    
    public function validateFreelancerLogin($username, $password) {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM freelancer f , freelancer_login l"
                . " WHERE f.freelancer_id = l.freelancer_id"
                . " AND l.freelancer_login_username = '$username'"
                . " AND l.freelancer_login_password = '$password'"
                . " AND f.freelancer_status = 1";
        $result = $con->query($sql);
        return $result;
    }

    public function getFreelancerLoginDetails($freelancerId) {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM freelancer_login WHERE freelancer_id = '$freelancerId'";
        $results = $con->query($sql);
        return $results;
    }

    public function updatePassword($freelancerId, $newPw) {
        $con = $GLOBALS['con'];
        $sql = "UPDATE freelancer_login SET freelancer_login_password = '$newPw' WHERE freelancer_id = '$freelancerId'";
        $results = $con->query($sql);
        return $results;
    }
    
}