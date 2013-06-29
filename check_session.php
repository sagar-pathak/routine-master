<?php
/*
  Document   : check_session
  Created on : Jun 10, 2013, 2:30:27 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
session_start();
if(isset($_SESSION['logged_in'])){
    if(isset($_GET['opt'])){
        //echo $_GET['opt'];
        header('Location: home.php?opt='.$_GET['opt']);
    }else{
       // echo 'he';
        header('Location: home.php?opt=1');
    }
}else{
    $_SESSION['no_session']=true;
    header('Location: login.php');
}
?>

