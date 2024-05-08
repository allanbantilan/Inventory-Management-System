<?php
require_once 'tcpdf/tcpdf.php';
// Create new TCPDF instance
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Inventory Summary Report');
$pdf->SetSubject('Inventory Summary');
$pdf->SetKeywords('Inventory, Summary, Report');

// Set default font
$pdf->SetFont('helvetica', '', 12);

// Add a page
$pdf->AddPage();

// Start table
$pdf->writeHTML('<table id="reportTable2" cellpadding="5" cellspacing="0" border="1">');

// Add table headers
$pdf->writeHTML('<thead>');
$pdf->writeHTML('<tr>');
$pdf->writeHTML('<th style="width: 20%;">Category</th>');
$pdf->writeHTML('<th style="width: 20%;">Sub Category</th>');
$pdf->writeHTML('<th style="width: 15%;">No. Good Items</th>');
$pdf->writeHTML('<th style="width: 15%;">No. Defective Items</th>');
$pdf->writeHTML('<th style="width: 15%;">No. New Items</th>');
$pdf->writeHTML('<th style="width: 15%;">No. of Items</th>');
$pdf->writeHTML('</tr>');
$pdf->writeHTML('</thead>');

// Start table body
$pdf->writeHTML('<tbody>');

// Add table rows dynamically generated from PHP code
// Assuming $output contains the rows generated dynamically in PHP
$pdf->writeHTML($output);

// End table body
$pdf->writeHTML('</tbody>');

// End table
$pdf->writeHTML('</table>');

// Close the PDF and output it
$pdf->Output('Inventory_Summary_Report.pdf', 'D');
?>
