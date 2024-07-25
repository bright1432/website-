<?php

$myqli= new mysqli("localhost", "root", "", "toothfairy_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt= $mysqli->prepare("SELECT patient_id, email, password FROM patients WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId, $dbUsername, $dbPassword);

    if ($stmt->fetch() && password_verify($password, $dbPassword)) {

        $_SESSION["patient_id"] = $userId;
    $_SESSION["email"] = $dbUsername;
    header("Location: index.html"); // Redirect to a dashboard or home page
    exit();
} else {
// Authentication failed, handle the error (e.g., display an error message)
    echo "Invalid username or password.";
    }

    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
        <h2>Login</h2>
        <form action="login.php" method="post">
            <input type="email" placeholder="E-mail" id="email" name="email" required><br>
            <input type="password" placeholder="Password" name="password" required><br>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</body>
</html>