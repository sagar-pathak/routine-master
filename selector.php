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
    $query = 'SELECT DISTINCT branch FROM department ORDER BY branch ASC';
    $result = mysql_query($query);
    
    if (isset($_POST["submit"])) {
        $department_name = $_POST['department'];
        $semester        = $_POST['semester'];
        setcookie("department_name",$department_name,time()+3600,"/");
        setcookie("semester",$semester,time()+3600,"/");
        header('Location: '.$_SERVER["PHP_SELF"].'?opt='.$_COOKIE['option']);
    }
    if (isset($_COOKIE['new_branch'])) {
        setcookie("new_branch", "", time() - 3600, "/");
    }
}

?>
<link href="css/sample.css" rel="stylesheet" type="text/css" />
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">       
<div class="container" style="width:410px">
    <div class="table-row">
         <div class="col">Department</div>
         <div class="col">
              <select name="department">
                    <?php
                    while ($row = mysql_fetch_array($result)) {
                        $branch = $row['branch'];
                        $query1 = 'SELECT * FROM department WHERE branch = "' . $branch . '" ORDER BY department_name ASC';
                        $result1 = mysql_query($query1);
                        echo '<optgroup label="' . $branch . '">';
                        while ($row1 = mysql_fetch_array($result1)) {
                            echo '<option>' . $row1["department_name"] . '</option>';
                        }
                        echo '</optgroup>';
                    }
                    ?>
                </select>
            
         </div>
    </div>
    <div class="table-row">
         <div class="col">Semester</div>
         <div class="col">
              <select name="semester">
                    <option value="1">First</option>
                    <option value="2">Second</option>
                    <option value="3">Third</option>
                    <option value="4">Fourth</option>
                    <option value="5">Fifth</option>
                    <option value="6">Sixth</option>
                    <option value="7">Seventh</option>
                    <option value="8">Eighth</option>
                </select>
         </div>
    </div>
  
        
       
    
</div>
    <p>
        
        <div style="padding-left:0px"><input style="width:195px"class="button round blue" type="submit" name="submit" value="SELECT"/></div>
    </p>
    
</form>
