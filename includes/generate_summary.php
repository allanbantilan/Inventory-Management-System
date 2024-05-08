<?php
// Include TCPDF library
require_once 'db_connect.php';
require_once 'tcpdf/tcpdf.php';

// Retrieve form data
$category = $_POST['category'];
$good_count = $_POST['good_count'];
$defective_count = $_POST['defective_count'];
$new_count = $_POST['new_count'];
$total_count = $_POST['total_count'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$status = $_POST['status'];
$site = $_POST['site'];
$tableContent = $_POST['tableContent']; // The HTML content of the table
// Include DataTables CSS
$tableContentWithStyles = '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">';

// Retrieve DataTables JavaScript
$tableContentWithStyles .= '<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>';

// Append table content
$tableContentWithStyles .= $tableContent;
// Create new TCPDF instance
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set default font
$pdf->SetFont('helvetica', '', 12);

// Add a page
$pdf->AddPage();
$pdf->Ln(5);
// Set font for the title
$pdf->SetFont('helvetica', 'B', 20);

$pdf->Cell(0, 10, 'SPLACE COWORKING SPACE DAVAO CORPORATION', 0, 0, 'C', 0, '', false, 'M', 'M');
// Move to the next line
$pdf->Ln();

// Add address
if ($site == 'Puan' || $site == 'all') {
    // Display the address for Puan
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(0, 10, '2nd Floor Sartorio Building, Km. 9 Puan McArthur Highway,  Talomo, Davao City Phil. 8000', 0, 1, 'C', 0, '', false, 'M', 'M');
}

if ($site == 'Sta. Ana') {
    // Display the address for Sta. Ana
    $pdf->SetFont('helvetica', '', 9);
    $pdf->Cell(0, 10, '5th floor 3JG8+JFW, Sta. Ana Avenue corner Leon Ma, Leon M Guerrero St,'  . "\n" . 'Poblacion District, Davao City, 8000 Davao del Sur, Philippines', 0, 1, 'C', 0, '', false, 'M', 'M');
}


// Add a blank line
$pdf->Ln(10);



// Calculate the width of the page
$pageWidth = $pdf->GetPageWidth();

// Set padding for the left and right sides
$padding = 20; // Adjust as needed
$paddingright = 140;

$pdf->SetFont('helvetica', 'B', 12);

// Set the X position for the left-aligned text
$leftAlignedX = $padding; // Add padding to the left side
$rightAlignedX = $paddingright;

// Add "Date" on the left
$pdf->SetX($leftAlignedX);
$pdf->Cell(0, 10, 'Date: '  . date('Y-m-d'), 0, 0, 'L');

// Add "Start Date" on the right
$pdf->SetX($rightAlignedX);
$pdf->Cell(0, 10, 'Start Date: ' . $startDate, 0, 1, 'L');

// Add "Site" on the left
$pdf->SetX($leftAlignedX);
$pdf->Cell(0, 10, ' Site: ' . ($site == 'all' ? 'All' : $site), 0, 0, 'L');

// Add "End Date" on the right
$pdf->SetX($rightAlignedX);
$pdf->Cell(0, 10, ' End Date: '  . $endDate, 0, 1, 'L');

$pdf->Ln(5); // Move to the next line



// Add a line
$pdf->SetDrawColor(0, 0, 0); // Set draw color to black
$pdf->Line($leftAlignedX - 10, $pdf->GetY(), $rightAlignedX + 60, $pdf->GetY()); // Draw line from left to right aligned X, extending it by 10 units

$pdf->Ln(4); // Move to the next line
// Set font for the text
$pdf->SetFont('helvetica', '', 10);

$pdf->Ln(1); // Move to the next line
// Write HTML content
// Retrieve table content including CSS styles

$pdf->writeHTML($tableContentWithStyles);


// Output the PDF as a file (download)
$pdf->Output('inventory_report.pdf', 'D');
?>
