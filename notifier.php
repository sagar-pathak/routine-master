<?php

/*
  Document   : notifier
  Created on : Jun 29, 2013, 10:14:21 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
$redirected_to = '/routine-master/home.php?opt=3';
?>
<style>
    .noti{
        height:100px;
        text-align: center;
        padding-top:50px;
    }
</style>
<div class="noti">
    <font color="green" size="40px"><b>
    SUCCESS!!
    </b></font>
    <a style="text-decoration: none" href="<?php echo $redirected_to;?>"><div >RETURN</div></a>
</div>
<BR/>

