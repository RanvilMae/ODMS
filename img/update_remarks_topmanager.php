<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<?php

		include ("conn.php");
			if(ISSET($_POST['save']));
			{
				$id=$_POST['id'];
				$remarks=$_POST['remarks'];
				date_default_timezone_set("Asia/Manila");
				$date = date('Y-m-d H:i:s');
				
		
			$conn->query("INSERT INTO remarks (id, remarks, date) VALUES ('$id', '$remarks', '$date')") or die (mysqli_error());
			$message = "REMARKS SAVED!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script>window.location = 'view_topmanager.php'</script>";

				}
?>
