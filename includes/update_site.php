<?php
// Check if the form is submitted
require 'phpalert.php';
$alert = new PHPAlert();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    require_once "db_connect.php";

    // Get category ID and name from the form
    $siteID = $_POST["site_id"];
    $siteName = $_POST["site_name"];

    // Update category in the database
    $sql = "UPDATE site SET site_name = ? WHERE site_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $siteName, $siteID);
    
    if (mysqli_stmt_execute($stmt)) {
        // Category updated successfully
        $alert->success("Successfully Edited");
        echo '<script>window.setTimeout(function(){window.location.href = "../addCategory.php";}, 1500);</script>';
        exit(); // Stop further execution
    } else {
        // Error updating category
        echo "Error updating category: " . mysqli_error($conn);
    }

    // Close statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Redirect back to the form page if accessed directly
    header("Location: ../addCategory.php");
    exit();
}
?>
