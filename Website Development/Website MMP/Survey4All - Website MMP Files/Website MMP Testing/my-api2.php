<?php

    $conn = mysqli_connect("localhost", "2112834", "85rj5j", "db2112834");
    if(!$conn){
        echo "Connection error," . mysqli_connect_error();
    }

    $id = htmlspecialchars($_GET['id']);

    $sql = 'SELECT * FROM `SurveyQuestions` WHERE SurveyDetails_SurveyID = "'.$id.'"';

    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        $json[] = $row;
    }

    // Error ?
    if($result == null) {
        echo("<h4>SQL error description: " . $mysqli -> error . "</h4>");
    }

    // Get data, convert to JSON and print
    print json_encode($json);

    // Free result set and close connection
    $result -> free_result();
    $conn -> close();
    ?>