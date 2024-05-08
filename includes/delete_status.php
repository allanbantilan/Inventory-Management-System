<?php
   require 'db_connect.php';

if(isset($_POST['statusID'])) {
    $statusID = $_POST['statusID'];

    // Prepare and execute SQL query to delete the status
    $delete_query = "DELETE FROM status WHERE statusID = '$statusID'";
    if(mysqli_query($conn, $delete_query)) {
        // Category deleted successfully
        session_start();
        $_SESSION['success_message'] = 'Status deleted successfully.';
        header("Location: ../addCategory.php"); // Redirect back to the previous page
        exit();
    } else {
        // Error occurred while deleting category
        session_start();
        $_SESSION['error_message'] = 'Error occurred while deleting Status: ' . mysqli_error($conn);
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
