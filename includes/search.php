<?php
require 'db_connect.php';

// Check if search query is set and not empty
if (isset($_POST['searchText']) && !empty($_POST['searchText'])) {
    $searchText = mysqli_real_escape_string($conn, $_POST['searchText']);

    // Construct the SQL query to fetch filtered results
    $sql = "SELECT * FROM inventory WHERE serialNumber LIKE '%$searchText%' OR type LIKE '%$searchText%' OR status LIKE '%$searchText%' OR description LIKE '%$searchText%'";
} else {
    // If search query is not set or empty, retrieve all data
    $sql = "SELECT * FROM inventory";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['inv_id'] . "</td>";
        echo "<td>" . $row['serialNumber'] . "</td>";
        echo "<td>" . $row['type'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['dateAdded'] . "</td>";
        echo "<td class='text-center'>";
        echo "<div>";
        echo "<button type='button' class='btn btn-info btn-sm mr-2 edit-btn' data-id='" . $row['inv_id'] . "'>Edit</button>";
        echo "<a href='includes/delete.php?id=" . $row['inv_id'] . "' class='btn btn-danger btn-sm'>Delete</a>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No data found</td></tr>";
}

// Close the database connection
$conn->close();
?>
