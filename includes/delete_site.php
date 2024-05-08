<?php
    require 'db_connect.php';

    if(isset($_POST['siteID'])) {
        $siteID = $_POST['siteID'];

        // Prepare and execute SQL query to delete the site
        $delete_query = "DELETE FROM site WHERE site_id = '$siteID'";
        if(mysqli_query($conn, $delete_query)) {
            // Site deleted successfully
            session_start();
            $_SESSION['success_message'] = 'Site deleted successfully.';
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
        $_SESSION['error_message'] = 'Site ID not provided.';
        header("Location: ../addCategory.php"); // Redirect back to the previous page
        exit();
    }

    mysqli_close($conn);
?>
