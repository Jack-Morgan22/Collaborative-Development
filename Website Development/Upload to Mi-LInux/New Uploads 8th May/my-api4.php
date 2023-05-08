<?php

    $conn = mysqli_connect("localhost", "2112834", "85rj5j", "db2112834");
    if(!$conn){
        echo "Connection error," . mysqli_connect_error();
    }
    $username = stripslashes($_SESSION['Username']);

    $sql1 = "SELECT UserID FROM `Users` WHERE Username = '$username'";

    $result1 = mysqli_query($con, $sql1);
    
    while($rows = mysqli_fetch_assoc($result1)){
        $userID = $rows['UserID'];
    }

    $sql = "SELECT * FROM `SurveyDetails` WHERE User_UserID = '$userID'";

    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        $json[] = $row;
    }

    // Error ?
    if($result == null) {
        echo("<h4>SQL error description: " . $mysqli -> error . "</h4>");
    }

    // Get data, convert to JSON and print
    echo json_encode($json);

    // Free result set and close connection
    $result -> free_result();
    $conn -> close();
    ?>