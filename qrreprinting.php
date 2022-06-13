<?php

include('libs/phpqrcode/qrlib.php'); 
require('fpdf/wrap.php');
include('conn.php');

 

  $id = $_POST['id'];  
   $conn->query("UPDATE `reprint_qr` SET `reprinted`='1' WHERE `id`='$id' ") or die (mysqli_error());
    
  $query = $conn->query ("SELECT * FROM `reprint_qr` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
  $file = $query->fetch_array ();
  $qrCode = $file['record_id'];
  echo $qrCode;

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
  $pdf->SetFont('Arial','B',16);
  $image1 = "temp/reprinted/".$qrCode.".png";

  $pdf->Image($image1,0,50,160);

  $pdf->Image('temp/reprinted/ODMS.png',140,90,100);

  ob_start();

  $pdf->Output();

 


?>

