<?php

include_once("conn.php");
  $docu_id = $_POST['docu_id'];  
  $record_id = $_POST['record_id'];   
  $conn->query("UPDATE reprint_qr SET track='1' WHERE docu_id='$docu_id' AND record_id = '$record_id' ") or die (mysqli_error());
         $message = "REPRINTING OF QR IS ACTIVATED!";
  echo "<script type='text/javascript'>alert('$message');</script>";
  echo "<script>window.location = 'qr_reprinting.php'</script>";
?>