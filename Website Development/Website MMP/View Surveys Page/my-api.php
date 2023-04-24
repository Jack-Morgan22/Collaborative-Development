<?php

    $conn = mysqli_connect("localhost", "2112834", "85rj5j", "db2112834");
    if(!$conn){
        echo "Connection error," . mysqli_connect_error();
    }

    $id = htmlspecialchars($_GET['id']);

    $sql = 'SELECT `SurveyName` FROM `SurveyDetails` WHERE SurveyID = "'.$id.'"';

    $result = mysqli_query($conn, $sql);

    // Error ?
    if($result == null) {
        echo("<h4>SQL error description: " . $mysqli -> error . "</h4>");
    }

    // Get data, convert to JSON and print
    $row = $result -> fetch_assoc();
    echo json_encode($row);

    // Free result set and close connection
    $result -> free_result();
    $conn -> close();
    ?>