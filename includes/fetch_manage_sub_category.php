<?php
// Include your database connection file
require_once 'db_connect.php';

// Check if the 'id' parameter is set in the GET request
if(isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $sub_CategoryID = mysqli_real_escape_string($conn, $_GET['id']);

    // Query to fetch category data based on the ID
    $query = "SELECT * FROM sub_category WHERE sub_id = $sub_CategoryID";

    // Perform the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if($result) {
        // Check if any category record was found
        if(mysqli_num_rows($result) > 0) {
            // Fetch the category data as an associative array
            $sub_CategoryID = mysqli_fetch_assoc($result);

            echo '<form id="editSubCategoryForm" action="includes/update_sub_category.php" method="post">';
            echo '<input type="hidden" name="sub_id" value="' . $sub_CategoryID['sub_id'] . '">'; // Include the sub category ID in a hidden input field
            
            // Fetch categories from the database
            $categories_query = "SELECT * FROM categories";
            $categories_result = mysqli_query($conn, $categories_query);
            
            echo 'Sub Category Name: <input type="text" class="form-control" name="sub_name" value="' . $sub_CategoryID['sub_category_name'] . '"><br>';
            echo 'Sub Category For: <select class="form-control" name="sub_category_for">';
            while ($category_row = mysqli_fetch_assoc($categories_result)) {
                // Pre-select the current sub category's parent category
                $selected = ($category_row['categoryID'] == $sub_CategoryID['sub_category_for']) ? "selected" : "";
                echo '<option value="' . $category_row['category'] . '" ' . $selected . '>' . $category_row['category'] . '</option>';
            }
            echo '</select><br>';
            
            echo '<button type="submit" class="btn btn-primary">Save Changes</button>';
            echo '</form>';
            
        } else {
            echo 'No category found with the provided ID.';
        }
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }

    // Free the result set
    mysqli_free_result($result);

    // Close the database connection
    mysqli_close($conn);
} else {
    echo 'Error: ID parameter is missing.';
}
?>
