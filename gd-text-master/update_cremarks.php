

<?php

		include ("conn.php");
			if(ISSET($_POST['save']));
			{
				$id=$_POST['id'];
				$remarks=$_POST['remarks'];
				date_default_timezone_set("Asia/Manila");
				$date = date('Y-m-d H:i:s');
				$status = $_POST['status'];
				$action=$_POST['action'];
				$tid=$_POST['tid'];
				
			$conn->query("INSERT INTO remarks (id, remarks, date, status, action,tid) VALUES ('$id', '$remarks', '$date', '$status', '$action', '$tid')") or die (mysqli_error());
			$message = "REMARKS SAVED!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo "<script>window.location = 'ca_viewdata.php'</script>";

				}

?>