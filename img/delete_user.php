<?php
	require("conn.php");
	$userid = $_GET['userid'];
	$query="Delete from data WHERE userid='$userid'";
	$conn->query($query); 
	$conn->close();
	require("view_user.php");
?>

