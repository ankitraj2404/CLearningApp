<?php
// Include the session.php file to enforce session-based authentication
include('session.php');
?>

<DOCTYPE html> 
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" <meta name="viewport" content="width=device-width,initial-scale=1.0"> 
<title>javaboi</title>
<link rel="stylesheet" href="styles3.css">
</head>
<header>
        <h2 class="logo">javaboi</h2>
            <nav class="navigation"> <a href="#">Home</a>
                  <a href="#">About</a>                
                  <a href="#">Contact</a>
                  <a href="login.html" class="btnlogout">LOG OUT</a> 
 
             </nav>
   </header>
<body>
 <div class="QUIZ">
    <h1 class="title">QUIZ</h1>
    <form action="quiz_processor.php" method="post">
    <?php
    // Include your database connection code here
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "javaboi";

    $db_connection = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($db_connection->connect_error) {
        die("Connection failed: " . $db_connection->connect_error);
    }

    // Fetch quiz questions and options from the database
    $quiz_query = "SELECT * FROM quizzes LIMIT 10";
    $quiz_result = $db_connection->query($quiz_query);

    while ($quiz_row = $quiz_result->fetch_assoc()) {
        $question_id = $quiz_row['question_id'];
        $question_text = $quiz_row['question_text'];

        // Fetch options for each question
        $options_query = "SELECT * FROM Options WHERE question_id = $question_id";
        $options_result = $db_connection->query($options_query);

        echo "<h3>$question_text</h3>";

        while ($option_row = $options_result->fetch_assoc()) {
            $option_id = $option_row['option_id'];
            $option_text = $option_row['option_text'];

            // Correctly associate the radio button with the question ID
            echo "<input type='radio' name='answers[$question_id]' value='$option_id'> $option_text<br>";
        }
    }

    // Close the database connection
    $db_connection->close();
    ?>
 </div>
 <div style="text-align: center;">
    <input type="submit" value="Submit" style="font-size: 16px; padding: 10px 20px; background: #4EB33E; color:#fff;">
</div>

</form>
</body>
</html>
