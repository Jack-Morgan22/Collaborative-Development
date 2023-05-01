<?php
session_start();
if(!isset($_SESSION["Username"])){
    header("Location: login.php");//If user not logged in redirect to the login page
    exit(); 
}
?>