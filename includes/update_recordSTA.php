<?php
// Assuming you have established a database connection already
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set and not empty
    if (isset($_POST['id']) && isset($_POST['itemNameSTA']) && isset($_POST['itemCategorySTA']) && isset($_POST['itemStatusSTA']) && isset($_POST['descriptionSTA'])) {
        // Sanitize the data to prevent SQL injection
        $idSTA = $_POST['id'];
        $itemNameSTA = $_POST['itemNameSTA'];
        $itemCategorySTA = $_POST['itemCategorySTA'];
        $itemStatusSTA = $_POST['itemStatusSTA'];
        $descriptionSTA = $_POST['descriptionSTA'];

        // Prepare the UPDATE statement
        $updateQuery = "UPDATE inventorysta SET serialNumberSTA = ?, typeSTA = ?, statusSTA = ?, descriptionSTA = ? WHERE inv_idSTA = ?";
        $stmt = $conn->prepare($updateQuery);

        // Bind the parameters
        $stmt->bind_param("ssssi", $itemNameSTA, $itemCategorySTA, $itemStatusSTA, $descriptionSTA, $idSTA);

        // Execute the statement
        if ($stmt->execute()) {
            // Close the statement
            $stmt->close();
            
            // Display alert message using JavaScript
            echo '<script>alert("Data updated successfully");</script>';
            
            // Delay redirection by 1 second
            echo '<script>setTimeout(function() { window.location.href = "../inventorySTA.php"; }, 100);</script>';
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
