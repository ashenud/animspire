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

    function qouteCount($customer_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    quotation_id 
                FROM 
                    quotations
                WHERE
                    status = 2
                    AND customer_id = '$customer_id'";
        $results = $con->query($sql);
        
        return $results;       

    }

    function paymentReqCount($customer_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    payment_id 
                FROM 
                    payment
                WHERE
                    status = 1
                    AND customer_id = '$customer_id'";
        $results = $con->query($sql);
        
        return $results;       

    }

    function getPaymentDetails($customer_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    p.payment_id,
                    p.quotation_id,
                    q.subject,
                    CONCAT(c.customer_fname, ' ', c.customer_lname) AS name,
                    c.customer_country AS address,
                    p.payment_description,
                    p.amount,
                    p.paid_amount,
                    p.payment_method,
                    DATE(p.requested_date) AS requested_date,
                    IFNULL(DATE(p.paid_date),'-') AS paid_date,
                    p.status
                FROM 
                    payment p
                        INNER JOIN
                    customer c ON c.customer_id = p.customer_id
                        INNER JOIN
                    quotations q ON q.quotation_id = p.quotation_id
                WHERE
                    p.customer_id = '$customer_id'";
        $results = $con->query($sql);

        return $results;
    }

    function getPaymentForPaymentId($payment_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    p.payment_id,
                    p.quotation_id,
                    q.subject,
                    CONCAT(c.customer_fname, ' ', c.customer_lname) AS name,
                    p.payment_description,
                    p.amount,
                    p.paid_amount,
                    p.payment_method,
                    DATE(p.requested_date) AS requested_date,
                    IFNULL(DATE(p.paid_date),'-') AS paid_date,
                    p.status
                FROM 
                    payment p
                        INNER JOIN
                    customer c ON c.customer_id = p.customer_id
                        INNER JOIN
                    quotations q ON q.quotation_id = p.quotation_id
                WHERE
                    p.payment_id = '$payment_id'";
        $results = $con->query($sql);

        return $results;
    }
    
    function getQuoteForPaymentId($id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    q.quotation_id,
                    c.customer_id,
                    CONCAT(c.customer_fname, ' ', c.customer_lname) AS name,
                    q.subject,
                    q.requirements,
                    IFNULL(q.remarks,'') AS remarks,
                    q.status AS status_id,
                    IF(q.status=1,'Pending',
                    IF(q.status=2,'Submitted',
                        IF(q.status=3, 'Approved',
                        IF(q.status=4, 'Rejected','')))) AS status
                FROM
                    quotations q
                        INNER JOIN
                    customer c ON c.customer_id = q.customer_id
                        INNER JOIN
                    payment p ON p.quotation_id = q.quotation_id
                WHERE
                    p.payment_id = '$id'
                LIMIT 1";
        $results = $con->query($sql);

        return $results;
    }

    function settlePayment($payment_id,$total) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    payment
                SET
                    paid_amount = '$total',
                    payment_method = 'PayPal',
                    paid_date = now(),
                    status = 2
                WHERE
                    payment_id = '$payment_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }    
    
    function getCustomerProjectDetails($customer_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    p.project_id,
                    p.project_name,
                    p.description,
                    p.quotation_id,
                    py.paid_amount,
                    c.customer_id,
                    c.customer_image,
                    CONCAT(c.customer_fname, ' ', c.customer_lname) AS cus_name,
                    p.project_manager_id,
                    CONCAT(u.user_fname, ' ', u.user_lname) AS pro_name,
                    IFNULL(p.freelancer_id,0) AS freelancer_id,
                    p.start_date,
                    p.end_date,
                    p.project_timeline
                FROM
                    project p
                        INNER JOIN
                    customer c ON c.customer_id = p.customer_id
                        INNER JOIN
                    user u ON u.user_id = p.project_manager_id
                        INNER JOIN
                    payment py ON py.quotation_id = p.quotation_id
                WHERE
                    c.customer_status = 1
                    AND p.project_status = 0
                    AND p.customer_id = '$customer_id'";
        $results = $con->query($sql);

        return $results;
    }    
    
    function getTotalTaskCount($project_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    t.task_id,
                    p.project_id
                FROM
                    task t
                        INNER JOIN
                    project p ON p.project_id = t.project_id
                WHERE
                    t.task_status = 0
                    AND p.project_status = 0
                    AND p.project_id = '$project_id'";
        $results = $con->query($sql);

        return $results;
    }

    function getCompletedTaskCount($project_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    t.task_id,
                    p.project_id
                FROM
                    task t
                        INNER JOIN
                    project p ON p.project_id = t.project_id
                WHERE
                    t.task_status = 0
                    AND t.task_timeline = 1
                    AND p.project_status = 0
                    AND p.project_id = '$project_id'";
        $results = $con->query($sql);

        return $results;
    }

    
}