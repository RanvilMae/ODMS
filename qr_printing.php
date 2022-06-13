<?php
  include ("conn.php");
  
   include('libs/phpqrcode/qrlib.php'); 
require('fpdf/wrap.php');
if(isset($_POST['sub']))  
{  

  $qrCode     = $_POST['qrCode'];

$query = $conn->query ("SELECT * FROM files WHERE docu_id = '$qrCode' ") or die (mysql_error());
$fetch = $query->fetch_array ();
$id=$fetch['id'];

$path = 'temp/reprinted/';
$file = $path.$qrCode.".png";
  
// $ecc stores error correction capability('L')
$ecc = 'L';
$pixel_Size = 10;  
// Generates QR Code and Stores it in directory given
QRcode::png($qrCode, $file, $ecc, $pixel_Size);
 $pdf = new FPDF();
$pdf= new wrap();

$pdf->AddPage();
$pdf->SetFont('Arial','B',102);
$image1 = "temp/reprinted/".$qrCode.".png";

$pdf->Image($image1,0,50,160);

$pdf->Image('temp/reprinted/ODMS.png',140,90,100);

$pdf->SetXY(50, 50); 
$pdf->Write(5,$id);
ob_start();

$pdf->Output();
}
?>

