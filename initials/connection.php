<?php
/*
  Document   : connection
  Created on : Jun 10, 2013, 1:22:51 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
  $server = 'localhost';
  $username = 'root';
  $password = '';
  $dbname   = 'embedded_project';
  $con      = mysql_connect($server, $username, $password);

  session_start();
  if(!$con){
      die('Couldn\'t established connection to server because '.mysql_error()); 
  }else{
      if(!mysql_select_db($dbname)){
          $_SESSION['error'] = 'Required database is not installed in the system';
      }
  }
?>
