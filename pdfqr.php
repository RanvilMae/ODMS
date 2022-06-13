<?php
  
   include('libs/phpqrcode/qrlib.php'); 
require('fpdf/wrap.php');
include ("conn.php");

  $qrCode = $_GET['code'];

$path = 'temp/';

$query = $conn->query ("SELECT * FROM files WHERE id = '$qrCode' ") or die (mysql_error());
$fetch = $query->fetch_array ();
$docu_id=$fetch['docu_id'];
$file = $path.$docu_id.".png";
  
// $ecc stores error correction capability('L')
$ecc = 'L';
$pixel_Size = 10;  
// Generates QR Code and Stores it in directory given
QRcode::png($docu_id, $file, $ecc, $pixel_Size);
 $pdf = new FPDF();
$pdf= new wrap();

$pdf->AddPage();
$pdf->SetFont('Arial','B',102);
$image1 = "temp/".$docu_id.".png";

$pdf->Image($image1,0,50,160);
$pdf->Image('temp/ODMS.png',140,90,100);
$pdf->SetXY(50, 50); 
$pdf->Write(5,$qrCode);

ob_start();

$pdf->Output();
?>