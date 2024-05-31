<?php 

session_start();
$_SESSION = [];
session_unset();
setcookie('login', 'false');

session_destroy();
    header("location: login.php");
    exit;
?>