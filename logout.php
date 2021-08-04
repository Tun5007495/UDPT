<?php
session_start();

session_destroy();
session_start();
$_SESSION['user_email']="guest";



header("location:index.php");
?>