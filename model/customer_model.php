<?php

include_once realpath(dirname(__FILE__)."/../commons/dbConnection.php");
$dbConnObj = new dbConnetion();

class Customer{
    
    function validateCustomerEmail($email) {
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
    
    function addCustomer($customer_fname, $customer_lname, $customer_email, $customer_country, $customer_dob, $customer_gender, $customer_phone, $customer_image, $customer_status) {
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
    
    function addCustomerLogin($customer_login_username, $customer_login_password, $customer_id, $customer_login_status) {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO customer_login(customer_login_username, customer_login_password, customer_id, customer_login_status)
               VALUES('$customer_login_username', '$customer_login_password', '$customer_id', '1')";
        $con->query($sql);
        $customerLoginId = $con->insert_id;
        return $customerLoginId;
    }

    function requestQuote($customer_id,$subject,$requirements) {

        $con = $GLOBALS['con'];
        $sql = "INSERT 
                    INTO 
                quotations
                    (customer_id, subject, requirements)
                VALUES
                    ('$customer_id', '$subject', '$requirements')";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }

    function getQuoteForStatus($status,$customer_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    q.quotation_id,
                    q.subject,
                    q.requirements,
                    IFNULL(q.remarks,'No') AS remarks,
                    q.status AS status_id,
                    IF(q.status=1,'Pending',
                    IF(q.status=2,'Submitted',
                        IF(q.status=3, 'Approved',
                        IF(q.status=4, 'Rejected','')))) AS status
                FROM
                    quotations q
                WHERE
                    q.customer_id = '$customer_id'
                    $status";
        $results = $con->query($sql);

        return $results;
    }
    
}