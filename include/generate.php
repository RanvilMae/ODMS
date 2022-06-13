<?php
	header("Content-Type: application/pdf");
	
	require "vendor/autoload.php";
	
	use Endroid\QrCode\QrCode;
	
	$qrCode = new QrCode($_GET['code']);
	echo $qrCode->writeString();
?>