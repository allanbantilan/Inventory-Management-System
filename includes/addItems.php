<?php
require 'db_connect.php';
require 'session_check.php';

// require 'phpalert.php';
$alert = new PHPAlert();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $serialNumber = isset($_POST['serialNumber']) ? $_POST['serialNumber'] : '';
    $assetTag = isset($_POST['assetTag']) ? $_POST['assetTag'] : '';
    $itemCategory = isset($_POST['itemCategory']) ? $_POST['itemCategory'] : '';
    $itemStatus = isset($_POST['itemStatus']) ? $_POST['itemStatus'] : '';
    $site = isset($_POST['site']) ? $_POST['site'] : '';
    $itemSubCategory = isset($_POST['itemSubCategory']) ? $_POST['itemSubCategory'] : '';
    $itemDescription = isset($_POST['itemDescription']) ? $_POST['itemDescription'] : '';
    $itemMode = isset($_POST['itemMode']) ? $_POST['itemMode'] : '';
    date_default_timezone_set('Asia/Manila');
    $dateAdded = date('Y-m-d H:i:s'); // Get the current date and time
    $process = "Add"; // Get the current date and time
    $processedBy = $_SESSION['firstName'] . ' ' . $_SESSION['lastName'];

    // Check if serial number already exists
    if ($serialNumber !== 'N/A' && $serialNumber !== 'n/a' ) {
        // Check if serial number already exists
        $check_sql = "SELECT * FROM inventory WHERE serialNumber = '$serialNumber'";
        $check_result = $conn->query($check_sql);
        if ($check_result->num_rows > 0) {
            $alert->error("Serial number already exists. Please enter a unique serial number.");
            echo '<script>window.setTimeout(function(){window.location.href = "../inventory.php";}, 2000);</script>';
            exit(); // Stop further execution
        }
    }

    // Check if asset tag already exists
    if ($assetTag !== 'N/A' && $assetTag !== 'n/a' ) {
    $check_sql_asset = "SELECT * FROM inventory WHERE asset_tag = '$assetTag'";
    $check_result_asset = $conn->query($check_sql_asset);
    if ($check_result_asset->num_rows > 0) {
        // Display error message
        $alert->error("Asset Tag already exists. Please enter a unique asset tag.");
        echo '<script>window.setTimeout(function(){window.location.href = "../inventory.php";}, 2000);</script>';
        exit(); // Stop further execution
    }
}




    // Insert data into the database
    $sql = "INSERT INTO inventory (asset_tag, serialNumber, type, status, dateAdded, site, description, inv_mode, sub_category) 
        VALUES ('$assetTag', '$serialNumber', '$itemCategory', '$itemStatus', '$dateAdded', '$site', '$itemDescription', '$itemMode', '$itemSubCategory')";

    if ($conn->query($sql) === TRUE) {
        // Insert into history table
        $history_sql = "INSERT INTO history (asset_tag_his, serialNumberHis, typeHis, statusHis, dateDeletedHis, siteHis, descriptionHis, process, deletedBy, sub_category_his, item_mode_his) 
                    VALUES ('$assetTag', '$serialNumber', '$itemCategory', '$itemStatus', '$dateAdded', '$site', '$itemDescription', '$process', '$processedBy', '$itemSubCategory', '$itemMode')";

        if ($conn->query($history_sql) === TRUE) {
            // Display success message
            $alert->success("Successfully Added");
            echo '<script>window.setTimeout(function(){window.location.href = "../inventory.php";}, 500);</script>';
            exit(); // Stop further execution
        } else {
            echo "Error: " . $history_sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}



?>