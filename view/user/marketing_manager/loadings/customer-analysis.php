<?php
include '../../../../commons/session.php';
include '../../../../model/user_model.php';
include_once realpath(dirname(__FILE__)."/../commons/dbConnection.php");
$dbConnObj = new dbConnetion();

$customer_id=$_POST['customer_id'];

$customer_name = getCustomerName($customer_id)->fetch_assoc()['cus_name'];
$quote_count = getAllQuote($customer_id)->fetch_assoc()['total'];
$approved_quote_count = getApprovedQuote($customer_id)->fetch_assoc()['total'];
$rejected_quote_count = getRejectedQuote($customer_id)->fetch_assoc()['total'];
$pending_payment_count = getPendingPayment($customer_id)->fetch_assoc()['total'];
$paid_payment_count = getPaidPayment($customer_id)->fetch_assoc()['total'];


$result = array();
$series = array();

$series[0]['name'] = 'All Quotations';
$series[0]['data'][] = (float)$quote_count;
$series[1]['name'] = 'Approved Quotations';
$series[1]['data'][] = (float)$approved_quote_count;
$series[2]['name'] = 'Rejected Quotations';
$series[2]['data'][] = (float)$rejected_quote_count;
$series[3]['name'] = 'Pending Payments';
$series[3]['data'][] = (float)$pending_payment_count;
$series[4]['name'] = 'Settled Payments';
$series[4]['data'][] = (float)$paid_payment_count;

$result['customer_id'] = $customer_id;
$result['customer_name'] = $customer_name;
$result['quote_count'] = $quote_count;
$result['approved_quote_count'] = $approved_quote_count;
$result['rejected_quote_count'] = $rejected_quote_count;
$result['pending_payment_count'] = $pending_payment_count;
$result['paid_payment_count'] = $paid_payment_count;
$result['series'] = $series;

echo json_encode($result);


function getCustomerName($customer_id) {

    $con = $GLOBALS['con'];
    $query="SELECT
                CONCAT(c.customer_fname, ' ', c.customer_lname) AS cus_name
            FROM
                customer c
            WHERE
                c.customer_id = '$customer_id'
            LIMIT 1";
    $results = $con->query($query);
    return $results;
}

function getAllQuote($customer_id) {

    $con = $GLOBALS['con'];
    $query="SELECT
                COUNT(q.quotation_id) AS total
            FROM
                customer c
                    INNER JOIN
                quotations q ON q.customer_id = c.customer_id
            WHERE
                c.customer_id = '$customer_id'";
    $results = $con->query($query);
    return $results;
}

function getApprovedQuote($customer_id) {

    $con = $GLOBALS['con'];
    $query="SELECT
                COUNT(q.quotation_id) AS total
            FROM
                customer c
                    INNER JOIN
                quotations q ON q.customer_id = c.customer_id
            WHERE
                q.status = 3
                AND c.customer_id = '$customer_id'";
    $results = $con->query($query);
    return $results;
}

function getRejectedQuote($customer_id) {

    $con = $GLOBALS['con'];
    $query="SELECT
                COUNT(q.quotation_id) AS total
            FROM
                customer c
                    INNER JOIN
                quotations q ON q.customer_id = c.customer_id
            WHERE
                q.status = 4
                AND c.customer_id = '$customer_id'";
    $results = $con->query($query);
    return $results;
}

function getPendingPayment($customer_id) {

    $con = $GLOBALS['con'];
    $query="SELECT
                COUNT(p.payment_id) AS total
            FROM
                payment p
            WHERE
                p.status = 1
                AND p.customer_id = '$customer_id'";
    $results = $con->query($query);
    return $results;
}

function getPaidPayment($customer_id) {

    $con = $GLOBALS['con'];
    $query="SELECT
                COUNT(p.payment_id) AS total
            FROM
                payment p
            WHERE
                p.status = 2
                AND p.customer_id = '$customer_id'";
    $results = $con->query($query);
    return $results;
}

?>