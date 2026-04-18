<?php

include 'connect.php';

session_start();

// destroy all session data
session_unset();
session_destroy();

// delete cookie
setcookie('user_id','', time() - 3600, '/');

// redirect
header('location:../home.php');
exit();

?>