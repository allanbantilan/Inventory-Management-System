<?php
// Start the session
require 'session_check.php';

require 'db_connect.php';
$alert = new PHPAlert();
// Check if user ID is set in the session
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Check if item ID is provided
    if (isset($_POST['id'])) {
        $inv_id = $_POST['id'];
        $assetTag = $_POST['assetTag'];
        $itemName = $_POST['itemName'];
        $itemCategory = $_POST['itemCategory'];
        $itemSubCategory = $_POST['itemSubCategory'];
        $itemMode = $_POST['itemMode'];
        $itemStatus = $_POST['itemStatus'];
        $itemDescription = $_POST['itemDescription'];
        $site = $_POST['site'];
        $remarks = $_POST['remarks'];
        date_default_timezone_set('Asia/Manila');
        $dateAdded = $_POST['dateAdded'];
        $process = "Delete";

        // Fetch user information from the database based on user ID
        $selectUserQuery = "SELECT * FROM users WHERE userId = ?";
        $stmt = $conn->prepare($selectUserQuery);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $userResult = $stmt->get_result();

        // Check if user exists
        if ($userResult->num_rows > 0) {
            $user = $userResult->fetch_assoc();
            $deleteBy = $user['firstName'] . ' ' . $user['lastName'];

            // Insert record into history table
            $insertQuery = "INSERT INTO history (asset_tag_his, serialNumberHis, typeHis, statusHis, descriptionHis, dateDeletedHis, siteHis, process, remarks, deletedBy, sub_category_his, item_mode_his)
                                 VALUES (?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            if ($stmt) {
                $stmt->bind_param("sssssssssss",  $assetTag, $itemName, $itemCategory, $itemStatus, $itemDescription, $site, $process, $remarks, $deleteBy, $itemSubCategory,  $itemMode );
                if ($stmt->execute()) {
                    // Delete record from inventory table
                    $deleteQuery = "DELETE FROM inventory WHERE inv_id = ?";
                    $stmt = $conn->prepare($deleteQuery);
                    $stmt->bind_param("i", $inv_id);
                    if ($stmt->execute()) {
                        // Show alert
                        $alert->success("Successfully Deleted");
                        echo '<script>window.setTimeout(function(){window.location.href = "../inventory.php";}, 1500);</script>';
                        exit(); // Stop further execution
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
