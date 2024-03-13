<!DOCTYPE html>
<html>
<head>
    <title>View Colleges</title>
</head>
<body>
    <h2>View All Colleges</h2>
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

    // If delete button is clicked
    if(isset($_POST['delete'])){
        $college_id = $_POST['college_id'];
        // SQL to delete record
        $sql = "DELETE FROM College WHERE college_id=$college_id";

        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    // Fetch all colleges
    $sql = "SELECT * FROM College";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='2'><tr><th>ID</th><th>Name</th><th>Location</th><th>Established Year</th><th>Action</th></tr>";
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["college_id"]."</td><td>".$row["name"]."</td><td>".$row["location"]."</td><td>".$row["established_year"]."</td>";
            echo "<td>";
            echo "<form action='edit_college.php' method='get' style='display:inline;'><input type='hidden' name='college_id' value='".$row["college_id"]."'><input type='submit' value='Edit'></form>";
            echo "<form method='post' style='display:inline;'><input type='hidden' name='college_id' value='".$row["college_id"]."'><input type='submit' name='delete' value='Delete'></form>";
            echo "<form method='get' action='choose_course.php'><input type='hidden' name='college_id' value='".$row["college_id"]."'><input type='submit' value='Choose Course'></form>";

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
