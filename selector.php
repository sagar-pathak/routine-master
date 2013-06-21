<?php
/*
  Document   : selector
  Created on : Jun 21, 2013, 3:53:00 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
include 'initials/connection.php';
$addDepartmentFile = "add_new_department.php";
$query  = 'SELECT DISTINCT branch FROM department ORDER BY branch ASC';
$result = mysql_query($query);
if (isset($_POST["submit"])) {
    if($_POST['department'] == 'addNew'){
    header("Location: " . $addDepartmentFile);
    }else{
        echo "new setting";
    }
}
if(isset($_COOKIE['new_branch'])){
    setcookie("new_branch","",time()-3600,"/");
}
?>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    Department<select name="department">
        <?php
        while ($row = mysql_fetch_array($result)) {
            $branch = $row['branch'];
            $query1 = 'SELECT department_name FROM department WHERE branch = "'.$branch.'" ORDER BY department_name ASC';
            $result1 = mysql_query($query1);
            echo '<optgroup label="'.$branch.'">';
            while($row1 = mysql_fetch_array($result1)){
               echo  '<option>'.$row1["department_name"].'</option>';
            }
            echo '</optgroup>';
        }
        ?>
        <option name ="addNew" value="addNew">Add New</option>
    </select> <br/>
    <input type="submit" name="submit" value="SET"/>
</form>
