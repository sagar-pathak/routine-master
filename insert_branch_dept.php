<?php
/*
  Document   : insert_branch_dept
  Created on : Jun 29, 2013, 12:37:26 PM
  Author     : Sagar Pathak
  Description:
 */
include 'initials/connection.php';
if (isset($_POST['submitNow'])) {
    $department_name = $_POST['department'];
    $department_desc = $_POST['depart_desc'];
    $redirected_to = '/routine-master/home.php?opt=1'; 
    if (isset($_COOKIE['new_branch'])) {
        $branch = $_COOKIE['new_branch'];
        setcookie("new_branch"," ",time()-3600,"/");
    } else {
        $branch = $_POST['branch'];
    }
    include 'initials/connection.php';
    $query = 'INSERT INTO department (department_name,department_desc,branch) VALUES ("' . $department_name . '","' . $department_desc . '","' . $branch . '")';
    if (mysql_query($query)) {
        header('Location: ' . $redirected_to);
        //echo "Successfully Added.";
    } else {
        echo mysql_error();
    }
}
?>
