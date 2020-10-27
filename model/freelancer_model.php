<?php

include_once '../commons/dbConnection.php';
$dbConnObj = new dbConnetion();

class Freelancer{
    
    function validateFreelancerEmail($email)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM freelancer WHERE freelancer_email = '$email'";
        $result = $con->query($sql);
        if($result->num_rows>0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    function addFreelancer($freelancer_fname, $freelancer_lname, $freelancer_email, $freelancer_country, $freelancer_dob, $freelancer_gender, $freelancer_phone, $freelancer_image, $freelancer_status)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO freelancer(freelancer_fname,
                                    freelancer_lname,
                                    freelancer_email,	
                                    freelancer_country,
                                    freelancer_dob,
                                    freelancer_gender,
                                    freelancer_phone,
                                    freelancer_image,
                                    freelancer_status
                                    )VALUES(
                                    '$freelancer_fname', '$freelancer_lname', '$freelancer_email', '$freelancer_country', '$freelancer_dob', '$freelancer_gender', '$freelancer_phone', '$freelancer_image', '$freelancer_status'
                                     )";
        $result = $con->query($sql);
        $freelancerId = $con->insert_id;
        return $freelancerId;
    }
    
    function addFreelancerLogin($freelancer_login_username, $freelancer_login_password, $freelancer_id, $freelancer_login_status)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO freelancer_login(freelancer_login_username, freelancer_login_password, freelancer_id, freelancer_login_status)
               VALUES('$freelancer_login_username', '$freelancer_login_password', '$freelancer_id', '1')";
        $con->query($sql);
        $freelancerLoginId = $con->insert_id;
        return $freelancerLoginId;
    }
    
    
    
    
}