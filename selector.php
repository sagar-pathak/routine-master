<?php
/*
  Document   : selector
  Created on : Jun 21, 2013, 3:53:00 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
if(isset($_COOKIE['department_name']) && isset($_COOKIE['semester'])){
    if(isset($_COOKIE['option'])){
        header("Location: home.php?opt=".$_COOKIE['option']);
    }else{
        header("Location: home.php?opt=1");//.$option);
    }
}else{
    include 'initials/connection.php';
    $getOption = $_GET['opt'];
    setcookie("option",$getOption,  time() + 3600,"/");
    $addDepartmentFile = "add_new_department.php";
    $query = 'SELECT DISTINCT branch FROM department ORDER BY branch ASC';
    $result = mysql_query($query);
    
    if (isset($_POST["submit"])) {
        $department_name = $_POST['department'];
        $semester        = $_POST['semester'];
        if ($department_name == 'addNew') {
            header("Location: " . $addDepartmentFile);
        } else {   
            setcookie("department_name",$department_name,time()+3600,"/");
            setcookie("semester",$semester,time()+3600,"/");
            header("Location: ".$_SERVER["PHP_SELF"]."?opt=".$_COOKIE['option']);
        }
    }
    if (isset($_COOKIE['new_branch'])) {
        setcookie("new_branch", "", time() - 3600, "/");
    }
}

?>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    <div class="option_table">
    <table>
        <tr>
            <td> Department</td>
            <td>
                <select name="department">
                    <?php
                    while ($row = mysql_fetch_array($result)) {
                        $branch = $row['branch'];
                        $query1 = 'SELECT department_name FROM department WHERE branch = "' . $branch . '" ORDER BY department_name ASC';
                        $result1 = mysql_query($query1);
                        echo '<optgroup label="' . $branch . '">';
                        while ($row1 = mysql_fetch_array($result1)) {
                            echo '<option>' . $row1["department_name"] . '</option>';
                        }
                        echo '</optgroup>';
                    }
                    ?>
                    <option name ="addNew" value="addNew">Add New</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Semester</td>
            <td>
                <select name="semester">
                    <option>First</option>
                    <option>Second</option>
                    <option>Third</option>
                    <option>Fourth</option>
                    <option>Fifth</option>
                    <option>Sixth</option>
                    <option>Seventh</option>
                    <option>Eighth</option>
                </select>
            </td>
        </tr>
        <tr><td></td>
            <td align="left">
                <input class="button round blue image-right" type="submit" name="submit" value="SELECT"/>
            </td>
        </tr>    
    </table>
</div>
</form>
