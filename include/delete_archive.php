<?php
	require("conn.php");
    $name = $_GET['name'];
	$query="Delete from archive WHERE name='$name'";
	$conn->query($query);
		$message = "FILE SUCCESSFULLY DELETED!";
		echo "<script type='text/javascript'>alert('$message');</script>";	
		unlink( "archive/".$name."" );
	$conn->close();
	header ('location:archive.php');
?>

