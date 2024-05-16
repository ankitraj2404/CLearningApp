const questions = [
    {
        question: "Which environment variable is used to set the java path?",
        answer: [
            { text:"MAVEN_Path", correct: false},
            { text:"JavaPATH", correct: false},
            { text:"JAVA", correct: false},
            { text:"JAVA_HOME", correct: true},
        ]
    },
    {
        question: "Which of the following is not an OOPS concept in Java?",
       answer: [
           { text:"Polymorphism", correct: false},
           { text:" Inheritance", correct: false},
           { text:"Compilation", correct: true},
           { text:"Encapsulation", correct: false},
       ] 
    },
    {
        question: "What is not the use of “this” keyword in Java?",
       answer: [
           { text:"Referring to the instance variable when a local variable has the same name", correct: false},
           { text:"Passing itself to the method of the same class", correct: true},
           { text:"Passing itself to another method", correct: false},
           { text:"Calling another constructor in constructor chaining", correct: false},
       ] 
    },
    {
        question: "Which of the following is a type of polymorphism in Java Programming?",
       answer: [
           { text:"Multiple polymorphism", correct: false},
           { text:"Compile time polymorphism", correct: true},
           { text:"Multilevel polymorphism", correct: false},
           { text:"Execution time polymorphism", correct: false},
       ] 
    },
    {
        question: "What is Truncation in Java?",
       answer: [
           { text:"Floating-point value assigned to a Floating type", correct: false},
           { text:"Floating-point value assigned to an integer type", correct: true},
           { text:"Integer value assigned to floating type", correct: false},
           { text:"Integer value assigned to floating type", correct: false},
       ] 
    },
    {
        question: "Which exception is thrown when java is out of memory?",
       answer: [
           { text:"MemoryError", correct: false},
           { text:"OutOfMemoryError", correct: true},
           { text:"MemoryOutOfBoundsException", correct: false},
           { text:"MemoryFullException", correct: false},
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
    {
        question: "Which of the below is not a Java Profiler?",
       answer: [
           { text:"JProfiler", correct: false},
           { text:"Eclipse Profiler", correct: false},
           { text:"JVM", correct: true},
           { text:"JConsole", correct: false},
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
    fetch('submit-score1.php', {
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
