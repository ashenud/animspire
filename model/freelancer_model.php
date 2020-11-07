<?php

include_once realpath(dirname(__FILE__)."/../commons/dbConnection.php");
$dbConnObj = new dbConnetion();

class Freelancer{
    
    function validateFreelancerEmail($email) {
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
    
    function addFreelancer($freelancer_fname, $freelancer_lname, $freelancer_email, $freelancer_country, $freelancer_dob, $freelancer_gender, $freelancer_phone, $freelancer_image, $freelancer_status) {
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
    
    function addFreelancerLogin($freelancer_login_username, $freelancer_login_password, $freelancer_id, $freelancer_login_status) {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO freelancer_login(freelancer_login_username, freelancer_login_password, freelancer_id, freelancer_login_status)
               VALUES('$freelancer_login_username', '$freelancer_login_password', '$freelancer_id', '0')";
        $con->query($sql);
        $freelancerLoginId = $con->insert_id;
        return $freelancerLoginId;
    }
    
    function viewFreelancer($freelancer_id) {
        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    * 
                FROM 
                    freelancer f
                WHERE 
                    f.freelancer_id = '$freelancer_id'
                LIMIT 1";
        $results = $con->query($sql);
        return $results;
    }

    function updateEmailValidation($freelancerId, $email) {
        $con = $GLOBALS['con'];
        $sql = "SELECT 1 FROM freelancer WHERE freelancer_email = '$email' AND freelancer_id != '$freelancerId'";
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

    function updateFreelancer($freelancerId, $freelancer_fname, $freelancer_lname, $freelancer_email, $freelancer_dob, $freelancer_phone, $freelancer_image, $freelancer_status) {
        $con = $GLOBALS['con'];
        
        if($freelancer_image!="defaultImage.png")
        {
        $sql = "UPDATE freelancer SET "
                . "freelancer_fname = '$freelancer_fname',"
                . "freelancer_lname = '$freelancer_lname',"
                . "freelancer_email = '$freelancer_email',"
                . "freelancer_dob = '$freelancer_dob',"
                . "freelancer_phone = '$freelancer_phone',"
                . "freelancer_image = '$freelancer_image'"
                . "WHERE freelancer_id = '$freelancerId'";
        }
        else 
        {
            $sql = "UPDATE freelancer SET "
                . "freelancer_fname = '$freelancer_fname',"
                . "freelancer_lname = '$freelancer_lname',"
                . "freelancer_email = '$freelancer_email',"
                . "freelancer_dob = '$freelancer_dob',"
                . "freelancer_phone = '$freelancer_phone'"
                . "WHERE freelancer_id = '$freelancerId'";
        }
        $result = $con->query($sql) or die($con->error);
    }

    
    
    
}