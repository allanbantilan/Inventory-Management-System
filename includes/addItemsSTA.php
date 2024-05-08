<?php
require 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $serialNumberSTA = isset($_POST['serialNumberSTA']) ? $_POST['serialNumberSTA'] : '';
    $itemCategorySTA = isset($_POST['itemCategorySTA']) ? $_POST['itemCategorySTA'] : '';
    $itemStatusSTA = isset($_POST['itemStatusSTA']) ? $_POST['itemStatusSTA'] : '';
    $itemDescriptionSTA = isset($_POST['itemDescriptionSTA']) ? $_POST['itemDescriptionSTA'] : '';
    $dateAddedSTA = date('Y-m-d H:i:s'); // Get the current date and time

    // Check for empty fields
    if (empty($serialNumberSTA) || empty($itemCategorySTA) || empty($itemStatusSTA) || empty($itemDescriptionSTA)) {
        // Display error message and redirect
        echo "<script>alert('All inputs are required to be filled.'); window.location.href = '../inventorySTA.php';</script>";
        exit(); // Stop further execution
    }

    // Check if serial number already exists
    $check_sql = "SELECT * FROM inventorySTA WHERE serialNumberSTA = '$serialNumberSTA'";
    $check_result = $conn->query($check_sql);
    if ($check_result->num_rows > 0) {
        // Serial number already exists, display error message
        echo "<script>alert('Serial number already exists. Please enter a unique serial number.'); window.location.href = '../inventorySTA.php';</script>";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO inventorysta (serialNumberSTA, typeSTA, statusSTA, dateAddedSTA, descriptionSTA) VALUES ('$serialNumberSTA', '$itemCategorySTA', '$itemStatusSTA', '$dateAddedSTA', '$itemDescriptionSTA')";

        if ($conn->query($sql) === TRUE) {
            // JavaScript to display success message and redirect
            echo "<script>alert('Item added successfully'); window.location.href = '../inventorySTA.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
