<?php
/*
  Document   : home
  Created on : Jun 10, 2013, 3:00:03 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
session_start();
//echo $_SESSION['user_name'] . '<br/>';
//echo '<a href="logout.php">Logout</a>';
$project_name = 'Routine Master ';
$username = $_SESSION['user_name'];
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $project_name; ?> - Home page</title>
        <!-- Stylesheets -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/sample.css">
        <!-- Optimize for mobile devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- jQuery & JS files -->
        <script src="js/jquery.min.js"></script>
        <script src="js/script.js"></script>  
    </head>
    <body>
        <!-- TOP BAR -->
        <div id="top-bar">
            <div class="page-full-width cf">
                <ul id="nav" class="fl">
                    <div class="project_name"><?php echo $project_name; ?></div>
                    <li style="margin-left:850px"><a href="#" 
                                                     class="round button dark menu-user image-left">
                            Logged in as <strong><?php echo $username; ?></strong></a>
                        <ul>
                            <li style="width:119px"><a href="#">My Profile</a></li>
                            <li style="width:119px"><a href="#">User Settings</a></li>
                            <li style="width:119px"><a href="#">Change Password</a></li>
                            <li style="width:119px"><a href="logout.php">Log out</a></li>
                        </ul> 
                    </li>
                    <!--      <li><a href="#" class="round button dark menu-email-special image-left">3 new messages</a></li>
                          <li><a href="#" class="round button dark menu-logoff image-left">Log out</a></li> 
                    -->
                </ul> <!-- end nav -->
                <!--
                <form action="#" method="POST" id="search-form" class="fr">
                    <fieldset>
                        <input type="text" id="search-keyword" class="round button dark ic-search image-right" placeholder="Search..." />
                        <input type="hidden" value="SUBMIT" />
                    </fieldset>
                </form>
                -->
            </div> <!-- end full-width -->	
        </div> <!-- end top-bar -->

        <!-- MAIN CONTENT -->
        <div id="content">
            <div class="page-full-width cf">
                <div class="side-menu fl">
                    <h3>Options</h3>
                    <ul>
                        <li><a href="<?php echo $_SERVER["PHP_SELF"] . '?opt=1'; ?>">Create Routine</a></li>
                        <li><a href="<?php echo $_SERVER["PHP_SELF"] . '?opt=2'; ?>">Edit Routine</a></li>
                        <li><a href="<?php echo $_SERVER["PHP_SELF"] . '?opt=3'; ?>">Update Course</a></li>
                        <li><a href="<?php echo $_SERVER["PHP_SELF"] . '?opt=4'; ?>">Add Branch/Department</a></li>
                        <li><a href="<?php echo $_SERVER["PHP_SELF"] . '?opt=7'; ?>">Delete Branch/Department</a></li>
                    </ul>
                </div> <!-- end side-menu -->
                <div class="side-content fr">
                    <!--  <div class="half-size-column fl"> -->
                    <div class="content-module">
                        <div class="content-module-heading cf">
                            <h3 class="fl">Headings &amp; Paragraphs</h3>
                            <span class="fr expand-collapse-text">Click to collapse</span>
                            <span class="fr expand-collapse-text initial-expand">Click to expand</span>
                        </div> <!-- end content-module-heading -->
                        <div class="content-module-main ">

                            <?php
                            /*
                              <h1>This is an H1 heading</h1>
                              <p>Followed by a very short paragraph and a stripe content separator.</p>
                              <div class="stripe-separator"><!-- --></div>
                              <h2>This is an H2 heading</h2>
                              <h3>This is an H3 heading</h3>
                              <h4>This is an H4 heading</h4>
                              <h5>This is an H5 heading</h5>
                              <div class="stripe-separator"><!-- --></div>
                              <p>The separator above has top and bottom margin set by default, so it will split the content accordingly without
                              any extra tweaks needed from you.</p>
                              <div class="stripe-separator"><!-- --></div>
                              <blockquote>This is a blockquote followed by a cite tag. And no matter how much text you put in this, it will automatically resize.</blockquote>
                              <cite>- John</cite>
                             */
                            if ((isset($_COOKIE['department_name']) && isset($_COOKIE['semester']))) {
                                 setcookie("new_depart"," ",time()-3600,"/");
                                 setcookie("new_branch"," ",time()-3600,"/");
                                if (isset($_GET['opt'])) {
                                    $option = $_GET['opt'];
                                } else {
                                    $option = 1;
                                }
                                if ($option == 1) {
                                    include 'operation/create_routine.php';
                                } else if ($option == 2) {
                                    include 'operation/edit_routine.php';
                                } else if ($option == 3) {
                                    include 'operation/update_courses.php';
                                } else if ($option == 4) {
                                    include 'operation/add_branch_dept.php';
                                } else if($option == 5){
                                    include 'add_new_branch.php';
                                } else if($option == 6){
                                    include 'add_new_depart.php';
                                }else if($option == 7){
                                    include 'del_branch_dept.php';
                                }else if($option == 8){
                                    include 'notifier.php';
                                }else {
                                    include 'operation/create_routine.php';
                                }
                            } else {
                                if(isset($_GET['opt'])){
                                    if ($_GET['opt'] == '4') {
                                        include 'operation/add_branch_dept.php';
                                    }else if($_GET['opt'] == '5'){
                                        include 'add_new_branch.php';
                                    }else if($_GET['opt'] == '6'){
                                         include 'add_new_depart.php';
                                    }else if($_GET['opt'] == '7'){
                                         include 'del_branch_dept.php';
                                    }else{
                                        include 'selector.php';
                                    }
                                }else {
                                    include 'selector.php';
                                }
                            }
                            ?>

                        </div> <!-- end content-module-main -->
                    </div> <!-- end content-module -->
                    <!-- </div> end half-size-column-->
                </div> <!-- end side-content -->
            </div> <!-- end full-width -->
        </div> <!-- end content -->
        <!-- FOOTER -->
        <div id="footer">
            <p>&copy; Copyright 2013 <a href="www.ku.edu.np"> Kathmandu University </a>. All rights reserved.</p>
            <p><strong><?php echo $project_name; ?></strong> by <a href="credits.php"> Group-I</a></p>
        </div> <!-- end footer -->
    </body>
</html>
