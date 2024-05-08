<?php
    require 'db_connect.php';

    if(isset($_POST['sub_id'])) {
        $subcategory = $_POST['sub_id'];

        // Prepare and execute SQL query to delete the site
        $delete_query = "DELETE FROM sub_category WHERE sub_id = '$subcategory'";
        if(mysqli_query($conn, $delete_query)) {
            // Site deleted successfully
            session_start();
            $_SESSION['success_message'] = 'Sub Category deleted successfully.';
            header("Location: ../addCategory.php"); // Redirect back to the previous page
            exit();
        } else {
            // Error occurred while deleting site
            session_start();
            $_SESSION['error_message'] = 'Error occurred while deleting Site: ' . mysqli_error($conn);
            header("Location: ../addCategory.php"); // Redirect back to the previous page
            exit();
        }
    } else {
        // No site ID provided
        session_start();
        $_SESSION['error_message'] = 'Sub Category ID not provided.';
        header("Location: ../addCategory.php"); // Redirect back to the previous page
        exit();
    }

    mysqli_close($conn);
?>
