<!DOCTYPE html>
<html>
<head>
    <title>Courses Offered</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 20px;
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
<?php
// Check if college ID is provided in the URL
if(isset($_GET['college_id'])) {
    $college_id = $_GET['college_id'];

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

    // Fetch college name
    $sql = "SELECT name FROM College WHERE college_id=$college_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h2>Courses offered by ".$row["name"]."</h2>";

        // Fetch courses offered by the college
        $sql_courses = "SELECT course_id, name FROM Course WHERE college_id=$college_id";
        $result_courses = $conn->query($sql_courses);

        if ($result_courses->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Course Name</th><th>Add Student</th></tr>";
            // Output data of each row
            while ($row_courses = $result_courses->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row_courses["name"]."</td>";
                echo "<td><form method='get' action='add_student.php'>";
                echo "<input type='hidden' name='course_id' value='".$row_courses["course_id"]."'>";
                echo "<input type='submit' value='Add Student'>";

                

                echo "</form></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No courses offered by this college";
        }
    } else {
        echo "College not found";
    }

    // Close database connection
    $conn->close();
} else {
    echo "College ID not provided";
}
?>
</body>
</html>
