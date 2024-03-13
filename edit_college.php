<!DOCTYPE html>
<html>
<head>
    <title>Edit College</title>
</head>
<body>
    <h2>Edit College Details</h2>
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

    // Get college ID from URL parameter
    $college_id = $_GET['college_id'];

    // Fetch college details
    $sql = "SELECT * FROM College WHERE college_id=$college_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Form for editing college details
        echo "<form action='update_college.php' method='post'>";
        echo "<input type='hidden' name='college_id' value='".$row["college_id"]."'>";
        echo "Name: <input type='text' name='name' value='".$row["name"]."'><br>";
        echo "Location: <input type='text' name='location' value='".$row["location"]."'><br>";
        echo "Established Year: <input type='number' name='established_year' value='".$row["established_year"]."'><br>";
        echo "<input type='submit' value='Update'>";
        echo "</form>";
    } else {
        echo "College not found";
    }

    // Close database connection
    $conn->close();
    ?>
</body>
</html>
