<?php
require 'db_connect.php';

if(isset($_POST['categoryID'])) {
    $categoryID = $_POST['categoryID'];

    // Delete the category from the database
    $delete_query = "DELETE FROM categories WHERE categoryID = '$categoryID'";
    if(mysqli_query($conn, $delete_query)) {
        // Category deleted successfully
        session_start();
        $_SESSION['success_message'] = 'Category deleted successfully.';
        header("Location: ../addCategory.php"); // Redirect back to the previous page
        exit();
    } else {
        // Error occurred while deleting category
        session_start();
        $_SESSION['error_message'] = 'Error occurred while deleting category: ' . mysqli_error($conn);
        header("Location: ../addCategory.php"); // Redirect back to the previous page
        exit();
    }
} else {
    // No category ID provided
    session_start();
    $_SESSION['error_message'] = 'Category ID not provided.';
    header("Location: ../addCategory.php"); // Redirect back to the previous page
    exit();
}

mysqli_close($conn);
?>
