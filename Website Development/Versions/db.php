<?php
    // Enter host name, database username, password, and database name.
    $con = mysqli_connect("localhost","2112834","85rj5j","db2112834");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
