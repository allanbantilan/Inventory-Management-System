<?php
require 'db_connect.php';

// Check if the site value is set in the POST request
if(isset($_POST['site'])) {
    $selectedSite = $_POST['site'];

    // Query to fetch data based on the selected site
    $query = "SELECT COUNT(*) AS item_count FROM inventory WHERE site = '$selectedSite'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $item_count = $row['item_count'];

    $query_history = "SELECT COUNT(*) AS item_count_history FROM history WHERE site = '$selectedSite'";
    $result_history = mysqli_query($conn, $query_history);
    $row_history = mysqli_fetch_assoc($result_history);
    $item_count_history = $row_history['item_count_history'];

    // You need to modify these queries according to your database structure
    $goodItemsCount = 0; // Example query to fetch count of good items
    $newItemsCount = 0; // Example query to fetch count of new items
    $defectiveItemsCount = 0; // Example query to fetch count of defective items

    // Return the fetched data as JSON
    $data = array(
        'item_count' => $item_count,
        'item_count_history' => $item_count_history,
        'good_items_count' => $goodItemsCount,
        'new_items_count' => $newItemsCount,
        'defective_items_count' => $defectiveItemsCount
    );
    echo json_encode($data);
}
?>
