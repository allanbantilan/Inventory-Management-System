<?php
// Include your database connection file
require 'db_connect.php';

// Fetch record from the database based on the provided ID
$id = $_GET['id'];


// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT * FROM inventory WHERE inv_id = ?");
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
    echo '<form id="deleteForm" method="post" action="includes/delete.php">

         <div class="form-group">
         <input type="hidden" name="assetTag" value="' . $row['asset_tag'] . '">
          <label for="itemCategory">Item Category</label>
          <input type="text" class="form-control" id="assetTag" value="' . $row['asset_tag'] . '" readonly>
        </div>
        <div class="form-group">
            <input type="hidden" name="id" value="' . $id . '">
            <label for="itemName">Item Name</label>
            <input type="text" class="form-control" id="itemName" name="itemName" value="' . ($row['serialNumber'] ?? '') . '" readonly>
        </div>
      
        <div class="form-group">
            <input type="hidden" name="itemCategory" value="' . $row['type'] . '">
            <label for="itemCategory">Item Category</label>
            <input type="text" class="form-control" id="itemCategory" value="' . $row['type'] . '" readonly>
        </div>
        <div class="form-group">
            <input type="hidden" name="itemSubCategory" value="' . $row['sub_category'] . '">
            <label for="itemCategory">Item Sub Category</label>
            <input type="text" class="form-control" id="itemSubCategory" value="' . $row['sub_category'] . '" readonly>
        </div>
        <div class="form-group">
            <input type="hidden" name="itemMode" value="' . $row['inv_mode'] . '">
            <label for="itemCategory">Item Mode</label>
            <input type="text" class="form-control" id="itemMode" value="' . $row['inv_mode'] . '" readonly>
        </div>
        <div class="form-group">
            <input type="hidden" name="itemCategory" value="' . $row['type'] . '">
            <label for="itemCategory">Item Category</label>
            <input type="text" class="form-control" id="itemCategory" value="' . $row['type'] . '" readonly>
        </div>
        <div class="form-group">
            <input type="hidden" name="itemStatus" value="' . $row['status'] . '">
            <label for="itemStatus">Item Status</label>
            <input type="text" class="form-control" id="itemStatus" value="' . $row['status'] . '" readonly>
        </div>
        <div class="form-group">
            <input type="hidden" name="site" value="' . $row['site'] . '">
            <label for="itemStatus">Item Status</label>
            <input type="text" class="form-control" id="site" value="' . $row['site'] . '" readonly>
        </div>
        <div class="form-group">
            <input type="hidden" name="itemDescription" value="' . $row['description'] . '">
            <label for="itemDescription">Item Description</label>
            <textarea class="form-control" id="itemDescription" name="itemDescription" rows="5" readonly>' . ($row['description'] ?? '') . '</textarea>
            <input type="hidden" name="dateAdded" value="' . $row['dateAdded'] . '">
        </div>
        <div class="form-group">
            <label for="remarks">Remarks</label>
            <input type="text" class="form-control" id="remarks" name="remarks">
        </div>
        <div class="alert alert-danger" id="errorAlert" style="display: none;">
        Please fill out all fields.
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
<script>
    document.getElementById('deleteForm').addEventListener('submit', function (event) {
        var remarks = document.getElementById('remarks').value.trim();
        if (!remarks) {
            event.preventDefault(); // Prevent form submission
            document.getElementById('errorAlert').style.display = 'block';
        } else {
            document.getElementById('errorAlert').style.display = 'none';
        }
    });
</script>