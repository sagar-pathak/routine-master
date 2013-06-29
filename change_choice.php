<?php

/*
  Document   : change_choice
  Created on : Jun 22, 2013, 12:23:27 AM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
setcookie("department_name",'',time()-3600,"/");
setcookie("semester",'' ,time()-3600,"/");
if(isset($_COOKIE['option'])){
    $option          = $_COOKIE['option'];
}else{
    $option = '1';
}
header("Location: check_session.php?opt=".$option);
?>
