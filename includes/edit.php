<?php
// Include your database connection file
require 'db_connect.php';



  

 
// Fetch record from the database based on the provided ID
$id = $_GET['id'];

// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT serialNumber, itemCategory, itemStatus FROM inventory WHERE Id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Return data as JSON
echo json_encode(array(
    'serialNumber' => $serialNumber,
    'type' => $type,
    'status' => $status
));
?>

?>
