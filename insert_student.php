<?php
// Database connection parameters
$servername = "localhost"; // Change this to your MySQL server hostname if it's not localhost
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "StudentResults";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the insert statement
$stmt = $conn->prepare("INSERT INTO Students (name, age, semester, course) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siss", $name, $age, $semester, $course);

// Set parameters and execute
$name = $_POST['name'];
$age = $_POST['age'];
$semester = $_POST['semester'];
$course = $_POST['course'];
$stmt->execute();

echo "New student record inserted successfully";

// Close statement and connection
$stmt->close();
$conn->close();
?>