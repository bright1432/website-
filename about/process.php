<!DOCTYPE html>
<html>
<head>
    <title>Appointment Confirmation</title>
</head>
<body>
    <h1>Appointment Confirmation</h1>

    <?php

$mysqli = new mysqli("localhost", "root", "", "toothfairy_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $appointment_id = $_POST["appointment_id"];
        $firstName = $_POST["first_name"];
        $lastName = $_POST["last_name"];
        $mobileNumber = $_POST["mobile_number"];
        $email = $_POST["email"];
        $medicalCondition = $_POST["medical_condition"];
        $gender = $_POST["gender"];
        $age = $_POST["age"];
        $preferred_day = $_POST["preferred_day"];
        $preferred_time= $_POST["preferred_time"];

         $stmt = $mysqli->prepare("INSERT INTO patientappointments (appointment_id,first_name, last_name, mobile_number, email, medical_condition, gender, age, preferred_day, preferred_time ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
         $stmt->bind_param("isssssssss", $appointment_id, $firstName, $lastName, $mobileNumber, $email, $medicalCondition,$gender, $age,$preferred_day,$preferred_time );
    }

if ($stmt->execute()) {
    header("Location: appointmentconfirmation.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}


        $stmt->close();

        $mysqli->close();

?>

  <style>
        body {
            background-color: #FFC0CB; /* Pink background color */
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #FF1493; /* Deep pink text color for the heading */
        }

        p {
            color: #333; /* Dark text color for paragraphs */
        }

        input[type="submit"] {
            background-color: #FF1493; /* Deep pink background color for submit button */
            color: #fff; /* White text color for the button */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #FF69B4; /* Lighter pink background color on hover */
        }
    </style>

    <form action="appointmentconfirmation.php" method="post">
        <input type="submit" name="confirm" value="Confirm Appointment">
    </form>
</body>
</html>