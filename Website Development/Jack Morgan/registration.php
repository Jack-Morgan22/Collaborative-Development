<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
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
    
</head>

<body>
<?php
	//Registration form will connect to the database.
    require('db.php');
    // When form submitted, the details will insert values into the database.


    // Checks if a password contains at least one lowercase letter, one uppercase letter, one number, and one special character.
    $pattern_1 = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+-.,:;])[a-zA-Z\d!@#$%^&*()_+-.,:;]{8,50}$/';
    // Checks if other fields have only spaces, letters and numbers. Allows maximum of 50 characters.
    $pattern_2 = '/^[\p{L}\p{N}\s]{1,50}$/u';

    if (isset($_REQUEST['Username'])) {
        // Does not allow backslashes.
        $Username = stripslashes($_REQUEST['Username']);
        // Does not allow special characters within a string.
        $Username = mysqli_real_escape_string($con, $Username);
        $Password = stripslashes($_REQUEST['Password']);
        $Password = mysqli_real_escape_string($con, $Password);
        $ConfirmPassword = stripslashes($_REQUEST['ConfirmPassword']);
        $ConfirmPassword = mysqli_real_escape_string($con, $ConfirmPassword);
        $Email = stripslashes($_REQUEST['Email']);
        $Email = mysqli_real_escape_string($con, $Email);
		$Name = stripslashes($_REQUEST['Name']);
        $Name = mysqli_real_escape_string($con, $Name);
        $JoinDate = date("Y-m-d H:i:s");
        $query = "INSERT into `Users` (Username, Password, Email, Name, JoinDate)
         VALUES ('$Username', '" . md5($Password) . "', '$Email', '$Name', '$JoinDate')"; //Registration where the password is encrypted.

        // Checks for allowed characters in Username, Name, Email and Password and displays message if conditions are not met.

        if (!preg_match($pattern_2, $Username)) {
            echo "<div class='form'>
                  <h4>The username can only contain letters, numbers, and spaces, and must be 50 characters or less.</h4><br/>";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<p class='link'>Click here to comeback to the <a href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/registration.php'>registration form</a> again.</p>";
            }
            echo "</div>";     
            exit;
        }

        if (!preg_match($pattern_2, $Name)) {
            echo "<div class='form'>
                  <h4>The name can only contain letters, numbers, and spaces, and must be 50 characters or less.</h4><br/>";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<p class='link'>Click here to comeback to the <a href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/registration.php'>registration form</a> again.</p>";
            }
            echo "</div>";  
            exit;
        }

        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='form'>
                  <h4>Please enter a valid email address.</h4><br/>";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<p class='link'>Click here to comeback to the <a href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/registration.php'>registration form</a> again.</p>";
            }
            echo "</div>";
            exit;
        }

        // Limits the email length to 50 characters.
        if (strlen($Email) > 50) {
            echo "<div class='form'>
                  <h4>The email address must be 50 characters or less.</h4><br/>";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<p class='link'>Click here to comeback to the <a href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/registration.php'>registration form</a> again.</p>";
            }
            echo "</div>";                
            exit;
        }

        if (!preg_match($pattern_1, $Password)) {
            echo "<div class='form'>
                  <h4>The password must be minimum 8 characters long and contain at least 1 special character, 1 capital letter, and 1 number.</h4><br/>";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<p class='link'>Click here to comeback to the <a href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/registration.php'>registration form</a> again.</p>";
            }
            echo "</div>";
            exit;
        }

        // Check if the entered username already exists in the database
        $query_username = "SELECT * FROM `Users` WHERE `Username` = '$Username'";
        $result_username = mysqli_query($con, $query_username);
        if (mysqli_num_rows($result_username) > 0) {
            echo "<div class='form'>
                  <h4>The entered username already exists. Please choose a different username.</h4><br/>";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<p class='link'>Click here to comeback to the <a href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/registration.php'>registration form</a> again.</p>";
            }
            echo "</div>";   
            exit;
        }

        // Check if the entered email address already exists in the database
        $query_email = "SELECT * FROM `Users` WHERE `Email` = '$Email'";
        $result_email = mysqli_query($con, $query_email);
        if (mysqli_num_rows($result_email) > 0) {
            echo "<div class='form'>
                  <h4>The entered email address already exists. Please choose a different email address.</h4><br/>";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<p class='link'>Click here to comeback to the <a href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/registration.php'>registration form</a> again.</p>";
            }
            echo "</div>";   
            exit;
        }

        //Checks if Password and Confirm Passwords match.
        if ($Password !== $ConfirmPassword) {
            echo "<div class='form'>
                  <h4>The entered passwords do not match. Please try again.</h4><br/>";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<p class='link'>Click here to comeback to the <a href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/registration.php'>registration form</a> again.</p>";
            }
            echo "</div>";
            exit;
        }


        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h4>You are registered successfully.</h4><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h4>Required fields are missing.</h4><br/>
                  <p class='link'>Click here to comeback to the <a href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/registration.php'>registration form</a> again.</p>
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
  <input type="password" class="login-input" name="ConfirmPassword" placeholder="Confirm password">
  <input type="submit" name="submit" value="Register" class="login-button">
  <p class="link"><a href="login.php">Click to Login</a></p>
   <p class="link"><a href="https://mi-linux.wlv.ac.uk/~2201053/Survey4All/homepage.html">Back to Homepage</a></p>
   <br>
  <label>
    <input type="checkbox" name="agree" value="yes" required>I confirm that I have read, understood, and agree to the Terms of Service, Privacy Policy, and Cookie Use Policy.
	<br>
	<br>
    <a href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/_termsofservice.html">Terms of service</a>
    <br>
    <a href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/_privacypolicy.html">Privacy Policy</a>
    <br>
    <a href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/_cookieusepolicy.html">Cookie use Policy</a>
  </label>
</form>
	
	
	
<?php
// The section above is where it shows the output of Registration form to the users where they can input their values.
    }
?>
</body>
</html>
