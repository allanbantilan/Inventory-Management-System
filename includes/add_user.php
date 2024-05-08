<?php
// Include the database connection file
require 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    // Insert user data into the database
    $sql = "INSERT INTO users (firstName, lastName, email, password, type) VALUES ('$firstName', '$lastName', '$email', '$password', '$type')";

    if ($conn->query($sql) === TRUE) {
        // Success message
        echo '<script>alert("User added successfully"); window.location.href = "../addUser.php";</script>';
    } else {
        // Error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
