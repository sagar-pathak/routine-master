<?php
/*
  Document   : del_branch_dept
  Created on : Jun 29, 2013, 1:31:43 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
include 'initials/connection.php';
$query = "SELECT * FROM department";
$result = mysql_query($query);
?>
<script type="text/javascript">
    function check(){
        return confirm("Are you sure you want to delete?");
    }
</script>
<link href="css/sample.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/style.css">
<div class="container" style="width:500px">
    <div class="heading">
        <div class="col">Department</div>
        <div class="col">Branch</div>
        <div class="col">Operation</div>
    </div>
    <div class="table-row"><div class="col" style="height:10px;"></div></div>
    <?php
    $link = '/routine-master/del_execution.php';
    while ($row = mysql_fetch_array($result)) {
        $department = $row['department_name'];
        $branch = $row['branch'];
        $fake_id = $row['department_id'] + 169;
        $department_id = md5($fake_id);
        echo '<div class="table-row">';
        echo '<div class="col">';
        echo $department;
        echo '</div>';
        echo '<div class="col">';
        echo $branch;
        echo '</div>';

        //echo '<div class="col round red">';
        echo '<a href="'.$link.'?id='.$department_id.'" onclick="return check()">
                <div class="col round red">
                DELETE
                </div>
                </a>';
        // echo '</div>';
        echo '</div>';
        echo '<div class="table-row"><div class="col" style="height:10px;"></div></div>';
    }
    ?>
</div>

