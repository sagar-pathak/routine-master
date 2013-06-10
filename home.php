<?php

/*
  Document   : home
  Created on : Jun 10, 2013, 3:00:03 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
session_start();
echo $_SESSION['user_name'].'<br/>';
?>


<a href="logout.php">Logout</a>
