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
            height: 40%;
            width: 15%;
            margin: 25px 5px;
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

        .button {
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

        button:hover {
            background-color: lightgray;
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

        table {
            border-collapse: collapse;
            width: 90%; /* changed to 90% */
            margin: 0 auto;
        }

        td {
            padding: 10px;
            border: 1px solid #cccccc; /* light gray */
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
    <?php

        if (!isset($_SESSION['Username'])) {
            header('Location: login.php');
            exit();
        }

        require('db.php');

        $Username = $_SESSION['Username'];
        $query = "SELECT * FROM `Users` WHERE `Username`='$Username'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $Name = $row['Name'];
        $Email = $row['Email'];
        $JoinDate = $row['JoinDate'];
    ?>
    <div class="form">
        <h2>Profile Information</h2>
        <table>
            <tr>
                <td>Username:</td>
                <td><?php echo $Username; ?></td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><?php echo $Name; ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $Email; ?></td>
            </tr>
            <tr>
                <td>Join Date:</td>
                <td><?php echo $JoinDate; ?></td>
            </tr>
             <!-- Add more rows to the table for additional information -->
        </table>

        <table>
        <tr>
        <td>
        <button class="button" onclick="window.location.href='logout.php'">Logout</button>
        <button class="button" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/dashboard.php'">Dashboard</button>
        <button class="button" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/homepage.html'">Home</button>
        </td>
        </tr>
        </table>
    </div>
</body>
</html>