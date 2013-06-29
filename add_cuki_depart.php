<?php

/*
  Document   : add_cuki_depart
  Created on : Jun 29, 2013, 1:14:50 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the stylesheet follows.
 */
$redirected_to = '/routine-master/home.php?opt=4'; 
if (isset($_POST['submitDepart'])) {
    $new_depart = $_POST["department_name"];
    setcookie("new_depart",$new_depart,time()+3600,"/");
    header("Location: ".$redirected_to);
}  
?>
