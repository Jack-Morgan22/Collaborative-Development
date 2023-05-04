<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        header {
            background-color: lightgray;
            width: 100%;
            height: 100px;
            border: none;
            margin: 0;
            padding: 0;
        }

        .popup {
            background-color: lightgray;
            width: 450px;
            padding: 30px 40px;
            position: absolute;
            transform: translate(-50%,-50%);
            left: 50%;
            top: 50%;
            border-radius: 8px;
            font-family: "Poppins",sans-serif;
            display: none;
            text-align: center;
        }

        .popup button {
            display: block;
            margin:  0 0 20px auto;
            background-color: transparent;
            font-size: 30px;
            color: black;
            border: none;
            outline: none;
            cursor: pointer;
        }

        .popup p {
            font-family: Arial, sans-serif;
            font-size: 14px;
            text-align: justify;
            margin: 20px 0;
            line-height: 25px;
        }

        .logo {
            float: left;
            height: 50%;
            width: 20%;
            margin: 20px 5px;
        }

        nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            flex-direction: row;
        }

        nav ul li {
            margin: 20px 20px;
        }

        nav ul li p {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        .navbutton, .dropbtn {
            background-color: lightgray;
            border: none;
            color: black;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            transition-duration: 0.4s;
        }

        #login, #register {
                    background-color: gray;
                    border: none;
                    color: black;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 4px 2px;
                    cursor: pointer;
                    transition-duration: 0.4s;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: lightgray;
            border: none;
            color: black;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .navbutton:hover, .dropbtn:hover {
            background-color: white;
            color: black;
        }

        #login:hover, #register:hover {
                    background-color: white;
                    color: black;
                }

        .container {
            width: 100%;
            height: 500px;
        }

        .frames {
            width: 100%;
            height: 500px;
            border: none;
        }
    </style>
    <script src = "https://mi-linux.wlv.ac.uk/~2112834/CollabDev/jquery-3.6.3.min.js"></script>
    <title>Survey Questions</title>
    <link rel="stylesheet" href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/td_style.css">
</head>
<body onload="showSection(home)">
<div class="popup">
    <button id="close">&times;</button>
    <h2>Alert</h2>
    <p>
        By using the website you are agreeing to the Terms of Service, Privacy Policy, and Cookie Use Policy.
        <br><br>
        They can be found here:
        <br>
        <a target="_blank" href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/_termsofservice.html">Terms of Service</a>
        <br>
        <a target="_blank" href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/_privacypolicy.html">Privacy Policy</a>
        <br>
        <a target="_blank" href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/_cookieusepolicy.html">Cookie Use Policy</a>
    </p>
</div>
<header>
    <img src="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/Survey4AllLogo.png" alt="Logo" class="logo">
    <nav>
        <ul>
            <li>
                <button class="navbutton" id="home" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/homepage.html';">Home</button>
                <button class="navbutton" id="vs" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/viewsurveys.html';">View Surveys</button>
                <button class="navbutton" id="cs" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/createsurveys.php';">Create Surveys</button>
                <button class="navbutton" id="contact" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/contactus.html';">Contact Us</button>
                <button class="navbutton" id="va" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/myaccount.php';">My Account</button>
                <div class="dropdown">
                    <button class="dropbtn" id="legal">Legal</button>
                    <div class="dropdown-content">
                        <button class="navbutton" id="tos" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/termsofservice.html';">Terms of Service</button>
                        <button class="navbutton" id="priv" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/privacypolicy.html';">Privacy Policy</button>
                        <button class="navbutton" id="cook" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/cookieusepolicy.html';">Cookie Use Policy</button>
                    </div>
                </div>
                <button class="navbutton" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/login.php';">Login</button>
                <button class="navbutton" onclick="window.location.href='https://mi-linux.wlv.ac.uk/~2201053/Survey4All/registration.php';">Register</button>
            </li>
        </ul>
    </nav>
</header>
<div class="container">
    <?php
        require('db.php');
        // If the survey title is requested it will call this code.
        if(isset($_REQUEST['surveytitle'])){
            // This sets the question array.
            $questionarray = [];
            // This requests the title from the HTML and takes away the slashes.
            $surveyname = stripslashes($_REQUEST['surveytitle']);
            // This is the SQL syntax to insert into the survey details.
            $sql = $sql = "INSERT INTO `SurveyDetails` (SurveyID, SurveyName, CreationDate, UploadStatus, UploadDate, Users_UserID)
                VALUES (NULL, '$surveyname', now(), 'Y', NULL, '2023502400')";
                // This puts the SQL syntax into the database.
                $result = mysqli_query($con, $sql);
            }
            // If arraytext is requested it will call this code.
            if(isset($_REQUEST['arraytext'])){
                // This selects the surveyID from the database.
                $surveyID = 'SELECT SurveyID FROM SurveyDetails';
                $result = mysqli_query($con, $surveyID);
                while($row = mysqli_fetch_assoc($result)){
                    $surveyID = $row['SurveyID'];
                }
                //This get's all the questions and seperates them into an array.
                $questions = stripslashes($_REQUEST['arraytext']);
                $questionarray = explode('|||', $questions);
                $questionarray = array_filter($questionarray);
                //This goes through the array and adds the data to the database in order.
                $i = 0;
                $y = 1;
                $questionnumber = 1;
                $arrayLength = count($questionarray);
                while($i < $arrayLength)
                {
                    $sql = "INSERT INTO `SurveyQuestions` (QuestionNumber, QuestionName, QuestionType, QuestionStatus, SurveyDetails_SurveyID)
                    VALUES ('$questionnumber', '$questionarray[$i]', '$questionarray[$y]', 'M', '$surveyID')";
                    $questionnumber++;
                    $y = $y + 2;
                    $i = $i + 2;
                    $result = mysqli_query($con, $sql);
                }
            }
    ?>
    <h1>Survey Questions</h1>
    <form>
        <input type = 'text' placeholder = 'Survey Title' id = 'surveytitle' name = 'surveytitle' form = 'submitForm'>
        <input type="text" id="new-item" placeholder="Question Name">
        <label for="questionType">Question Type:</label>
        <select name="questionType" id="questionType">
            <option value = "TX">Text</option>
            <option value = "NM">Number</option>
            <option value = "CL">Colour</option>
            <option value = "EM">Email</option>
            <option value = "DT">Date</option>
        </select>
        <button type="submit" id="add-btn">Add</button>
        <ul id="items"></ul>
    </form>
    <form  action = '' method = 'post' id = 'submitForm' name = 'submitForm'>
        <input type = 'text' id = 'arraytext' name = 'arraytext' value = '' hidden>
        <button type = 'submit' id = 'submitbtn' name = 'submitbtn'>Submit</button>
    </form>
</div>
<script type="text/javascript">
    // Select the form, input, and list elements from the HTML
    const form = document.querySelector('form');
    const input = document.querySelector('#new-item');
    const itemsList = document.querySelector('#items');
    const selectQuestion = document.getElementById('questionType');
    const liSpan = document.getElementById('Number');

    // Select the arraytext input and buttons
    const arraystringvalue = document.getElementById('arraytext');
    const addButton = document.getElementById('add-btn');
    const submitButton = document.getElementById('submit-btn');

    // This makes the empty arrays and strings.
    let listArray = [];
    var arraystring = '';
    const items = [];

    // Display the items in the list
    function displayItems() {
        // Create an array of list items, one for each item in the items array
        var questionValue = selectQuestion.options[selectQuestion.selectedIndex].value;
        const itemsHTML = items.map((item, index) => {
            // Each item in the array will be a list item with a span for
            // the text and a button for deleting
            return ` <li> <span id="${questionValue}" name="${item}">${item}</span> <button class="delete-btn" data-index="${index}">Delete</button> </li> `;
        });
        // Join the array of list items into a single string and add it to
        // the list element in the HTML
        itemsList.innerHTML = itemsHTML.join('');
    }

    // Add a new item to the list
    function addItem(e) {
        // Prevent the default form submission
        e.preventDefault();
        // Get the text value from the input and trim any whitespace
        var questionValue = selectQuestion.options[selectQuestion.selectedIndex].value;
        var text = input.value.trim();
        if (text.length) {
            // Add the text to the items array
            listArray.push(text + '|||' + questionValue + '|||');
            items.push(text);
            // Clear the input field and display the updated list of items
            input.value = '';
            displayItems();
            arraystring = '';
            listArray.forEach((i) =>
                arraystring = arraystring + i);
        }
        arraystringvalue.value = arraystring;
    }

    // Delete an item from the list
    function deleteItem(e) {
        // Check if the clicked element is a delete button
        if (e.target.matches('.delete-btn')) {
            // Get the index of the item from the data-index attribute
            // of the delete button
            const index = e.target.dataset.index;
            // Remove the item from the items array
            listArray.splice(index, 1);
            items.splice(index, 1);
            // Display the updated list of items
            console.log(listArray);
            displayItems();
        }
    }

    // Add event listeners to the form and list elements
    form.addEventListener('submit', addItem);
    //form.addEventListener(submitButton, itemsIntoArray);
    itemsList.addEventListener('click', deleteItem);

    // Call the displayItems function to initially display the items
    // in the list
    displayItems();
</script>
</body>
</html>
