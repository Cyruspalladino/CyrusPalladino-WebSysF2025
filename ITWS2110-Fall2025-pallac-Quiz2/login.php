

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require 'db.php';

session_start();
require 'db.php'; // mysqli connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    $password = $_POST['password'];

    // Get user from DB
    $stmt = $conn->prepare("SELECT password_hash, salt FROM users WHERE userId = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        // User does not exist → redirect to register.php
        header("Location: register.php?userId=$userId");
        exit();
    }

    $stmt->bind_result($db_hash, $db_salt);
    $stmt->fetch();

    // Hash input password with stored salt
    $hash_input = hash('sha256', $password . $db_salt);

    if ($hash_input === $db_hash) {
        $_SESSION['userId'] = $userId;
        header("Location: index.php");
        exit();
    } else {
        $error = "Incorrect password. Please try again.";
    }
}
?>

<!-- Simple HTML form -->
<form method="post" action="login.php">
    User ID: <input type="number" name="userId" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
</form>

<?php if(isset($error)) echo "<p>$error</p>"; ?>
