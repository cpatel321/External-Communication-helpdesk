<?php
session_start();
include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT admin_id, password, admin_type FROM Admins WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['admin_id'] = $user['admin_id'];
    $_SESSION['admin_type'] = $user['admin_type'];
    header("Location: admin_panel.html");
    exit;
} else {
    echo "Invalid username or password";
}

$stmt->close();
$conn->close();
?>
