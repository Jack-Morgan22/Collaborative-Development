<html>
    <head>
        <p><h1 id = "SurveyName"></h1></p>
        <script src="jquery-3.6.3.min.js"></script>
        <link rel="stylesheet" href="td_style.css">
    </head>
    <body>
        <?php/*
        //Connects to the database.
        $conn = mysqli_connect("localhost", "2112834", "85rj5j", "db2112834");
        if(!$conn){
            echo "Connection error," . mysqli_connect_error();
        }
        //Sets an array
        $answerarray = [];
        //Checks to see if they have been set
        if(isset($_REQUEST['number'])){
            if(isset($_REQUEST['survey'])){
                //Requests data and strips slashes from data
                $number = stripslashes($_REQUEST['number']);
                $surveyname = stripslashes($_REQUEST['survey']);
                //Setting some basic variables
                $i = 1;
                $x = 0;
                //This should go through the entire range of the unordered list and get every answer.
                while($x < $number)
                {
                    $tempVar = stripslashes($_REQUEST["$x"]);
                    array_push($answerarray, $tempVar);
                    $x = $x + 1;
                    $i = $i + 1;
                }
                //This takes the variable
                $detailsarray = explode('|||', $details);
                $detailsarray = array_filter($detailsarray);
                $i = 0;
                $questionnumber = 1;
                while($i < $number)
                {
                    $sql = "INSERT INTO `SurveyAnswers` (QuestionNumber, QuestionAnswer, SurveyQuestions_QuestionName, SurveyDetails_SurveyID)
                    VALUES ('$questionnumber','$answerarray[$i]','$detailsarray[$i]','$surveyname')";
                    $i = $i + 1;
                    $questionnumber = $questionnumber + 1;
                    $result = mysqli_query($conn, $sql);
                }
            }
        }*/
        ?>
        <form id="phpForm" method="post" onsubmit="sortingAnswers()">
            <div id = "Questions">
                <ul></ul>
            </div>
            <input type ="text" name="number" id="number" hidden>
            <input type ="text" name="surveyname" id="surveyname" hidden>
            <input type ="text" name="details" id="details" hidden>
            <input type ="text" name="Answers" id="Answers" hidden>
            <button type="submit" id="submitbtn" name="submitbtn">Submit</button>
        </form>
    </body>
</html>
    <script type="text/javascript">
        window.addEventListener("load", (event) => {
            const queryString = window.location.search;
            const surveyname = document.getElementById("surveyname");
            let result = queryString.replace(/[^0-9]/g,"");
            surveyname.setAttribute("value", result);
            var detailsString = "";
            fetch('https://mi-linux.wlv.ac.uk/~2119668/my-api.php' + queryString)
            .then(response => response.json())
            .then(response =>{
            document.getElementById("SurveyName").innerHTML = response.SurveyName;
            var surveyName = response.SurveyName;})
            .catch(err => {
                console.log(err);
            });
            fetch('https://mi-linux.wlv.ac.uk/~2119668/my-api2.php' + queryString)
            .then(response => response.json())
            .then(response =>{
                const questionList = document.getElementById("Questions");
                const arraylength = document.getElementById("number");
                const details = document.getElementById("details");
                let i = 0;
                var list = $("#Questions").find('ul');
                arraylength.setAttribute("value", response.length);
                while(i < response.length){
                    var questionName = response[i].QuestionName;
                    var questionType = response[i].QuestionType;

                    detailsString = detailsString + questionName + "|||";
                    var stringAppend =`<li id="${questionType}" name="${questionName}">"${questionName}"</li>`;
                    list.append(`${stringAppend}`);
                    if(String(questionType) == "TX"){
                        list.append(`<li><input type='text' form = "phpForm" class="answers" name="answers[]" multiple></li>`);
                    }
                    else if(String(questionType) == "NM"){
                        list.append(`<li><input type='number' form = "phpForm" class="answers" name="answers[]" multiple></li>`);
                    }
                    else if(String(questionType) == "CL"){
                        list.append(`<li><input type='color' form = "phpForm" class="answers" name="answers[]" multiple></li>`);
                    }
                    else if(String(questionType) == "EM"){
                        list.append(`<li><input type='email' form = "phpForm" class="answers" name="answers[]" multiple></li>`);
                    }
                    else if(String(questionType) == "DT"){
                        list.append(`<li><input type='date' form = "phpForm" class="answers" name="answers[]" multiple></li>`);
                    }
                    else if(String(questionType) == "FL"){
                        list.append(`<li><input type='file' form = "phpForm" class="answers" name="answers[]" multiple></li>`);
                    }
                    i++;
                }
                details.setAttribute("value", detailsString);
            })
            .catch(err => {
                console.log(err);
            });
        });
        function sortingAnswers(){
            const answerText = document.getElementById("Answers");
            theAnswers = document.getElementsByClassName('answers');
            answerString = "";
            i = 0;
            while(i < theAnswers.length){
                answerString = answerString + theAnswers[i] + "|||";
            }
            answerText.setAttribute("value", answerString);
            console.log(answerString);
        }
    </script>
    <?php
    $conn = mysqli_connect("localhost", "2112834", "85rj5j", "db2112834");
    if(!$conn){
        echo "Connection error," . mysqli_connect_error();
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['surveyname'])){
            if(isset($_POST['number'])){
                if(isset($_POST['details'])){
                    if(isset($_POST['Answers'])){
                    $surveyName = $_POST['surveyname'];
                    $Number = $_POST['number'];
                    $detailsString = $_POST['details'];
                    $detailsArray = [];
                    $answerArray = [];
                    $answerString = $_POST['Answers'];
                    $detailsArray = explode('|||', $detailsString);
                    $detailsArray = array_filter($detailsArray);
                    $answerArray = explode('|||', $answerString);
                    $answerArray = array_filter($answerArray);
                    $i = 0;
                    $x = 1;
                    while($i < $Number){
                        $sql = "INSERT INTO `SurveyAnswers` (QuestionNumber, QuestionAnswer, 
                        SurveyQuestions_QuestionName, SurveyDetails_SurveyID)
                        VALUES ('$x','$answerArray[$i]','$detailsArray[$i]','$surveyName')";
                        $i++;
                        $x++;
                        $result = mysqli_query($conn, $sql);
                    }
                }
            }
        }
    }
}
    ?>