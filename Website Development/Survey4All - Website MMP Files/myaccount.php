<?php
session_start();
if(!isset($_SESSION["Username"])){
    header("Location: login.php");//If user not logged in redirect to the login page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Survey4All</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1, h3, p {
            font-family: Arial, sans-serif;
        }

        header {
            background-color: lightgray;
            width: 100%;
            height: 100px;
            border: none;
            margin: 0;
            padding: 0;
        }

        .popup {
            background-color: lightgray;
            width: 450px;
            padding: 30px 40px;
            position: absolute;
            transform: translate(-50%,-50%);
            left: 50%;
            top: 50%;
            border-radius: 8px;
            font-family: "Poppins",sans-serif;
            display: none;
            text-align: center;
        }

        .popup button {
            display: block;
            margin:  0 0 20px auto;
            background-color: transparent;
            font-size: 30px;
            color: black;
            border: none;
            outline: none;
            cursor: pointer;
        }

        .popup p {
            font-family: Arial, sans-serif;
            font-size: 14px;
            text-align: justify;
            margin: 20px 0;
            line-height: 25px;
        }

        .logo {
            float: left;
            height: 50%;
            width: 20%;
            margin: 20px 5px;
        }

        ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            flex-direction: row;
        }

        ul li {
            margin: 20px 20px;
        }

        ul li p {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        .navbutton, .dropbtn {
            background-color: lightgray;
            border: none;
            color: black;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            transition-duration: 0.4s;
        }

        #login, #register {
            background-color: gray;
            border: none;
            color: black;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            transition-duration: 0.4s;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: lightgray;
            border: none;
            color: black;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .navbutton:hover, .dropbtn:hover {
            background-color: white;
            color: black;
        }

        .container {
            width: 100%;
            height: 500px;
        }

        .frames {
            width: 100%;
            height: 500px;
            border: none;
        }

        form {
            align-items: center;
            justify-content: center;
            flex-direction: column;
            position: relative;
            text-align: center;
        }

        input[type=submit], input[type=text], input[type=email], h2, textarea {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        input[type=text], input[type=email] {
            height: 50px;
        }
        input[type=submit] {
            background-color: #04AA6D;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            transition-duration: 0.4s;
        }
        input[type=submit]:hover {
            background-color: lightgray;
            color: black;
        }

        #login:hover, #register:hover {
            background-color: white;
            color: black;
        }

        .center {
            margin: auto;
            width: 50%;
            padding: 10px;
        }

        form * {
            width: 100%;
            margin-top: 2px;
            text-align: center;
        }
    </style>
</head>
<body onload="showSection(home)">
<div class="popup">
    <button id="close">&times;</button>
    <h2>Alert</h2>
    <p>
        By using the website you are agreeing to the Terms of Service, Privacy Policy, and Cookie Use Policy.
        <br><br>
        They can be found here:
        <br>
        <a target="_blank" href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/_termsofservice.html">Terms of Service</a>
        <br>
        <a target="_blank" href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/_privacypolicy.html">Privacy Policy</a>
        <br>
        <a target="_blank" href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/_cookieusepolicy.html">Cookie Use Policy</a>
    </p>
</div>
<header>
    <img src="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/Survey4AllLogo.png" alt="Logo" class="logo">
    <nav>
        <ul>
            <li>
                <button class="navbutton" id="home" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/homepage.html';">Home</button>
                <button class="navbutton" id="vs" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/viewsurveys.html';">View Surveys</button>
                <button class="navbutton" id="cs" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/createsurveys.php';">Create Surveys</button>
                <button class="navbutton" id="contact" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/contactus.html';">Contact Us</button>
                <button class="navbutton" id="va" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/myaccount.php';">My Account</button>
                <div class="dropdown">
                    <button class="dropbtn" id="legal">Legal</button>
                    <div class="dropdown-content">
                        <button class="navbutton" id="tos" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/termsofservice.html';">Terms of Service</button>
                        <button class="navbutton" id="priv" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/privacypolicy.html';">Privacy Policy</button>
                        <button class="navbutton" id="cook" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/cookieusepolicy.html';">Cookie Use Policy</button>
                    </div>
                </div>
                <button class="navbutton" id="login" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/login.php';">Login</button>
                <button class="navbutton" id="register" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/registration.php';">Register</button>
            </li>
        </ul>
    </nav>
</header>
<div class="container">
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
    		<p><a href="Profile.php">My Profile</a></p>
    		<p><a href="dashboard.php">Go to Dashboard</a></p>
        </div>
</body>
</html>