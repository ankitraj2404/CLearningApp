<?php
include('session.php');

// Establish a connection to your database (replace these with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "javaboi";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch questions from the database
$sql = "SELECT * FROM quiz_questions";
$result = $conn->query($sql);

$questions = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $question = array(
            "question" => $row["question"],
            "answer" => array(
                array("text" => $row["answer_1"], "correct" => ($row["correct_answer"] == 1)),
                array("text" => $row["answer_2"], "correct" => ($row["correct_answer"] == 2)),
                array("text" => $row["answer_3"], "correct" => ($row["correct_answer"] == 3)),
                array("text" => $row["answer_4"], "correct" => ($row["correct_answer"] == 4)),
            ),
            // "value" => $row["value"]  // Add the 'value' field to the question
        );
        $questions[] = $question;
    }
}

// Close the database connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($questions);
?>
