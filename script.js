document.addEventListener("DOMContentLoaded", function () {
    const questionElement = document.getElementById("question");
    const answerButtons = document.getElementById("answer-buttons");
    const nextButton = document.getElementById("next-btn");
    const submitButton = document.getElementById("submit-btn");
    const playAgainButton = document.getElementById("playagain-btn");

    let currentQuestionIndex = 0;
    let score = 0;
    let questions;

    async function fetchQuestions() {
        try {
            const response = await fetch('fetch-question.php');
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error fetching questions:', error);
            return [];
        }
    }

    function startQuiz() {
        fetchQuestions().then((data) => {
            if (data.length > 0) {
                questions = shuffleArray(data);
                currentQuestionIndex = 0;
                score = 0;
                nextButton.innerHTML = "Next";
                submitButton.style.display = "none";
                playAgainButton.style.display = "none";
                showQuestion();
            } else {
                alert('Error loading questions. Please try again later.');
            }
        });
    }

    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    function showQuestion() {
        resetState();
        let currentQuestion = questions[currentQuestionIndex];
        let questionNo = currentQuestionIndex + 1;
        questionElement.innerHTML = questionNo + ". " + currentQuestion.question;

        currentQuestion.answer.forEach((answer, index) => {
            const button = document.createElement("button");
            button.innerHTML = answer.text;
            button.classList.add("btn");
            answerButtons.appendChild(button);
            button.addEventListener("click", () => selectAnswer(index + 1));
        });
    }

    function resetState() {
        nextButton.style.display = "none";
        while (answerButtons.firstChild) {
            answerButtons.removeChild(answerButtons.firstChild);
        }
    }

    function selectAnswer(selectedIndex) {
        console.log("Selected Index:", selectedIndex);
        console.log("Correct Answer:", questions[currentQuestionIndex].answer[selectedIndex - 1].correct);

        const isCorrect = questions[currentQuestionIndex].answer[selectedIndex - 1].correct;
        showCorrectness(selectedIndex);
        disableButtons();
        nextButton.style.display = "block";

        if (isCorrect) {
            score++;
        }
    }

    function showCorrectness(selectedIndex) {
        const correctIndex = questions[currentQuestionIndex].correct_answer;
        Array.from(answerButtons.children).forEach((button, index) => {
            const isCorrect = questions[currentQuestionIndex].answer[index].correct;

            if (isCorrect) {
                button.classList.add("correct");
            }

            if (index + 1 === selectedIndex && !isCorrect) {
                button.classList.add("incorrect");
            }
        });
    }

    function disableButtons() {
        Array.from(answerButtons.children).forEach(button => {
            button.disabled = true;
        });
    }

    function showScore() {
        resetState();
        questionElement.innerHTML = `You scored ${score} out of ${questions.length}!`;
        nextButton.style.display = "none";
        submitButton.style.display = "block";
        playAgainButton.style.display = "block";
    }

    function handleNextButton() {
        currentQuestionIndex++;
        if (currentQuestionIndex < questions.length) {
            showQuestion();
        } else {
            showScore();
        }
    }

    nextButton.addEventListener("click", () => {
        if (currentQuestionIndex < questions.length) {
            handleNextButton();
        } else {
            startQuiz();
        }
    });

    submitButton.addEventListener("click", () => {
        // Send the score to the server (replace 'submit-score.php' with your actual endpoint)
        fetch('submit-score.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `score=${score}`,
        })
            .then(response => {
                if (response.ok) {
                    alert(`Score submitted: ${score}`);
                } else {
                    console.error('Error submitting score');
                }
            })
            .catch(error => {
                console.error('Network error:', error);
            });
    });

    playAgainButton.addEventListener("click", () => {
        startQuiz();
    });

    startQuiz();
});
