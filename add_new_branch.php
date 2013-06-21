<?php
/*
  Document   : add_new_branch
  Created on : Jun 21, 2013, 4:38:46 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 *//*
include 'initials/connection.php';
$redirected_to = "add_new_department.php";
if (isset($_POST['submitBranch'])) {

    $new_branch = $_POST["branch_name"];
    $query = 'INSERT INTO department (branch) VALUES ("' . $new_branch . '")';
    if (mysql_query($query)) {
        header("Location: " . $redirected_to);
    } else {
        echo mysql_error();
    }
}
  */
$redirected_to = "add_new_department.php";
if (isset($_POST['submitBranch'])) {
    $new_branch = $_POST["branch_name"];
    setcookie("new_branch",$new_branch,time()+3600,"/");
    header("Location: ".$redirected_to);
}
?>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    Branch Name : <input type="text" name="branch_name"/> <br/>
    <input type="submit" name="submitBranch" value="ADD BRANCH"/>
</form>