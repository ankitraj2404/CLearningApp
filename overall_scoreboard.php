<?php
include('session.php');
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
    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "javaboi";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to update the 'allpoints' column
    $updateQuery = "UPDATE user_info SET allpoints = points + quiz_score + level3 + level4 + int_level1 + int_level2 + int_level3 + int_level4 + exp_level1 + exp_level2 + exp_level3 + exp_level4";
    if ($conn->query($updateQuery) === TRUE) {
        echo "";
    } else {
        echo "Error updating allpoints: " . $conn->error;
    }

    // SQL query to fetch the overall points and username
    $sql = "SELECT username, allpoints FROM user_info  ORDER BY allpoints DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<table><tr><th>Username</th><th>Overall Points</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["username"] . "</td><td>" . $row["allpoints"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No results found";
    }

    // Close the database connection
    $conn->close();
    ?>
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
    <form method="post" action="certificate.php">
        <input type="submit" name="get_certificate" value="VIEW CERTIFICATE">
    </form>
</body>
</html>
