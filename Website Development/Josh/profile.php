<?php
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profile - Client area</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="form">
        <h1 class="login-title">Profile information</h1>
        <!-- Replace the following with your user profile code -->
        <p>Usernamename: <?php echo $_SESSION['Username']; ?></p>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>