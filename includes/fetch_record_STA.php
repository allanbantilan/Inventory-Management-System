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
    echo '<form id="editForm" method="post" action="includes/update_recordSTA.php">
        <div class="form-group">
            <label for="itemName">Item Name</label>
            <input type="text" class="form-control" id="itemNameSTA" name="itemNameSTA" value="' . ($row['serialNumberSTA'] ?? '') . '">
        </div>

        
        <div class="form-group">
            <label for="itemCategorySTA">Item Category</label>
            <select class="form-control" id="itemCategorySTA" name="itemCategorySTA">
                <option value="" disabled>Select an option</option>';
              // Loop through fetched categories to populate the dropdown
             while ($category_row = mysqli_fetch_assoc($categories_result)) {
                echo '<option value="' . $category_row['category'] . '"';
                if ($row['typeSTA'] == $category_row['category']) {
                    echo ' selected';
                }
                echo '>' . $category_row['category'] . '</option>';
            }
        echo '</select>
        </div>


        <div class="form-group">
            <label for="itemStatus">Item Status</label>
            <select class="form-control" id="itemStatusSTA" name="itemStatusSTA">
                <option value="" disabled>Select an option</option>';
                // Loop through fetched statuses to populate the dropdown
                while ($status_row = mysqli_fetch_assoc($statuses_result)) {
                    echo '<option value="' . $status_row['status'] . '"';
                    if ($row['statusSTA'] == $status_row['status']) {
                        echo ' selected';
                    }
                    echo '>' . $status_row['status'] . '</option>';
                }
            echo '</select>
        </div>
        <div class="form-group">
                <label for="itemNameSTA">Item Name</label>
                <!-- Change input field to textarea -->
                <textarea class="form-control" id="itemNameSTA" name="descriptionSTA" rows="5">' . ($row['descriptionSTA'] ?? '') . '</textarea>
            </div>

        <!-- Add other form fields and their values here -->
        <input type="hidden" name="id" value="' . $row['inv_idSTA'] . '">
        <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
    </form>';
} else {
    // Handle the case where the record doesn't exist
    echo "Record not found.";
}

$stmt->close();
$conn->close();
?>
