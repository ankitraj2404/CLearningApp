<?php
// Start the session (if not already started)
session_start();
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "javaboi";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and execute the SQL query to retrieve user information
$stmt = $conn->prepare("SELECT user_id, username, password FROM user_info WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($user_id, $db_username, $db_password);
$stmt->fetch();
$stmt->close();

// Check if a user with the provided username exists
if ($db_username) {
    // Verify the provided password against the stored plaintext password in the database
    if ($password === $db_password) {
         // Store user information in session variables
         $_SESSION['user_id'] = $user_id;
         $_SESSION['username'] = $db_username;
 
         // Redirect to a page after successful login
         header("Location: competency.php");
        // You can implement session management or other authentication mechanisms here
    } else {
        echo "Incorrect password. Please try again.";
    }
} else {
    echo "User not found. Please check your username or <a href='signup.html'>create a new account</a>.";
}

// Close the database connection
$conn->close();
?>
