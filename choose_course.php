<!DOCTYPE html>
<html>
<head>
    <title>Choose Course</title>
</head>
<body>
    <h2>Choose Course for Selected College</h2>
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
            echo "<p>Selected College: ".$row["name"]."</p>";

            // Form to choose courses
            echo "<form method='post'>";
            echo "<input type='hidden' name='college_id' value='".$college_id."'>";
            echo "<p>Select Courses:</p>";
            echo "<input type='checkbox' name='courses[]' value='BCA'> BCA<br>";
            echo "<input type='checkbox' name='courses[]' value='BIM'> BIM<br>";
            echo "<input type='checkbox' name='courses[]' value='BBM'> BBM<br>";
            echo "<input type='checkbox' name='courses[]' value='BSc CSIT'> BSc CSIT<br>";
            echo "<input type='checkbox' name='courses[]' value='BSW'> BSW<br>";
            echo "<input type='checkbox' name='courses[]' value='BIT'> BIT<br>";
            echo "<input type='checkbox' name='courses[]' value='BHM'> BHM<br>";
            echo "<input type='checkbox' name='courses[]' value='BBA'> BBA<br>";
            echo "<input type='checkbox' name='courses[]' value='BBS'> BBS<br>";
            echo "<br><input type='submit' name='submit' value='Submit'>";
            echo "</form>";
        } else {
            echo "College not found";
        }

        // Close database connection
        $conn->close();
    } else {
        echo "College ID not provided";
    }

    // Process course selection
    if(isset($_POST['submit'])) {
        // Check if college ID and courses are provided
        if(isset($_POST['college_id']) && isset($_POST['courses'])) {
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

            // Sanitize inputs
            $college_id = $_POST['college_id'];
            $courses = $_POST['courses'];

            // Insert selected courses into the database
            foreach($courses as $course) {
                // Insert course into Course table
                $sql = "INSERT INTO Course (name, college_id) VALUES ('$course', '$college_id')";
                if ($conn->query($sql) !== TRUE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            echo "Selected courses added successfully";

            // Close database connection
            $conn->close();
        } else {
            echo "College ID or courses not provided";
        }
    }
    ?>
</body>
</html>
