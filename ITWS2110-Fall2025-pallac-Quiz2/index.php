<?php
session_start();
if (!isset($_SESSION['userId'])) {
    // User not logged in → redirect to login page
    header("Location: login.php");
    exit();
}

// Options for logged-in users
echo "<h1>Welcome, User #" . $_SESSION['userId'] . "</h1>";
echo "<ul>
        <li><a href='project.php'>Add / View projects</a></li>
        <li><a href='logout.php'>Logout</a></li>
      </ul>";
?>
