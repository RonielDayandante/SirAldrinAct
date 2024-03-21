<?php

//This variable stores the hostname of mysql server.
$serverName = "localhost";

//This variable stores the username used to connect to the MySQL database.
$user = "root";

//This variable stores the pass used to connect to the MySQL database.
$pass = "";

//This variable stores the name of the database you want to connect within the MySQL server.
$databaseName = "dayandante";

//Establishing the connection between php and your database
$conn = new mysqli ($serverName, $user, $pass, $databaseName);

//Checking the connection if its successfully established or not
if($conn->connect_error){
    die("Connection Failed: ".$conn->connect_error);
}

echo "Connection Established";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            margin: auto;
        }
        form{
            position: absolute;
            top: 50px;
            left: 100px;
            border: solid:black ;
        }
        input[type="text"],input[type="number"] {
            width: 100%; 
            padding: 3px; 
           
      
        }
        .container{
            position: absolute;
            top: 450px;
            left: 100px;
        }

        .Metric{
            position: absolute;
            top: 3px;
            left: 280px;
        }

        .Imperial{
            position: absolute;
            top: 3px;
            left: 450px;
        }

        .bmi-calculation{
            position: absolute;
            top: .5px;
            left: 300px;
        }

        .bmi-calculation2{
            position: absolute;
            top: .5px;
            left: 450px;
        }
    </style>
</head>
<body>

<form method="post" action="">
    <h1>Student Profile</h1>
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value=""><br>

    <label for="age">Age:</label><br>
    <input type="number" id="age" name="age" value=""><br>

    <label for="address">Address:</label><br>
    <input type="text" id="address" name="address" value=""><br>

    <label for="contactNumber">Contact Number:</label><br>
    <input type="text" id="contactNumber" name="contactNumber" value=""><br>

    <label for="birthdate">Birthdate:</label><br>
    <input type="text" id="birthdate" name="birthdate" value=""><br>

    <label for="gender">Gender:</label><br>
    <input type="text" id="gender" name="gender" value=""><br>

    <label for="bloodType">Blood Type:</label><br>
    <input type="text" id="bloodType" name="bloodType" value=""><br>

<div class="Metric">
    <!-- BMI input fields for Metric -->
    <h1> Metric</h1>
    <label for="heightMetric">Height (m):</label><br>
    <input type="number" id="heightMetric" name="heightMetric" value=""><br>

    <label for="weightMetric">Weight (kg):</label><br>
    <input type="number" id="weightMetric" name="weightMetric" value=""><br>
</div>

<div class="Imperial">
    <!-- BMI input fields for Imperial -->
    <h1>Imperial</h1>
    <label for="height">Height (in):</label><br>
    <input type="number" id="heightImperial" name="heightImperial" value=""><br>

    <label for="weight">Weight (lbs):</label><br>
    <input type="number" id="weightImperial" name="weightImperial" value=""><br>


</div>
<input type="submit" name="submit" value="Submit">
</form>

<div class="container">
    <?php
    if (isset($_POST['submit'])) {
        // Get student details from form
        $name = $_POST['name'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $contactNumber = $_POST['contactNumber'];
        $birthdate = $_POST['birthdate'];
        $gender = $_POST['gender'];
        $bloodType = $_POST['bloodType'];

        // Get height and weight for Metric BMI
        $height_m = isset($_POST['heightMetric']) ? $_POST['heightMetric'] : null;
        $weight_kg = isset($_POST['weightMetric']) ? $_POST['weightMetric'] : null;

        // Get height and weight for Imperial BMI
        $height_in = isset($_POST['heightImperial']) ? $_POST['heightImperial'] : null;
        $weight_lbs = isset($_POST['weightImperial']) ? $_POST['weightImperial'] : null;

        // Insert data into database
        $sql = "INSERT INTO `studentprofile` 
        (`Name`, `Age`, `Address`, `Contact Number`, `Birthdate`, `Gender`, `BloodType`, `Height(m)`, `Weight(kg)`, `BMI_Metric`, `Height(in)`, `Weight(lbs)`, `BMI_Imperial`)
        VALUES ('$name', '$age', '$address', '$contactNumber', '$birthdate', '$gender', '$bloodType', '$height_m', '$weight_kg', '', '$height_in', '$weight_lbs', '')";

        $result = $conn->query($sql);

        if ($result == TRUE) {
            echo "New record created successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Display student profile
        echo "<div class='student-profile'>";
        echo "<h1>Student Profile</h1><br>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Age:</strong> $age</p>";
        echo "<p><strong>Address:</strong> $address</p>";
        echo "<p><strong>Contact Number:</strong> $contactNumber</p>";
        echo "<p><strong>Birthdate:</strong> $birthdate</p>";
        echo "<p><strong>Gender:</strong> $gender</p>";
        echo "<p><strong>Blood Type:</strong> $bloodType</p><br>";
        echo "</div>";

        // Display Metric BMI
        if ($height_m !== null && $weight_kg !== null && $height_m > 0) {
            $bmiMetric = $weight_kg / ($height_m * $height_m);
            echo "<div class='bmi-calculation'>";
            echo "<h2>BMI Calculation Metric</h2><br>";
            echo "<p><strong>Height:</strong> $height_m m</p>";
            echo "<p><strong>Weight:</strong> $weight_kg kg</p>";
            echo "<p><strong>BMI:</strong> $bmiMetric</p>";
            // Interpret Metric BMI
            // Your interpretation code here
            echo "</div>";
        }

        // Display Imperial BMI
        if ($height_in !== null && $weight_lbs !== null && $height_in > 0) {
            $bmiImperial = ($weight_lbs / ($height_in * $height_in)) * 703;
            echo "<div class='bmi-calculation'>";
            echo "<h2>BMI Calculation Imperial</h2><br>";
            echo "<p><strong>Height:</strong> $height_in in</p>";
            echo "<p><strong>Weight:</strong> $weight_lbs lbs</p>";
            echo "<p><strong>BMI:</strong> $bmiImperial</p>";
            // Interpret Imperial BMI
            // Your interpretation code here
            echo "</div>";
        }
    }
    ?>
</div>

</body>
</html>