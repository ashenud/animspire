<?php

include_once '../commons/dbConnection.php';
$dbConnObj = new dbConnetion();

class Customer{
    
    function validateCustomerEmail($email)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT 1 FROM customer WHERE customer_email='$email'";
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
    
    function addCustomer($customer_fname, $customer_lname, $customer_email, $customer_country, $customer_dob, $customer_gender, $customer_phone, $customer_image, $customer_status)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO customer(customer_fname,
                                    customer_lname,
                                    customer_email,	
                                    customer_country,
                                    customer_dob,
                                    customer_gender,
                                    customer_phone,
                                    customer_image,
                                    customer_status
                                    )VALUES(
                                    '$customer_fname', '$customer_lname', '$customer_email', '$customer_country', '$customer_dob', '$customer_gender', '$customer_phone', '$customer_image', '$customer_status'
                                     )";
        $result = $con->query($sql);
        $customerId = $con->insert_id;
        return $customerId;
    }
    
    function addCustomerLogin($customer_login_username, $customer_login_password, $customer_id, $customer_login_status)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO customer_login(customer_login_username, customer_login_password, customer_id, customer_login_status)
               VALUES('$customer_login_username', '$customer_login_password', '$customer_id', '1')";
        $con->query($sql);
        $customerLoginId = $con->insert_id;
        return $customerLoginId;
    }
    
}