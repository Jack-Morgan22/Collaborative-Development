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
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="form">
        <h1 class="login-title">My Profile</h1>
        <p>Usernamename: <?php echo $_SESSION['Username']; ?></p>
        <p><a href="dashboard.php">Go to Dashboard</a></p>
        <p><a href="logout.php">Logout</a></p>
		<p><a href="Profile.php">My Profile</a></p>
    </div>
</body>
</html>