<!DOCTYPE html>
<html>
    <head>
        <title style="color: #333333;">Profile Page</title>
        <style>
            body {
                background-color: #FFFFFF
                font-family: Arial, sans-serif;
                color: #333333; /* dark gray */
            }
php
Copy code
        h2 {
            color: #008000; /* green */
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

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #666666; /* gray */
            color: #ffffff; /* white */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #4d4d4d; /* darker gray */
        }
    </style>
</head>
<body>
    <?php
    session_start();

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
    <center>
        <div class="container">
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
            <button class="button" onclick="window.location.href='logout.php'">Logout</button>
			<button class="button" onclick="window.location.href='dashboard.php'">Dashboard</button>
			<button class="button" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/homepage.html'">Home</button>
        </div>
    </center>
</body>
</html>