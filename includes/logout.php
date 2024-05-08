<?php
// Start the session
session_start();
    
// Include the database connection file
require 'db_connect.php';

// Add the session timeout check here
$timeout = 600; // 10 minutes (in seconds)
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    // Session expired due to inactivity, force logout

    // Capture user activity before destroying the session
    if (isset($_SESSION['user_id'])) {
        // Retrieve user details from the session
        $userLastName = $_SESSION['lastName'];
        $userFirstName = $_SESSION['firstName'];
        $userEmail = $_SESSION['email'];
        $userRole = $_SESSION['type'];
        date_default_timezone_set('Asia/Manila');
        $userDateLogged = date('Y-m-d H:i:s'); // Current date and time
        $userinout = "Out"; // Indicate that the user is logging out

        // Insert user activity into the database
        $insertSql = "INSERT INTO user_activity (user_last_name, user_first_name, user_email, user_in_out, user_date_logged, user_role)
                             VALUES ('$userLastName', '$userFirstName', '$userEmail', '$userinout', '$userDateLogged', '$userRole')";
        if ($conn->query($insertSql) === TRUE) {
            // Insertion successful
        } else {
            // Error in insertion
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }

        // Update online status to 0 for the logged-out user
        $onlineStatus = 0; // Set online status to 0 for offline
        $updateSql = "UPDATE users SET online_status = '$onlineStatus' WHERE email = '$userEmail'";
        if ($conn->query($updateSql) === TRUE) {
            // Online status updated successfully
        } else {
            // Handle error
            echo "Error updating online status: " . $conn->error;
        }
    }

    // Unset all of the session variables
    $_SESSION = array();
    // Destroy the session
    session_destroy();

    // Notify the user about the logout due to inactivity
    echo '<script>alert("You have been logged out due to inactivity.");</script>';
    // Redirect the user to the login page with a message indicating the reason for the logout
    header("Location: ../index.php?timeout=true");
    exit;
} else {
    // Session still active, proceed with regular logout

    // Capture user activity before destroying the session
    if (isset($_SESSION['user_id'])) {
        // Retrieve user details from the session
        $userLastName = $_SESSION['lastName'];
        $userFirstName = $_SESSION['firstName'];
        $userEmail = $_SESSION['email'];
        $userRole = $_SESSION['type'];
        date_default_timezone_set('Asia/Manila');
        $userDateLogged = date('Y-m-d H:i:s'); // Current date and time
        $userinout = "Out"; // Indicate that the user is logging out

        // Insert user activity into the database
        $insertSql = "INSERT INTO user_activity (user_last_name, user_first_name, user_email, user_in_out, user_date_logged, user_role)
                             VALUES ('$userLastName', '$userFirstName', '$userEmail', '$userinout', '$userDateLogged', '$userRole')";
        if ($conn->query($insertSql) === TRUE) {
            // Insertion successful
        } else {
            // Error in insertion
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }

        // Update online status to 0 for the logged-out user
        $onlineStatus = 0; // Set online status to 0 for offline
        $updateSql = "UPDATE users SET online_status = '$onlineStatus' WHERE email = '$userEmail'";
        if ($conn->query($updateSql) === TRUE) {
            // Online status updated successfully
        } else {
            // Handle error
            echo "Error updating online status: " . $conn->error;
        }
    }

    // Unset all of the session variables
    $_SESSION = array();
    // Destroy the session
    session_destroy();

    // Redirect the user to the login page or any other desired page
    header("Location: ../index.php");
    exit;
}
?>
