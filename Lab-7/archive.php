<?php
$host = "localhost";
$user = "admin";
$pass = "WaterLight33?"; 
$db = "Lab7";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$crn = 10005;

$sql = "SELECT course_info FROM courses WHERE crn = $crn";
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    $course_json = $row['course_info'];
    $course_data = json_decode($course_json, true);
} else {
    die("Course JSON not found.");
}

if (isset($_POST['archive'])) {
    // Insert lectures
    foreach ($course_data['Websys_course']['Lectures'] as $lecture_number => $lecture) {
        $title = $conn->real_escape_string($lecture['Title']);
        $desc = $conn->real_escape_string($lecture['Description']);
        $conn->query("INSERT INTO lectures (crn, lecture_number, title, description) 
                      VALUES ($crn, '$lecture_number', '$title', '$desc')");
    }

    // Insert labs
    foreach ($course_data['Websys_course']['Labs'] as $lab_number => $lab) {
        $title = $conn->real_escape_string($lab['Title']);
        $desc = $conn->real_escape_string($lab['Description']);
        $conn->query("INSERT INTO labs (crn, lab_number, title, description) 
                      VALUES ($crn, '$lab_number', '$title', '$desc')");
    }

    echo "<p>Content archived.</p>";
}

if (isset($_POST['delete'])) {
    $conn->query("TRUNCATE TABLE lectures");
    $conn->query("TRUNCATE TABLE labs");
    echo "<p>Tables cleared.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Archive Course</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<form method="post">
    <div class="center-wrapper">
        <h1>Archive Spooky Web Sys Content</h1>
        <div class="button-row">
            <button type="submit" name="archive">Archive Course Content</button>
            <button type="submit" name="delete">Clear Archived Tables</button>
        </div>
    </div>
</form>
</body>
</html>
