<?php 
	require("conn.php");
    $id = $_GET['file_id'];
	$query="Delete from files WHERE id='$id'";
	$conn->query($query);
		$message = "FILE SUCCESSFULLY DELETED!";
		echo "<script type='text/javascript'>alert('$message');</script>";	
	$conn->close();
	require("archive.php");
?>

