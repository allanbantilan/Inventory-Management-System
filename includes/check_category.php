<?php
require 'db_connect.php';

// Check if category name is provided via POST request
if(isset($_POST['categoryName'])) {
    $categoryName = $_POST['categoryName'];

    // Prepare and execute SQL query to check if category name exists
    $check_query = "SELECT COUNT(*) as count FROM categories WHERE category = ?";
    $stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($stmt, 's', $categoryName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);

    // Return response based on the result
    if ($count > 0) {
        echo 'exists';
    } else {
        echo 'not_exists';
    }

    mysqli_stmt_close($stmt);
} else {
    // If category name is not provided in the POST request
    echo 'error';
}

mysqli_close($conn);
?>
