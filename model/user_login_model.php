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
    public function updatePassword($userId, $newPw)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE user_login SET user_login_password = '$newPw' WHERE user_id = '$userId'";
        $results = $con->query($sql);
        return $results;
    }
    
}