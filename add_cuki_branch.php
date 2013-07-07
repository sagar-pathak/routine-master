<?php
$redirected_to = '/routine-master/home.php?opt=4'; 

if (isset($_POST['submitBranch'])) {
    $new_branch = $_POST["branch_name"];
    setcookie("new_branch",$new_branch,time()+3600,"/");
    header("Location: ".$redirected_to);
}else{
    echo 'test';
}  
?>
