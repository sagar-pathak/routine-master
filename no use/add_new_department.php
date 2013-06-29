<?php
/*
  Document   : add_new_department
  Created on : Jun 21, 2013, 4:01:16 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */

$add_new_branch = "add_new_branch.php";
include 'initials/connection.php';
$query = 'SELECT DISTINCT branch FROM department';
$result = mysql_query($query);


if (isset($_POST['submitNow'])) {
    if ($_POST['branch'] == "add_new_branch") {
        setcookie("new_branch",$add_new_branch,time()+3600,"/");
        setcookie("new_department"," ",time()-3600,"/");
        header("Location: " . $add_new_branch);
       // header("Location: ".$_SERVER["PHP_SELF"]."?opt=".$_COOKIE['option']);
    } else {
        $department_name = $_POST['new_department'];
        $department_desc = $_POST['depart_desc'];
        $branch = $_POST['branch'];
        $redirected_to = "selector.php";

        include 'initials/connection.php';
        $query = 'INSERT INTO department (department_name,department_desc,branch) VALUES ("' . $department_name . '","' . $department_desc . '","' . $branch . '")';
        if (mysql_query($query)) {
            header('Location: ' . $redirected_to);
        } else {
            echo mysql_error();
        }
    }
}
?>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    Department Branch: <select name="branch"> 
        <?php
        while ($row = mysql_fetch_array($result)) {
            echo '<option>' . $row["branch"] . '</option>';
        }
        if(isset($_COOKIE['new_branch'])){
            echo '<option>'.$_COOKIE['new_branch'].'</option>';
        }
        ?>
        
        <option value="add_new_branch">Add New</option>
    </select>
    <br/>
    Department Name: <input type="text" name="new_department"/><br/>
    Description: <input type="text" name="depart_desc"/><br/>
    <input type="submit" name="submitNow" value="SUBMIT"/>
</form>