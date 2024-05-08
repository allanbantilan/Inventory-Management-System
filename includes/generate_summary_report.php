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
$sub_category_filter = $_POST['itemSubCategory'];

// Initialize output variable
$output = "";

$output .= '<table id="reportTable2" style="width: 100%; border-collapse: collapse; border: 1px solid #000; font-family: Arial, sans-serif; font-size: 12px;">';
$output .= '<thead>';
$output .= '<tr>';

$output .= '<th style="background-color: #f2f2f2; padding: 8px; border: 1px solid #000; color: #000; text-align: center;">Category</th>';
$output .= '<th style="background-color: #f2f2f2; padding: 8px; border: 1px solid #000; color: #000; text-align: center;">Sub Category</th>';
$output .= '<th style="background-color: #f2f2f2; padding: 8px; border: 1px solid #000; color: #000; text-align: center;">No. Good Items</th>';
$output .= '<th style="background-color: #f2f2f2; padding: 8px; border: 1px solid #000; color: #000; text-align: center;">No. Defective Items</th>';
$output .= '<th style="background-color: #f2f2f2; padding: 8px; border: 1px solid #000; color: #000; text-align: center;">No. New Items</th>';
$output .= '<th style="background-color: #f2f2f2; padding: 8px; border: 1px solid #000; color: #000; text-align: center;">No. of Items</th>';
$output .= '<th style="background-color: #f2f2f2; padding: 8px; border: 1px solid #000; color: #000; text-align: center;">Total</th>';

$output .= '</tr>';
$output .= '</thead>';
$output .= '<tbody>';

// Prepare the SQL query with placeholders for optional filters
$sql = "SELECT type, sub_category,
        SUM(CASE WHEN status = 'Good' THEN 1 ELSE 0 END) AS good_count,
        SUM(CASE WHEN status = 'Defective' THEN 1 ELSE 0 END) AS defective_count,
        SUM(CASE WHEN status = 'New' THEN 1 ELSE 0 END) AS new_count,
        COUNT(*) AS total_count
        FROM inventory 
        WHERE dateAdded BETWEEN ? AND ?";

$params = array($startDate, $endDate);

// Add optional filters for site, category, subcategory, and status if selected
if (!empty($site) && $site != 'all') {
    $sql .= " AND site = ?";
    $params[] = $site;
}

if (!empty($category) && $category != 'all') {
    $sql .= " AND type = ?";
    $params[] = $category;
}

if (!empty($sub_category_filter) && $sub_category_filter != 'all') {
    // Only include subcategory filter if a specific subcategory is selected
    $sql .= " AND sub_category = ?";
    $params[] = $sub_category_filter;
}

if (!empty($status) && $status != 'all') {
    $sql .= " AND status = ?";
    $params[] = $status;
}

$sql .= " GROUP BY type, sub_category";

// Prepare and execute the SQL query with optional filters
$query = $conn->prepare($sql);

// Bind parameters dynamically based on the number of parameters
$types = str_repeat("s", count($params));
$query->bind_param($types, ...$params);

$query->execute();
$result = $query->get_result();

// Store rows in an array grouped by category
$category_rows = array();

while ($row = $result->fetch_assoc()) {
    $category = $row['type'];

    // If category not in array, initialize an empty array for it
    if (!isset($category_rows[$category])) {
        $category_rows[$category] = array(
            'total_items' => 0, // Initialize total items for the category
            'rows' => array(),  // Initialize rows for the category
        );
    }

    // Increment total items for the category
    $category_rows[$category]['total_items'] += $row['total_count'];

    // Add current row to the category's rows
    $category_rows[$category]['rows'][] = $row;
}

// Loop through the stored rows and generate table rows
$grand_total = 0;
foreach ($category_rows as $category => $data) {
    $rows = $data['rows'];
    $total_items = $data['total_items'];
    $rowspan = count($rows);
    $last_row = true;

    foreach ($rows as $index => $row) {
        $output .= "<tr>";
        if ($index === 0) {
            $output .= "<td rowspan='" . $rowspan . "' style='border: 1px solid #000; padding: 8px; color: #000; text-align: center;'>" . $category . "</td>";
        }
        $output .= "<td style='border: 1px solid #000; padding: 8px; color: #000; text-align: center;'>" . $row['sub_category'] . "</td>";
        $output .= "<td style='border: 1px solid #000; padding: 8px; color: #000; text-align: center;'>" . $row['good_count'] . "</td>";
        $output .= "<td style='border: 1px solid #000; padding: 8px; color: #000; text-align: center;'>" . $row['defective_count'] . "</td>";
        $output .= "<td style='border: 1px solid #000; padding: 8px; color: #000; text-align: center;'>" . $row['new_count'] . "</td>";
        $output .= "<td style='border: 1px solid #000; padding: 8px; color: #000; text-align: center;'>" . $row['total_count'] . "</td>";

        if ($last_row) {
            $output .= "<td style='border: 1px solid #000; padding: 8px; color: #000; text-align: center;'><b>" . $total_items . "</b></td>";
            $last_row = false;
            $grand_total += $total_items;
        } else {
            $output .= "<td style='border: 1px solid #000; padding: 8px; color: #000; text-align: center;'>&nbsp;</td>";
        }

        $output .= "</tr>";
    }
}

$output .= "<tr>";
$output .= "<td colspan='6' style='border: 1px solid #000; padding: 8px; color: #000; text-align: right;'><b>Total:</b></td>";
$output .= "<td style='border: 1px solid #000; padding: 8px; color: #000; text-align: center;'><b>" . $grand_total . "</b></td>";
$output .= "</tr>";

$output .= "</tbody>";
$output .= "</table>";
// Output the generated table
echo $output;

// Close the database connection
$conn->close();
?>


<a href="#" id="downloadPDF">Download PDF</a>

<!-- Hidden form to send data to generate_summary.php -->
<form id="dataForm" action="includes/generate_summary.php" method="post" style="display: none;" target="_blank">
    <input type="hidden" name="category" value="<?php echo $category; ?>">
    <input type="hidden" name="good_count" value="<?php echo $good_count; ?>">
    <input type="hidden" name="defective_count" value="<?php echo $defective_count; ?>">
    <input type="hidden" name="new_count" value="<?php echo $new_count; ?>">
    <input type="hidden" name="total_count" value="<?php echo $total_count; ?>">
    <input type="hidden" name="startDate" value="<?php echo $startDate; ?>">
    <input type="hidden" name="endDate" value="<?php echo $endDate; ?>">
    <input type="hidden" name="status" value="<?php echo $status; ?>">
    <input type="hidden" name="site" value="<?php echo $site; ?>">
    <input type="hidden" id="tableContent" name="tableContent" value="">
    <!-- Add additional hidden inputs for startDate, endDate, status, and site -->
</form>

<script>
    // Add an event listener to the "Download PDF" link
    document.getElementById('downloadPDF').addEventListener('click', function() {

        var tableContent = document.getElementById('reportTable2').outerHTML;
        // Set the table content to the hidden input field
        document.getElementById('tableContent').value = tableContent;
        // Submit the form when the link is clicked
        document.getElementById('dataForm').submit();
    });
</script>


<!-- <form id="dataForm" action="includes/generate_summary.php" method="post" style="display: none;" target="_blank">
    <input type="hidden" name="category" value="<?php echo $category; ?>">
    <input type="hidden" name="good_count" value="<?php echo $good_count; ?>">
    <input type="hidden" name="defective_count" value="<?php echo $defective_count; ?>">
    <input type="hidden" name="new_count" value="<?php echo $new_count; ?>">
    <input type="hidden" name="total_count" value="<?php echo $total_count; ?>">
    <input type="hidden" name="startDate" value="<?php echo $startDate; ?>">
    <input type="hidden" name="endDate" value="<?php echo $endDate; ?>">
    <input type="hidden" name="status" value="<?php echo $status; ?>">
    <input type="hidden" name="site" value="<?php echo $site; ?>">
   
</form> -->

 
<!-- <button class="btn btn-primary" id="downloadExcelBtn">Download PDF</button> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<!-- DataTables JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


<script>
    $(document).ready(function () {
        // Initialize DataTable
      

        // Download button click event
        $("#downloadExcelBtn").click(function () {
            // Submit the hidden form
            $("#dataForm").submit();
        });
    });
</script>
