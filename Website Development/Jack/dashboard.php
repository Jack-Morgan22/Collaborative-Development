<?php
session_start();
if(!isset($_SESSION["Username"])){
    header("Location: login.php");//If user not logged in redirect to the login page
    exit(); 
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
body {
    background: #d3d3d3;
}
.form {
    margin: 50px auto;
    width: 300px;
    padding: 30px 25px;
    background: white;
}
h1.login-title {
    color: #666;
    margin: 0px auto 25px;
    font-size: 25px;
    font-weight: 300;
    text-align: center;
}
.login-input {
    font-size: 15px;
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 25px;
    height: 25px;
    width: calc(100% - 23px);
}
.login-input:focus {
    border-color:#6e8095;
    outline: none;
}
.login-button {
    color: #fff;
    background: #55a1ff;
    border: 0;
    outline: 0;
    width: 100%;
    height: 50px;
    font-size: 16px;
    text-align: center;
    cursor: pointer;
}
.link {
    color: #666;
    font-size: 15px;
    text-align: center;
    margin-bottom: 0px;
}
.link a {
    color: #666;
}
h3 {
    font-weight: normal;
    text-align: center;
}
</style>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="form">
        <h1 class="login-title">Welcome, <?php echo $_SESSION['Username']; ?>!</h1>
<?php
    // This is where the connection happens through host name, database username, password, and database name.
    $con = mysqli_connect("localhost","2112834","85rj5j","db2112834");
    // The database will check connection between the site and database.
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	
 // get the user's ID from the session
    $UserID = $_SESSION['Username'];
    // establish MySQLi connection
    // This is where the connection happens through host name, database username, password, and database name.
    $con = mysqli_connect("localhost","2112834","85rj5j","db2112834");
    // The database will check connection between the site and database.
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    // query the database for the user's surveys
    $sql = "SELECT SurveyID, SurveyName FROM SurveyDetails WHERE Users_UserID = '$UserID'";
    $result = mysqli_query($con, $sql);
    // display the surveys in a list
    if (mysqli_num_rows($result) > 0) {
        echo "<h2>My Surveys</h2>";
        echo "<ul>";
        while($row = mysqli_fetch_assoc($result)) {
            $surveyID = $row['SurveyID'];
            $surveyName = $row['SurveyName'];
            // display the survey name with a link to the survey
            echo "<li><a href='survey.php?id=$surveyID'>$surveyName</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>You haven't created any surveys yet.</p>";
    }
    // close the MySQLi connection
    mysqli_close($con);
?>

        <p><a href="logout.php">Logout</a></p>
		<p><a href="survey.php">Create survey</a></p>	
    </div>
</body>
</html>