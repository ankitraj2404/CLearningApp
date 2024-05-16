<?php
// Replace these database credentials with your own
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "javaboi";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for a successful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Replace 'your_user_id' with the actual user ID of the logged-in user
$userID = 1;

// Define the threshold points required to complete Level 1
$requiredPointsForLevel1 = 100; // Adjust this value as needed

// Query the database to retrieve the user's points
$sql = "SELECT points FROM user_info WHERE user_id = $userID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Assuming the result contains only one row for the user
    $row = $result->fetch_assoc();

    // Check if the user has enough points to complete Level 1
    $level1Completed = ($row['points'] >= 3);
} else {
    // Handle the case when no user points are found
    $level1Completed = false;
}

// Close the database connection
$conn->close();

// Return the result (true if Level 1 is completed, false otherwise)
// echo json_encode(['level1Completed' => $level1Completed]);
?>
