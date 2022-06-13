<?php
  
   include('libs/phpqrcode/qrlib.php'); 
require('fpdf/wrap.php');


  $qrCode = $_GET['code'];

$path = 'temp/';
$file = $path.$qrCode.".png";
  
// $ecc stores error correction capability('L')
$ecc = 'L';
$pixel_Size = 10;  
// Generates QR Code and Stores it in directory given
QRcode::png($qrCode, $file, $ecc, $pixel_Size);
 $pdf = new FPDF();
$pdf= new wrap();

$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$image1 = "temp/".$qrCode.".png";

$pdf->Image($image1,0,50,160);

$pdf->Image('temp/ODMS.png',140,90,100);

ob_start();

$pdf->Output();
?>