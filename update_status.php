<?php
session_start();
include 'config.php'; // Ensure this file has your database connection details

// Check if the admin is logged in, else return an error
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['query_id']) && isset($_POST['current_status'])) {
    $queryId = $_POST['query_id'];
    $currentStatus = strtolower($_POST['current_status']);
    $newStatus = $currentStatus === 'open' ? 'resolved' : 'open'; // Toggle the status

    // Prepare the SQL statement to update
    $stmt = $conn->prepare("UPDATE Queries SET status = ? WHERE query_id = ?");
    $stmt->bind_param("si", $newStatus, $queryId);
    $success = $stmt->execute();

    // Check if update was successful
    if ($success) {
        // The response will now echo the new status, which is the toggled status
        echo json_encode(['success' => true, 'newStatus' => $newStatus]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update status.']);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
