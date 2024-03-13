<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <style>
        table {
            border-collapse: collapse;
            
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>View Students</h2>
    <?php
    // Check if course ID is provided in the URL
    if(isset($_GET['course_id'])) {
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

        // Fetch students enrolled in the specified course
        $sql = "SELECT * FROM Student WHERE course_id='$course_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>Student ID</th><th>Name</th><th>Age</th><th>Gender</th><th>Action</th></tr>";
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["student_id"]."</td><td>".$row["name"]."</td><td>".$row["age"]."</td><td>".$row["gender"]."</td>";
                echo "<td><form method='post' action='delete_student.php'>";
                echo "<input type='hidden' name='student_id' value='".$row["student_id"]."'>";
                echo "<input type='hidden' name='course_id' value='".$course_id."'>";
                echo "<button type='submit' name='submit_delete'>Delete</button>";
                echo "</form>";
                echo "<form method='get' action='edit_student.php'>";
                echo "<input type='hidden' name='student_id' value='".$row["student_id"]."'>";
                echo "<input type='hidden' name='course_id' value='".$course_id."'>";
                echo "<button type='submit' name='submit_edit'>Edit</button>";
                echo "</form></td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        // Close database connection
        $conn->close();
    } else {
        echo "Course ID not provided";
    }
    ?>
</body>
</html>
