<?php
	require("conn.php");
    $name = $_GET['name'];
	$query="Delete from forms WHERE name='$name'";
	$conn->query($query);
		$message = "FILE SUCCESSFULLY DELETED!";
		echo "<script type='text/javascript'>alert('$message');</script>";	
		unlink( "forms/".$name."" );
	$conn->close();
	header ('location:forms_sadmin.php');
?>

