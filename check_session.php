<?php
/*
  Document   : check_session
  Created on : Jun 10, 2013, 2:30:27 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
session_start();
if(isset($_SESSION['logged_in'])){
    header('Location: home.php');
}
?>
