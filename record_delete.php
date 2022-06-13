<?php
require('conn.php');
 

  $id     = $_GET['id'];
  $qquery="Delete from files WHERE id='$id'";
  $conn->query($qquery);
  $query="Delete from tags WHERE id='$id'";
  $conn->query($query);
  $message = "RECORD ID SUCCESSFULLY DELETED!";
  echo "<script type='text/javascript'>alert('$message');</script>";
          
  $conn->close();
  echo "<script>window.location = 'filedelete.php'</script>";


?>