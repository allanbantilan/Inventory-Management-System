<?php
error_reporting(0);
ini_set('display_errors', 0);

// Send appropriate headers for Excel file
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=inventory-report.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Database connection
require_once 'db_connect.php';

// Initialize variables with default values
$startDate = isset($_POST['dateStartPI']) ? $_POST['dateStartPI'] : '';
$endDate = isset($_POST['dateEndPI']) ? $_POST['dateEndPI'] : '';
$status = isset($_POST['statusPI']) ? $_POST['statusPI'] : '';
$site = isset($_POST['siteDropInv']) ? $_POST['siteDropInv'] : '';
$category = isset($_POST['categoryInv']) ? $_POST['categoryInv'] : '';
$sub_category = isset($_POST['itemSubCategory']) ? $_POST['itemSubCategory'] : '';



// Initialize output variable
$output = "";

// Start building the table structure with some basic styling
$output .= "
    <style>
        table {
            width: 60%;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: 0;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            width: auto;
            white-space: nowrap;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        td {
            text-align: left;
        }
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 20px;
        }
    </style>
    <div class='title'>Inventory Report</div>
    <table>
        <thead>
            <tr>
                <th>Asset Tag</th>
                <th>Serial Number</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Item Mode</th>
                <th>Status</th>
                <th>Date Added</th>
                <th>Description</th>
                <th>Site</th>
            </tr>
        </thead>
        <tbody>
";

// Prepare the SQL query with placeholders for optional filters
$sql = "SELECT asset_tag, serialNumber, site, type, status, dateAdded, description, inv_mode, sub_category 
        FROM inventory 
        WHERE dateAdded BETWEEN ? AND ?";

$params = array($startDate, $endDate);

// Add optional filters for site, category, and status if selected
if (!empty($site) && $site != 'all') {
    $sql .= " AND site = ?";
    $params[] = $site;
}

if (!empty($category) && $category != 'all') {
    $sql .= " AND type = ?";
    $params[] = $category;
}

if (!empty($status) && $status != 'all') {
    $sql .= " AND status = ?";
    $params[] = $status;
}

if (!empty($sub_category) && $sub_category != 'all') {
    $sql .= " AND sub_category = ?";
    $params[] = $sub_category;
}

// Prepare and execute the SQL query with optional filters
$query = $conn->prepare($sql);

// Bind parameters dynamically based on the number of parameters
$types = str_repeat("s", count($params));
$query->bind_param($types, ...$params);

$query->execute();
$result = $query->get_result();

while ($row = $result->fetch_assoc()) {
    $output .= "
        <tr>
            <td>" . $row['asset_tag'] . "</td>
            <td>" . $row['serialNumber'] . "</td>
            <td>" . $row['type'] . "</td>
            <td>" . $row['sub_category'] . "</td>
            <td>" . $row['inv_mode'] . "</td>
            <td>" . $row['status'] . "</td>
            <td>" . $row['dateAdded'] . "</td>
            <td>" . $row['description'] . "</td>
            <td>" . $row['site'] . "</td>
        </tr>
    ";
}

// Close the table structure
$output .= "
        </tbody>
    </table>
";

// Output the generated table
echo $output;
?>