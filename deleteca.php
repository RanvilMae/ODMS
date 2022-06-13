<?php
	require("conn.php");
	$id = $_GET['id'];
	$query="Delete from centraladmin WHERE id='$id'";
	$conn->query($query);
		$message = "FILE SUCCESSFULLY DELETED!";
		echo "<script type='text/javascript'>alert('$message');</script>";
	$conn->close();
	require("viewcentraladmins.php");
	?>