<!DOCTYPE html>
<html lang="eng">
<head>
  <script src = "jquery-3.6.3.min.js"></script>
  <title>Survey Questions</title>
  <link rel="stylesheet" href="td_style.css">
</head> 
<body>
    <?php
        require('db.php');
        if(isset($_REQUEST['surveytitle'])){
            $questionarray = [];
            $surveyname = stripslashes($_REQUEST['surveytitle']);
            //$surveyname = mysqli_real_escape_string($con, $surveyname);
            $sql = $sql = "INSERT INTO `SurveyDetails` (SurveyID, SurveyName, CreationDate, UploadStatus, UploadDate, Users_UserID) 
                VALUES (NULL, '$surveyname', now(), 'Y', NULL, '2023502400')";
                $result = mysqli_query($con, $sql); 
            }
            if(isset($_REQUEST['arraytext'])){
                $surveyID = 'SELECT SurveyID FROM SurveyDetails';
                $result = mysqli_query($con, $surveyID);
                while($row = mysqli_fetch_assoc($result)){
                    $surveyID = $row['SurveyID'];
                }
                $questions = stripslashes($_REQUEST['arraytext']);
                $questionarray = explode('|||', $questions);
                $questionarray = array_filter($questionarray);
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
            </select>
        <button type="submit" id="add-btn">Add</button>
        <ul id="items"></ul>
    </form>
    <form  action = '' method = 'post' id = 'submitForm' name = 'submitForm'>
        <input type = 'text' id = 'arraytext' name = 'arraytext' value = '' hidden>
        <button type = 'submit' id = 'submitbtn' name = 'submitbtn'>Submit</button>
    </form>

<script>
  // Select the form, input, and list elements from the HTML
const form = document.querySelector('form');
const input = document.querySelector('#new-item');
const itemsList = document.querySelector('#items');
const selectQuestion = document.getElementById('questionType');
const liSpan = document.getElementById('Number');

const arraystringvalue = document.getElementById('arraytext');

const addButton = document.getElementById('add-btn');
const submitButton = document.getElementById('submit-btn');
let listArray = [];
var arraystring = '';
// Load items from local storage, or create an empty array 
// if there are none
const items = JSON.parse(localStorage.getItem('items')) || [];

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

function arrayToObject(){
    for(i in listArray){
        jObject[i] = listArray[i];
    }
    jObject=JSON.stringify(jObject);
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
