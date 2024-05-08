<?php
// Start a session
session_start();

// Include the database connection file
require 'db_connect.php';
// Include session handler




// Check if the user is already logged in
if (isset ($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Redirect the user to the appropriate dashboard based on user type
    if ($_SESSION['type'] === 'audit') {
        header("Location: ../audit_inventory.php");
    } elseif ($_SESSION['type'] === 'admin' || $_SESSION['type'] === 'user') {
        header("Location: ../dashboard1.php");
    }
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform authentication - query the database to check if the email and password match a user record
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, fetch user data
        $user = $result->fetch_assoc();

        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user['userId'];
        $_SESSION['email'] = $email;
        $_SESSION['firstName'] = $user['firstName'];
        $_SESSION['lastName'] = $user['lastName'];
        $_SESSION['type'] = $user['type']; // Assuming 'type' is the column in the users table

        // Insert user activity into the database
        $userLastName = $user['lastName'];
        $userFirstName = $user['firstName'];
        $userEmail = $email;
        $userinout = "In"; // Indicate that the user is logging in
        date_default_timezone_set('Asia/Manila');
        $userDateLogged = date("Y-m-d H:i:s"); // Current date and time in Philippines timezone        
        $userRole = $user['type'];

        $insertSql = "INSERT INTO user_activity (user_last_name, user_first_name, user_email, user_in_out, user_date_logged, user_role)
   VALUES ('$userLastName', '$userFirstName', '$userEmail', '$userinout', '$userDateLogged', '$userRole')";
        if ($conn->query($insertSql) === TRUE) {
            // Insertion successful
        } else {
            // Error in insertion
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }

        // Update online status to indicate that the user is online
        $onlineStatus = 1; // 1 for online, 0 for offline
        $updateSql = "UPDATE users SET online_status = '$onlineStatus' WHERE email = '$email'";
        if ($conn->query($updateSql) === TRUE) {
            // Online status updated successfully
        } else {
            // Handle error
            echo "Error updating online status: " . $conn->error;
        }

        // Redirect the user to the appropriate dashboard based on user type
        if ($user['type'] === 'audit') {
            header("Location: ../audit_inventory.php");
        } elseif ($user['type'] === 'admin' || $user['type'] === 'user') {
            header("Location: ../dashboard1.php");
        }
        exit;
    } else {
        // User not found or credentials incorrect, show error message
        echo "<script>alert('Email or password is incorrect. Please try again.'); window.location='../index.php';</script>";
    }



}
?>