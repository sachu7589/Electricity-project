<?php
if(isset($_GET['C_id'])){
    $C_id=$_GET['C_id'];
    $sql="SELECT * FROM tbl_consumers WHERE C_id=$C_id;";
    require_once "connect.php";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $C_Lid=$row["C_Lid"];
    $sql1="SELECT L_uname FROM tbl_login WHERE L_id=$C_Lid;";
    $result1=$conn->query($sql1);
    $row1=$result1->fetch_assoc();
    require_once('TCPDF-main/tcpdf.php');

    date_default_timezone_set('Asia/Kolkata');
    // Create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Electricity 4 U');
    $pdf->SetTitle('Consumer Details');
    $pdf->SetSubject('Consumer Details');
    $pdf->SetKeywords('TCPDF, PDF, consumer, details');

    // Set default header data
// Set header data with logo image
    $pdf->SetHeaderData('logo.jpg', 50, 'E4 U', 'Electricity Management');

    // Set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Add content here using PHP styled content
    $content = '<style>';
    $content .= '.text-center { text-align: center; }';
    $content .= '.mb-4 { margin-bottom: 4px; }';
    $content .= '.table { width: 100%; border-collapse: collapse; }'; // Removed table border
    $content .= '.table th, .table td { padding: 8px; border: none; }'; // Removed cell border
    $content .= '.table th { background-color: #007bff; color: #fff; }';
    $content .= '.table-striped tbody tr:nth-of-type(odd) { background-color: rgba(0, 123, 255, 0.1); }';
    $content .= '.table td { padding: 10px; border: 1px solid #000; }'; // Added border to table cells
    $content .= '.printed-time { position: absolute; bottom: 20px; right: 20px; }'; // Position for printed time
    $content .= '</style>';
    $content .= '<h1 class="text-center mb-4">Consumer Details</h1>';
    $content .= '<table class="table table-striped" style="height: 800px;"> ';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white"></th><td></td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white">Name</th><td>'. ucfirst($row['C_fname']) . ' ' . ucfirst($row['C_lname']) .'</td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white"></th><td></td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white">Phone</th><td>'. $row['C_phne'] .'</td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white"></th><td></td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white">Email</th><td>'. $row1['L_uname'] .'</td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white"></th><td></td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white">Area</th><td>'. $row['C_area'] .'</td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white"></th><td></td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white">Connection Type</th><td>'. $row['C_con_type'] .'</td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white"></th><td></td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white">S/o</th><td>'. $row['C_so'] .'</td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white"></th><td></td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white">Address</th><td>'. $row['C_house'] .', '. $row['C_street'] .', '. $row['C_city'] .', '. $row['C_postal'] .', '. $row['C_district'] .'</td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white"></th><td></td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white">Request Date</th><td>'. $row['C_req_date'] .'</td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white"></th><td></td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white">Status</th><td>'. $row['C_status'] .'</td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white"></th><td></td></tr>';
    $content .= '<tr style="height: 50px;"><th class="bg-primary text-white"></th><td></td></tr>';

    $content .= '<tr class="printed-time"><td colspan="2">Printed on: '. date('Y-m-d H:i:s') .'</td></tr>'; 
    $content .= '</table>';

    // Write the HTML content to the PDF
    $pdf->writeHTML($content, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('consumer.pdf', 'I');
}
?>