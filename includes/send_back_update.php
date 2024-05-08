<?php
// Include your database connection file
require 'db_connect.php';
require 'session_check.php';
$alert = new PHPAlert();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get form data

    $assetTag = $_POST['assetTag'];
    $items_id = $_POST['items_id'];
    $serialNumber = $_POST['serialNumber'];
    $itemCategory = $_POST['itemCategory'];
    $itemsubCategory = $_POST['subCategory'];
    $itemitemMode = $_POST['itemMode'];
    $itemStatus = $_POST['itemStatus'];
    $site = $_POST['site'];
    $dateIssued = $_POST['dateIssued'];
    $description = $_POST['description'];
    $issuedTo = $_POST['issuedTo'];
    $processedBy = $_SESSION['firstName'] . ' ' . $_SESSION['lastName'];
    $remarks = $_POST['remarks'];
    $process = "Edit";

    // Insert the item back into the inventory table
    $insertQueryInventory = "UPDATE issued_items 
    SET 
        item_mode_issue = '$itemitemMode', 
        item_issued_to = '$issuedTo'
    WHERE 
         items_id = '$items_id'";

    // Insert the activity log into the issued_items_log table
    $insertQueryLog = "INSERT INTO history (asset_tag_his, serialNumberHis, typeHis, statusHis, dateDeletedHis , siteHis, descriptionHis, remarks, deletedBy, item_mode_his, sub_category_his, process) 
                             VALUES ( '$assetTag','$serialNumber', '$itemCategory', '$itemStatus', NOW(),      '$site',    '$description',  ' $remarks', '$processedBy ' ,  '$itemitemMode' ,  '$itemsubCategory', ' $process')";
    // Execute queries
    if (mysqli_query($conn, $insertQueryInventory) && mysqli_query($conn, $insertQueryLog)) {
        // Success


        $alert->success("Successfully Updated");
        echo '<script>window.setTimeout(function(){window.location.href = "../issued_item.php";}, 1500);</script>';
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