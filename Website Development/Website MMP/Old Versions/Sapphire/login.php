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
    background: #2E8B57 ;
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
	<meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.3s ease-out;
            z-index: 999;
        }

        .popup .close {
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <?php
        require('db.php');
        session_start();
        // When the form submitted it will check and create user session within the Registration\Login system.
        if (isset($_POST['Username'])) {
            $Username = stripslashes($_REQUEST['Username']);    // removes backslashes
            $Username = mysqli_real_escape_string($con, $Username);
            $Password = stripslashes($_REQUEST['Password']);
            $Password = mysqli_real_escape_string($con, $Password);
            // This will check if the user exists in the database.
            $query    = "SELECT * FROM `Users` WHERE Username='$Username'
                         AND Password='" . md5($Password) . "'";
            $result = mysqli_query($con, $query) or die(mysql_error());
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {
                $_SESSION['Username'] = $Username;
                // If login is correct it will redirect to user dashboard page.
                header("Location: dashboard.php");
            } else {
                echo "<div class='form'>
                      <h3>Incorrect Username/password.</h3><br/>
                      <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                      </div>";
            }
        } else {
    ?>
        <div id="loginPopup" class="popup">
            <span class="close" onclick="closePopup()">&times;</span>
            <p>Please log in to create/view your surveys within the Dashboard.</p>
        </div>
        <form class="form" method="post" name="login">
            <h1 class="login-title">Login</h1>
            <input type="text" class="login-input" name="Username" placeholder="Username" autofocus/>
            <input type="Password" class="login-input" name="Password" placeholder="Password"/>
            <input type="submit" value="Login" name="submit" class="login-button"/>
            <p class="link"><a href="registration.php">New Registration</a></p>
            <p class="link"><a href="https://mi-linux.wlv.ac.uk/~2201053/Survey4All/homepage.html">Home</a></p>
        </form>
    <?php
        }
        // The section above is where it shows the output of login to the users where they can input their values.
    ?>

    <script>
        function closePopup() {
            document.getElementById("loginPopup").style.display = "none";
        }
    </script>
</body>
</html>