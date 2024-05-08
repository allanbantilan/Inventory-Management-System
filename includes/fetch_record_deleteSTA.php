<?php
// Include your database connection file
require 'db_connect.php';

// Fetch record from the database based on the provided ID
$id = $_GET['id'];


// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT * FROM inventorysta WHERE inv_idSTA = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    // Fetching item categories from the database
    $categories_query = "SELECT * FROM categories";
    $categories_result = mysqli_query($conn, $categories_query);

    // Fetching item statuses from the database
    $statuses_query = "SELECT * FROM status";
    $statuses_result = mysqli_query($conn, $statuses_query);

    

    // HTML code to populate the modal fields with the fetched record data
    echo '<form id="deleteForm" method="post" action="includes/deleteSTA.php">
        <div class="form-group">
            <input type="hidden" name="id" value="' . $id . '">
            <label for="itemName">Item Name</label>
            <input type="text" class="form-control" id="itemNameSTA" name="itemNameSTA" value="' . ($row['serialNumberSTA'] ?? '') . '" readonly>
        </div>
        <div class="form-group">
            <input type="hidden" name="itemCategorySTA" value="' . $row['typeSTA'] . '">
            <label for="itemCategory">Item Category</label>
            <input type="text" class="form-control" id="itemCategorySTA" value="' . $row['typeSTA'] . '" readonly>
        </div>
        <div class="form-group">
            <input type="hidden" name="itemStatusSTA" value="' . $row['statusSTA'] . '">
            <label for="itemStatus">Item Status</label>
            <input type="text" class="form-control" id="itemStatusSTA" value="' . $row['statusSTA'] . '" readonly>
        </div>
        <div class="form-group">
            <input type="hidden" name="itemDescriptionSTA" value="' . $row['descriptionSTA'] . '">
            <label for="itemDescription">Item Description</label>
            <textarea class="form-control" id="itemDescription" name="itemDescriptionSTA" rows="5" readonly>' . ($row['descriptionSTA'] ?? '') . '</textarea>
            <input type="hidden" name="dateAddedSTA" value="' . $row['dateAddedSTA'] . '">
        </div>
        <div class="form-group">
            <label for="remarks">Remarks</label>
            <input type="text" class="form-control" id="remarksSTA" name="remarksSTA">
        </div>
        <button type="submit" class="btn btn-danger" form="deleteForm">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
    </form>';


} else {
    // Handle the case where the record doesn't exist
    echo "Record not found.";
}

$stmt->close();
$conn->close();
?>
