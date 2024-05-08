<?php
// Include your database connection
require 'db_connect.php';

// Check if the category is set in the POST request
if (isset($_POST['category'])) {
    $selectedCategory = $_POST['category'];

    // Prepare and execute a query to fetch sub-categories based on the selected category
    $query = "SELECT sub_category_name FROM sub_category WHERE sub_category_for = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "s", $selectedCategory);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    // Fetch the results and construct the options for the sub-category dropdown
    $options = '<option value="" selected disabled>Select N/A if not applicable</option>';


    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row['sub_category_name'] . '">' . $row['sub_category_name'] . '</option>';
        $hasSubCategories = true;
    }

    // If no sub-categories found, add the "N/A" option
    if (!$hasSubCategories) {
        $options .= '<option value="N/A">N/A</option>';
    }

    // Always include the "Show All" option
    $options .= '<option value="all">Show All</option>';

    echo $options;
} else {
    // Handle the case where the category is not set
    echo "<option value='' selected disabled>No sub-categories available</option>";
}

// Close the database connection
mysqli_close($conn);
?>