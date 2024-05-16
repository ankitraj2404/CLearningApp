const questions = [
    {
        question: "Which one of the following is not an access modifier?",
        answer: [
            { text:"Protected", correct: false},
            { text:"Void", correct: true},
            { text:"Public", correct: false},
            { text:"Private", correct: false},
        ]
    },
    {
        question: "What is the numerical range of a char data type in Java?",
       answer: [
           { text:"0 to 256", correct: false},
           { text:"-128 to 127", correct: false},
           { text:"0 to 65535", correct: true},
           { text:"0 to 32767", correct: false},
       ] 
    },
    {
        question: "Which class provides system independent server side implementation?",
       answer: [
           { text:"Server", correct: false},
           { text:"ServerReader", correct: false},
           { text:"Socket", correct: false},
           { text:"ServerSocket", correct: true},
       ] 
    },
    {
        question: "Which of the following is true about servlets?",
       answer: [
           { text:"Servlets can use the full functionality of the Java class libraries", correct: false},
           { text:"Servlets execute within the address space of web server, platform independent and uses the functionality of java class libraries", correct: true},
           { text:"Servlets execute within the address space of web server", correct: false},
           { text:"Servlets are platform-independent because they are written in java", correct: false},
       ] 
    },
    {
        question: "What will be the output of the following Java code   class Output{public static void main(String args[]) {Integer i = new Integer(257);   byte x = i.byteValue(); System.out.print(x);  } }",
       answer: [
           { text:"257", correct: false},
           { text:"256", correct: false},
           { text:"1", correct: true},
           { text:"0", correct: false},
       ] 
    },
    {
        question: "What will be the output of the following Java code?  class increment {public static void main(String args[]) {  int g = 3;  System.out.print(++g * 8);    } } ",
       answer: [
           { text:"32", correct: true},
           { text:"33", correct: false},
           { text:"24", correct: false},
           { text:"25", correct: false},
       ] 
    },
    {
        question: "Which of the following option leads to the portability and security of Java?",
       answer: [
           { text:"Bytecode is executed by JVM", correct: true},
           { text:"The applet makes the Java code secure and portable", correct: false},
           { text:"Use of exception handling", correct: false},
           { text:"Dynamic binding between objects", correct: false},
       ] 
    },
    {
        question: "Which of the following is not a Java features?",
       answer: [
           { text:"Dynamic", correct: false},
           { text:"Architecture Neutral", correct: false},
           { text:"Use of pointers", correct: true},
           { text:"Object-oriented", correct: false},
       ] 
    },
    {
        question: "The u0021 article referred to as a",
       answer: [
           { text:"Unicode escape sequence", correct: true},
           { text:"Octal escape", correct: false},
           { text:"Hexadecimal", correct: false},
           { text:"Line feed", correct: false},
       ] 
    },
    {
        question: "What is the return type of the hashCode() method in the Object class?",
       answer: [
           { text:"Object", correct: false},
           { text:"int", correct: true},
           { text:"long", correct: false},
           { text:"void", correct: false},
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
    fetch('submit-scoreint1.php', {
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
