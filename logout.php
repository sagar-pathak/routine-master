<?php
/*
  Document   : logout
  Created on : Jun 10, 2013, 2:51:02 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
session_start();
unset($_SESSION['logged_in']);
unset($_SESSION['user_id']);
unset($_SESSION['error']);
session_destroy();
header('Location: login.php');
?>
