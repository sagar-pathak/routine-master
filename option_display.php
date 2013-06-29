<?php

/*
  Document   : option_display
  Created on : Jun 22, 2013, 12:12:09 AM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
$semester        = $_COOKIE['semester'];
$department_name = $_COOKIE['department_name'];

if(isset($_COOKIE['option'])){
    $option          = $_COOKIE['option'];
}else{
    $option = '1';
}
$link            = 'change_choice.php?opt='.$option;

echo '<h2><i><u>'.$semester. '</u> </i>semester of <i><u>'.$department_name.'</u> </i>department is selected. <a href="'.$link.'">CHANGE</a></h2>';
?>
