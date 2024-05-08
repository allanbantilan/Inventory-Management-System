<?php
require 'db_connect.php';
require 'phpalert.php';

$alert = new PHPAlert();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $sub_category_name = ($_POST["subCategoryName"]);
    $sub_category_for = ($_POST["subCategoryFor"]);

    // Prepare and bind the INSERT statement
    $stmt = $conn->prepare("INSERT INTO sub_category (sub_category_name, sub_category_for)
                             VALUES (?, ? )");
    $stmt->bind_param("ss", $sub_category_name, $sub_category_for );

    // Execute the statement
    if ($stmt->execute()) {
        // Close the statement and connection
        $stmt->close();
        $conn->close();
        
        // Display success message using JavaScript alert
        $alert->success("Successfully added");
        echo '<script>window.setTimeout(function(){window.location.href = "../addcategory.php";}, 1500);</script>';
        exit();
    } else {
        // Handle error if the execution fails
        echo '<script>alert("An error occurred while adding Sub Category.");</script>';
        exit();
    }
}
?>
