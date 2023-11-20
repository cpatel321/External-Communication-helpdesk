<?php
include 'config.php';

$name = $_POST['name'];
$department = $_POST['department'];
$queryType = $_POST['queryType'];
$imageVideo = isset($_POST['imageVideo']) ? $_POST['imageVideo'] : NULL;
$websiteLink = isset($_POST['websiteLink']) ? $_POST['websiteLink'] : NULL;
$description = $_POST['description'];

$stmt = $conn->prepare("INSERT INTO Queries (name, department, query_type, image_video, website_link, description) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $department, $queryType, $imageVideo, $websiteLink, $description);

if ($stmt->execute()) {
    echo "Query submitted successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
