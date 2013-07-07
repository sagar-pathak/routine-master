<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if (isset($_SESSION['logged_in'])) {
    $option = $_GET['opt'];
    header('Location: home.php?opt=' . $option);
} else {
    include 'initials/connection.php';
    $project_name = 'Routine Master';
    $table_name = 'admin';
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = mysql_real_escape_string($_POST['password']);
        $query = 'SELECT username, password FROM ' . $table_name;
        $result = mysql_query($query);
        $status = false;
        while ($row = mysql_fetch_array($result)) {
            if ($row['username'] == $username && $row['password'] == $password) {
                $status = true;
            }
        }
        if ($status == true) {
            $_SESSION['user_name'] = $_POST['username'];
            $_SESSION['logged_in'] = True;
            header('Location: check_session.php');
        } else {
            $_SESSION['error'] = 'Authentication Failed';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $project_name; ?> Administrator- Login</title>
        <!-- Stylesheets -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/jquery-ui.css" />
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>
       
        <!-- Optimize for mobile devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
    </head>
    <body>
        <!-- TOP BAR -->
        <div id="top-bar">
            <div class="page-full-width">
                <div class="project_name"><?php echo $project_name; ?></div>
            </div> <!-- end full-width -->
        </div> <!-- end top-bar -->

        <!-- HEADER -->
        <div id="header">
            <div class="page-full-width cf">
                <div id="login-intro" class="fl">
                    <h1>Login to <?php echo $project_name; ?></h1>
                    <h5>Enter your credentials below</h5>
                </div> <!-- login-intro -->
                <!-- The logo will automatically be resized to 39px height. -->
                <a href="#" id="company-branding" class="fr">
                    <img src="images/project_logo.png" alt="<?php echo $project_name . ' logo'; ?>" /></a>
            </div> <!-- end full-width -->	
        </div> <!-- end header -->
        <!-- MAIN CONTENT -->
        <div id="content">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="login-form">
                <fieldset>
                    <?php
                    //error printing box
                    if (isset($_SESSION['error'])) {
                        echo '<p class="error-box">' . $_SESSION['error'] . '</p>';
                        unset($_SESSION['error']);
                    }
                    ?>
                    <p>
                        <label for="login-username">username</label>
                        <input type="text" id="login-username" name="username" class="round full-width-input" autofocus />
                    </p>
                    <p>
                        <label for="login-password">password</label>
                        <input type="password" id="login-password" name="password" class="round full-width-input" />
                    </p>
                    <p>I've <a href="forgot_password.php">forgotten my password</a>.</p>
                    <input type="submit" class="button round blue image-right ic-right-arrow" name="submit" value="LOGIN"/>
                </fieldset>
                <br/><div class="information-box round">Just click on the "LOG IN" button to continue, no login information required.</div>
            </form>
        </div> <!-- end content -->
        <!-- FOOTER -->
        <div id="footer">

            <p>&copy; Copyright 2013 <a href="www.ku.edu.np"> Kathmandu University </a>. All rights reserved.</p>
            <p><strong><?php echo $project_name; ?></strong> by <a href="credits.php"> Group-I</a></p>
         
        </div> <!-- end footer -->

    </body>
</html>