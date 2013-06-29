<?php
/*
  Document   : add_new_department
  Created on : Jun 21, 2013, 4:01:16 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
include 'initials/connection.php';
$query = 'SELECT DISTINCT * FROM department';
$result = mysql_query($query);
?>

<form action="insert_branch_dept.php" method="POST">
    <div class="container" style="width:600px">
        <div class="table-row">
            <div class="col">Department Branch </div>

            <div class="col">
                <select name="branch"> 
                    <?php
                    while ($row = mysql_fetch_array($result)) {
                        echo '<option>' . $row["branch"] . '</option>';
                    }
                    if (isset($_COOKIE['new_branch'])) {
                        echo '<option>' . $_COOKIE['new_branch'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <a href="<?php echo $_SERVER["PHP_SELF"] . '?opt=5'; ?>">New Branch</a>
            </div>
        </div>
            <div class="table-row">
                <div class="col">Department Name</div> 
                <div class="col">
                <select name="department"> 
                    <?php
                    $result = mysql_query($query);
                    while ($row = mysql_fetch_array($result)) {
                        echo '<option>' . $row["department_name"] . '</option>';
                    }
                    if (isset($_COOKIE['new_depart'])) {
                        echo '<option>' . $_COOKIE['new_depart'] . '</option>';
                        
                    }
                    ?>
                </select>
                </div>
                <div class="col">
                    <a href="<?php echo $_SERVER["PHP_SELF"] . '?opt=6'; ?>">New Department</a>
                </div>
            </div>
            <div class="table-row">
                <div class="col">Description </div>
                <div class="col"><input style="width:298px" type="text" name="depart_desc"/></div>
                  <div class="col"></div>
            </div>
           
        </div>
    
     <input type="submit" name="submitNow" value="SUBMIT"/>
</form>