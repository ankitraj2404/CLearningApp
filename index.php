<?php
// Include the session.php file to enforce session-based authentication
include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz App</title>
  <link rel="stylesheet" href="style4.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<header>
<h2 class="logo"><i class="fas fa-graduation-cap" id="cap"></i>C LEARNING APP</h2>
      <nav class="navigation"> <a href="competency.php" class="btnlogout">Competency</a>
            <a href="topic.php" class="btnlogout">Levels</a>                
            <a href="scoreboard2.php" class="btnlogout">Scoreboard</a>
            <a href="login.html" class="btnlogout">LOG OUT</a>

       </nav>
</header>

<body>
  <div class="app">
    <h1>Quiz</h1>
    <div class="timer" id="time">Time Left: <span id="timer">05:00</span></div> <!-- Timer display -->
    <div class="quiz">
      <h2 id="question">Question goes here</h2>
      <div id="answer-buttons">
        <button class="btn">A. </button>
        <button class="btn">B.</button>
        <button class="btn">C.</button>
        <button class="btn">D.</button>
      </div>
      <button id="next-btn">Next</button>
      <button id="submit-btn" class="custom-btn">Submit</button>
      <button id="playagain-btn" class="custom-btn">play again</button>
    </div>
  </div>
  <script src="script.js"></script>
  <script>
    // JavaScript code for timer goes here
    const startingMinutes = 5;
    let time = startingMinutes * 60;

    const countdownEl = document.getElementById('timer');

    function updateTimer() {
      const minutes = Math.floor(time / 60);
      let seconds = time % 60;

      seconds = seconds < 10 ? '0' + seconds : seconds;

      countdownEl.innerHTML = `${minutes}:${seconds}`;
      if (minutes == 0 && seconds == 0) {
        clearInterval(timerInterval);
        alert("Time's up!");
        // Call function to handle time's up event
      }
      time--;
    }

    updateTimer(); // Initial call to display timer immediately

    const timerInterval = setInterval(updateTimer, 1000);
  </script>
</body>
</html>
