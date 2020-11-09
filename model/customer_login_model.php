<?php

include_once realpath(dirname(__FILE__)."/../commons/dbConnection.php");
$dbConnObj = new dbConnetion();

class customerLogin{
    
    public function validateCustomerLogin($username, $password) {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM customer c , customer_login l"
              . " WHERE c.customer_id = l.customer_id"
              . " AND l.customer_login_username = '$username'"
              . " AND l.customer_login_password = '$password'";
      $result = $con->query($sql);
      return $result;
    }

    public function getCustomerLoginDetails($customerId) {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM customer_login WHERE customer_id = '$customerId'";
        $results = $con->query($sql);
        return $results;
    }

    public function updatePassword($customerId, $newPw) {
        $con = $GLOBALS['con'];
        $sql = "UPDATE customer_login SET customer_login_password = '$newPw' WHERE customer_id = '$customerId'";
        $results = $con->query($sql);
        return $results;
    }

    public function updateFrogetPassword($email, $newPw) {
        $con = $GLOBALS['con'];
        $sql = "UPDATE customer_login SET customer_login_password = '$newPw' WHERE customer_login_username = '$email'";
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