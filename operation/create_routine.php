<?php

/*
  Document   : create_routine
  Created on : Jun 21, 2013, 11:19:21 PM
  Author     : Sagar Pathak
  Description:
  Purpose of the php file as follows.
 */
include 'option_display.php';
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<div class="container">
    <div class="heading">
         <div class="col" style="width:20%">Course Code</div>
         <div class="col" style="width:60%">Course Title</div>
         <div class="col" style="width:20%">Time</div>
      
    </div>
    <div class="table-row">
         <div class="col" style="width:20%"></div>
         <div class="col" style="width:60%"></div>
          <div class="col" style="width:20%"><input type="text"/></div>
    </div>
</div>
</form>