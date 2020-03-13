<?php 

session_start();
session_destroy();
setcookie("rememberlogin", "", time() - (86400 * 7), "/");
header('Location:index.php');
?>