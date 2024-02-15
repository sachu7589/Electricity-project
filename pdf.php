<?php

require_once __DIR__ . '/vendor/autoload.php'; // Include mpdf library

$mpdf = new \Mpdf\Mpdf(); // Create new instance

// Set some content to display in the PDF
$html = '<h1>Hello, World!</h1><p>This is some sample content.</p>';

// Write HTML content
$mpdf->WriteHTML($html);

// Output PDF
$mpdf->Output('example.pdf', 'D'); // D for download, I for inline display, F for file saving
