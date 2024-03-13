<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "StudentRecord";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get college details from the form
$college_id = $_POST['college_id'];
$name = $_POST['name'];
$location = $_POST['location'];
$established_year = $_POST['established_year'];

// Update college details
$sql = "UPDATE College SET name='$name', location='$location', established_year=$established_year WHERE college_id=$college_id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

// Close database connection
$conn->close();
?>
