<?php
session_start();
require 'db.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

// Fetch users
$userResult = $conn->query("SELECT userId, firstName, lastName FROM users");
$users = [];
while ($row = $userResult->fetch_assoc()) $users[] = $row;

$error = '';
$success = '';
$newProjectId = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $members = $_POST['members'] ?? [];

    if (count($members) < 3) {
        $error = "Select at least 3 members.";
    } else {
        $stmt = $conn->prepare("SELECT projectId FROM projects WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Project name already exists.";
        } else {
            $stmtInsert = $conn->prepare("INSERT INTO projects (name, description) VALUES (?, ?)");
            $stmtInsert->bind_param("ss", $name, $description);
            $stmtInsert->execute();
            $newProjectId = $stmtInsert->insert_id;

            $stmtMember = $conn->prepare("INSERT INTO projectMembership (projectId, memberId) VALUES (?, ?)");
            foreach ($members as $memberId) {
                $stmtMember->bind_param("ii", $newProjectId, $memberId);
                $stmtMember->execute();
            }
            $success = "Project added successfully!";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Projects</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .members-checkboxes label {
            display: block;
            margin: 5px 0;
            cursor: pointer;
        }
        .members-checkboxes input[type="checkbox"] {
            margin-right: 8px;
        }
        .project.highlight {
            background-color: #d4ffd4;
            padding: 10px;
            border-radius: 5px;
        }
        .project {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>
<div class="topnav">
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>
</div>
<div class="container">
    <h1>Projects</h1>

    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
    <?php if ($success) echo "<p style='color:#6bffc9;'>$success</p>"; ?>

    <form method="post" action="">
        <label>Project Name:</label><br>
        <input type="text" name="name" required><br>

        <label>Description:</label><br>
        <textarea name="description" required></textarea><br>

        <label>Members (select at least 3):</label><br>
        <div class="members-checkboxes">
            <?php foreach ($users as $user): ?>
                <label>
                    <input type="checkbox" name="members[]" value="<?= $user['userId'] ?>">
                    <?= htmlspecialchars($user['firstName'] . ' ' . $user['lastName']) ?>
                </label>
            <?php endforeach; ?>
        </div>

        <input type="submit" value="Add Project">
    </form>

    <h2>Existing Projects</h2>
    <?php
    $projectsResult = $conn->query("SELECT * FROM projects ORDER BY projectId DESC");
    while ($project = $projectsResult->fetch_assoc()) {
        $highlightClass = ($project['projectId'] == $newProjectId) ? "project highlight" : "project";
        echo "<div class='$highlightClass'>";
        echo "<strong>" . htmlspecialchars($project['name']) . "</strong><br>";
        echo htmlspecialchars($project['description']) . "<br>";

        $stmtMembers = $conn->prepare("
            SELECT u.firstName, u.lastName 
            FROM users u 
            JOIN projectMembership pm ON u.userId = pm.memberId 
            WHERE pm.projectId = ?
        ");
        $stmtMembers->bind_param("i", $project['projectId']);
        $stmtMembers->execute();
        $resultMembers = $stmtMembers->get_result();
        $membersList = [];
        while ($m = $resultMembers->fetch_assoc()) $membersList[] = $m['firstName'] . ' ' . $m['lastName'];
        echo "Members: " . implode(", ", $membersList);
        echo "</div>";
    }
    ?>
</div>
<footer>WebSys Quiz2</footer>
</body>
</html>
