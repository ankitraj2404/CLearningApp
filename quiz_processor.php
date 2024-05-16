<DOCTYPE html> 
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" <meta name="viewport" content="width=device-width,initial-scale=1.0"> 
<title>javaboi</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

   <header>
       <h2 class="logo">javaboi</h2>
           <nav class="navigation"> <a href="#">Home</a>
                 <a href="#">About</a>                
                 <a href="#">Contact</a>
                 <button class="btnlogin-popup">Login</button>  

            </nav>
  </header>
<?php
// Initialize the score and total number of questions
$score = 0;
$totalQuestions = 0;

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code here
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "javaboi";

    $db_connection = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($db_connection->connect_error) {
        die("Connection failed: " . $db_connection->connect_error);
    }

    // Calculate the score based on submitted answers
    if (isset($_POST['answers']) && is_array($_POST['answers'])) {
        foreach ($_POST['answers'] as $question_id => $selected_option_id) {
            $query = "SELECT correct_option FROM quizzes WHERE question_id = $question_id";
            $result = $db_connection->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $correct_option_id = $row['correct_option'];

                // Check if the selected option is correct
                if ($selected_option_id == $correct_option_id) {
                    $score++;
                }
            }

            // Increment the total number of questions
            $totalQuestions++;
        }
    }

    // Close the database connection
    $db_connection->close();
}

// Calculate the percentage score
if ($totalQuestions > 0) {
    $percentageScore = ($score / $totalQuestions) * 100;
} else {
    $percentageScore = 0; // Avoid division by zero
}

// Update the user's score in the user_info table
session_start(); // Start the session (if not already started)

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Retrieve the username from the session

    // Include your database connection code here
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "javaboi";

    $db_connection = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($db_connection->connect_error) {
        die("Connection failed: " . $db_connection->connect_error);
    }

    // Update the score based on the retrieved username
    $update_query = "UPDATE user_info SET points = $score WHERE username = '$username'";
    $db_connection->query($update_query);

    // Close the database connection
    $db_connection->close();

    echo '<div style="text-align: center;">';
    echo '<div style="border: 2px solid #333; padding: 20px; display: inline-block;">';
    echo '<p style="font-size: 24px; font-weight: bold; color: #333;">Your score: <span style="color: #FF5722;">' . number_format($percentageScore, 2) . '%</span></p>';
    echo '</div>';
    echo '</div>';
    // Display the percentage score
    echo '<div style="text-align: center; margin-top: 20px;">';
    echo '<form action="scoreboard.php" method="post">';
    echo '<input type="submit" name="scoreboard" value="Scoreboard" style="font-size: 16px; padding: 10px 20px; background: #4EB33E; color: #fff; border: none;">';
    echo '</form>';
    echo '</div>';
} else {
    echo "User not logged in."; // Handle the case where the user is not logged in
}
?>
