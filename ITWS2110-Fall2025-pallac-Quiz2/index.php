<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="topnav">
    <div class="logo">LOGO</div>
    <div class="nav-links">
        <a href="project.php">Projects</a>
        <a href="logout.php">Logout</a>
    </div>
</div>
<div class="container">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['firstName']) ?></h1>
    <p>Use the navigation above to manage projects.</p>
</div>
<footer>WebSys Quiz2</footer>
</body>
</html>
