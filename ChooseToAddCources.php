<html>
<head>
    <title>View Colleges</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
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
    <h2>View All College Names</h2>
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

    // Fetch all college names
    $sql = "SELECT college_id, name FROM College";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>College Name</th><th>Choose Course</th></tr>";
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["name"]."</td>";
            echo "<td><form method='get' action='choose_course.php'><input type='hidden' name='college_id' value='".$row["college_id"]."'><input type='submit' value='Choose Course'></form>";
        
        
        
            echo "<form method='get' action='show_courses.php'>";
            echo "<input type='hidden' name='college_id' value='".$row["college_id"]."'>";
            echo "<input type='submit' value='Show Courses'>";
            echo "</form>";
            echo "</td></tr>";
        
        
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close database connection
    $conn->close();
    ?>
</body>
</html>