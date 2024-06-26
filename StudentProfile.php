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
            top: 60px;
            left: 300px;
        }
        input[type="text"],input[type="number"] {
            width: 135%; 
            padding: 5px; 
        }
        .container{
            position: absolute;
            top: 60px;
            left: 850px;
        }
    </style>
</head>
<body>

<form method="post" action="">
    <h1>Student Profile</h1>
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="Caranguian, Emilfred C."><br>

    <label for="age">Age:</label><br>
    <input type="number" id="age" name="age" value="21"><br>

    <label for="address">Address:</label><br>
    <input type="text" id="address" name="address" value="Block 51 E lot 7 Phase 3 F2 Dagat-dagatan Caloocan City"><br>

    <label for="contactNumber">Contact Number:</label><br>
    <input type="text" id="contactNumber" name="contactNumber" value="09236520014"><br>

    <label for="birthdate">Birthdate:</label><br>
    <input type="text" id="birthdate" name="birthdate" value="04-26-2002"><br>

    <label for="gender">Gender:</label><br>
    <input type="text" id="gender" name="gender" value="Male"><br>

    <label for="bloodType">Blood Type:</label><br>
    <input type="text" id="bloodType" name="bloodType" value="O"><br>

<div class="Metric">
    <!-- BMI input fields for Metric -->
    <h2>BMI Calculation Metric</h2>
    <label for="heightMetric">Height (m):</label><br>
    <input type="number" id="heightMetric" name="heightMetric" value="1.6256"><br>

    <label for="weightMetric">Weight (kg):</label><br>
    <input type="number" id="weightMetric" name="weightMetric" value="69"><br>
</div>

<div class="Imperial">
    <!-- BMI input fields for Imperial -->
    <h2>BMI Calculation Imperial</h2>
    <label for="height">Height (in):</label><br>
    <input type="number" id="heightImperial" name="heightImperial" value="64"><br>

    <label for="weight">Weight (lbs):</label><br>
    <input type="number" id="weightImperial" name="weightImperial" value="152"><br>

    <input type="submit" value="Submit">
</div>
</form>

<div class="container">
    <div class="student-profile">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get student details from form
            $name = $_POST['name'];
            $age = $_POST['age'];
            $address = $_POST['address'];
            $contactNumber = $_POST['contactNumber'];
            $birthdate = $_POST['birthdate'];
            $gender = $_POST['gender'];
            $bloodType = $_POST['bloodType'];

            // Display student profile
            echo "<h1>Student Profile</h1><br>";
            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Age:</strong> $age</p>";
            echo "<p><strong>Address:</strong> $address</p>";
            echo "<p><strong>Contact Number:</strong> $contactNumber</p>";
            echo "<p><strong>Birthdate:</strong> $birthdate</p>";
            echo "<p><strong>Gender:</strong> $gender</p>";
            echo "<p><strong>Blood Type:</strong> $bloodType</p><br>";

        }
        ?>
    </div>

    <div class="bmi-calculation">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get height and weight for Metric BMI
        $height_m = isset($_POST['heightMetric']) ? $_POST['heightMetric'] : null;
        $weight_kg = isset($_POST['weightMetric']) ? $_POST['weightMetric'] : null;

        // Check if height and weight are set and not null before calculating Metric BMI
        if ($height_m !== null && $weight_kg !== null && $height_m > 0) {
            // Calculate Metric BMI
            $bmiMetric = $weight_kg / ($height_m * $height_m);

            // Display Metric BMI
            echo "<h2>BMI Calculation Metric</h2><br>";
            echo "<p><strong>Height:</strong> $height_m m</p>";
            echo "<p><strong>Weight:</strong> $weight_kg kg</p>";
            echo "<p><strong>BMI:</strong> $bmiMetric</p>";

            // Interpret Metric BMI
            if ($bmiMetric < 18.5) {
                echo "<p><strong>Interpretation:</strong> Underweight</p><br>";
            } elseif ($bmiMetric >= 18.5 && $bmiMetric < 25) {
                echo "<p><strong>Interpretation:</strong> Normal weight</p><br>";
            } elseif ($bmiMetric >= 25 && $bmiMetric < 30) {
                echo "<p><strong>Interpretation:</strong> Overweight</p><br>";
            } else {
                echo "<p><strong>Interpretation:</strong> Obesity</p><br>";
            }
        } else {
            echo "<p>Please enter valid height and weight for Metric BMI.</p>";
        }
    }
    ?>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get height and weight for Imperial BMI
        $height_in = isset($_POST['heightImperial']) ? $_POST['heightImperial'] : null;
        $weight_lbs = isset($_POST['weightImperial']) ? $_POST['weightImperial'] : null;

        // Check if height and weight are set and not null before calculating Imperial BMI
        if ($height_in !== null && $weight_lbs !== null && $height_in > 0) {
            // Calculate Imperial BMI
            $bmiImperial = ($weight_lbs / ($height_in * $height_in)) * 703;

            // Display Imperial BMI
            echo "<h2>BMI Calculation Imperial</h2><br>";
            echo "<p><strong>Height:</strong> $height_in in</p>";
            echo "<p><strong>Weight:</strong> $weight_lbs lbs</p>";
            echo "<p><strong>BMI:</strong> $bmiImperial</p>";

            // Interpret Imperial BMI
            if ($bmiImperial < 18.5) {
                echo "<p><strong>Interpretation:</strong> Underweight</p>";
            } elseif ($bmiImperial >= 18.5 && $bmiImperial < 25) {
                echo "<p><strong>Interpretation:</strong> Normal weight</p>";
            } elseif ($bmiImperial >= 25 && $bmiImperial < 30) {
                echo "<p><strong>Interpretation:</strong> Overweight</p>";
            } else {
                echo "<p><strong>Interpretation:</strong> Obesity</p>";
            }
        } else {
            echo "<p>Please enter valid height and weight for Imperial BMI.</p>";
        }
    }
    ?>
</div>
</div>

</body>
</html>
