<?php
session_start();
if (!isset($_SESSION['userId'])) {
    // User not logged in → redirect to login page
    header("Location: login.php");
    exit();
}

// Redirect if user is not logged in
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

// Options for logged-in users
echo "<h1>Welcome, User #" . $_SESSION['userId'] . "</h1>";
echo "<ul>
        <li><a href='addProject.php'>Add a project</a></li>
        <li><a href='viewProjects.php'>View existing projects</a></li>
        <li><a href='logout.php'>Logout</a></li>
      </ul>";
?>
