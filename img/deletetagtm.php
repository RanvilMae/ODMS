<?php
require('conn.php');

$id= $_GET['tagid']; 
$query="Delete from tags WHERE primary_id='$id'";
$conn->query($query);
$message = "TAG SUCCESSFULLY DELETED!";
echo "<script type='text/javascript'>alert('$message');</script>";
					
	$conn->close();
	echo "<script>window.location = 'view_topmanager.php'</script>";
?>