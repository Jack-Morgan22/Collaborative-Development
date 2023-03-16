<?php
    session_start();//This will keep a recoud of the session of the user.
    if(!isset($_SESSION["Username"])) {
        header("Location: login.php");
        exit();
    }
?>