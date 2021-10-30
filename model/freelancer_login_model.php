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

    public function updateFrogetPassword($email, $newPw) {
        $con = $GLOBALS['con'];
        $sql = "UPDATE freelancer_login SET freelancer_login_password = '$newPw' WHERE freelancer_login_username = '$email'";
        $results = $con->query($sql);
        return $results;
    }

    public function insertResetCode($reset_code, $reset_email) {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO 
                    reset_password(reset_code,reset_email) 
                VALUES ('{$reset_code}','{$reset_email}')";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }

    public function checkResetCode($code) {
        $con = $GLOBALS['con'];
        $sql = "SELECT
                    reset_email 
                FROM 
                    reset_password 
                WHERE reset_code='$code'";
        $results = $con->query($sql);
        
        return $results;
    }

    public function deleteRestCode($email) {
        $con = $GLOBALS['con'];
        $sql = "DELETE FROM 
                    reset_password 
                WHERE 
                    reset_email='{$email}'";
        $results = $con->query($sql);
        
        return $results;
    }
    
}