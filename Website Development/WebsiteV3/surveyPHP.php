<?php
    require('db.php');
    $array = json_decode($_POST['listArray']);
    $surveyname = $_GET['survey-title'];
    $response = listArray();
    echo($surveyname);
?>