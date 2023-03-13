<!DOCTYPE html>
<html>
<head>
<style>
body {
    background: #3e4144;
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
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['Username'])) {
        // removes backslashes
        $Username = stripslashes($_REQUEST['Username']);
        //escapes special characters in a string
        $Username = mysqli_real_escape_string($con, $Username);
        $Password   = stripslashes($_REQUEST['Password']);
        $Password   = mysqli_real_escape_string($con, $Password);
        $Email = stripslashes($_REQUEST['Email']);
        $Email = mysqli_real_escape_string($con, $Email);
		$Name = stripslashes($_REQUEST['Name']);
        $Name = mysqli_real_escape_string($con, $Name);
        $JoinDate = date("Y-m-d H:i:s");
        $query    = $query    = "INSERT into `Users` (Username, Password, Email, Name, JoinDate)
                     VALUES ('$Username', '" . md5($Password) . "', '$Email', '$Name', '$JoinDate')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="Username" placeholder="Username" required />
		<input type="text" class="login-input" name="Name" placeholder="Name">
        <input type="text" class="login-input" name="Email" placeholder="Email Adress">
        <input type="password" class="login-input" name="Password" placeholder="Password">
		<input type="password" class="login-input" name="Confirm password" placeholder="Confirm password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>
