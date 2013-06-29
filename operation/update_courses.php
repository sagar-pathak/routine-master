<?php
/*
  Document   : update_courses
  Created on : Jun 21, 2013, 11:19:52 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
//include "option_display.php";
$redirected_to = '/routine-master/set_course_no.php';
?>
<link rel="stylesheet" href="../css/sample.css"/>
<?php
if (!isset($_COOKIE['c_no'])) {
    
    $semester = $_COOKIE['semester'];
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
    echo '<form action= "' . $redirected_to . '" method="POST">';
    echo 'Enter total number of course in <i><font color="red"> ' .$call_semester . '</font></i> semester of <i><font color="red">' . $_COOKIE['department_name'] . '</font></i>.';
    echo '<BR/><input type="text" name="total_courses"/>';
    echo '<br/><input type="submit" name="submit_course_no" value="submit"/>';
    echo '</form>';
} else {
    $specified_range = $_COOKIE['c_no'];
    $i = 1;
     echo '<form action= "' . $redirected_to . '" method="POST">';
    echo '<div class="container" style="width:700px">
    <div class="heading">
        <div class="col">COURSE CODE</div>
        <div class="col" style="width:50%">COURSE TITLE</div>
        <div class="col">COURSE CREDITS</div>
        <div class="col">COURSE PASSWORD</div>
    </div> ';

    while ($i <= $specified_range) {
        echo '<div class="table-row">
                    <div class="col"><input type="text" name="course_code'.$i.'"></div>
                    <div class="col"><input class="modified" type="text" name="course_title'.$i.'"></div>
                    <div class="col"><input type="text" name="course_credit'.$i.'"></div>
                    <div class="col"><input type="text" name="course_password'.$i.'"></div>
                </div> ';
        $i++;
    }
    echo '<input type="submit" name="submit_courses" value="submit"/>';
    echo '</form>';
}
?>
</div>
