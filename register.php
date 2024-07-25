<?php

$myqli= new mysqli("localhost", "root", "", "toothfairy_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $patient_id = $_POST["patient_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $date_of_birth = $_POST["date_of_birth"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
}

$stmt= $mysqli->prepare("INSERT INTO patients (patient_id, first_name, last_name, email, phone, date_of_birth, password) VALUES(?, ?, ?, ?, ?, ?, ?)" );

$stmt->bind_param("issssss", $patient_id, $first_name, $last_name, $email, $phone, $date_of_birth, $password);

if ($stmt->execute()) {
    header("Location: login.php"):
    exit();
}else{

    echo"Error: " . $stmt->error;

 }
 
 $stmt->close();  

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fdd7e4; /* Light pink background */
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #ff80ab; /* Dark pink container */
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #fff; /* White text */
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #ff1493; /* Deep pink submit button */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ff007f; /* Darker pink on hover */
        }

        a {
            color: #ff007f; /* Pink link color */
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form action="register.php" method="post">
            <input type="text" placeholder="First Name" id="first_name" name="first_name" required><br>
            <input type="text" placeholder="Last Name" id="last_name" name="last_name" required><br>
            <input type="email" placeholder="E-mail" id="email" name="email" required><br>
            <input type="number" placeholder="Phone Number" id="phone" name="phone" required><br>
            <input type="date" placeholder="Date Of Birth" id="date_of_birth" name="date_of_birth" required><br>
            <input type="password" placeholder="Password" name="password" required><br>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>