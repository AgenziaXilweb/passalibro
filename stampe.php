<?

require('fpdf/fpdf.php');

if ($_GET['azione'] == 'stamparichieste') {
    
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

   
    
$pdf->Cell(40,10,$message);
    
    


$pdf->Output();
$pdf->Exit();
    
}
?>