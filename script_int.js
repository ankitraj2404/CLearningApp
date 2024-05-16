const questions = [
    {
        question: "Which of the following is a valid long literal?",
        answer: [
            { text:"ABH8097", correct: false},
            { text:"L990023", correct: false},
            { text:"904423", correct: false},
            { text:"0xnf029L", correct: true},
        ]
    },
    {
        question: "What does the expression float a = 35 / 0 return?",
       answer: [
           { text:"0", correct: false},
           { text:"Not a Number", correct: false},
           { text:"Infinity", correct: true},
           { text:"Run time exception", correct: false},
       ] 
    },
    {
        question: "Evaluate the following Java expression, if x=3, y=5, and z=10:  ++z + y - y + z + x++ ",
       answer: [
           { text:"24", correct: false},
           { text:"23", correct: false},
           { text:"20", correct: false},
           { text:"25", correct: true},
       ] 
    },
    {
        question: "Which of the following tool is used to generate API documentation in HTML format from doc comments in source code?",
       answer: [
           { text:"javap tool", correct: false},
           { text:"javaw command", correct: false},
           { text:"Javadoc tool", correct: true},
           { text:"javah command", correct: false},
       ] 
    },
    {
        question: "Which of the following creates a List of 3 visible items and multiple selections abled?",
       answer: [
           { text:"new List(false, 3)", correct: false},
           { text:"new List(3, true)", correct: true},
           { text:"new List(true, 3)", correct: false},
           { text:"new List(3, false)", correct: false},
       ] 
    },
    {
        question: "Which method of the Class.class is used to determine the name of a class represented by the class object as a String?",
       answer: [
           { text:"getClass()", correct: false},
           { text:"intern()", correct: false},
           { text:"getName()", correct: true},
           { text:"toString()", correct: false},
       ] 
    },
    {
        question: "In which process, a local variable has the same name as one of the instance variables?",
       answer: [
           { text:"Serialization", correct: false},
           { text:"Variable Shadowing", correct: true},
           { text:"Abstraction", correct: false},
           { text:"Multi-threading", correct: false},
       ] 
    },
    {
        question: "Which of the following is true about the anonymous inner class?",
       answer: [
           { text:"It has only methods", correct: false},
           { text:"Objects can't be created", correct: false},
           { text:"It has a fixed class name", correct: false},
           { text:"It has no class name", correct: true},
       ] 
    },
    {
        question: "Which package contains the Random class?",
       answer: [
           { text:"java.util package", correct: true},
           { text:"java.lang package", correct: false},
           { text:"java.awt package", correct: false},
           { text:"java.io package", correct: false},
       ] 
    },
    {
        question: "What do you mean by nameless objects?",
       answer: [
           { text:"An object created by using the new keyword.", correct: false},
           { text:"An object of a superclass created in the subclass.", correct: false},
           { text:"An object without having any name but having a reference.", correct: false},
           { text:"An object that has no reference.", correct: true},
       ] 
    },
];

const questionElement = document.getElementById("question");
const answerButtons = document.getElementById("answer-buttons");
const nextButton = document.getElementById("next-btn");
const submitButton = document.getElementById("submit-btn");
const playAgainButton = document.getElementById("playagain-btn");

let currentQuestionIndex = 0;
let score = 0;

function startQuiz(){
    currentQuestionIndex = 0;
    score = 0;
    nextButton.innerHTML = "Next";
    submitButton.style.display = "none"; // Hide the Submit button
    playAgainButton.style.display = "none"; // Hide the Play Again button
    showQuestion();
}

function showQuestion() {
    resetState();
    let currentQuestion = questions[currentQuestionIndex];
    let questionNo = currentQuestionIndex + 1;
    questionElement.innerHTML = questionNo + ". " + currentQuestion.question; // Remove the extra period after currentQuestion.question

    currentQuestion.answer.forEach(answer => {
        const button = document.createElement("button");
        button.innerHTML = answer.text;
        button.classList.add("btn");
        answerButtons.appendChild(button);
        if (answer.correct) {
            button.dataset.correct = answer.correct;
        }
        button.addEventListener("click", selectAnswer);
    });
}



function resetState(){
    nextButton.style.display = "none";
    while(answerButtons.firstChild){
        answerButtons.removeChild(answerButtons.firstChild);
    }
}

function selectAnswer(e){
    const selectedBtn = e.target;
    const iscorrect = selectedBtn.dataset.correct === "true";
    if(iscorrect){
        selectedBtn.classList.add("correct");
        score++;
    }else{
        selectedBtn.classList.add("incorrect");
    }
    Array.from(answerButtons.children).forEach(button => {
        if(button.dataset.correct === "true"){
            button.classList.add("correct");
        }
        button.disabled = true;
    });
    nextButton.style.display = "block";
}

function showScore() {
    resetState();
    questionElement.innerHTML = `You scored ${score} out of ${questions.length}!`; // Corrected template literal
    nextButton.style.display = "none"; // Hide the Next button
    submitButton.style.display = "block"; // Show the Submit button
    playAgainButton.style.display = "block"; // Show the Play Again button
}


function   handelNextButton(){
    currentQuestionIndex++;
    if(currentQuestionIndex < questions.length){
        showQuestion();
    }else{
        showScore();
    }
}


nextButton.addEventListener("click", ()=>{
    if(currentQuestionIndex < questions.length){
        handelNextButton();
    }else{
        startQuiz()
    }
});
submitButton.addEventListener("click", () => {
    // Handle the submission of the score here
    // You can use AJAX or fetch to send the score to your server
    // For now, let's just display a message
    alert(`Score submitted: ${score}`);
});

submitButton.addEventListener("click", () => {
    // Send the score to the PHP script
    fetch('submit-scoreint.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `score=${score}`,
    })
    .then(response => {
        if (response.ok) {
            // Score submitted successfully
            alert(`Score submitted: ${score}`);
        } else {
            // Handle error
            console.error('Error submitting score');
        }
    })
    .catch(error => {
        console.error('Network error:', error);
    });
});

playAgainButton.addEventListener("click", () => {
    // Restart the quiz
    startQuiz();
});

startQuiz();
