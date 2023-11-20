<?php
include 'config.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt the password
$adminType = $_POST['adminType'];

$stmt = $conn->prepare("INSERT INTO Admins (username, password, admin_type) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $adminType);

if ($stmt->execute()) {
    echo "Admin registered successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
