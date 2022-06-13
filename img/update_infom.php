<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<?php

		include ("conn.php");
			if(ISSET($_POST['edit']));
			{
				$id = $_SESSION['m'];
				
				$fname=$_POST['fname'];
				$fname = strtoupper($fname);
				$lname=$_POST['lname'];
				$lname = strtoupper($lname);
				$mname=$_POST['mname'];
				$mname = strtoupper($mname);
				$email=$_POST['email'];
				
				$conn->query("UPDATE users SET fname='$fname', mname='$mname', lname='$lname', email='$email' WHERE id='$id' ") or die (mysqli_error());
		$message = "FILE SUCCESSFULLY UPDATED!";
echo "<script type='text/javascript'>alert('$message');</script>";
header('Location: ' . $_SERVER['HTTP_REFERER']);
			} 
?>
