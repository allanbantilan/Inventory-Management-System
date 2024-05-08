<?php

    
    // Send appropriate headers for Excel file
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=history-report_sta.ana.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Database connection
    require_once 'db_connect.php';

    // Get the start date, end date, and status from the form
    $startDateSTA = $_POST['dateStartSTH'];
    $endDateSTA = $_POST['dateEndSTH'];
    $statusSTA = $_POST['statusSTH'];

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
        <div class='title'>History Report - Puan</div>
        <table>
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date Added</th>
                    <th>Date Deleted</th>
                    <th>Description</th>
                    <th>Remarks</th>
                    <th>Deleted By</th>
                </tr>
            </thead>
            <tbody>
    ";

    // Fetch data from the database based on the specified date range and status
    $query = $conn->prepare("SELECT * FROM historySTA WHERE dateAddedHisSTA BETWEEN ? AND ? AND statusHisSTA = ?");
    $query->bind_param("sss", $startDateSTA, $endDateSTA, $statusSTA);
    $query->execute();
    $result = $query->get_result();

    while($row = $result->fetch_assoc()){
        $output .= "
            <tr>
                <td>".$row['serialNumberHisSTA']."</td>
                <td>".$row['typeHisSTA']."</td>
                <td>".$row['statusHisSTA']."</td>
                <td>".$row['dateAddedHisSTA']."</td>
                <td>".$row['dateDeletedHisSTA']."</td>
                <td>".$row['descriptionHisSTA']."</td>
                <td>".$row['remarksSTA']."</td>
                <td>".$row['deletedBySTA']."</td>
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
