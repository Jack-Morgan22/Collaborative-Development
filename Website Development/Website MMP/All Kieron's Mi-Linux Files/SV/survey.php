<!DOCTYPE html>
<html lang="eng">
<head>
<style>
  body {
    font-family: Arial, sans-serif;
}

h1 {
    text-align: center;
}

form {
    margin-bottom: 20px;
}

input[type="text"] {
    padding: 10px;
    font-size: 16px;
    border: none;
    border-bottom: 2px solid #ccc;
    width: 70%;
}

button {
    background-color: #04AA6D;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            transition-duration: 0.4s;
}
select{
        background-color: #04AA6D;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            transition-duration: 0.4s;
}

button:hover, select:hover, .delete-btn:hover {
    background-color: lightgray;
            color: black;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ccc;
    color: black;
}

li .delete-btn {
    color: white;
    font-size: 16px;
    cursor: pointer;
    background-color: #04AA6D;
}
</style>
  <script src = "https://mi-linux.wlv.ac.uk/~2112834/CollabDev/SV/jquery-3.6.3.min.js"></script>
  <title>Survey Questions</title>
  <link rel="stylesheet" href="https://mi-linux.wlv.ac.uk/~2112834/CollabDev/SV/td_style.css">
</head> 
<body>
    <?php
        require('db.php');
        // check if user is logged in
        session_start();
        if (!isset($_SESSION['Username']) || empty($_SESSION['Username'])) {
            header("Location: login.php");
            exit();
        }
        // If the survey title is requested it will call this code.
        if(isset($_REQUEST['surveytitle'])){
            // This sets the question array.
            $questionarray = [];
            $userID = $_SESSION['Username'];
            // This requests the title from the HTML and takes away the slashes.
            $surveyname = stripslashes($_REQUEST['surveytitle']);
            // This is the SQL syntax to insert into the survey details.
            $sql = "INSERT INTO `SurveyDetails` (SurveyID, SurveyName, CreationDate, UploadStatus, UploadDate, Users_UserID) 
                    VALUES (NULL, '$surveyname', NOW(), 'Y', NULL, '$userID')";
            // This puts the SQL syntax into the database.
            $result = mysqli_query($con, $sql); 
        }
        // If arraytext is requested it will call this code.
        if(isset($_REQUEST['arraytext'])){
            // This selects the surveyID from the database.
            $surveyID = 'SELECT SurveyID FROM SurveyDetails LIMIT 1';
            $result = mysqli_query($con, $surveyID);
            $row = mysqli_fetch_assoc($result);
            $surveyID = $row['SurveyID'];
            //This get's all the questions and separates them into an array.
            $questions = stripslashes($_REQUEST['arraytext']);
            $questionarray = explode('|||', $questions);
            $questionarray = array_filter($questionarray);
            //This goes through the array and adds the data to the database in order.
            $i = 0;
            $questionnumber = 1;
            $arrayLength = count($questionarray);
            while($i < $arrayLength)
            {
                $question = mysqli_real_escape_string($con, $questionarray[$i]);
                $questiontype = mysqli_real_escape_string($con, $questionarray[$i+1]);
                $sql = "INSERT INTO `SurveyQuestions` (QuestionNumber, QuestionName, QuestionType, QuestionStatus, SurveyDetails_SurveyID) 
                        VALUES ('$questionnumber', '$question', '$questiontype', 'M', '$surveyID')";
                $questionnumber++;
                $i = $i + 2;
                $result = mysqli_query($con, $sql);
            }
        }          
    ?>
	
</body>
</html>
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
                <option value = "FL">File</option>
            </select>
        <button type="submit" id="add-btn">Add</button>
        <ul id="items"></ul>
    </form>
    <form  action = '' method = 'post' id = 'submitForm' name = 'submitForm'>
        <input type = 'text' id = 'arraytext' name = 'arraytext' value = '' hidden>
        <button type = 'submit' id = 'submitbtn' name = 'submitbtn'>Submit</button>
		<a href="dashboard.php" target="_blank">
		<button type="button">Dashboard page</button>
		</a>
    </form>
<script>
  // Select the form, input, and list elements from the HTML
const form = document.querySelector('form');
const input = document.querySelector('#new-item');
const itemsList = document.querySelector('#items');
const selectQuestion = document.getElementById('questionType');
const liSpan = document.getElementById('Number');
const MCSelector = document.getElementById('MultipleChoiceSelector');
const MCForm = document.getElementById('MCform');

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
    if (questionValue == "MC"){
        MCForm.removeAttribute("hidden");
    }
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

// Listen to the form submission
form.addEventListener('submit', event => {
  event.preventDefault(); // Prevent the default form submission

  // Get the input value and clear the input field
  const newItem = input.value.trim();
  input.value = '';

  // Add the item to the items array and display the updated list
  if (newItem !== '') {
    items.push(newItem);
    displayItems();
  }
});

// Listen to the delete button clicks and remove the item from the list
itemsList.addEventListener('click', event => {
  if (event.target.classList.contains('delete-btn')) {
    const index = event.target.dataset.index;
    items.splice(index, 1);
    displayItems();
  }
});

// Update the arraystring value when the submit button is clicked
submitButton.addEventListener('click', event => {
  event.preventDefault(); // Prevent the default form submission
  arraystring = items.join('|||');
  arraystringvalue.value = arraystring;
  submitForm.submit();
});

// Display the items in the list
function displayItems() {
  // Clear the existing list
  itemsList.innerHTML = '';

  // Create a new list item for each item in the items array
  items.forEach((item, index) => {
    const questionValue = selectQuestion.options[selectQuestion.selectedIndex].value;
    const li = document.createElement('li');
    const span = document.createElement('span');
    span.id = questionValue;
    span.name = item;
    span.textContent = item;
    li.appendChild(span);
    const deleteBtn = document.createElement('button');
    deleteBtn.classList.add('delete-btn');
    deleteBtn.dataset.index = index;
    deleteBtn.textContent = 'Delete';
    li.appendChild(deleteBtn);
    itemsList.appendChild(li);
  });
}
</script>
</body>
</html>
