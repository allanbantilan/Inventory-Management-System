<?php
require 'session_check.php';
// Assuming you have established a database connection already
require 'db_connect.php';
// require 'phpalert.php';
$alert = new PHPAlert();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set and not empty
    if (isset($_POST['id']) && isset($_POST['serialNumber']) && isset($_POST['itemCategory'])
     && isset($_POST['itemStatus']) && isset($_POST['site']) && isset($_POST['description']) 
    && isset($_POST['dateCreated']) && isset($_POST['remarks']) && isset($_POST['itemSubCategory']) && isset($_POST['itemMode'])) {
        // Sanitize the data to prevent SQL injection
        $id = $_POST['id'];
        $assetTag = $_POST['assetTag'];
        $serialNumber = $_POST['serialNumber'];
        $itemCategory = $_POST['itemCategory'];
        $itemSubCategory = $_POST['itemSubCategory'];
        $itemMode = $_POST['itemMode'];
        $itemStatus = $_POST['itemStatus'];
        $site = $_POST['site'];
        $description = $_POST['description'];
        date_default_timezone_set('Asia/Manila');
        $dateCreated = $_POST['dateCreated']; // Get date created from the form
        $remarks = $_POST['remarks']; // Get remarks from the form
        
        // Retrieve user information from session variables
        $editedBy = $_SESSION['firstName'] . ' ' . $_SESSION['lastName'];
        $process = "Edit";

        // Prepare the UPDATE statement
        $updateQuery = "UPDATE inventory SET asset_tag = ?, serialNumber = ?, type = ?, status = ?, site = ?, description = ?, dateAdded = ?, inv_mode = ?, sub_category = ? WHERE inv_id = ?";
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare() call was successful
        if (!$stmt) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            exit;
        }

        // Bind the parameters
        $stmt->bind_param("sssssssssi", $assetTag, $serialNumber, $itemCategory, $itemStatus, $site, $description, $dateCreated, $itemMode, $itemSubCategory, $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Insert into history table
            $insertHistoryQuery = "INSERT INTO history (asset_tag_his, serialNumberHis, typeHis, statusHis, siteHis, descriptionHis, dateDeletedHis, process, remarks, deletedBy, item_mode_his, sub_category_his ) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtHistory = $conn->prepare($insertHistoryQuery);
            
            // Check if the prepare() call was successful
            if (!$stmtHistory) {
                echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                exit;
            }
            
            // Get the current date and time in the format YYYY-MM-DD HH:MM:SS
            $currentDateTime = date('Y-m-d H:i:s');
            
            // Bind parameters for history insert
            $stmtHistory->bind_param("ssssssssssss", $assetTag, $serialNumber, $itemCategory, $itemStatus, $site, $description, $currentDateTime, $process, $remarks, $editedBy, $itemMode, $itemSubCategory);
            $stmtHistory->execute();
            $stmtHistory->close();
            
            

            // Close the statement
            $stmt->close();
            
            // Display alert message using JavaScript
            $alert->success("Successfully Edited");
            echo '<script>window.setTimeout(function(){window.location.href = "../inventory.php";}, 1500);</script>';
            exit(); // Stop further execution
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
