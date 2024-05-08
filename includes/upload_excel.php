<?php
require 'db_connect.php';
// Include PhpSpreadsheet classes
require 'PhpSpreadsheet/src/Bootstrap.php';
require 'PhpSpreadsheet/src/PhpSpreadsheet/IOFactory.php';
require 'PhpSpreadsheet/src/PhpSpreadsheet/Reader/IReader.php';
require 'PhpSpreadsheet/src/PhpSpreadsheet/Reader/Xlsx.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // Get the temporary file path
    $fileTmpPath = $_FILES['file']['tmp_name'];

    // Load the Excel file
    $spreadsheet = IOFactory::load($fileTmpPath);
    $worksheet = $spreadsheet->getActiveSheet();

    // Assuming the first row contains headers, start from the second row
    foreach ($worksheet->getRowIterator(2) as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
        $rowData = [];

        foreach ($cellIterator as $cell) {
            $rowData[] = $cell->getValue();
        }

        // Extract data from $rowData array
        $inv_id = $rowData[0]; // Assuming inv_id is the first column in your Excel file
        $assetTag = $rowData[1];
        $serialNumber = $rowData[2];
        $type = $rowData[3];
        $status = $rowData[4];
        $dateAdded = $rowData[5];
        $site = $rowData[6];
        $description = $rowData[7];
        $invMode = $rowData[8];
        $subCategory = $rowData[9];

        // Insert data into your database table
        $stmt = $conn->prepare("INSERT INTO inventory (inv_id, asset_tag, serialNumber, type, status, dateAdded, site, description, inv_mode, sub_category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $inv_id, $assetTag, $serialNumber, $type, $status, $dateAdded, $site, $description, $invMode, $subCategory);
        $stmt->execute();
    }

    echo 'File uploaded and data inserted into the database successfully.';
} else {
    echo 'Error: File upload failed. Please try again.';
}
?>
