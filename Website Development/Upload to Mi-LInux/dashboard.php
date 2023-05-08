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
                    fetch('https://mi-linux.wlv.ac.uk/~2112834/CollabDev/my-api4.php')
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
		<p><a href="https://mi-linux.wlv.ac.uk/~2201053/Survey4All/myaccount.php">My Profile</a></p>
		<p><a href="https://mi-linux.wlv.ac.uk/~2201053/Survey4All/homepage.html">Homepage</a></p>
    </div>
</body>
</html>