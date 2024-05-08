<?php
// Start a session
session_start();

// Include database connection
require_once 'db_connect.php'; // Assuming this file contains your database connection code

// Retrieve user ID from session
$userID = $_SESSION['user_id'];

// Retrieve form input values
$firstName = $_POST['firstNameChange'];
$lastName = $_POST['lastNameChange'];
$email = $_POST['emailChange'];
$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];

// You may want to perform further validation/sanitization of the input values

// Check if the current password matches the password in the database
$query = $conn->prepare("SELECT * FROM users WHERE userId = ? AND password = ?");
$query->bind_param("is", $userID, $currentPassword);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    // Current password is correct, proceed with the update
    $updateQuery = $conn->prepare("UPDATE users SET firstName = ?, lastName = ?, email = ?, password = ? WHERE userId = ?");
    $updateQuery->bind_param("ssssi", $firstName, $lastName, $email, $newPassword, $userID);
    if ($updateQuery->execute()) {
        // Profile updated successfully
        echo "<script>alert('Profile updated successfully.'); window.location.href = '../auditDashboard.php';</script>";
        exit;
    } else {
        // Error updating profile
        echo "<script>alert('Error updating profile. Please try again later.'); window.location.href = '../auditDashboard.php';</script>";
        exit;
    }
} else {
    // Current password is incorrect
    echo "<script>alert('Current password does not match.'); window.location.href = '../auditDashboard.php';</script>";
    exit;
}

// Close database connection
$query->close();
$updateQuery->close();
$conn->close();
?>
