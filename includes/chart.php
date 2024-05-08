<?php
// Include your database connection file
require_once 'db_connect.php';

// Query to fetch data from the database
$sql = "SELECT status, COUNT(*) as count FROM inventory GROUP BY status";
$result = $conn->query($sql);

// Initialize arrays to store labels and values
$labels = [];
$values = [];

// Fetch data and populate arrays
while ($row = $result->fetch_assoc()) {
    $labels[] = $row['status'];
    $values[] = $row['count'];
}

// Close database connection
$conn->close();

// Combine labels and values into an associative array
$data = [
    'labels' => $labels,
    'values' => $values
];

// Encode data as JSON and output
echo json_encode($data);
?>
