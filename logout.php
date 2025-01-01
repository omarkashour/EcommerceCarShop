<?php


if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$_SESSION['user'] = null;
session_destroy();
header("Location: ./index.php");


?>