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
    
    function getAllProjectDetails($freelancer_id) {

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
                    AND p.freelancer_id = '$freelancer_id'";
        $results = $con->query($sql);

        return $results;
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
    
    function getAllTaskDetailsSearch($freelancer_id,$project_id,$type) {

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
                    AND f.freelancer_id = '$freelancer_id'
                    AND p.project_id = '$project_id'
                    $type";
        $results = $con->query($sql);

        return $results;
    }  

    function markTaskAsCompleted($task_id) {

        $con = $GLOBALS['con'];
        $sql = "UPDATE
                    task
                SET
                    task_timeline = '1'
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

    function getAllActiveTools($freelancer_id,$cat_name) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    t.tool_id,
                    t.tool_name,
                    t.category_id,
                    t.website,
                    t.tool_image,
                    t.tool_status,
                    tc.category_name,
                    IF(ft.status = 0,'Requested','Accepted') AS permission,
                    IF(ft.status = 0,'0','1') AS permission_id
                FROM
                    tools t
                        INNER JOIN
                    tool_category tc ON tc.category_id = t.category_id
                        LEFT JOIN
                    freelancer_tools ft ON ft.tool_id = t.tool_id
                WHERE
                    tc.category_status = 0
                    AND t.tool_status = 0
                    AND ft.freelancer_id = '$freelancer_id'
                    AND ft.status <= 2
                    $cat_name
                GROUP BY
                    t.tool_id
            UNION (

                SELECT
                    t.tool_id,
                    t.tool_name,
                    t.category_id,
                    t.website,
                    t.tool_image,
                    t.tool_status,
                    tc.category_name,
                    'Not-Requested' AS permission,
                    '2' AS permission_id
                FROM
                    tools t
                        INNER JOIN 
                    tool_category tc ON tc.category_id = t.category_id
                WHERE
                    t.tool_id NOT IN (
                        SELECT
                            t1.tool_id
                        FROM
                            tools t1
                                INNER JOIN
                            freelancer_tools ft1 ON ft1.tool_id = t1.tool_id
                        WHERE
                            t.tool_status = 0
                            AND ft1.freelancer_id = '$freelancer_id'
                    )
                    $cat_name
                GROUP BY
                    t.tool_id
                )";
        $results = $con->query($sql);

        return $results;
    }  

    function requestTool($tool_id,$freelancer_id) {

        $con = $GLOBALS['con'];
        $sql = "INSERT INTO
                    freelancer_tools
                    (tool_id,freelancer_id)
                VALUE
                    ('$tool_id', '$freelancer_id')";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }   

    function checkGroup($group,$freelancer_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    fm.id
                FROM
                    freelancer_marks fm
                WHERE
                    fm.status = 0
                    AND fm.group_id = '$group'
                    AND fm.freelancer_id = '$freelancer_id'";
        $results = $con->query($sql);

        return $results;
    } 

    function getQuestionsForGroup($group) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    *
                FROM
                    questions q
                WHERE
                    q.status = 0
                    AND q.group_id = '$group'";
        $results = $con->query($sql);

        return $results;
    } 

    function getQuestionGroups() {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    *
                FROM
                    questions_group qg
                WHERE
                    qg.status = 0";
        $results = $con->query($sql);

        return $results;
    }  

    function getAnswersForQuestion($question_id) {

        $con = $GLOBALS['con'];
        $sql = "SELECT
                    *
                FROM
                    question_answers qw
                WHERE
                    qw.status = 0
                    AND qw.question_id = '$question_id'
                LIMIT 4";
        $results = $con->query($sql);

        return $results;
    } 

    function addFreelancerMarks($group,$freelancer_id,$marks) {

        $con = $GLOBALS['con'];
        $sql = "INSERT INTO
                    freelancer_marks
                    (group_id,freelancer_id,marks)
                VALUE
                    ('$group', '$freelancer_id', '$marks')";
        $results = $con->query($sql);

        if ($results) {
            return 1;
        }
        else {
            return 0;
        }

    }
}