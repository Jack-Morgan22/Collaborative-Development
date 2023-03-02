const addButton = document.querySelector("addBtn");
const addQuestionButton = document.querySelector("addQuestionBtn");
const deleteButton = document.getElementById("delBtn");
const submitButton = document.querySelector("submitBtn");

const questionList = document.querySelector("#questionList")

const questionForm = document.getElementById("questionFrm");
const surveyName = document.getElementById("surveyNm");

const questions = [];
const i = 0;

function AddQuestion(){
    const questionDetails = [];
    const selectQuestion = document.getElementById("qstns");
    var questionValue = selectQuestion.options[selectQuestion.selectedIndex].value;
    var questionNameValue = document.getElementById("question"+i).value;
    questionDetails.push(questionNameValue, questionValue);
    questions.push(questionDetails);
    questionForm.setAttribute("hidden", true);
    console.log(questions);
}
function DeleteQuestion(){
    let id = deleteButton.form.id;
    const form = document.getElementById(id);
    form.setAttribute("hidden", true);
    console.log(id);
}
function SurveyQuestions(){
    /*const clone = questionID.cloneNode(true);
    clone.id = ("question" + i);
    clone.removeAttribute("hidden");
    document.body.appendChild(clone);*/
    const questionsHTML = questionList.map((item, index) => {
        return '<li> <span>${item}<input type="text" placeholder="Enter Question Name" data-index = "${index}"name="questionNm" id="questionID"> <input type="button" value = "Add" id="submitQuestionBtn" onclick = "AddQuestion()"></li>';
    })
}
function SubmitQuestion(){

}