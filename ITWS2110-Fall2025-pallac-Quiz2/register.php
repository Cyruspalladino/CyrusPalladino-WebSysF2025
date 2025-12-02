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
    header("Location: index.php");
    exit();
}
?>

<form method="post" action="register.php">
    First Name: <input type="text" name="firstName" required><br>
    Last Name: <input type="text" name="lastName" required><br>
    Nick Name: <input type="text" name="nickName"><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Register">
</form>
