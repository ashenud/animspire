<?php

include_once realpath(dirname(__FILE__)."/../commons/dbConnection.php");
$dbConnObj = new dbConnetion();

class User{
    
    function validateUserEmail($email) {
        $con = $GLOBALS['con'];
        $sql = "SELECT 1 FROM user WHERE user_email = '$email'";
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
    
    function addUser($user_fname, $user_lname, $user_email, $user_role, $user_dob, $user_gender, $user_phone, $user_image, $user_status) {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO user(user_fname,
                                    user_lname,
                                    user_email,	
                                    user_role,
                                    user_dob,
                                    user_gender,
                                    user_phone,
                                    user_image,
                                    user_status
                                    )VALUES(
                                    '$user_fname', '$user_lname', '$user_email', '$user_role', '$user_dob', '$user_gender', '$user_phone', '$user_image', '$user_status'
                                     )";
        $result = $con->query($sql);
        $userId = $con->insert_id;
        return $userId;
    }
    
    function addUserLogin($user_login_username, $user_login_password, $user_id, $user_login_status) {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO user_login(user_login_username, user_login_password, user_id, user_login_status)
               VALUES('$user_login_username', '$user_login_password', '$user_id', '1')";
        $con->query($sql);
        $userLoginId = $con->insert_id;
        return $userLoginId;
    }

    function checkUser($role_id) {

        $msg = "You have no permission to vist there !";
        $msg = base64_encode($msg);

        if ($role_id == 1) {
            ?>
                <script> window.location = "../system_admin/admin-dashboard.php?msg=<?php echo $msg; ?>"</script>
            <?php
        }
        elseif ($role_id == 2) {
            ?>
                <script> window.location = "../project_manager/pro-manager-dashboard.php?msg=<?php echo $msg; ?>"</script>
            <?php
        }
        elseif ($role_id == 3) {
            ?>
                <script> window.location = "../finance_manager/finance-manager-dashboard.php?msg=<?php echo $msg; ?>"</script>
            <?php
        }
        elseif ($role_id == 4) {
            ?>
                <script> window.location = "../marketing_manager/marketing-manager-dashboard.php?msg=<?php echo $msg; ?>"</script>
            <?php
        }
        else {
            ?>
                <script> window.location = "../../../index.php?msg=<?php echo $msg; ?>"</script>
            <?php
        }
    }

    function deactivateUser($userId) {
        $con = $GLOBALS['con'];
        $sql = "UPDATE user SET user_status='0' WHERE user_id = '$userId'";
        $results = $con->query($sql);
    }

    function activateUser($userId) {
        $con = $GLOBALS['con'];
        $sql = "UPDATE user SET user_status='1' WHERE user_id = '$userId'";
        $results = $con->query($sql);
    }

    function viewUser($userId) {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM user u, user_role r WHERE u.user_role = r.role_id AND u.user_id = '$userId'";
        $results = $con->query($sql);
        return $results;
    }

    function updateEmailValidation($userId, $email) {
        $con = $GLOBALS['con'];
        $sql = "SELECT 1 FROM user WHERE user_email = '$email' AND user_id != '$userId'";
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

    function updateUser($userId, $user_fname, $user_lname, $user_email, $user_role, $user_dob, $user_gender, $user_phone, $user_image, $user_status) {
        $con = $GLOBALS['con'];
        
        if($user_image!="defaultImage.png")
        {
        $sql = "UPDATE user SET "
                . "user_fname = '$user_fname',"
                . "user_lname = '$user_lname',"
                . "user_email = '$user_email',"
                . "user_role = '$user_role',"
                . "user_dob = '$user_dob',"
                . "user_gender = '$user_gender',"
                . "user_phone = '$user_phone',"
                . "user_image = '$user_image'"
                . "WHERE user_id = '$userId'";
        }
        else 
        {
            $sql = "UPDATE user SET "
                . "user_fname = '$user_fname',"
                . "user_lname = '$user_lname',"
                . "user_email = '$user_email',"
                . "user_role = '$user_role',"
                . "user_dob = '$user_dob',"
                . "user_gender = '$user_gender',"
                . "user_phone = '$user_phone'"
                . "WHERE user_id = '$userId'";
        }
        $result = $con->query($sql) or die($con->error);
    }
    
    public function getAllUsers() {
        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    * 
                FROM 
                    user u,
                    user_role r 
                WHERE 
                    u.user_role = r.role_id
                    AND u.user_status =1";
        $userResults = $con->query($sql);
        return $userResults;
    }

    public function getAllAdmins() {
        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    * 
                FROM 
                    user u
                WHERE 
                    u.user_status = 1
                    AND u.user_role = 1";
        $userResults = $con->query($sql);
        return $userResults;
    }

    public function getUserRoles() {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM user_role";
        $results = $con->query($sql);
        return $results;
    }
    
    function getAllCustomers() {
        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    * 
                FROM 
                    customer c
                WHERE 
                    c.customer_status =1";
        $results = $con->query($sql);
        return $results;
    }

    function getRoles() {
        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    *
                FROM 
                    user_role u
                ORDER BY
                    u.role_id";
        $results = $con->query($sql);
        return $results;
    }

    function getUsersForRole($role) {
        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    u.user_id AS id,
                    CONCAT(u.user_fname, ' ', u.user_lname) AS name,
                    u.user_email AS email,
                    u.user_phone AS phone,
                    ur.role_name AS designation,
                    ud.department_name AS department,
                    IF((u.user_gender = 0),'Male','Female') AS gender
                FROM 
                    user u
                        INNER JOIN
                    user_role ur ON u.user_role = ur.role_id
                        INNER JOIN
                    user_department ud ON ur.department_id = ud.department_id
                WHERE
                    u.user_status = 1
                    $role";

        $results = $con->query($sql);
        return $results;
    }

    function getUserDetails($user_id) {
        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    *
                FROM 
                    user u
                WHERE
                    u.user_status = 1
                    AND u.user_id = $user_id
                LIMIT 1";

        $results = $con->query($sql);
        return $results;
    }

    function getNotifyMessages($user_id) {

        $user_id = base64_decode($user_id);

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    GROUP_CONCAT(c.msg_id) AS msg_ids,
                    c.sender_id AS sender_id,
                    u2.user_fname AS sender_name,
                    c.message
                FROM 
                    communication c 
                        INNER JOIN
                    user u1 ON c.receiver_id = u1.user_id
                        INNER JOIN
                    user u2 ON c.sender_id = u2.user_id
                WHERE
                    u1.user_status = 1
                    AND c.receiver_id = '$user_id'
                    AND c.status = 0
                GROUP BY
                    c.sender_id
                ORDER BY 
                    c.send_date DESC
                LIMIT 5";

        $results = $con->query($sql);
        return $results;
    }

    function getMessages($user_id,$chat_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    *
                FROM            
                    (   
                        (SELECT
                                u1.user_fname AS receiver,
                                u2.user_fname AS sender,
                                c.message,
                                c.send_date
                            FROM
                                user u1
                                    INNER JOIN
                                communication c ON u1.user_id = c.receiver_id
                                    INNER JOIN
                                user u2 ON u2.user_id = c.sender_id
                            WHERE
                                u1.user_status = 1
                                AND c.receiver_id = '$user_id'
                                AND c.sender_id = '$chat_id'
                        )    
                        UNION (

                            SELECT
                                u1.user_fname AS receiver,
                                u2.user_fname AS sender,
                                c.message,
                                c.send_date
                            FROM
                                user u1
                                    INNER JOIN
                                communication c ON u1.user_id = c.receiver_id
                                    INNER JOIN
                                user u2 ON u2.user_id = c.sender_id
                            WHERE
                                u2.user_status = 1
                                AND c.receiver_id = '$chat_id'
                                AND c.sender_id = '$user_id'
                        ) 
                        ORDER BY
                            send_date DESC
                        LIMIT 15
                    ) AS messages
                ORDER BY send_date ASC";

        $results = $con->query($sql);
        return $results;
    }

    function sendMessage($receiver_id,$sender_id,$message) {

        $con = $GLOBALS['con'];
        $sql = "INSERT 
                    INTO 
                communication
                    (sender_id, receiver_id, message)
                VALUES
                    ('$sender_id', '$receiver_id', '$message')";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }

    function messageMarkAsReaded($user_id,$chat_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    communication
                SET 
                    status = 1
                WHERE
                    status = 0
                    AND sender_id = '$chat_id'
                    AND receiver_id = '$user_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }

}

class Admin {

    function getAllDbTables() {
        $connect = new PDO("mysql:host=192.168.1.101;dbname=animspire", "root", "2486");
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

    function insertBackupData($userId,$description,$backup_reference) {
        $con = $GLOBALS['con'];
        $sql = "INSERT 
                    INTO 
                backup_details
                    (user_id, description, backup_reference)
                VALUES
                    ('$userId', '$description', '$backup_reference')";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }

    function getDbBackupData($admin_id){
        $con = $GLOBALS['con'];
        $sql = "SELECT
                    bd.backup_id,
                    bd.backup_reference AS reference,
                    DATE(bd.backup_time) AS date,
                    TIME(bd.backup_time) AS time,
                    bd.description
                FROM
                    user u
                        INNER JOIN 
                    user_role ur ON u.user_role = ur.role_id
                        INNER JOIN 
                    backup_details bd ON bd.user_id = u.user_id
                WHERE
                    u.user_status = 1
                    $admin_id";

        $results = $con->query($sql);
        return $results;
    }

    function freelancerRequest(){
        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    f.freelancer_id,
                    fl.freelancer_login_id,
                    f.freelancer_fname
                FROM
                    freelancer f 
                        INNER JOIN
                    freelancer_login fl ON f.freelancer_id = fl.freelancer_id
                WHERE 
                    fl.freelancer_login_status = 0
                    AND f.freelancer_status = 1";

        $results = $con->query($sql);
        return $results;
    }

    function acceptFreelancer($fl_login_id){
        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    freelancer_login
                SET
                    freelancer_login_status = 1
                WHERE
                    freelancer_login_id = '$fl_login_id'";
        $result = $con->query($sql);

        if ($result) {
            return 1;
        }
        else {
            return 0;
        }
    }

    function getUsersForAdmin($user_id,$fname){
        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    * 
                FROM 
                    user u
                        INNER JOIN 
                    user_role r ON u.user_role = r.role_id
                WHERE 
                    u.user_id != '$user_id'
                    AND u.user_status =1
                    {$fname}
                ORDER BY
                    u.user_id";
        $userResults = $con->query($sql);
        return $userResults;
    }

    function getFreelancersSearch($fname){
        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    * 
                FROM 
                    freelancer f
                        INNER JOIN 
                    freelancer_login fl ON fl.freelancer_id = f.freelancer_id
                WHERE 
                    fl.freelancer_login_status = 1
                    {$fname}
                ORDER BY
                    f.freelancer_id";
        $userResults = $con->query($sql);
        return $userResults;
    }

    function deleteFreelancer($freelancer_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    freelancer
                SET
                    freelancer_status = '0'
                WHERE
                    freelancer_id = '$freelancer_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }

    function activateFreelancer($freelancer_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    freelancer
                SET
                    freelancer_status = '1'
                WHERE
                    freelancer_id = '$freelancer_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }
}

class MarketingManager {

    function getQuoteForStatus($status) {

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
                WHERE
                    c.customer_status = 1
                    $status";
        $results = $con->query($sql);

        return $results;
    }

    function getPaidQuote() {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    q.quotation_id,
                    p.payment_id,
                    c.customer_id,
                    c.customer_image,
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
                    c.customer_status = 1
                    AND q.status = 3
                    AND p.status = 2
                    AND p.project_status = 0";
        $results = $con->query($sql);

        return $results;
    }

    function getAssignedProjects() {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    p.project_id,
                    p.project_name,
                    p.description,
                    p.quotation_id,
                    c.customer_id,
                    c.customer_image,
                    CONCAT(c.customer_fname, ' ', c.customer_lname) AS cus_name,
                    p.project_manager_id,
                    CONCAT(u.user_fname, ' ', u.user_lname) AS pro_name,
                    p.start_date,
                    p.end_date,
                    p.project_status
                FROM
                    project p
                        INNER JOIN
                    customer c ON c.customer_id = p.customer_id
                        INNER JOIN
                    user u ON u.user_id = p.project_manager_id
                WHERE
                    c.customer_status = 1";
        $results = $con->query($sql);

        return $results;
    }

    function getAllCustomersSearch($fname){
        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    * 
                FROM 
                    customer c
                {$fname}
                ORDER BY
                    c.customer_id";
        $userResults = $con->query($sql);
        return $userResults;
    }

    function getPaymentForQuoteId($id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    p.payment_id,
                    p.quotation_id,
                    CONCAT(c.customer_fname, ' ', c.customer_lname) AS name,
                    p.payment_description,
                    p.amount,
                    p.paid_amount,
                    DATE(p.requested_date) AS requested_date,
                    IFNULL(DATE(p.paid_date),'-') AS paid_date,
                    p.status
                FROM 
                    payment p
                        INNER JOIN
                    customer c ON c.customer_id = p.customer_id
                WHERE
                    p.quotation_id = '$id'
                LIMIT 1";
        $results = $con->query($sql);

        return $results;
    }

    function sendQuote($quotation_id,$remarks) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    quotations
                SET
                    remarks = '$remarks',
                    status = 2
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

    function requestPayment($quote_id,$customer_id,$description,$total) {

        $con = $GLOBALS['con'];
        $sql = "INSERT INTO
                    payment
                    (quotation_id,customer_id,payment_description,amount)
                VALUE
                    ('$quote_id', '$customer_id', '$description', '$total')";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }

    function assignProject($project_name,$description,$quotation_id,$customer_id,$project_manager_id,$start_date,$end_date) {

        $con = $GLOBALS['con'];
        $sql = "INSERT INTO
                    project
                    (project_name,description,quotation_id,customer_id,project_manager_id,start_date,end_date)
                VALUE
                    ('$project_name', '$description', '$quotation_id', '$customer_id', '$project_manager_id', '$start_date', '$end_date')";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }

    function updateProjectStatus($payment_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    payment
                SET
                    project_status = 1
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

    function editProject($project_id,$description,$project_manager_id,$start_date,$end_date) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    project
                SET
                    description = '$description',
                    project_manager_id = '$project_manager_id',
                    start_date = '$start_date',
                    end_date = '$end_date'
                WHERE 
                    project_id = '$project_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }

    function deleteProject($project_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    project
                SET
                    project_status = '1'
                WHERE
                    project_id = '$project_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }

    function activateProject($project_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    project
                SET
                    project_status = '0'
                WHERE
                    project_id = '$project_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }

    function deleteCustomer($customer_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    customer
                SET
                    customer_status = '0'
                WHERE
                    customer_id = '$customer_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }

    function activateCustomer($customer_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    customer
                SET
                    customer_status = '1'
                WHERE
                    customer_id = '$customer_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }

    function qouteCount() {

        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    quotation_id 
                FROM 
                    quotations
                WHERE
                    status = 1";
        $results = $con->query($sql);
        
        return $results;       

    }

}

class projectManager {

    function getAllProjectDetails($user_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    p.project_id,
                    p.project_name,
                    p.description,
                    p.quotation_id,
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
                WHERE
                    c.customer_status = 1
                    AND p.project_status = 0
                    AND p.project_manager_id = '$user_id'";
        $results = $con->query($sql);

        return $results;
    }
    
    function getAllFreelancers() {
        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    f.freelancer_id AS id,
                    CONCAT(f.freelancer_fname, ' ', f.freelancer_lname) AS name
                FROM 
                    freelancer f
                        INNER JOIN
                    freelancer_login fl ON fl.freelancer_id = f.freelancer_id
                WHERE 
                    f.freelancer_status = 1
                    AND fl.freelancer_login_status = 1";
        $results = $con->query($sql);
        return $results;
    }

    function assignFreelancerToProject($project_id,$freelancer) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    project
                SET
                    freelancer_id = '$freelancer'
                WHERE
                    project_id = '$project_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }

    function addTaskToProject($project_id,$task_name,$priority_level,$start_date,$end_date) {

        $con = $GLOBALS['con'];
        $sql = "INSERT INTO
                    task
                    (task_name,project_id,priority_level,start_date,end_date)
                VALUE
                    ('$task_name', '$project_id', '$priority_level', '$start_date', '$end_date')";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }

    function addTool($tool_name, $category_id, $website, $img) {

        $con = $GLOBALS['con'];
        $sql = "INSERT INTO
                    tools
                    (tool_name,category_id,website,tool_image)
                VALUE
                    ('$tool_name', '$category_id', '$website', '$img')";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }

    function editTool($tool_id, $tool_name, $category_id, $website, $img) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    tools
                SET
                    tool_name = '$tool_name',
                    category_id = '$category_id',
                    website = '$website',
                    tool_image = '$img'
                WHERE 
                    tool_id = '$tool_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }

    function editTaskInProject($task_id,$task_name,$priority_level,$start_date,$end_date) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    task
                SET
                    task_name = '$task_name',
                    priority_level = '$priority_level',
                    start_date = '$start_date',
                    end_date = '$end_date'
                WHERE
                    task_id = '$task_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }

    function markProjectAsCompleted($project_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    project
                SET
                    project_timeline = '1'
                WHERE
                    project_id = '$project_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }  

    function deleteTask($task_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    task
                SET
                    task_status = '1'
                WHERE
                    task_id = '$task_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }  

    function activateTask($task_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    task
                SET
                    task_status = '0'
                WHERE
                    task_id = '$task_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }  

    function deleteTool($tool_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    tools
                SET
                    tool_status = '1'
                WHERE
                    tool_id = '$tool_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }  

    function activateTool($tool_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    tools
                SET
                    tool_status = '0'
                WHERE
                    tool_id = '$tool_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    } 

    function giveToolAccess($request_id,$username,$password) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    freelancer_tools
                SET
                    user_name = '$username',
                    password = '$password',
                    status = 1
                WHERE
                    id = '$request_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }    

    function getProjectDetails($project_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    p.project_id,
                    p.project_name,
                    p.description,
                    p.quotation_id,
                    q.subject,
                    q.requirements,
                    q.remarks,
                    IF(q.status=1,'Pending',
                        IF(q.status=2,'Submitted',
                            IF(q.status=3, 'Approved',
                                IF(q.status=4, 'Rejected','')))) AS status,
                    c.customer_id,
                    c.customer_image,
                    CONCAT(c.customer_fname, ' ', c.customer_lname) AS cus_name,
                    p.project_manager_id,
                    CONCAT(u.user_fname, ' ', u.user_lname) AS pro_name,
                    CONCAT(f.freelancer_fname, ' ', f.freelancer_lname) AS free_name,
                    f.freelancer_image,
                    p.start_date,
                    p.end_date
                FROM
                    project p
                        INNER JOIN
                    customer c ON c.customer_id = p.customer_id
                        INNER JOIN
                    user u ON u.user_id = p.project_manager_id
                        INNER JOIN
                    quotations q ON q.quotation_id = p.quotation_id
                        INNER JOIN
                    freelancer f ON f.freelancer_id = p.freelancer_id
                WHERE
                    c.customer_status = 1
                    AND p.project_status = 0
                    AND p.project_id = '$project_id'
                LIMIT 1";
        $results = $con->query($sql);

        return $results;
    }    

    function getAllToolsSearch($cat_name) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    t.tool_id,
                    t.tool_name,
                    t.category_id,
                    t.website,
                    t.tool_image,
                    t.tool_status,
                    tc.category_name
                FROM
                    tools t
                        INNER JOIN
                    tool_category tc ON tc.category_id = t.category_id
                WHERE
                    tc.category_status = 0
                    $cat_name";
        $results = $con->query($sql);

        return $results;
    }  

    function getAllProjectTasks($project_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    p.project_id,
                    p.project_name,
                    p.description,
                    t.task_id,
                    t.task_name,
                    t.priority_level AS priority_id,
                    IF(t.priority_level=1,'Normal',
                        IF(t.priority_level=2,'Urgent',
                            IF(t.priority_level=3, 'Top Urgent',''))) AS priority_level,
                    f.freelancer_id,
                    CONCAT(f.freelancer_fname, ' ', f.freelancer_lname) AS freelancer_name,
                    f.freelancer_image,
                    p.start_date,
                    p.end_date,
                    t.start_date AS t_start_date,
                    t.end_date AS t_end_date,
                    t.task_timeline,
                    t.task_status
                FROM
                    task t
                        INNER JOIN
                    project p ON p.project_id = t.project_id
                        INNER JOIN
                    freelancer f ON f.freelancer_id = p.freelancer_id
                WHERE
                    p.project_status = 0
                    AND p.project_id = '$project_id'";
        $results = $con->query($sql);

        return $results;
    }
         
    function getAllToolRequest() {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    ft.id AS request_id,
                    t.tool_id,
                    t.tool_name,
                    t.category_id,
                    t.website,
                    t.tool_image,
                    t.tool_status,
                    tc.category_name,
                    f.freelancer_id,
                    f.freelancer_email,
                    CONCAT(f.freelancer_fname,' ',f.freelancer_lname) AS freelancer
                FROM
                    freelancer_tools ft
                    INNER JOIN tools t ON t.tool_id = ft.tool_id
                    INNER JOIN tool_category tc ON tc.category_id = t.category_id
                    INNER JOIN freelancer f ON f.freelancer_id = ft.freelancer_id
                WHERE
                    ft.status = 0
                ORDER BY
                    f.freelancer_fname ASC";
        $results = $con->query($sql);

        return $results;
    } 
         
    function toolsAllowedFreelancers() {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    f.freelancer_id,
                    CONCAT(f.freelancer_fname,' ',f.freelancer_lname) AS freelancer
                FROM
                    freelancer_tools ft
                    INNER JOIN freelancer f ON f.freelancer_id = ft.freelancer_id
                WHERE
                    ft.status = 1
                GROUP BY
                    ft.freelancer_id
                ORDER BY
                    f.freelancer_fname ASC";
        $results = $con->query($sql);

        return $results;
    } 
         
    function getAllowedToolsForFreelancers($freelancer_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    ft.id AS request_id,
                    t.tool_id,
                    t.tool_name,
                    t.category_id,
                    t.website,
                    t.tool_image,
                    t.tool_status,
                    tc.category_name,
                    f.freelancer_id,
                    f.freelancer_email,
                    CONCAT(f.freelancer_fname,' ',f.freelancer_lname) AS freelancer
                FROM
                    freelancer_tools ft
                    INNER JOIN tools t ON t.tool_id = ft.tool_id
                    INNER JOIN tool_category tc ON tc.category_id = t.category_id
                    INNER JOIN freelancer f ON f.freelancer_id = ft.freelancer_id
                WHERE
                    ft.status = 1
                    AND ft.freelancer_id = '$freelancer_id'
                GROUP BY
                    ft.tool_id
                ORDER BY
                    t.category_id ASC";
        $results = $con->query($sql);

        return $results;
    } 

}

class FinanceManager {

    function getAllPaymentsDetailsSearch($status) {

        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    p.payment_id,
                    p.quotation_id,
                    IFNULL(pr.project_id,'-') AS project_id,
                    IFNULL(pr.project_name,'Project Not Assign') AS project_name,
                    (SELECT
                        IFNULL(CONCAT(u.user_fname, ' ', u.user_lname),'') AS pro_man_name
                    FROM
                        user u
                    WHERE
                        u.user_id = pr.project_manager_id
                        ) AS pro_man_name,
                    IFNULL(pr.start_date,'-') AS start_date,
                    IFNULL(pr.end_date,'-') AS end_date,
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
                        LEFT JOIN
                    project pr ON pr.quotation_id = q.quotation_id
                WHERE
                    c.customer_status = 1
                    $status";
        $results = $con->query($sql);

        return $results;
    }

    function getAllProjectDetails($user_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    p.project_id,
                    p.project_name,
                    p.description,
                    p.quotation_id,
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
                WHERE
                    c.customer_status = 1
                    AND p.project_status = 0
                    AND p.project_manager_id = '$user_id'";
        $results = $con->query($sql);

        return $results;
    }
    
    function getAllFreelancers() {
        $con = $GLOBALS['con'];
        $sql = "SELECT 
                    f.freelancer_id AS id,
                    CONCAT(f.freelancer_fname, ' ', f.freelancer_lname) AS name
                FROM 
                    freelancer f
                        INNER JOIN
                    freelancer_login fl ON fl.freelancer_id = f.freelancer_id
                WHERE 
                    f.freelancer_status = 1
                    AND fl.freelancer_login_status = 1";
        $results = $con->query($sql);
        return $results;
    }

    function deleteTask($task_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    task
                SET
                    task_status = '1'
                WHERE
                    task_id = '$task_id'";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }
    }    

    function getProjectDetails($project_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    p.project_id,
                    p.project_name,
                    p.description,
                    p.quotation_id,
                    q.subject,
                    q.requirements,
                    q.remarks,
                    IF(q.status=1,'Pending',
                        IF(q.status=2,'Submitted',
                            IF(q.status=3, 'Approved',
                                IF(q.status=4, 'Rejected','')))) AS status,
                    c.customer_id,
                    c.customer_image,
                    CONCAT(c.customer_fname, ' ', c.customer_lname) AS cus_name,
                    p.project_manager_id,
                    CONCAT(u.user_fname, ' ', u.user_lname) AS pro_name,
                    CONCAT(f.freelancer_fname, ' ', f.freelancer_lname) AS free_name,
                    f.freelancer_image,
                    p.start_date,
                    p.end_date
                FROM
                    project p
                        INNER JOIN
                    customer c ON c.customer_id = p.customer_id
                        INNER JOIN
                    user u ON u.user_id = p.project_manager_id
                        INNER JOIN
                    quotations q ON q.quotation_id = p.quotation_id
                        INNER JOIN
                    freelancer f ON f.freelancer_id = p.freelancer_id
                WHERE
                    c.customer_status = 1
                    AND p.project_status = 0
                    AND p.project_id = '$project_id'
                LIMIT 1";
        $results = $con->query($sql);

        return $results;
    }  

    function getAllProjectTasks($project_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    p.project_id,
                    p.project_name,
                    p.description,
                    t.task_id,
                    t.task_name,
                    t.priority_level AS priority_id,
                    IF(t.priority_level=1,'Normal',
                        IF(t.priority_level=2,'Urgent',
                            IF(t.priority_level=3, 'Top Urgent',''))) AS priority_level,
                    f.freelancer_id,
                    CONCAT(f.freelancer_fname, ' ', f.freelancer_lname) AS freelancer_name,
                    f.freelancer_image,
                    p.start_date,
                    p.end_date,
                    t.start_date AS t_start_date,
                    t.end_date AS t_end_date,
                    t.task_timeline
                FROM
                    task t
                        INNER JOIN
                    project p ON p.project_id = t.project_id
                        INNER JOIN
                    freelancer f ON f.freelancer_id = p.freelancer_id
                WHERE
                    p.project_status = 0
                    AND t.task_status = 0
                    AND p.project_id = '$project_id'";
        $results = $con->query($sql);

        return $results;
    }

}