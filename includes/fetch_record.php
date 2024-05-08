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

    // Fetching sites from the database
    $sites_query = "SELECT * FROM site";
    $sites_result = mysqli_query($conn, $sites_query);

    // Fetching sub categories from the database
    $query_sub_category = "SELECT * FROM sub_category";
    $result_sub = mysqli_query($conn, $query_sub_category);

    // Fetching item modes from the database
    $query_mode = "SELECT * FROM modes_bp";
    $result_mode = mysqli_query($conn, $query_mode);

    // HTML code to populate the modal fields with the fetched record data
    echo '<form id="editForm" method="post" action="includes/update_record.php">
        <div class="form-group">
            <label for="serialNumber">Asset Tag</label>
            <input type="text" class="form-control" id="assetTag" name="assetTag" value="' . ($row['asset_tag'] ?? '') . '">
        </div>
        <div class="form-group">
            <label for="serialNumber">Serial Number</label>
            <input type="text" class="form-control" id="serialNumber" name="serialNumber" value="' . ($row['serialNumber'] ?? '') . '">
        </div>

        <div class="form-group">
            <label for="itemCategory">Item Category</label>
            <select class="form-control" id="itemCategory" name="itemCategory">
                <option value="" disabled>Select an option</option>';
    // Loop through fetched categories to populate the dropdown
    while ($category_row = mysqli_fetch_assoc($categories_result)) {
        echo '<option value="' . $category_row['category'] . '"';
        if ($row['type'] == $category_row['category']) {
            echo ' selected';
        }
        echo '>' . $category_row['category'] . '</option>';
    }
    echo '</select>
        </div>

        <div class="form-group">
            <label for="itemSubCategory">Item Sub Category</label>
            <select class="form-control" id="itemSubCategory" name="itemSubCategory">
                <option value="" disabled>Select an option</option>';
    // Loop through fetched sub-categories to populate the dropdown
    while ($sub_category_row = mysqli_fetch_assoc($result_sub)) {
        echo '<option value="' . $sub_category_row['sub_category_name'] . '"';
        if ($row['sub_category'] == $sub_category_row['sub_category_name']) {
            echo ' selected';
        }
        echo '>' . $sub_category_row['sub_category_name'] . '</option>';
    }
    echo '</select>
        </div>

        <div class="form-group">
            <label for="itemMode">Item Mode</label>
            <select class="form-control" id="itemMode" name="itemMode">
                <option value="" disabled>Select an option</option>';
    // Loop through fetched modes to populate the dropdown
    while ($itemMode_row = mysqli_fetch_assoc($result_mode)) {
        echo '<option value="' . $itemMode_row['modes_borrow_purchase'] . '"';
        if ($row['inv_mode'] == $itemMode_row['modes_borrow_purchase']) {
            echo ' selected';
        }
        echo '>' . $itemMode_row['modes_borrow_purchase'] . '</option>';
  // Debugging output to console
  echo '<script>console.log("inv_mode = ' . $row['inv_mode'] . ', modes_borrow_purchase = ' . $itemMode_row['modes_borrow_purchase'] . '");</script>';
    }

    echo '</select>
        </div>

        <div class="form-group">
            <label for="itemStatus">Item Status</label>
            <select class="form-control" id="itemStatus" name="itemStatus">
                <option value="" disabled>Select an option</option>';
    // Loop through fetched statuses to populate the dropdown
    while ($status_row = mysqli_fetch_assoc($statuses_result)) {
        echo '<option value="' . $status_row['status'] . '"';
        if ($row['status'] == $status_row['status']) {
            echo ' selected';
        }
        echo '>' . $status_row['status'] . '</option>';
    }
    echo '</select>
        </div>

        <div class="form-group">
            <label for="site">Site</label>
            <select class="form-control" id="site" name="site">
                <option value="" disabled>Select an option</option>';
    // Loop through fetched sites to populate the dropdown
    while ($site_row = mysqli_fetch_assoc($sites_result)) {
        echo '<option value="' . $site_row['site_name'] . '"';
        if ($row['site'] == $site_row['site_name']) {
            echo ' selected';
        }
        echo '>' . $site_row['site_name'] . '</option>';
    }
    echo '</select>
        </div>

        <div class="form-group">
            <label for="dateCreated">Date Added</label>
            <input type="date" class="form-control" id="dateCreated" name="dateCreated" value="' . ($row['dateAdded'] ?? '') . '">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5">' . ($row['description'] ?? '') . '</textarea>
        </div>

        <div class="form-group">
            <label for="remarks">Remarks</label>
            <input type="text" class="form-control" id="remarks" name="remarks">
        </div>

        <div class="alert alert-danger" id="errorAlert" style="display: none;">
            Please fill out all fields.
        </div>

        <input type="hidden" name="id" value="' . $row['inv_id'] . '">
        <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
    </form>';

    // JavaScript code for form validation
    echo '<script>
    document.getElementById("editForm").addEventListener("submit", function(event) {
        var serialNumber = document.getElementById("serialNumber").value;
        var itemCategory = document.getElementById("itemCategory").value;
        var itemStatus = document.getElementById("itemStatus").value;
        var site = document.getElementById("site").value;
        var description = document.getElementById("description").value;
        var remarks = document.getElementById("remarks").value;
        var dateCreated = document.getElementById("dateCreated").value;

        if (!serialNumber || !itemCategory || !itemStatus || !site || !description || !remarks || !dateCreated) {
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