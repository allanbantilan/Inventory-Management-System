<?php
// Check if the form is submitted
require 'db_connect.php';
require 'session_check.php';
$alert = new PHPAlert();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Include database connection


    // Get form data
    $itemId = $_POST['id']; // ID of the item
    $assetTag = $_POST['assetTag'];
    $serialNumber = $_POST['serialNumber'];
    $itemCategory = $_POST['itemCategory'];
    $itemSubCategory = $_POST['itemSubCategory'];
    $itemMode = $_POST['itemMode'];
    $itemStatus = $_POST['itemStatus'];
    $site = $_POST['site'];
    $description = $_POST['description'];
    $dateIssued = $_POST['dateCreated'];
    $issuedTo = isset($_POST['issued_to']) ? $_POST['issued_to'] : '';
    $processedBy = $_SESSION['firstName'] . ' ' . $_SESSION['lastName'];
    $process = "In";
    $issuedToLabel = "Issued to: " . $issuedTo;

    // Insert issued item into issued_items table
    $insertQuery = $insertQuery = "INSERT INTO issued_items ( items_id, asset_tag_issue, item_serial_number, item_type, item_status, item_dateissued, item_site, item_description, item_issued_to, sub_category_issue, item_mode_issue) 
                                                      VALUES ('$itemId', '$assetTag', '$serialNumber', '$itemCategory', '$itemStatus', NOW(), '$site', '$description', '$issuedTo', '$itemSubCategory', '$itemMode')";

    // Insert the activity log into the issued_items_log table
    $insertQueryLog = "INSERT INTO history (asset_tag_his, serialNumberHis, typeHis, statusHis, dateDeletedHis , siteHis, descriptionHis, process, remarks, deletedBy, sub_category_his, item_mode_his) 
                        VALUES ('$assetTag', '$serialNumber', '$itemCategory', '$itemStatus', NOW(), '$site', '$description', ' $process', '$issuedToLabel',  '$processedBy',  '$itemSubCategory',  '$itemMode')";


    // Remove item from inventory table
    $deleteQuery = "DELETE FROM inventory WHERE inv_id = '$itemId'";

    if (mysqli_query($conn, $insertQuery) && mysqli_query($conn, $deleteQuery) && mysqli_query($conn, $insertQueryLog)) {
        // Success
        $alert->success("Successfully Issued");
                echo '<script>window.setTimeout(function(){window.location.href = "../issued_item.php";}, 1500);</script>';
                exit(); // Stop further execution
    } else {
        // Error
        echo "Error: " . mysqli_error($conn);
    }




    // Close connection
    mysqli_close($conn);
} else {
    // If the form is not submitted
    echo "Form submission failed!";
}
?>