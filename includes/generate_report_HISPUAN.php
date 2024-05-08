<?php
    // Send appropriate headers for Excel file
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=history-report.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Database connection
    require_once 'db_connect.php';

    // Get the start date, end date, and status from the form
    $startDatePH = $_POST['dateStartPH'];
    $endDatePH = $_POST['dateEndPH'];
    $statusPH = $_POST['statusPH'];
    $sitePH = $_POST['siteDropHis'];
    $categoryPH = $_POST['categoryHis'];

    // Initialize output variable
    $output = "";

    // Start building the table structure with some basic styling
    $output .="
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
        <div class='title'>History Report</div>
        <table>
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date Added</th>
                    <th>Date Deleted</th>
                    <th>Description</th>
                    <th>Site</th>
                    <th>Remarks</th>
                    <th>Deleted By</th>
                </tr>
            </thead>
            <tbody>
    ";

    $sql = "SELECT serialNumberHis, siteHis, typeHis, statusHis, dateAddedHis, dateDeletedHis, descriptionHis, remarks, deletedBy
            FROM history
            WHERE dateAddedHis BETWEEN ? AND ? AND statusHis = ?";
    $params = array($startDatePH, $endDatePH, $statusPH);

    // Add optional filters for site and category if selected
    if ($sitePH != 'all') {
        $sql .= " AND siteHis = ?";
        $params[] = $sitePH;
    }

    if ($categoryPH != 'all') {
        $sql .= " AND typeHis = ?";
        $params[] = $categoryPH;
    }

    // Prepare and execute the SQL query with optional filters
    $query = $conn->prepare($sql);

    if (!$query) {
        die("Error in preparing SQL statement: " . $conn->error);
    }

    // Bind parameters dynamically based on the number of parameters
    if (!empty($params)) {
        $types = str_repeat("s", count($params));
        $query->bind_param($types, ...$params);
    }

    $query->execute();
    $result = $query->get_result();

    while ($row = $result->fetch_assoc()) {
        $output .= "
            <tr>
                <td>".$row['serialNumberHis']."</td>
                <td>".$row['typeHis']."</td>
                <td>".$row['statusHis']."</td>
                <td>".$row['dateAddedHis']."</td>
                <td>".$row['dateDeletedHis']."</td>
                <td>".$row['descriptionHis']."</td>
                <td>".$row['siteHis']."</td>
                <td>".$row['remarks']."</td>
                <td>".$row['deletedBy']."</td>
            </tr>
        ";
    }

    // Close the table structure
    $output .="
            </tbody>
        </table>
    ";

    // Output the generated table
    echo $output;
?>
