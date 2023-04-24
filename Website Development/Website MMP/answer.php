<?php
    ?>

<!DOCTYPE html>
<html>
    <head>
        <p><h1 id = "SurveyName"></h1></p>
        <script src="jquery-3.6.3.min.js"></script>
        <link rel="stylesheet" href="td_style.css">
    </head>
    <body>
        <form id="phpForm">
            <div id = "Questions">
            </div>
            <button type="select" id="submitbtn" name="submitbtn">Submit</button>
        </form>
    </body>
</html>
    <script type="text/javascript">
        const queryString = window.location.search;
        const items = JSON.parse(localStorage.getItem('items')) || [];
        fetch('https://mi-linux.wlv.ac.uk/~2119668/my-api.php' + queryString)
        .then(response => response.json())
        .then(response =>{
        document.getElementById("SurveyName").innerHTML = response.SurveyName; })
        .catch(err => {
            console.log(err);
        });
        fetch('https://mi-linux.wlv.ac.uk/~2119668/my-api2.php' + queryString)
        .then(response => response.json())
        .then(response =>{
            const questionList = document.getElementById("Questions");
            let i = 0;
            var list = $("#Questions").append('<ul></ul>').find('ul');
            while(i < response.length){
                var questionName = response[i].QuestionName;
                var questionType = response[i].QuestionType;
                var questionNumber = response[i].QuestionNumber;
                var stringAppend =`<li id="${questionType}" name="${questionName}">"${questionName}"</li>`;
                list.append(`${stringAppend}`);
                if(String(questionType) == "TX"){
                    list.append(`<li id="${questionNumber}"><input type='text'></li>`);
                }
                else if(String(questionType) == "NM"){
                    list.append(`<li id="${questionNumber}"><input type='number'></li>`);
                }
                else if(String(questionType) == "CL"){
                    list.append(`<li id="${questionNumber}"><input type='color'></li>`);
                }
                else if(String(questionType) == "EM"){
                    list.append(`<li id="${questionNumber}"><input type='email'></li>`);
                }
                else if(String(questionType) == "DT"){
                    list.append(`<li id="${questionNumber}"><input type='date'></li>`);
                }
                else if(String(questionType) == "FL"){
                    list.append(`<li id="${questionNumber}"><input type='file'></li>`);
                }
                i++;
            }
        })
    </script>