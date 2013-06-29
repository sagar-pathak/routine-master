<?php

/*
  Document   : set_cookie
  Created on : Jun 29, 2013, 6:57:39 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
$redirected_to = '/routine-master/home.php?opt=3';
if (isset($_POST['submit_course_no'])) {
    $number = $_POST['total_courses'];
    setcookie("c_no", $number, time() + 3600, "/");
    header("Location: " . $redirected_to);
} else if (isset($_POST['submit_courses'])) {
    include 'initials/connection.php';
    $semester = $_COOKIE['semester'];
    $department_name = $_COOKIE['department_name'];
    //getting department id
    $query = 'SELECT department_id,department_name FROM department';
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        if ($department_name == $row['department_name']) {
            $department_id = $row['department_id'];
        }
    }
    $number = $_COOKIE['c_no'];
    setcookie("c_no", " ", time() - 3600, "/");
    $i = 1;
    while ($i <= $number) {
        $course_code = 'course_code' . $i;
        $course_title = 'course_title' . $i;
        $course_password = 'course_password' . $i;
        $course_credit = 'course_credit' . $i;
        if (isset($_POST[$course_code])) {
            ${'course_code' . $i} = $_POST[$course_code];
        }
        if (isset($_POST[$course_title])) {
            ${'course_title' . $i} = $_POST[$course_title];
        }
        if (isset($_POST[$course_password])) {
            ${'course_password' . $i} = $_POST[$course_password];
        }
        if (isset($_POST[$course_credit])) {
            ${'course_credit' . $i} = $_POST[$course_credit];
        }
        $i++;
    }
    $i = 1;
    while ($i <= $number) {
        $course_code =  ${'course_code' . $i};
        $course_title = ${'course_title' . $i};
        $course_credit = ${'course_credit' . $i};
         $course_password = ${'course_password' . $i};
        $sql = 'INSERT INTO courses (course_code,department_id,semester,course_title,course_credit,course_password) 
            VALUES ("' .$course_code. '",' . $department_id . ',' . $semester . ',"' 
                .  $course_title . '",' .  $course_credit. ',"' .$course_password . '")';
        if(mysql_query($sql)){
        }else{
            die(mysql_error());
            exit(0);
        }
        $i++;
    }
}
?>
