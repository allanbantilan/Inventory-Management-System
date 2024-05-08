<?php
// Check if the form is submitted
require 'phpalert.php';
$alert = new PHPAlert();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    require_once "db_connect.php";

    // Get sub category ID, name, and parent category from the form
    $subID = $_POST["sub_id"];
    $subName = $_POST["sub_name"];
    $subCategoryFor = $_POST["sub_category_for"]; // Assuming this is the name of the select element in your form

    // Update sub category in the database
    $sql = "UPDATE sub_category SET sub_category_name = ?, sub_category_for = ? WHERE sub_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $subName, $subCategoryFor, $subID);
    
    if (mysqli_stmt_execute($stmt)) {
        // Sub category updated successfully
        $alert->success("Successfully Edited");
        echo '<script>window.setTimeout(function(){window.location.href = "../addCategory.php";}, 1500);</script>';
        exit(); // Stop further execution
    } else {
        // Error updating sub category
        $alert->error('Error updating sub category: ' . mysqli_error($conn));
    }

    // Close statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Redirect back to the form page if accessed directly
    header("Location: ../edit_sub_category.php");
    exit();
}
?>
