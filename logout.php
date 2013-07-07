<?php

/*
  Document   : logout
  Created on : Jun 10, 2013, 2:51:02 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
session_start();
if (isset($_COOKIE['new_branch'])) {
    setcookie("new_branch", "", time() - 3600, "/");
}
if (isset($_COOKIE['new_branch'])) {
    setcookie("new_branch", "", time() - 3600, "/");
}
unset($_SESSION['logged_in']);
unset($_SESSION['user_id']);
unset($_SESSION['error']);
setcookie("department_name", " ", time() - 3600);
setcookie("semester", " ", time() - 3600);
session_destroy();
header('Location: login.php');
?>
