<?php
error_reporting(0);
ini_set('display_errors', 0);
require_once 'db_connect.php';

// Get the start date, end date, status, site, and category from the form
$startDate = $_POST['dateStartPI'];
$endDate = $_POST['dateEndPI'];
$status = $_POST['statusPI'];
$site = $_POST['siteDropInv'];
$category = $_POST['categoryInv'];
$sub_category = $_POST['itemSubCategory'];

// Initialize output variable
$output = "";

// Start building the table structure
$output .= '<table id="reportTable" class="display" style="width:100%">';
$output .= '<thead>';
$output .= '<tr>';
$output .= '<th>Asset Tag</th>';
$output .= '<th>Serial Number</th>';
$output .= '<th>Category</th>';
$output .= '<th>Sub Category</th>';
$output .= '<th>Item Mode</th>';
$output .= '<th>Status</th>';
$output .= '<th>Date Added</th>';
$output .= '<th>Description</th>';
$output .= '<th>Site</th>';
$output .= '</tr>';
$output .= '</thead>';
$output .= '<tbody>';

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
    $output .= "<tr>";
    $output .= "<td>" . $row['asset_tag'] . "</td>";
    $output .= "<td>" . $row['serialNumber'] . "</td>";
    $output .= "<td>" . $row['type'] . "</td>";
    $output .= "<td>" . $row['sub_category'] . "</td>";
    $output .= "<td>" . $row['inv_mode'] . "</td>";
    $output .= "<td>" . $row['status'] . "</td>";
    $output .= "<td>" . $row['dateAdded'] . "</td>";
    $output .= "<td>" . $row['description'] . "</td>";
    $output .= "<td>" . $row['site'] . "</td>";
    $output .= "</tr>";
}

// Close the table structure
$output .= "</tbody>";
$output .= "</table>";

// Output the generated table
echo $output;

// Close the database connection
$conn->close();
?>
<!-- Hidden form to pass data to generate_report_PI.php -->
<form id="dataForm" action="includes/generate_report_PI.php" method="post" style="display: none;">
    <input type="hidden" name="dateStartPI" value="<?php echo $startDate; ?>">
    <input type="hidden" name="dateEndPI" value="<?php echo $endDate; ?>">
    <input type="hidden" name="statusPI" value="<?php echo $status; ?>">
    <input type="hidden" name="siteDropInv" value="<?php echo $site; ?>">
    <input type="hidden" name="categoryInv" value="<?php echo $category; ?>">
    <input type="hidden" name="itemSubCategory" value="<?php echo $sub_category; ?>">
    <!-- Download button -->

</form>
<button class="btn btn-primary" id="downloadExcelBtn">Download Excel</button>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<!-- DataTables JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        $('#reportTable').DataTable({
            "lengthChange": false, // Disable the show entries dropdown
            "searching": false // Disable search
        });

        // Download button click event
        $("#downloadExcelBtn").click(function () {
            // Submit the hidden form
            $("#dataForm").submit();
        });
    });
</script>
