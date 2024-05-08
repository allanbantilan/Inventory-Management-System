<?php
// Include your database connection file
require 'db_connect.php';
require 'session_check.php';
require 'phpalert.php';
$alert = new PHPAlert();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get form data
    $assetTag = $_POST['assetTag'];
    $serialNumber = $_POST['serialNumber'];
    $itemCategory = $_POST['itemCategory'];
    $itemsubCategory = $_POST['subCategory'];
    $itemitemMode = $_POST['itemMode'];
    $itemStatus = $_POST['itemStatus'];
    $site = $_POST['site'];
    $dateIssued = $_POST['dateIssued'];
    $description = $_POST['description'];
    $issuedTo = isset($_POST['issued_to']) ? $_POST['issued_to'] : '';
    $itemId = $_POST['id'];
    $processedBy = $_SESSION['firstName'] . ' ' . $_SESSION['lastName'];
    $process = "Out";
    $issuedToLabel = "Sent back to Inventory";

    // Insert the item back into the inventory table
    $insertQueryInventory = "INSERT INTO inventory ( asset_tag, serialNumber, type, status, site, dateAdded, description, inv_mode, sub_category)
                             VALUES ( '$assetTag', '$serialNumber', '$itemCategory', '$itemStatus', '$site', '$dateIssued', '$description' , '$itemitemMode' , '$itemsubCategory')";

    // Insert the activity log into the issued_items_log table
    $insertQueryLog = "INSERT INTO history (asset_tag_his, serialNumberHis, typeHis, statusHis, dateDeletedHis , siteHis, descriptionHis, process, remarks, deletedBy, item_mode_his, sub_category_his) 
                             VALUES ( '$assetTag','$serialNumber', '$itemCategory', '$itemStatus', NOW(), '$site', '$description', ' $process', '$issuedToLabel',  '$processedBy' ,  '$itemitemMode' ,  '$itemsubCategory')";
    $deleteQuery = "DELETE FROM issued_items WHERE items_id = '$itemId'";
    // Execute queries
    if (mysqli_query($conn, $insertQueryInventory) && mysqli_query($conn, $insertQueryLog) && mysqli_query($conn, $deleteQuery)) {
        // Success


        $alert->success("Successfully Sent back to Inventory");
        echo '<script>window.setTimeout(function(){window.location.href = "../inventory.php";}, 1500);</script>';
        exit(); // Stop further execution
    } else {
        // Error
        echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.history.back();</script>';
    }

} else {
    // If the form is not submitted
    echo "Form submission failed!";
}

// Close connection
mysqli_close($conn);
?>