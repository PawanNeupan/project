<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student Details</h2>
    <?php
    // Check if student ID and course ID are provided in the URL
    if(isset($_GET['student_id']) && isset($_GET['course_id'])) {
        $student_id = $_GET['student_id'];
        $course_id = $_GET['course_id'];

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

        // Fetch student details
        $sql = "SELECT * FROM Student WHERE student_id='$student_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post">
                <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                <p>Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"></p>
                <p>Age: <input type="number" name="age" value="<?php echo $row['age']; ?>"></p>
                <p>Gender: <input type="text" name="gender" value="<?php echo $row['gender']; ?>"></p>
                <input type="submit" name="submit" value="Update">
            </form>
            <?php
        } else {
            echo "Student not found";
        }

        // Close database connection
        $conn->close();
    } else {
        echo "Student ID or course ID not provided";
    }

    // Process form submission to update student details
    if(isset($_POST['submit'])) {
        // Check if student ID and course ID are provided
        if(isset($_POST['student_id']) && isset($_POST['course_id'])) {
            $student_id = $_POST['student_id'];
            $course_id = $_POST['course_id'];

            // Database connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Sanitize inputs
            $name = $_POST['name'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];

            // Update student details in the database
            $sql = "UPDATE Student SET name='$name', age='$age', gender='$gender' WHERE student_id='$student_id'";
            if ($conn->query($sql) === TRUE) {
                echo "Student details updated successfully";
            } else {
                echo "Error updating student details: " . $conn->error;
            }

            // Close database connection
            $conn->close();
        } else {
            echo "Student ID or course ID not provided";
        }
    }
    ?>
    <form action="view_students.php" method="get">
        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
        <input type="submit" value="View Students Enrolled in This Course">
    </form>
</body>
</html>
