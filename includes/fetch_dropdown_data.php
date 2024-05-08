<?php
require  'db_connect';

// Fetch data for item categories
$category_sql = "SELECT categories FROM category";
$category_result = $conn->query($category_sql);
$categories = [];

if ($category_result->num_rows > 0) {
    while($row = $category_result->fetch_assoc()) {
        $categories[] = $row["category_name"];
    }
}

// Fetch data for item statuses
$status_sql = "SELECT status FROM status";
$status_result = $conn->query($status_sql);
$statuses = [];

if ($status_result->num_rows > 0) {
    while($row = $status_result->fetch_assoc()) {
        $statuses[] = $row["status_name"];
    }
}

// Close database connection
$conn->close();

// Return data as JSON
$data = [
    'categories' => $categories,
    'statuses' => $statuses
];

header('Content-Type: application/json');
echo json_encode($data);
?>
