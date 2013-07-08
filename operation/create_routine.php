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
$table_name1 = 'routine';
$query = 'SELECT DISTINCT department_id FROM department WHERE department_name = "' . $department_name . '"';
$result_set_first = mysql_query($query);
$row = mysql_fetch_array($result_set_first);
$department_id = $row['department_id'];
$query = 'SELECT course_code, course_title FROM ' . $table_name . ' WHERE (department_id = ' . $department_id . '  AND semester = ' . $semester . ' )';
$result = mysql_query($query);
$query1 = 'SELECT course_code, course_title FROM ' . $table_name . ' WHERE (department_id = ' . $department_id . '  AND semester = ' . $semester . ' AND lab = 1 )';
$result1 = mysql_query($query1);
$query2 = 'SELECT DISTINCT `group` FROM `'. $table_name1.'`';
$result2 = mysql_query($query2);

//INSERTING ROUTINE INTO TABLE
if(isset( $_COOKIE['day'])){
    $day   = $_COOKIE['day'];
}
if(isset($_COOKIE['group'])){
    $selected_group = $_COOKIE['group'];
}
if (isset($_POST['set_routine'])) {
    $count = $_POST['count'];
    $group = $_POST['group_name'];
    $i = 1;
    while ($i <= $count) {
        if ((isset($_POST['choose_this_course_' . $i])) && ($_POST['choose_this_course_' . $i] == 'yes')) {
            $course_code = $_POST['course_code_' . $i];
            $time = $_POST['time_to_n_from_' . $i];
            
            //check whether the routine has been already set up or not
            $query_internal = 'SELECT course_code FROM routine where (`course_code` = "'.$course_code.'" 
                 AND `department_id` = '.$department_id.' AND `semester` = '.$semester.' 
                     AND `group` = "'.$group.'" AND `day` = "'.$day.'")';
            $result_set_number=mysql_query($query_internal);
            $row=  mysql_fetch_array($result_set_number);
            if($row['course_code']==NULL){
                //insert if not exists.
                $query_dynamic = 'INSERT INTO `routine`(`course_code`, `department_id`, 
                `semester`,`group`,  `day`, `from_and_to`) VALUES ("' . $course_code . '",' . $department_id . ',
                ' . $semester . ',"'.$group.'", "' . $day . '","' . $time . '")';
            }else{
               //update if already exists.
               $query_dynamic = 'UPDATE `routine` SET 
                   `from_and_to`= "'.$time.'" WHERE (`course_code` = "'.$course_code.'" 
                       AND `department_id` = '.$department_id.' AND `semester` = '.$semester.' 
                           AND `group` = "'.$group.'" AND `day` = "'.$day.'")';
            }         
            if (mysql_query($query_dynamic)) {
                
            } else {
                die(mysql_error());
                exit(0);
            }
        }
        $i++;
    }
    setcookie('success_notifier', $day, time() + 3600, '/');
     setcookie('group_name_new', $_POST['new_group'], time() - 3600, "/");
    header('Location: ' . $redirected_to);
}
if (isset($_POST['new_group_set'])) {
    if($_POST[new_group] != NULL){
        setcookie('group_name_new', $_POST['new_group'], time() + 3600, "/");
        setcookie('flag',"set", time() + 3600, "/");
    }else{
        setcookie('flag',"not-set", time() + 3600, "/");
    }
    setcookie('group', $_POST['group_name'], time() + 3600, '/');
    setcookie('day', $_POST['day'], time() + 3600, '/');
    header('Location: ' . $redirected_to);
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

    <div class="container">
        <?php
        if (isset($_COOKIE['success_notifier'])) {
            echo '<div class="table-row">
             <div class="col information-box" style="width:70%">Routine has been successfully created for ' . $_COOKIE['success_notifier'] . '</div> 
        </div><br/>';
            setcookie('success_notifier', '', time() - 3600, '/');
        }
        ?>
    </div>
    <div class="container">
        <div class="table-row">
            <div class="col" style="width:23%">Choose Day:</div>
            <div class="col">
                <select name="day">
                    <option value="Sunday"<?php if(isset($day)){if($day == "Sunday"){echo ' selected ';}}?>>Sunday</option>
                    <option value="Monday"<?php if(isset($day)){if($day == "Monday"){echo ' selected ';}}?>>Monday</option>
                    <option value="Tuesday"<?php if(isset($day)){if($day == "Tuesday"){echo ' selected ';}}?>>Tuesday</option>
                    <option value="Wednesday"<?php if(isset($day)){if($day == "Wednesday"){echo ' selected ';}}?>>Wednesday</option>
                    <option value="Thursday"<?php if(isset($day)){if($day == "Thursday"){echo ' selected ';}}?>>Thursday</option>
                    <option value="Friday"<?php if(isset($day)){if($day == "Friday"){echo ' selected ';}}?>>Friday</option>
                    <option value="Saturday"<?php if(isset($day)){if($day == "Saturday"){echo ' selected ';}}?>>Saturday</option>
                </select>

            </div>
            <div class="col" style="width:20%"></div> 
        </div>
    </div>
    <div class="container">
        <div class="table-row">
            <div class="col" style="width:23%">Choose Group:</div>
            <div class="col">
                <select name="group_name">
                    <?php
                    if (isset($_COOKIE['group_name_new'])) {
                        $new_group = $_COOKIE['group_name_new'];
                        echo '<option>' . $new_group . '</option>';
                    }
                    while ($row = mysql_fetch_array($result2)) {
                            echo '<option ';if(isset($selected_group)){if($row['group'] == $selected_group){ echo 'selected';}} echo '>' . $row['group'] . '</option>';
                    }    
                    ?>
                </select>

            </div>
            <div class="col" style="width:20%"></div> 
        </div>
        <div class="table-row">
            <div class="col">Specify new group(if any):</div>
            <div class="col"><input type="text" name="new_group"/>
                <input style="width:23%;" type="submit" value="SET" name="new_group_set"/></div>
            <div class="col"></div>
        </div>
    </div>
    <?php
    if(isset($_COOKIE['day']) && $_COOKIE['flag'] == "not-set"){
    echo '<p>
    <div class="container">
        <div class="heading">
            <div class="col" style="width:10%">Select</div>
            <div class="col" style="width:20%">Course Code</div>
            <div class="col" style="width:50%">Course Title</div>
            <div class="col" style="width:20%">Time</div>
        </div>';
        
        $count = 1;
        while ($row = mysql_fetch_array($result)) {
            $course_code = $row['course_code'];
            $query_internal1 = 'SELECT course_code, from_and_to FROM routine WHERE  (`course_code` = "'.$course_code.'" 
                       AND `department_id` = '.$department_id.' AND `semester` = '.$semester.' AND `group` = "'.$selected_group.'" AND `day` = "'.$day.'")';
            $resultset_internal = mysql_query($query_internal1);
            $row1 = mysql_fetch_array($resultset_internal);
            if($row1['course_code'] == NULL){
                $existed_value = NULL;
            }else{
                $existed_value = $row1['from_and_to'];
            }
            echo '<div class="table-row">
             <div class="col" style="width:10%"><input type="checkbox" ';if($existed_value != NULL){echo 'checked';} echo ' name="choose_this_course_' . $count . '" value="yes" /></div>
             <div class="col" style="width:20%"><input type="hidden" value="' . $row['course_code'] . '" name="course_code_' . $count . '"/> ' . $row['course_code'] . '</div>
             <div class="col" style="width:50%">' . $row['course_title'] . '</div>
             <div class="col" style="width:20%"><input type="text" value="'.$existed_value.'" name="time_to_n_from_' . $count . '" /></div>
        </div>';
            $count++;
        }
        while ($row = mysql_fetch_array($result1)) {
            $course_code = $row['course_code'];
            $query_internal1 = 'SELECT course_code, from_and_to FROM routine WHERE  (`course_code` = "'.$course_code.'[LAB]" 
                       AND `department_id` = '.$department_id.' AND `semester` = '.$semester.' AND `group` = "'.$selected_group.'" AND `day` = "'.$day.'")';
            $resultset_internal = mysql_query($query_internal1);
            $row1 = mysql_fetch_array($resultset_internal);
            if($row1['course_code'] == NULL){
                $existed_value = NULL;
            }else{
                $existed_value = $row1['from_and_to'];
            }
            echo '<div class="table-row">
             <div class="col" style="width:10%"><input type="checkbox" ';if($existed_value != NULL){echo ' checked ';} echo 'name="choose_this_course_' . $count . '" value="yes" /></div>
             <div class="col" style="width:20%"><input type="hidden" value="' . $row['course_code'] . '[LAB]" name="course_code_' . $count . '"/> ' . $row['course_code'] . ' [LAB]</div>
             <div class="col" style="width:50%">' . $row['course_title'] . ' [LAB]</div>
             <div class="col" style="width:20%"><input type="text" value="'.$existed_value.'" name="time_to_n_from_' . $count . '" /></div>
        </div>';
            $count++;
        }
        
            //checking updated value for lunch
            $course_code = 'LUNCH';
            $query_internal1 = 'SELECT course_code, from_and_to FROM routine WHERE  (`course_code` = "'.$course_code.'" 
                       AND `department_id` = '.$department_id.' AND `semester` = '.$semester.' AND `group` = "'.$selected_group.'" AND `day` = "'.$day.'")';
            $resultset_internal = mysql_query($query_internal1);
            $row1 = mysql_fetch_array($resultset_internal);
            if($row1['course_code'] == NULL){
                $existed_value = NULL;
            }else{
                $existed_value = $row1['from_and_to'];
            }
        
    echo '</div>
    <div class="container">
        <div class="table-row">
             <div class="col" style="width:10%;border: 1px solid #CCC;">
             <input type="checkbox" '; if($existed_value != NULL){echo ' checked ';} echo 'name="choose_this_course_'.$count.'" value="yes" /></div>
             <div class="col" style="width:20%;border: 1px solid #CCC;">
             <input type="hidden" value="LUNCH" name="course_code_'.$count.'"/> LUNCH </div>
             <div class="col" style="width:50%;border: 1px solid #CCC;">LUNCH</div>
             <div class="col" style="width:20%">
             <input type="text" value="'.$existed_value.'" name="time_to_n_from_'.$count.'" /></div>
        </div>
    </div>
    <div class="container">
        <div class="table-row">
            <div class="col" style="width:10%"><input type="hidden" name="count" value="'.$count.'"/></div>
            <div class="col" style="width:20%"><input type="submit" name="set_routine" value="SET ROUTINE" /></div>
            <div class="col" style="width:50%"></div>
            <div class="col" style="width:20%"></div>
        </div>
    </div>
</p>';
}
?>
</form>