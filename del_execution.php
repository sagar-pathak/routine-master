<?php
/*
  Document   : del_execution
  Created on : Jun 29, 2013, 2:45:40 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
include 'initials/connection.php';
$redirected_to = '/routine-master/home.php?opt=7';
$id     = $_GET['id'];
$query  = 'SELECT department_id FROM department';
$result = mysql_query($query);
$real_id     = 0;
while ($row = mysql_fetch_array($result)){
    $fake_id = $row['department_id'] + 169;
    $encrypted_id = md5($fake_id);
    if($encrypted_id == $id){
        $real_id = $row['department_id'];
    }
}
$query = 'DELETE FROM department WHERE department_id='.$real_id;
if(mysql_query($query)){
   header("Location: ".$redirected_to);
}else{
    die(mysql_error());
}
?>
