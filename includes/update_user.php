<?php
// Include your database connection file
require 'db_connect.php';
require 'phpalert.php';
$alert = new PHPAlert();

// Check if form is submitted and the required fields are not empty
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST['first_name']) && $_POST['first_name'] !== '' &&
    isset($_POST['last_name']) && $_POST['last_name'] !== '' &&
    isset($_POST['email']) && $_POST['email'] !== '' &&
    isset($_POST['password']) && $_POST['password'] !== '' &&
    isset($_POST['type']) && $_POST['type'] !== '' && // Updated field name
    isset($_POST['id']) && $_POST['id'] !== '') {

    // Sanitize input data to prevent SQL injection
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $itemStatus = $_POST['type']; // Updated field name
    $id = $_POST['id'];

    // Update the record in the database
    $stmt = $conn->prepare("UPDATE users SET firstName=?, lastName=?, email=?, password=?, type=? WHERE userId=?");
    $stmt->bind_param("sssssi", $first_name, $last_name, $email, $password, $itemStatus, $id);

    if ($stmt->execute()) {
        $alert->success("Successfully Edited");
        echo '<script>window.setTimeout(function(){window.location.href = "../user_status.php";}, 1500);</script>';
        exit(); // Stop further execution
    } else {
        // Handle the case where the update fails
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
} else {
    // Handle the case where the form data is incomplete
    echo "All fields are required.";
}

$conn->close();
?>