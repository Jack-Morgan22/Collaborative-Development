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
    background: #2E8B57;
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
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
	//Registration form will connect to the database.
    require('db.php');
    // When form submitted, the details will insert values into the database.
    if (isset($_REQUEST['Username'])) {
        // Does not allow backslashes.
        $Username = stripslashes($_REQUEST['Username']);
        // Does not allow special characters within a string.
        $Username = mysqli_real_escape_string($con, $Username);
        $Password   = stripslashes($_REQUEST['Password']);
        $Password   = mysqli_real_escape_string($con, $Password);
        $Email = stripslashes($_REQUEST['Email']);
        $Email = mysqli_real_escape_string($con, $Email);
		$Name = stripslashes($_REQUEST['Name']);
        $Name = mysqli_real_escape_string($con, $Name);
        $JoinDate = date("Y-m-d H:i:s");
        $query    = $query    = "INSERT into `Users` (Username, Password, Email, Name, JoinDate)
                     VALUES ('$Username', '" . md5($Password) . "', '$Email', '$Name', '$JoinDate')"; //Registration where the password is encrypted.
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
                  </div>"; //This where Registration will check for errors within the code.
        }
    } else {
?>
  <form class="form" action="" method="post">
  <h1 class="login-title">Registration</h1>
  <input type="text" class="login-input" name="Username" placeholder="Username" required />
  <input type="text" class="login-input" name="Name" placeholder="Name" required />
  <input type="text" class="login-input" name="Email" placeholder="Email Adress" required />
  <input type="password" class="login-input" name="Password" placeholder="Password" required />
  <input type="password" class="login-input" name="Confirm password" placeholder="Confirm password">
  <input type="submit" name="submit" value="Register" class="login-button">
  <p class="link"><a href="login.php">Click to Login</a></p>
   <p class="link"><a href="https://mi-linux.wlv.ac.uk/~2201053/Survey4All/homepage.html">Home</a></p>
  <label>
    <input type="checkbox" name="agree" value="yes" required>I read, understood and agree with the Terms of Service, Privacy Policy and Cookie Use Policy found on the Hyperlinks.
	<br>
	<br>
    <a href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/_termsofservice.html">Terms of service</a> 
    <a href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/_privacypolicy.html">Privacy Policy</a> 
    <a href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/_cookieusepolicy.html">Cookie use Policy</a>
  </label>
</form>
	
	
	
<?php
// The section above is where it shows the output of Registration form to the users where they can input their values.
    }
?>
</body>
</html>
