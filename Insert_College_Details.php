<!DOCTYPE html>
<html>
<head>
    <title>Insert College Details</title>
</head>
<body>
    <h2>Insert College Details</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="location">Location:</label><br>
        <input type="text" id="location" name="location" required><br><br>
        
        <label for="established_year">Established Year:</label><br>
        <input type="number" id="established_year" name="established_year" required><br><br>
        
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
        $servername = "localhost";
        $username = "root"; // Change this to your database username
        $password = ""; // Change this to your database password
        $dbname = "StudentRecord";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO College (name, location, established_year) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $name, $location, $established_year);

        // Set parameters and execute
        $name = $_POST['name'];
        $location = $_POST['location'];
        $established_year = $_POST['established_year'];

        if ($stmt->execute()) {
            echo "<p>New record inserted successfully</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();
    }
    ?>
    <form action="view_colleges.php" method="post">   
        <input type="submit" name="submit" value="view details">
    </form>
</body>
</html>