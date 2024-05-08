<?php
// Include your database connection file
require_once 'db_connect.php';

// Query to fetch status options from the database
$sql = "SELECT DISTINCT status FROM status"; // Assuming 'status' is the name of your table containing status data

$result = $conn->query($sql);

if ($result) {
    $statusOptions = array();
    while ($row = $result->fetch_assoc()) {
        $statusOptions[] = $row['status'];
    }

    // Return status options as JSON
    header('Content-Type: application/json');
    echo json_encode($statusOptions);
} else {
    // Handle query error
    echo json_encode(array('error' => 'Failed to fetch status options'));
}

// Close database connection
$conn->close();
?>
