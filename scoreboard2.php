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

// Query to retrieve user scores
$query = "SELECT username, quiz_score FROM user_info ORDER BY level3 DESC";
$result = $db_connection->query($query);

if ($result->num_rows > 0) {
    $scoreboardData = array();
    while ($row = $result->fetch_assoc()) {
        $scoreboardData[] = $row;
    }
} else {
    $scoreboardData = array();
}

// Close the database connection
$db_connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoreboard</title>
    <link rel="stylesheet" href="styles1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0px 0px 10px rgba(135, 0, 0, 5); /* Shadow */
        }
        td {
            padding: 12px;
            text-align: left;
            border:3px solid black;
        }
        th {
            background-color: #c9170a;
            color:white;
            border-radius: 10px 10px 0 0; /* Rounded corners for top */
            padding: 12px;
            text-align: left;
        }
        td:first-child {
            border-left: none; /* Remove left border for first cell in each row */
        }
        td:last-child {
            border-right: none; /* Remove right border for last cell in each row */
        }
        tr:last-child td {
            border-bottom: none; /* Remove bottom border for last row */
        }
        h1 {
            padding: 15px;
        }
    </style>
</head>
<header>
<h2 class="logo"><i class="fas fa-graduation-cap" id="cap"></i>C LEARNING APP</h2>
            <nav class="navigation">
                  <a href="competency.php" class="btnlogout">Competency</a>                
                  <a href="topic.php" class="btnlogout">Level</a>
                  <a href="login.html" class="btnlogout">LOG OUT</a> 
 
             </nav>
   </header>
<body>
    <h1>Scoreboard</h1>
    <?php if (!empty($scoreboardData)) : ?>
        <table>
            <tr>
                <th>Username</th>
                <th>Score</th>
            </tr>
            <?php foreach ($scoreboardData as $row) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo $row['quiz_score']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No scores found.</p>
    <?php endif; ?>
<style>
        /* Style for the form */
        form {
            text-align: center;
            margin-top: 20px;
        }

        /* Style for the submit button */
        input[type="submit"] {
            background-color: #c7143b;
            color: white;
            border: none;
            border-radius:5px;
            padding: 10px 20px;
            cursor: pointer;
            font-family:"Lucida Console", "Courier New", monospace;
        }
    </style>
    <form method="post" action="overall_scoreboard.php">
        <input type="submit"  name="update_allpoints" value="OVERALL SCOREBOARD">
    </form>
</body>
</html>
