<?php

include_once '../commons/dbConnection.php';
$dbConnObj = new dbConnetion();

class userLogin{
    
    public function validateUserLogin($username, $password) 
    {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM user u , user_login l"
              . " WHERE u.user_id = l.user_id"
              . " AND l.user_login_username = '$username'"
              . " AND l.user_login_password = '$password'";
      $result = $con->query($sql);
      return $result;
    }
    public function getUserLoginDetails($userId)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM user_login WHERE user_id = '$userId'";
        $results = $con->query($sql);
        return $results;
    }
    public function updatePassword($userId, $newPw) {
        $con = $GLOBALS['con'];
        $sql = "UPDATE user_login SET user_login_password = '$newPw' WHERE user_id = '$userId'";
        $results = $con->query($sql);
        return $results;
    }

    public function updateFrogetPassword($email, $newPw) {
        $con = $GLOBALS['con'];
        $sql = "UPDATE user_login SET user_login_password = '$newPw' WHERE user_login_username = '$email'";
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