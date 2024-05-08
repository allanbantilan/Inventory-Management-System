<?php

// Include PHPExcel or PHPSpreadsheet library
require 'vendor/autoload.php';


// Retrieve parameters
$itemStatus = $_POST['itemStatus'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];

// Generate Excel file
// Here, you need to fetch data from the database based on the provided parameters
// and create an Excel file using PHPExcel or PHPSpreadsheet

// Example code to generate a simple Excel file
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Item Status');
$sheet->setCellValue('B1', 'Start Date');
$sheet->setCellValue('C1', 'End Date');

// Example data, you should fetch data from the database based on the provided parameters
$data = array(
    array('New', $startDate, $endDate),
    // Add more data rows here based on the fetched data
);

$row = 2;
foreach ($data as $rowData) {
    $sheet->fromArray($rowData, NULL, 'A' . $row);
    $row++;
}

// Save the Excel file
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$filename = 'filtered_inventory_' . date('YmdHis') . '.xlsx'; // Example filename
$writer->save($filename);

// Send the Excel file as a downloadable attachment
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
readfile($filename);
unlink($filename); // Delete the temporary file after sending
