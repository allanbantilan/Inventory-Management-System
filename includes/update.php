<?php
// Include your database connection file
require 'db_connect.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the AJAX request
    $serialNumber = $_POST['serialNumber'];
    $itemCategory = $_POST['itemCategory'];
    $itemStatus = $_POST['itemStatus'];

    // Prepare and execute the SQL query to update the record
    $sql = "UPDATE your_table SET itemCategory = ?, itemStatus = ? WHERE serialNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$itemCategory, $itemStatus, $serialNumber]);

   // Execute the SQL query
$stmt->execute();

// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if a row was returned
if ($result) {
    // Row exists, so the query was successful
    echo json_encode(["success" => "Record updated successfully"]);
} else {
    // No rows returned, possibly no changes made
    echo json_encode(["error" => "No changes made"]);
}

}

// Close the database connection
$conn = null;
?>
