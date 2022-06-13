<?php
	require("conn.php");
    $name = $_GET['name'];
	$query="Delete from board_resolution WHERE name='$name'";
	$conn->query($query);
		$message = "FILE SUCCESSFULLY DELETED!";
		echo "<script type='text/javascript'>alert('$message');</script>";	
		unlink( "uploads/".$name."" );
	$conn->close();
	header ('location:viewdata_br.php');
?>

