<?php
// Include your database connection file
require 'db_connect.php';

// Fetch record from the database based on the provided ID
$id = $_GET['id'];

// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT * FROM users WHERE userId = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {


    // HTML code to populate the modal fields with the fetched record data
    echo '<form id="editForm" method="post" action="includes/update_user.php">
        <div class="form-group">
            <label for="serialNumber">First Name</label>
            <input type="text" class="form-control" id="assetTag" name="first_name" value="' . ($row['firstName'] ?? '') . '">
        </div>
        <div class="form-group">
            <label for="serialNumber">Last Namer</label>
            <input type="text" class="form-control" id="serialNumber" name="last_name" value="' . ($row['lastName'] ?? '') . '">
        </div>
        <div class="form-group">
            <label for="serialNumber">Email</label>
            <input type="text" class="form-control" id="serialNumber" name="email" value="' . ($row['email'] ?? '') . '">
        </div>
        <div class="form-group">
            <label for="serialNumber">Password</label>
            <input type="text" class="form-control" id="serialNumber" name="password" value="' . ($row['password'] ?? '') . '">
        </div>  

        <div class="form-group">
        <label for="itemStatus">Item Status</label>
        <select class="form-control" id="type" name="type">';

    // Define available types
    $types = ["admin", "user", "audit"]; // Assuming these are the possible types
// Loop through types to populate the dropdown
    foreach ($types as $type) {
        // Set current type as selected
        $selected = ($row['type'] == $type) ? 'selected' : '';
        echo '<option value="' . $type . '" ' . $selected . '>' . $type . '</option>';
    }

    echo '</select>
    </div>
    
    
     

   

        <div class="alert alert-danger" id="errorAlert" style="display: none;">
            Please fill out all fields.
        </div>

        <input type="hidden" name="id" value="' . $row['userId'] . '">
        <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
    </form>';

  
} else {
    // Handle the case where the record doesn't exist
    echo "Record not found.";
}

$stmt->close();
$conn->close();
?>