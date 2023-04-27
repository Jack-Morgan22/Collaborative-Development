<?php
//This where the dashboard will include auth_session.php file on all user panel pages.
include("auth_session.php");
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
        <p>Here you can view your surveys:</p>	
<?php
    // This is where the connection happens through host name, database username, password, and database name.
    $con = mysqli_connect("localhost","2112834","85rj5j","db2112834");
    // The database will check connection between the site and database.
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	
	// Retrieve the surveys for the logged in user
	if(isset($_SESSION['SurveyID'])) {
		$SurveyID = $_SESSION['SurveyID'];
		$sql = "SELECT * FROM SurveyDetails WHERE SurveyID = '$SurveyID'";
		$result = $con->query($sql);

		// Display the surveys in a table
		if ($result->num_rows > 0) {
			echo "<table>";
			echo "<tr><th>SurveyName</th><th>Users_ID</th><th>CreationDate</th></tr>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" . $row['SurveyName'] . "</td>";
				echo "<td>" . $row['Users_ID'] . "</td>";
				echo "<td>" . $row['CreationDate'] . "</td>";
				echo "</tr>";
				}
			echo "</table>";
			} else {
			echo "No surveys found.";
			}
		}

	// Close the MySQL connection
	$con->close();
?>

        <p><a href="logout.php">Logout</a></p>
		<p><a href="profile.php">Profile</a></p>
    </div>
</body>
</html>