<?php

include_once '../commons/dbConnection.php';
$dbConnObj = new dbConnetion();

class freelancerLogin{
    
    public function validateFreelancerLogin($username, $password) 
    {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM freelancer f , freelancer_login l"
              . " WHERE f.freelancer_id = l.freelancer_id"
              . " AND l.freelancer_login_username = '$username'"
              . " AND l.freelancer_login_password = '$password'";
      $result = $con->query($sql);
      return $result;
    }
    
}