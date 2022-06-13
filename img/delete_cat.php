<?php
require('conn.php');

$category= $_GET['category']; 
$query="Delete from category WHERE category='$category'";
$conn->query($query);
$message = "CATEGORY SUCCESSFULLY DELETED!";
echo "<script type='text/javascript'>alert('$message');</script>";
					
	$conn->close();
echo "<script>window.location = 'upload_category.php'</script>";
?>