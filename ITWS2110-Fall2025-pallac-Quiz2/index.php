<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

// Options for logged-in users
echo "<h1>Welcome, User #" . $_SESSION['userId'] . "</h1>";
echo "<ul>
        <li><a href='addProject.php'>Add a project</a></li>
        <li><a href='viewProjects.php'>View existing projects</a></li>
      </ul>";
