<?php
// Include the database connection file
require 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Note: You should hash the password before storing it in the database for security

    // SQL query to insert data into the database
    $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful
        echo '<script>alert("Registration successful. You can now log in."); window.location.href = "../index.php";</script>';
        exit; // Stop further execution
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
