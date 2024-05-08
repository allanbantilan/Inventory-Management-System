<?php

    
    // Send appropriate headers for Excel file
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=inventory-report_sta.ana.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Database connection
    require_once 'db_connect.php';

    // Get the start date, end date, and status from the form
    $startDateSTA = $_POST['dateStartSTA'];
    $endDateSTA = $_POST['dateEndSTA'];
    $statusSTA = $_POST['statusSTA'];

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
        <div class='title'>Inventory Report - Sta. Ana</div>
        <table>
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date Added</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
    ";

    $query = $conn->prepare("SELECT * FROM inventorysta WHERE dateAddedSTA BETWEEN ? AND ? AND statusSTA = ?");
    if ($query === false) {
        die('Error preparing query: ' . $conn->error);
    }
    
    $query->bind_param("sss", $startDateSTA, $endDateSTA, $statusSTA);
    $query->execute();
    $result = $query->get_result();
    if ($result === false) {
        die('Error executing query: ' . $conn->error);
    }
    

    while($row = $result->fetch_assoc()){
        $output .= "
            <tr>
                <td>".$row['serialNumberSTA']."</td>
                <td>".$row['typeSTA']."</td>
                <td>".$row['statusSTA']."</td>
                <td>".$row['dateAddedSTA']."</td>
                <td>".$row['descriptionSTA']."</td>
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
