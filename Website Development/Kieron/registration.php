<!DOCTYPE html>
<html>
<head>
<style>
body {
    background: lightgray;
}
.form {
    margin: 50px auto;
    width: 375px;
    padding: 30px 25px;
    background: white;
    text-align: center;
    font-family: Arial, sans-serif;
}
h1.login-title {
    font-family: Arial, sans-serif;
    color: black;
    margin: 0px auto 25px;
    font-size: 25px;
    font-weight: 300;
    text-align: center;
}
.login-input {
    font-family: Arial, sans-serif;
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
    font-family: Arial, sans-serif;
    color: #fff;
    background: lightgray;
    border: 0;
    outline: black 2px;
    width: 100%;
    height: 50px;
    font-size: 16px;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease-in-out;
}
input[type=submit] {
    font-family: Arial, sans-serif;
    color: white;
    background: lightgray;
    border: 0;
    outline: black 2px;
    width: 100%;
    height: 50px;
    font-size: 16px;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease-in-out;
}
.login-button:hover, input[type=submit]:hover {
    background-color: #04AA6D;
    color: black;
}
.link {
    color: black;
    font-size: 15px;
    text-align: center;
    margin-bottom: 0px;
}
.link a {
    color: black;
    font-family: Arial, sans-serif;
}
h3 {
    font-weight: normal;
    text-align: center;
    font-family: Arial, sans-serif;
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

    //Checks if a password contains at least one lowercase letter, one uppercase letter, one number, and one special character.
    $pattern_1 = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[a-zA-Z\d!@#$%^&*()_+]{8,30}$/';
    // Checks if other fields have only spaces, letter and numbers.
    $pattern_2 = '/^[\p{L}\p{N}\s]+$/u';

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

        // Checks for allowed characters in Username, Name, Email and Password and displays message if conditions are not met.
 
        if (!preg_match($pattern_2, $Username)) {
            echo "The username can only contain letters, numbers, and spaces.";
            exit;
        }

        if (!preg_match($pattern_2, $Name)) {
            echo "The name can only contain letters, numbers, and spaces.";
            exit;
        }

        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            echo "Please enter a valid email address.";
            exit;
        }

        if (!preg_match($pattern_1, $Password)) {
            echo "The password must be minimum 8 characters long and contain at least 1 special character, 1 capital letter, and 1 number.";
            exit;
        }

        $query    = $query    = "INSERT into `Users` (Username, Password, Email, Name, JoinDate)
                     VALUES ('$Username', '" . md5($Password) . "', '$Email', '$Name', '$JoinDate')"; //Registration where the password is encrypted.
        $result   = mysqli_query($con, $query); 
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='https://mi-linux.wlv.ac.uk/~2112834/CollabDev/login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='https://mi-linux.wlv.ac.uk/~2112834/CollabDev/registration.php'>registration</a> again.</p>
                  </div>"; //This where Registration will check for errors within the code.
        }
    } else {
?>
  <form class="form" action="" method="post">
  <h1 class="login-title">Registration</h1>
  <input type="text" class="login-input" name="Username" placeholder="Username" required />
  <input type="text" class="login-input" name="Name" placeholder="Name" required />
  <input type="text" class="login-input" name="Email" placeholder="Email Address" required />
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
