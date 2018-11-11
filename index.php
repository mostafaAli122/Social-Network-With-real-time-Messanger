<?php
include('./classes/DB.php');
include('./classes/Login.php');
if (Login::isloggedIn()) {
   echo 'Logged In';
   echo Login::isloggedIn();
}else{
    echo 'Not Logged In';
}


?>
