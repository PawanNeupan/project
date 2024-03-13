<?php
// Check if form is submitted and student ID and course ID are provided
if(isset($_POST['submit']) && isset($_POST['student_id']) && isset($_POST['course_id'])) {
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];

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

    // Delete student from database
    $sql = "DELETE FROM Student WHERE student_id='$student_id' AND course_id='$course_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Student details deleted successfully";
        echo "<br><br><form method='get' action='view_students.php'>";
        echo "<input type='hidden' name='course_id' value='$course_id'>";
        echo "<button type='submit'>Go Back to View Students</button>";
        echo "</form>";
    } else {
        echo "Error deleting student details: " . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    echo "Student ID or course ID not provided";
}
?>