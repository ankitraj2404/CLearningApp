<?php
include("session.php"); // Add a semicolon here

// Check if the required POST parameters are set
if (!isset($_SESSION["username"]) || !isset($_POST["code"]) || !isset($_POST["input_data"])) {
    echo "Invalid request. Please provide username, code, and input_data.";
    exit();
}

$un = $_SESSION["username"];
$code = $_POST["code"];
$input = $_POST["input_data"];

// Define restricted keywords
$restrictedKeywords = ["unlink", "rmtree", "rmdir", "remove", "delete", "mkdir()", "list()", "getAbsolutePath()"];

// Check for restricted keywords
foreach ($restrictedKeywords as $keyword) {
    if (strpos($code, $keyword) !== false) {
        echo "You are not allowed to use the keyword '$keyword'.";
        exit();
    }
}

// Define restricted paths and extensions
$restrictedPaths = ["C:\\", "D:\\", "C:/", "D:/"];
$restrictedExtensions = [".exe", ".php"];

// Check for restricted paths and extensions
foreach ($restrictedPaths as $path) {
    if (strpos($code, $path) !== false) {
        echo "You are not allowed to use the path '$path'.";
        exit();
    }
}

foreach ($restrictedExtensions as $extension) {
    if (strpos($code, $extension) !== false) {
        echo "You are not allowed to use the file extension '$extension'.";
        exit();
    }
}

$codeFileName = $un . ".c";
$inputFileName = $un . "input.txt";
$outputFileName = $un . ".out";

// Write code to a file
if (file_put_contents($codeFileName, $code) === false) {
    echo "Error writing code to file.";
    exit();
}

// Write input data to a file
if (file_put_contents($inputFileName, $input) === false) {
    echo "Error writing input data to file.";
    unlink($codeFileName);  // Clean up the code file
    exit();
}

// Replace the old path with the new path
putenv("PATH=" . getenv("PATH") . ";C:\cygwin64\bin");

// Compile the C code
$compileCommand = "C:\cygwin64\bin\gcc.exe -o $outputFileName $codeFileName 2>&1";
exec($compileCommand, $compileOutput, $compileStatus);

if ($compileStatus !== 0) {
    echo "Compilation Error:\n";
    echo implode("\n", $compileOutput);
} else {
    // Run the compiled executable with input data
    $runCommand = "$outputFileName < $inputFileName 2>&1";
    exec($runCommand, $runOutput, $runStatus);

    if ($runStatus !== 0) {
        echo "Runtime Error:\n";
        echo implode("\n", $runOutput);
    } else {
        // Display the program's output
        echo implode("\n", $runOutput);
    }

    // Clean up files
    unlink($codeFileName);
    unlink($inputFileName);
    unlink($outputFileName);
}
?>
