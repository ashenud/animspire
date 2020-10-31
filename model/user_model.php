<?php

include_once realpath(dirname(__FILE__)."/../commons/dbConnection.php");
$dbConnObj = new dbConnetion();

class User{
    
    function validateUserEmail($email)
    {
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
    function addUser($user_fname, $user_lname, $user_email, $user_role, $user_dob, $user_gender, $user_phone, $user_image, $user_status)
    {
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
    
    function addUserLogin($user_login_username, $user_login_password, $user_id, $user_login_status)
    {
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

    public function getUserRoles()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM user_role";
        $results = $con->query($sql);
        return $results;
    }
    public function getAllUsers()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM user u, user_role r WHERE u.user_role = r.role_id";
        $userResults = $con->query($sql);
        return $userResults;
    }
    function deactivateUser($userId)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE user SET user_status='0' WHERE user_id = '$userId'";
        $results = $con->query($sql);
    }
    function activateUser($userId)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE user SET user_status='1' WHERE user_id = '$userId'";
        $results = $con->query($sql);
    }
    function viewUser($userId)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM user u, user_role r WHERE u.user_role = r.role_id AND u.user_id = '$userId'";
        $results = $con->query($sql);
        return $results;
    }
    function updateEmailValidation($userId, $email)
    {
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
    function updateUser($userId, $user_fname, $user_lname, $user_email, $user_role, $user_dob, $user_gender, $user_phone, $user_image, $user_status)
    {
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
        $connect = new PDO("mysql:host=192.168.1.110;dbname=animspire", "root", "2486");
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

    function getDbBackupData($role){
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
                    $role";

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
}