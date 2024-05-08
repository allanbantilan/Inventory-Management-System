<?php
session_start(); // Start session if not already started
require 'db_connect.php';

if (isset($_SESSION['userId'])) {
    // Get the user's ID from the session
    $userId = $_SESSION['userId'];
    
    // Update online_status to indicate that the user is online
    $onlineStatus = 1; // 1 for online, 0 for offline
    
    $sql = "UPDATE users SET online_status = '$onlineStatus' WHERE userId = '$userId'";
    if ($conn->query($sql) === TRUE) {
        // Online status updated successfully
        echo "Online status updated successfully.";
    } else {
        // Handle error
        echo "Error updating online status: " . $conn->error;
    }
} else {
    // User is not logged in
    echo "User is not logged in.";
}

// Close the database connection
$conn->close();
?>
