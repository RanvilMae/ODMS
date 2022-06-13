<?php
require('conn.php');

$status= $_GET['status']; 
$query="Delete from status WHERE status='$status'";
$conn->query($query);
$message = "STATUS SUCCESSFULLY DELETED!";
echo "<script type='text/javascript'>alert('$message');</script>";
					
	$conn->close();
echo "<script>window.location = 'upload_status.php'</script>";
?>