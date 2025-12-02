<?php
session_start();
require 'db.php';

// Redirect if not logged in
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

// Fetch all users for the multi-select
$userResult = $conn->query("SELECT userId, firstName, lastName FROM users");
$users = [];
while ($row = $userResult->fetch_assoc()) {
    $users[] = $row;
}

// Initialize messages
$error = '';
$success = '';
$newProjectId = null;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $members = $_POST['members'] ?? [];

    if (count($members) < 3) {
        $error = "Please select at least 3 members.";
    } else {
        $stmt = $conn->prepare("SELECT projectId FROM projects WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "A project with this name already exists.";
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

<h2>Add Project</h2>

<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
<?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>

<form method="post" action="">
    <label>Project Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Members (select at least 3):</label><br>
    <select name="members[]" multiple size="5" required>
        <?php foreach ($users as $user): ?>
            <option value="<?= $user['userId'] ?>">
                <?= htmlspecialchars($user['firstName'] . ' ' . $user['lastName']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" value="Add Project">
</form>

<h2>Projects</h2>
<?php
$projectsResult = $conn->query("SELECT * FROM projects ORDER BY projectId DESC");

while ($project = $projectsResult->fetch_assoc()) {
    $highlight = ($project['projectId'] == $newProjectId) ? "style='background-color: #d4f7d4; padding:10px;'" : "";
    echo "<div $highlight>";
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
    while ($m = $resultMembers->fetch_assoc()) {
        $membersList[] = $m['firstName'] . ' ' . $m['lastName'];
    }
    echo "Members: " . implode(", ", $membersList);
    echo "</div><br>";
}
?>
