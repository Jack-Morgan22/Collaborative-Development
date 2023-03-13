<?php
    session_start();
    //It should end the session.
    if(session_destroy()) {
		//Redirecting to registration page. 
        header("Location: login.php");
    }
?>

