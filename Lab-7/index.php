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
$course_json = '{}';
if ($result && $row = $result->fetch_assoc()) {
    $course_json = $row['course_info'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Spooky Web Sys Course Browser</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Course Content</h2>
            <button onclick="refreshContent()">Refresh</button>
            <ul id="nav-items"></ul>
        </div>

        <div class="preview">
            <h2 id="preview-title">Select a lecture/lab</h2>
            <p id="preview-description"></p>
        </div>
        <div class="jack">
            <img src="./pumpkin.webp">
        </div>
    </div>

<script>
    const courseData = <?php echo $course_json; ?>;
</script>
<script src="./script.js"></script>

</body>
</html>
