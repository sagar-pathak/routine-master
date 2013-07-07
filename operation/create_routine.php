<?php

/*
  Document   : create_routine
  Created on : Jun 21, 2013, 11:19:21 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
include 'option_display.php';
include 'initials/connection.php';
$redirected_to = '/routine-master/home.php?opt=1';
$department_name = $_COOKIE['department_name'];
$semester = $_COOKIE['semester'];
$table_name = 'courses';
$query = 'SELECT DISTINCT department_id FROM department WHERE department_name = "'.$department_name.'"';
$result_set_first = mysql_query($query);
$row = mysql_fetch_array($result_set_first);
$department_id = $row['department_id'];
$query = 'SELECT course_code, course_title FROM '.$table_name.' WHERE (department_id = '.$department_id.'  AND semester = '.$semester.' )';
$result = mysql_query($query);

//INSERTING ROUTINE INTO TABLE
if(isset($_POST['set_routine'])){
    $day = $_POST['day'];
    $count = $_POST['count'];
    $i = 1;
    while($i <= $count){
        if((isset($_POST['choose_this_course_'.$i])) && ($_POST['choose_this_course_'.$i] == 'yes')){
            $course_code = $_POST['course_code_'.$i];
            $time = $_POST['time_to_n_from_'.$i];
            
            $query = 'INSERT INTO `routine`(`course_code`, `department_id`, 
                `semester`, `day`, `from_and_to`) VALUES ("'.$course_code.'",'.$department_id.',
                '.$semester.',"'.$day.'","'.$time.'")';
            if(mysql_query($query)){
                
            }else{
                die(mysql_error());
                exit(0);
            }
        }
        $i++;
    }
    setcookie('success_notifier',$day,  time()+3600,'/');
    header('Location: '.$redirected_to);
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    
<div class="container">
    <?php
    if(isset($_COOKIE['success_notifier'])){
        echo '<div class="table-row">
             <div class="col information-box" style="width:70%">Routine has been successfully created for '.$_COOKIE['success_notifier'].'</div> 
        </div><br/>';
        setcookie('success_notifier','',  time()-3600,'/');
    }
    ?>
</div>
    <div class="container">
    <div class="table-row">
        <div class="col" style="width:10%"></div>
         <div class="col" style="width:20%">Choose Day:</div>
         <div class="col" style="width:50%"><p>
             <select name="day">
                    <option value="Sunday">Sunday</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                </select>
             </p>
         </div>
         <div class="col" style="width:20%"></div> 
    </div>
    <div class="heading">
         <div class="col" style="width:10%">Select</div>
         <div class="col" style="width:20%">Course Code</div>
         <div class="col" style="width:50%">Course Title</div>
         <div class="col" style="width:20%">Time</div>
    </div>
    <?php
    $count = 1;
    while($row = mysql_fetch_array($result)){
        echo '<div class="table-row">
            <div class="col" style="width:10%"><input type="checkbox" name="choose_this_course_'.$count.'" value="yes" /></div>
             <div class="col" style="width:20%"><input type="hidden" value="'.$row['course_code'].'" name="course_code_'.$count.'"/> '.$row['course_code'].'</div>
             <div class="col" style="width:50%">'.$row['course_title'].'</div>
             <div class="col" style="width:20%"><input type="text" name="time_to_n_from_'.$count.'" /></div>
        </div>';
        $count ++;
    }
    ?>
     <div class="table-row">
         <div class="col" style="width:10%"><input type="hidden" name="count" value="<?php echo $count;?>"/></div>
         <div class="col" style="width:20%"><input type="submit" name="set_routine" value="SET ROUTINE" /></div>
         <div class="col" style="width:50%"></div>
         <div class="col" style="width:20%"></div>
      
    </div>
</div>
</form>