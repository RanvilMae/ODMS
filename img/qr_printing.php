<?php
  
   include('libs/phpqrcode/qrlib.php'); 
require('fpdf/wrap.php');
if(isset($_POST['sub']))  
{  

  $qrCode     = $_POST['qrCode'];

$path = 'temp/';
$file = $path.$qrCode.".png";
  
// $ecc stores error correction capability('L')
$ecc = 'L';
$pixel_Size = 10;  
$pdf = new FPDF();
$pdf= new wrap();

$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$pdf->Image($file,0,50,160);
$pdf->Image('temp/ODMS.png',140,90,100);

ob_start();

$pdf->Output();
}
?>