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
$query2 = 'SELECT DISTINCT group FROM ' . $table_name1;
$result2 = mysql_query($query2);

//INSERTING ROUTINE INTO TABLE
if (isset($_POST['set_routine'])) {
    $day = $_POST['day'];
    $count = $_POST['count'];
    $i = 1;
    while ($i <= $count) {
        if ((isset($_POST['choose_this_course_' . $i])) && ($_POST['choose_this_course_' . $i] == 'yes')) {
            $course_code = $_POST['course_code_' . $i];
            $time = $_POST['time_to_n_from_' . $i];

            $query = 'INSERT INTO `routine`(`course_code`, `department_id`, 
                `semester`, `day`, `from_and_to`) VALUES ("' . $course_code . '",' . $department_id . ',
                ' . $semester . ',"' . $day . '","' . $time . '")';
            if (mysql_query($query)) {
                
            } else {
                die(mysql_error());
                exit(0);
            }
        }
        $i++;
    }
    setcookie('success_notifier', $day, time() + 3600, '/');
    header('Location: ' . $redirected_to);
} else if (isset($_POST['new_group_set'])) {
    setcookie('group_name', $_POST['new_group'], time() + 3600, '/');
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
                    <option value="Sunday">Sunday</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
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
                    while ($row = mysql_fetch_array($result2)) {
                       
                            echo '<option>' . $row['group'] . '</option>';
                        
                    }
                    if (isset($_COOKIE['group_name'])) {
                        $new_group = $_COOKIE['group_name'];
                        echo '<option>' . $new_group . '</option>';
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
    <p>
    <div class="container">
        <div class="heading">
            <div class="col" style="width:10%">Select</div>
            <div class="col" style="width:20%">Course Code</div>
            <div class="col" style="width:50%">Course Title</div>
            <div class="col" style="width:20%">Time</div>
        </div>
        <?php
        $count = 1;
        while ($row = mysql_fetch_array($result)) {
            echo '<div class="table-row">
            <div class="col" style="width:10%"><input type="checkbox" name="choose_this_course_' . $count . '" value="yes" /></div>
             <div class="col" style="width:20%"><input type="hidden" value="' . $row['course_code'] . '" name="course_code_' . $count . '"/> ' . $row['course_code'] . '</div>
             <div class="col" style="width:50%">' . $row['course_title'] . '</div>
             <div class="col" style="width:20%"><input type="text" name="time_to_n_from_' . $count . '" /></div>
        </div>';
            $count++;
        }
        while ($row = mysql_fetch_array($result1)) {
            echo '<div class="table-row">
             <div class="col" style="width:10%"><input type="checkbox" name="choose_this_course_' . $count . '" value="yes" /></div>
             <div class="col" style="width:20%"><input type="hidden" value="' . $row['course_code'] . '[LAB]" name="course_code_' . $count . '"/> ' . $row['course_code'] . ' [LAB]</div>
             <div class="col" style="width:50%">' . $row['course_title'] . ' [LAB]</div>
             <div class="col" style="width:20%"><input type="text" name="time_to_n_from_' . $count . '" /></div>
        </div>';
            $count++;
        }
        ?>
    </div>
    <div class="container">
        <div class="table-row">
             <div class="col" style="width:10%;border: 1px solid #CCC;"><input type="checkbox" name="choose_this_course_<?php $count++;echo $count;?>" value="yes" /></div>
             <div class="col" style="width:20%;border: 1px solid #CCC;"><input type="hidden" value="LUNCH" name="course_code_<?php echo $count;?>"/> LUNCH </div>
             <div class="col" style="width:50%;border: 1px solid #CCC;">LUNCH</div>
             <div class="col" style="width:20%"><input type="text" name="time_to_n_from_<?php echo $count;?>" /></div>
        </div>
    </div>
    <div class="container">
        <div class="table-row">
            <div class="col" style="width:10%"><input type="hidden" name="count" value="<?php echo $count; ?>"/></div>
            <div class="col" style="width:20%"><input type="submit" name="set_routine" value="SET ROUTINE" /></div>
            <div class="col" style="width:50%"></div>
            <div class="col" style="width:20%"></div>
        </div>
    </div>
</p>
</form>