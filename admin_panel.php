<?php
session_start();
include 'config.php'; // Contains your database connection information

// Check if the admin is logged in, if not, redirect to the login page
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_type'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit();
}

// Retrieve sorting and searching parameters
$sortOrder = isset($_GET['sort']) && $_GET['sort'] === 'oldest' ? 'ASC' : 'DESC';
$searchTerm = isset($_GET['search']) ? '%'.$_GET['search'].'%' : '%';

// Prepare and execute the SQL statement with sorting and searching
$query = "SELECT query_id, create_date, name, department, query_type, image_video, website_link, description, status FROM Queries WHERE (name LIKE ? OR department LIKE ? OR query_type LIKE ?) ORDER BY create_date $sortOrder";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the results
    $queries = [];
    while ($row = $result->fetch_assoc()) {
        $queries[] = $row;
    }

    $stmt->close();
}
$conn->close();

// Return the data as JSON
echo json_encode($queries);
?>
