<?php
	require("conn.php");
    $name = $_GET['name'];
	$query="Delete from documents WHERE name='$name'";
	$conn->query($query);
		$message = "FILE SUCCESSFULLY DELETED!";
		echo "<script type='text/javascript'>alert('$message');</script>";	
		unlink( "documents/".$name."" );
	$conn->close();
	header ('location:documents_admin.php');
?>

