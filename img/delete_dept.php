<?php
require('conn.php');

$department= $_GET['department']; 
$query="Delete from department WHERE department='$department'";
$conn->query($query);
$message = "DEPARTMENT SUCCESSFULLY DELETED!";
echo "<script type='text/javascript'>alert('$message');</script>";
					
	$conn->close();
echo "<script>window.location = 'upload_dept.php'</script>";
?>