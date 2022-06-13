<?php
  header("Content-Type: image/png");
  require "vendor/autoload.php";
  
  use Endroid\QrCode\QrCode;

  

  
  $qrCode = new QrCode($_GET['code']);
    $qrCode->setSize(90.424);
  echo $qrCode->writeString();


?>