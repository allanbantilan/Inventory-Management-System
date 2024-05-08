<?php
// Start a session
session_start();

// Check if user ID is set in the session
if (!isset($_SESSION['user_id'])) {
    // User ID is not set, return an error message
    http_response_code(400); // Bad Request
    echo json_encode(array("error" => "User ID is not set in the session"));
    exit;
}

// Include database connection
require_once 'db_connect.php'; // Assuming this file contains your database connection code

// Retrieve the user ID from the session
$userID = $_SESSION['user_id'];

// Prepare and execute query to fetch user data
$query = $conn->prepare("SELECT * FROM users WHERE userId = ?");
$query->bind_param("i", $userID);
$query->execute();

// Check for errors
if ($query->error) {
    echo "Query Error: " . $query->error;
    exit;
}

$result = $query->get_result();

// Check if user data exists
if ($result->num_rows > 0) {
    // User data found, fetch and return it as JSON
    $userData = $result->fetch_assoc();
    echo json_encode($userData);
} else {
    // User data not found, handle this according to your application logic
    http_response_code(404); // Not Found
    exit;
}

// Close database connection
$query->close();
$conn->close();
?>
