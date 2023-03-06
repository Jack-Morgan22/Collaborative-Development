<?php
    $con = mysqli_connect("localhost","2112834","85rj5j","db2112834");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    function(){
        $data = json_decode($_POST['jObject'], true);
        $surveyname = $_GET['survey-title'];
        var_dump(isset($surveyname));
        var_dump(isset($data));
        $sql = "INSERT INTO `SurveyDetails` (`SurveyID`, `SurveyName`, `CreationDate`, `UploadStatus`, `UploadDate`, `Users_UserID`) VALUES (NULL, '$surveytitle', 'now()', 'Y', NULL, '2023502400')";
        //$sql = "INSERT INTO `SurveyQuestions` (`QuestionNumber`, `QuestionName`, `QuestionType`, `QuestionStatus`, `SurveyDetails_SurveyID`) VALUES (' ', ' ', ' ', ' ', ' ')";
        mysqli_connect($con, $sql);
    }
?>