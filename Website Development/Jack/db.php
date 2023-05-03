<?php
    // This is where the connection happens through host name, database username, password, and database name.
    $con = mysqli_connect("localhost","2112834","85rj5j","db2112834");
    // The database will check connection between the site and database.
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
