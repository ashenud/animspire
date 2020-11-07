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

    function viewCustomer($customer_id) {
        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    * 
                FROM 
                    customer c 
                WHERE 
                    c.customer_id = '$customer_id'
                LIMIT 1";
        $results = $con->query($sql);
        return $results;
    }

    function updateEmailValidation($userId, $email) {
        $con = $GLOBALS['con'];
        $sql = "SELECT 1 FROM customer WHERE customer_email = '$email' AND customer_id != '$userId'";
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

    function updateCustomer($customerId, $customer_fname, $customer_lname, $customer_email, $customer_dob, $customer_phone, $customer_image, $customer_status) {
        $con = $GLOBALS['con'];
        
        if($customer_image!="defaultImage.png")
        {
        $sql = "UPDATE customer SET "
                . "customer_fname = '$customer_fname',"
                . "customer_lname = '$customer_lname',"
                . "customer_email = '$customer_email',"
                . "customer_dob = '$customer_dob',"
                . "customer_phone = '$customer_phone',"
                . "customer_image = '$customer_image'"
                . "WHERE customer_id = '$customerId'";
        }
        else 
        {
            $sql = "UPDATE customer SET "
                . "customer_fname = '$customer_fname',"
                . "customer_lname = '$customer_lname',"
                . "customer_email = '$customer_email',"
                . "customer_dob = '$customer_dob',"
                . "customer_phone = '$customer_phone'"
                . "WHERE customer_id = '$customerId'";
        }
        $result = $con->query($sql) or die($con->error);
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

    function editQuote($quotation_id,$subject,$requirements) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    quotations
                SET
                    subject = '$subject',
                    requirements = '$requirements',
                    date_updated = now(),
                    status = 1
                WHERE
                    quotation_id = '$quotation_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }

    function approveQuote($quotation_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    quotations
                SET
                    status = 3
                WHERE
                    quotation_id = '$quotation_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }

    function rejectQuote($quotation_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    quotations
                SET
                    status = 4
                WHERE
                    quotation_id = '$quotation_id'";
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
                    IFNULL(q.remarks,'No remarks') AS remarks,
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

    function qouteCount() {

        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    quotation_id 
                FROM 
                    quotations
                WHERE
                    status = 2";
        $results = $con->query($sql);
        
        return $results;       

    }
    
}