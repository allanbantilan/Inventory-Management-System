<?php
// Start the session
session_start();

// Assuming you have established a database connection already
require 'db_connect.php';

// Check if user ID is set in the session
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Check if item ID is provided
    if (isset($_POST['id'])) {
        $inv_idSTA = $_POST['id'];
        $itemNameSTA = $_POST['itemNameSTA'];
        $itemCategorySTA = $_POST['itemCategorySTA'];
        $itemStatusSTA = $_POST['itemStatusSTA'];
        $itemDescriptionSTA = $_POST['itemDescriptionSTA'];
        $remarksSTA = $_POST['remarksSTA'];
        $dateAddedSTA = $_POST['dateAddedSTA'];

        // Fetch user information from the database based on user ID
        $selectUserQuery = "SELECT * FROM users WHERE userId = ?";
        $stmt = $conn->prepare($selectUserQuery);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $userResult = $stmt->get_result();

        // Check if user exists
        if ($userResult->num_rows > 0) {
            $user = $userResult->fetch_assoc();
            $deleteBySTA = $user['firstName'] . ' ' . $user['lastName'];

            // Insert record into history table
            $insertQuery = "INSERT INTO historysta (serialNumberHisSTA, typeHisSTA, statusHisSTA, descriptionHisSTA, dateAddedHisSTA, dateDeletedHisSTA, remarksSTA, deletedBySTA) VALUES (?, ?, ?, ?, ?, NOW(), ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            if ($stmt) {
                $stmt->bind_param("sssssss", $itemNameSTA, $itemCategorySTA, $itemStatusSTA, $itemDescriptionSTA, $dateAddedSTA, $remarksSTA, $deleteBySTA);
                if ($stmt->execute()) {
                    // Delete record from inventory table
                    $deleteQuery = "DELETE FROM inventorysta WHERE inv_idSTA = ?";
                    $stmt = $conn->prepare($deleteQuery);
                    $stmt->bind_param("i", $inv_id);
                    if ($stmt->execute()) {
                        // Show alert
                        echo '<script>alert("Item deleted and stored in history.");</script>';
                        
                        // Redirect back to the inventory page with a success message
                        echo '<script>window.location.href = "../historySTA.php?success=1";</script>';
                        exit;
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                } else {
                    echo "Error executing insert statement: " . $stmt->error;
                }
            } else {
                echo "Error preparing insert statement: " . $conn->error;
            }
        } else {
            echo "User not found";
        }
    } else {
        echo "No ID provided";
    }
} else {
    echo "User ID not set in session";
}
?>
