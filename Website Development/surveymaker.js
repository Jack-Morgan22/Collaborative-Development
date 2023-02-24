const addButton = document.querySelector("addBtn");
const addQuestionButton = document.querySelector("addQuestionBtn");
const deleteButton = document.getElementById("delBtn");
const submitButton = document.querySelector("submitBtn");

const questionForm = document.getElementById("questionFrm");
const surveyName = document.getElementById("surveyNm");

const questions = [];
const i = 0;

function AddQuestion(){
    const questionDetails = [];
    const selectQuestion = document.getElementById("qstns");
    var questionValue = selectQuestion.options[selectQuestion.selectedIndex].value;
    let questionNameValue = document.getElementById("questionID").value;
    questionDetails.push(questionNameValue, questionValue);
    questions.push(questionDetails);
    questionForm.setAttribute("hidden", true);
    questionDetails.forEach(function(entry){
        console.log(entry);
    })
}
function DeleteQuestion(){
    let id = deleteButton.form.id;
    const form = document.getElementById(id);
    form.setAttribute("hidden", true);
    console.log(id);
}
function SurveyQuestions(){
    const clone = questionForm.cloneNode(true);
    clone.id = ("question" + i);
    clone.removeAttribute("hidden");
    document.body.appendChild(clone);
}
function SubmitQuestion(){

}