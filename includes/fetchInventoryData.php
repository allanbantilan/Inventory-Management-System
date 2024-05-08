<?php
// Include your database connection file
require_once 'db_connect.php';

// Retrieve POST data
$postData = json_decode(file_get_contents('php://input'), true);
$startDate = $postData['startDate'];
$endDate = $postData['endDate'];
$status = $postData['status'];

// Query the database to fetch inventory data based on the provided parameters
$sql = "SELECT * FROM inventory WHERE dateAdded BETWEEN ? AND ? AND status = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $startDate, $endDate, $status);
$stmt->execute();
$result = $stmt->get_result();

// Fetch data from result set
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);

// Close database connection
$stmt->close();
$conn->close();
?>
