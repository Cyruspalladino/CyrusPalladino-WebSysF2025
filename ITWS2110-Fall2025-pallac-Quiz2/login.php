<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    $password = $_POST['password'];

    // Query password_hash, salt, firstName
    $stmt = $conn->prepare("SELECT password_hash, salt, firstName FROM users WHERE userId = ?");
    $stmt->bind_param("i", $userId); // userId is INT
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hash, $salt, $firstName);
        $stmt->fetch();

        // Verify password
        if (hash('sha256', $password . $salt) === $hash) {
            $_SESSION['userId'] = $userId;
            $_SESSION['firstName'] = $firstName; // store first name in session
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        // Redirect to registration if user doesn't exist
        header("Location: register.php");
        exit();
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Login</h1>
    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post" action="">
        <label>User ID:</label><br>
        <input type="number" name="userId" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</div>
<footer>WebSys Quiz2</footer>
</body>
</html>
