<!DOCTYPE html>
<html>
<head>
    <title>Update Scores</title>
</head>
<body>
    <form method="post" action="">
        <!-- Your other input fields, if any -->
        <input type="hidden" name="update_scores" value="true">
        <button type="submit">Update Scores</button>
    </form>
</body>
</html>

<?php
// Start the session
session_start();

// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "javaboi";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have the user's ID stored in the session
if(isset($_POST['update_scores']) && isset($_SESSION['user_id'])) {
    // Get user ID from the session
    $user_id = $_SESSION['user_id'];
    
    // Retrieve the existing scores from the database
    $sql = "SELECT points, quiz_score, level3, level4, int_level1, int_level2, int_level3, int_level4, exp_level1, exp_level2, exp_level3, exp_level4 FROM user_info WHERE user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Get the existing scores from the database
        $points = $row['points'];
        $quiz_score = $row['quiz_score'];
        $level3 = $row['level3'];
        $level4 = $row['level4'];
        $int_level1 = $row['int_level1'];
        $int_level2 = $row['int_level2'];
        $int_level3 = $row['int_level3'];
        $int_level4 = $row['int_level4'];
        $exp_level1 = $row['exp_level1'];
        $exp_level2 = $row['exp_level2'];
        $exp_level3 = $row['exp_level3'];
        $exp_level4 = $row['exp_level4'];

        // Calculate the updated scores for each category
        $beginner_score = $points;
        $intermediate_score = $int_level1 + $int_level2 + $int_level3 + $int_level4;
        $expert_score = $exp_level1 + $exp_level2 + $exp_level3 + $exp_level4;

        // Update the scores in the table
        $updateSql = "UPDATE user_info SET 
                beginner_score = $beginner_score,
                intermediate_score = $intermediate_score,
                expert_score = $expert_score,
                quiz_score = quiz_score + $quiz_score,
                level3 = level3 + $level3,
                level4 = level4 + $level4
                WHERE user_id = $user_id";

        if ($conn->query($updateSql) === TRUE) {
            echo "Scores updated successfully";
        } else {
            echo "Error updating scores: " . $conn->error;
        }
    } else {
        echo "User not found.";
    }
}

// Retrieve scores and display certificates for the user
$user_id_for_certificates = $_SESSION['user_id'];

// Retrieve scores for the specified user from the database
$sql = "SELECT beginner_score, intermediate_score, expert_score FROM user_info WHERE user_id = $user_id_for_certificates";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Check the scores and determine which certificate to display
    $beginner_score = $row['beginner_score'];
    $intermediate_score = $row['intermediate_score'];
    $expert_score = $row['expert_score'];

  // Initialize certificateImage to an empty string
$certificateImage = '';

// Check the scores and determine which certificates to display
if ($beginner_score >= 5) {
    $certificateImage .= 'certificate_1.png ';
}

if ($intermediate_score >= 5) {
    $certificateImage .= 'certificate_2.png ';
}

if ($expert_score >= 5) {
    $certificateImage .= 'certificate_3.png ';
}

// Separate the certificates with a space
$certificateImage = trim($certificateImage);

// Output the certificate images
if (!empty($certificateImage)) {
    $certificates = explode(' ', $certificateImage);
    foreach ($certificates as $certificate) {
        echo "<img src='$certificate' alt='Certificate'>";
    }
}

} else {
    echo "User not found.";
}

// Close the database connection
$conn->close();
?>
