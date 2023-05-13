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
        background-color: white;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
      }
      .form {
        background-color: #f2f2f2;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        margin: 20px auto;
        max-width: 800px;
        padding: 30px;
      }
      .login-title {
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
      }
      ul {
        list-style: none;
        margin: 0;
        padding: 0;
      }
      li {
        margin: 10px 0;
      }
      a {
        color: #333;
        text-decoration: none;
      }
      a:hover {
        text-decoration: underline;
      }
      button {
        background-color: #4CAF50;
        border: none;
        border-radius: 4px;
        color: white;
        cursor: pointer;
        font-size: 16px;
        padding: 10px;
      }
      button:hover {
        background-color: #3e8e41;
      }
</style>
   <meta charset="utf-8">
<title>Dashboard - Client area</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="form">
        <h1 class="login-title">Welcome, <?php echo $_SESSION['Username']; ?>!</h1>
        <p>Listed here is all your user created surveys!</p>
        <head>
            <script src="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/SV/jquery-3.6.3.min.js"></script>
            <link rel="stylesheet" href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/SV/td_style.css">
        </head>
        <body>
            <form id="surveyform">
                <div id="list">
                    <ul></ul>
                </div>
            </form>
        </body>
        <script type="text/javascript">
          var UserID = <?php require('db.php');
          $username = stripslashes($_SESSION['Username']);

          $sql1 = "SELECT UserID FROM `Users` WHERE Username = '$username'";

          $result1 = mysqli_query($con, $sql1);

          while($rows = mysqli_fetch_assoc($result1)){
              $userID = $rows['UserID'];
          }
          echo($userID);
          ?>;
          UserID = "?userid=" + UserID;
          fetch('https://mi-linux.wlv.ac.uk/~2201053/Survey4All/my-api4.php' + UserID)
            .then(response => response.json())
            .then(response => {
                const questionList = document.getElementById("list");
                let i = 0;
                var list = $("#list").find('ul');
                while(i < response.length){
                    var stringAppend =`<li><a id="${response[i].SurveyName}" name="${response[i].SurveyName}" href="#">"${response[i].SurveyName}"</a><button onclick="shareLink('${response[i].SurveyID}')">Share</button></li>`;
                    list.append(`${stringAppend}`);
                    console.log(response[i].SurveyName);
                    i++;
                }
            })
            .catch(err =>{
                console.log(err);
            })
            function shareLink(surveyID) {
                var link = "https://mi-linux.wlv.ac.uk/~2112834/CollabDev/SV/answer.php?id=" + surveyID;
                window.prompt("Copy this link and share:", link);
            }
        </script>
        <p><a href="logout.php">Logout</a></p>
        <p><a href="https://mi-linux.wlv.ac.uk/~2201053/Survey4All/createsurveys.php">Create survey</a></p>
        <p><a href="https://mi-linux.wlv.ac.uk/~2201053/Survey4All/myaccount.php">My Account</a></p>
        <p><a href="https://mi-linux.wlv.ac.uk/~2201053/Survey4All/homepage.html">Go to the Home page</a></p>
    </div>
</body>
</html>
