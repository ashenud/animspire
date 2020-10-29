<?php

include_once '../commons/dbConnection.php';
$dbConnObj = new dbConnetion();

class customerLogin{
    
    public function validateCustomerLogin($username, $password) 
    {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM customer c , customer_login l"
              . " WHERE c.customer_id = l.customer_id"
              . " AND l.customer_login_username = '$username'"
              . " AND l.customer_login_password = '$password'";
      $result = $con->query($sql);
      return $result;
    }
    public function getCustomerLoginDetails($customerId)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM customer_login WHERE customer_id = '$customerId'";
        $results = $con->query($sql);
        return $results;
    }
    
}