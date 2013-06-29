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
switch($semester){
    case 1:
        $call_semester = "First";
        break;
    case 2:
         $call_semester = "Second";
        break;
    case 3:
         $call_semester = "Third";
        break;
    case 4:
         $call_semester = "Fourth";
        break;
    case 5:
        $call_semester = "Fifth";
        break;
    case 6:
        $call_semester = "Sixth";
        break;
    case 7:
        $call_semester = "Seventh";
        break;
    case 8:
        $call_semester = "Eighth";
        break;
    default:
        exit(0);
}
if(isset($_COOKIE['option'])){
    $option          = $_COOKIE['option'];
}else{
    $option = '1';
}
$link            = 'change_choice.php?opt='.$option;

echo '<h2><i><u>'.$call_semester. '</u> </i>semester of <i><u>'.$department_name.'</u> </i>department is selected. <a href="'.$link.'">CHANGE</a></h2>';
?>
