const questions = [
    {
        question: "Which of these packages contains the exception Stack Overflow in Java?",
       answer: [
           { text:"java.io", correct: false},
           { text:"java.system", correct: false},
           { text:"java.lang", correct: true},
           { text:"java.util", correct: false},
       ] 
    },
    {
        question: "Which of these statements is incorrect about Thread?",
       answer: [
           { text:"start() method is used to begin execution of the thread", correct: false},
           { text:"run() method is used to begin execution of a thread before start() method in special cases", correct: true},
           { text:"A thread can be formed by implementing Runnable interface only", correct: false},
           { text:"A thread can be formed by a class that extends Thread class", correct: false},
       ] 
    },
    {
        question: " Which statement is true about Java?",
       answer: [
           { text:"Java is a sequence-dependent programming language", correct: false},
           { text:"Java is a code dependent programming language", correct: false},
           { text:"Java is a platform-dependent programming language", correct: false},
           { text:"Java is a platform-independent programming language", correct: true},
       ] 
    },
    {
        question: " Which one of the following is not a Java feature?",
       answer: [
           { text:"Object-oriented", correct: false},
           { text:"Use of pointers", correct: true},
           { text:"Portable", correct: false},
           { text:"Dynamic and Extensible", correct: false},
       ] 
    },
    {
        question: " Which of these cannot be used for a variable name in Java?",
       answer: [
           { text:"identifier & keyword", correct: false},
           { text:"identifier", correct: false},
           { text:"keyword", correct: true},
           { text:"none of the mentioned", correct: false},
       ] 
    },
    {
        question: " What is the extension of java code files?",
       answer: [
           { text:".js", correct: false},
           { text:".txt", correct: false},
           { text:".class", correct: false},
           { text:".java", correct: true},
       ] 
    },
    {
        question: "Which of these are selection statements in Java?",
       answer: [
           { text:"break", correct: false},
           { text:"continue", correct: false},
           { text:"for()", correct: false},
           { text:"if()", correct: true},
       ] 
    },
    {
        question: "Which of these keywords is used to define interfaces in Java?",
       answer: [
           { text:"intf", correct: false},
           { text:"Intf", correct: false},
           { text:"interface", correct: true},
           { text:"Interf", correct: false},
       ] 
    },
    {
        question: "Which of the following is a superclass of every class in Java?",
       answer: [
           { text:"ArrayList", correct: false},
           { text:"Abstract class", correct: false},
           { text:"Object class", correct: true},
           { text:"String", correct: false},
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
    fetch('submit-score2.php', {
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
