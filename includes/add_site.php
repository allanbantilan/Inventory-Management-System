<?php
require 'db_connect.php';
require 'phpalert.php';
$alert = new PHPAlert();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $siteName = ($_POST["siteName"]);

    // Prepare and bind the INSERT statement
    $stmt = $conn->prepare("INSERT INTO site (site_name) VALUES (?)");
    $stmt->bind_param("s", $siteName);

    // Execute the statement
    if ($stmt->execute()) {
        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Display success message using JavaScript alert

        $alert->success("Successfully added");
        echo '<script>window.setTimeout(function(){window.location.href = "../addcategory.php";}, 1500);</script>';
    } else {
        // Handle error if the execution fails
        echo '<script>alert("An error occurred while adding site.");</script>';
        exit();
    }
}
?>