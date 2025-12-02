<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $nickName = $_POST['nickName'];
    $password = $_POST['password'];

    // Generate random salt
    $salt = bin2hex(random_bytes(16));
    $password_hash = hash('sha256', $password . $salt);

    $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, nickName, password_hash, salt) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName, $nickName, $password_hash, $salt);
    $stmt->execute();

    // Get the new userId
    $userId = $stmt->insert_id;

    session_start();
    $_SESSION['userId'] = $userId;
    $_SESSION['firstName'] = $firstName;

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Register</h1>
    <form method="post" action="register.php">
        <label>First Name:</label>
        <input type="text" name="firstName" required>

        <label>Last Name:</label>
        <input type="text" name="lastName" required>

        <label>Nick Name:</label>
        <input type="text" name="nickName">

        <label>Password:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</div>

<footer>WebSys Quiz2</footer>
</body>
</html>
