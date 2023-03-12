<?php
    $con = mysqli_connect("localhost","2112834","85rj5j","db2112834");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $data = json_decode(file_get_contents('php://input', true));
        var_dump()
    }else{
        echo('Invalid data.');
    }
    $surveyname = stripslashes($_REQUEST['survey-title']);
    $surveyname = mysqli_real_escape_string($con, $surveyname);
    $sql = "INSERT INTO `SurveyDetails` (`SurveyID`, `SurveyName`, `CreationDate`, `UploadStatus`, `UploadDate`, `Users_UserID`) VALUES (NULL, '$surveytitle', 'now()', 'Y', NULL, '2023502400')";
    //$sql = "INSERT INTO `SurveyQuestions` (`QuestionNumber`, `QuestionName`, `QuestionType`, `QuestionStatus`, `SurveyDetails_SurveyID`) VALUES (' ', ' ', ' ', ' ', ' ')";
    mysqli_query($con, $sql);
    
?>