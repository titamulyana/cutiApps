<?php
require_once './vendor/autoload.php';

use Dompdf\Dompdf;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tableHTML'])) {
  $tableHTML = $_POST['tableHTML'];

  // Create a new Dompdf instance
  $dompdf = new Dompdf();

  // Load the HTML content into Dompdf
  $html = '<!DOCTYPE html>
  <html>
  <head>
    <title>Daftar Cuti</title>
    <style>
      /* Add any custom CSS styles for the PDF here */
      table {
        width: 100%;
        border-collapse: collapse;
      }
      th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <h2>Daftar Cuti</h2>
    ' . $tableHTML . '
  </body>
  </html>';

  $dompdf->loadHtml($html);

  // (Optional) Set paper size and orientation
  $dompdf->setPaper('A4', 'landscape');

  // Render the HTML as PDF
  $dompdf->render();

  // Output the PDF as a blob
  $pdf = $dompdf->output();

  // Set response headers for PDF download
  header('Content-Type: application/pdf');
  header('Content-Disposition: inline; filename="table.pdf"');
  header('Content-Length: ' . strlen($pdf));

  // Output the PDF
  echo $pdf;
}
