<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "javaboi"; // Change this to your actual database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password']; // Plain text password
$points = 0; // You can set the initial points to 0

// Prepare and execute the SQL query
$stmt = $conn->prepare("INSERT INTO user_info (username, email, password, points) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $username, $email, $password, $points);

if ($stmt->execute()) {
    header("location: login.html");
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>
