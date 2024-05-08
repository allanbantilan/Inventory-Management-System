<?php
// Include your database connection file
require 'db_connect.php';

// Fetch record from the database based on the provided ID
$id = $_GET['items_id'];

// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT * FROM issued_items WHERE items_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {

    // HTML code to populate the modal fields with the fetched record data
    echo '<form id="editForm" method="post" action="includes/send_back_update.php">
        <div class="form-group">
            <label for="serialNumber">Asset Tag</label>
            <input type="text" class="form-control" id="assetTag" name="assetTag" value="' . ($row['asset_tag_issue'] ?? '') . '" readonly >
        </div>
        <div class="form-group" style="display:none;">
        <label for="serialNumber">Asset Tag</label>
        <input type="hidden" class="form-control" id="items_id" name="items_id" value="' . ($row['items_id'] ?? '') . '">
    </div>
    
        <div class="form-group">
            <label for="serialNumber">Serial Number</label>
            <input type="text" class="form-control" id="serialNumber" name="serialNumber" value="' . ($row['item_serial_number'] ?? '') . '" readonly >
        </div>

        <div class="form-group">
            <label for="itemCategory">Item Category</label>
            <input type="text" class="form-control" id="itemCategory" name="itemCategory" value="' . ($row['item_type'] ?? '') . '" readonly >
        </div>

        <div class="form-group">
            <label for="itemCategory">Item Sub Category</label>
            <input type="text" class="form-control" id="subCategory" name="subCategory" value="' . ($row['sub_category_issue'] ?? '') . '" readonly >
        </div>
        <div class="form-group">
            <label for="itemCategory">Item Sub Category</label>
            <input type="text" class="form-control" id="itemMode" name="itemMode" value="' . ($row['item_mode_issue'] ?? '') . '"  >
        </div>

        <div class="form-group">
            <label for="itemStatus">Item Status</label>
            <input type="text" class="form-control" id="itemStatus" name="itemStatus" value="' . ($row['item_status'] ?? '') . '" readonly >
        </div>

        <div class="form-group">
            <label for="site">Site</label>
            <input type="text" class="form-control" id="site" name="site" value="' . ($row['item_site'] ?? '') . '" readonly >
        </div>

        <div class="form-group">
            <label for="dateIssued">Date Issued</label>
            <input type="date" class="form-control" id="dateIssued" name="dateIssued" value="' . ($row['item_dateissued'] ?? '') . '" readonly >
        </div>
        <div class="form-group">
            <label for="dateIssued">Issued To</label>
            <input type="text" class="form-control" id="issuedTo" name="issuedTo" value="' . ($row['item_issued_to'] ?? '') . '" >
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5" readonly>' . ($row['item_description'] ?? '') . '</textarea>
        </div>

        <div class="form-group">
        <label for="dateIssued">Remarks</label>
        <input type="text" class="form-control" id="issuedTo" name="remarks">
    </div>

      

        <div class="alert alert-danger" id="errorAlert" style="display: none;">
            Please fill out all fields.
        </div>

        <!-- Add other form fields and their values here -->
        <input type="hidden" name="id" id="id" value="' . $row['items_id'] . '">
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>';

    echo '<script>
    document.getElementById("editForm").addEventListener("submit", function(event) {
        var serialNumber = document.getElementById("serialNumber").value;
        var itemCategory = document.getElementById("itemCategory").value;
        var itemStatus = document.getElementById("itemStatus").value;
        var site = document.getElementById("site").value;
        var dateIssued = document.getElementById("dateIssued").value;
        var description = document.getElementById("description").value;
        var issuedTo = document.getElementById("issuedTo").value;

        if (!serialNumber || !itemCategory || !itemStatus || !site || !dateIssued || !description || !issuedTo) {
            event.preventDefault(); // Prevent form submission
            document.getElementById("errorAlert").style.display = "block";
        }
    });
</script>';

} else {
    // Handle the case where the record doesn't exist
    echo "Record not found.";
}

$stmt->close();
$conn->close();
?>
