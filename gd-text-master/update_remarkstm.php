

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
				$department=$_POST['department'];
				
			$conn->query("INSERT INTO remarks (id, remarks, date, status, action,tid, department) VALUES ('$id', '$remarks', '$date', '$status', '$action', '$tid', '$department')") or die (mysqli_error());
			$message = "REMARKS SAVED!";
			echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script>window.location = 'in_tm.php'</script>";

				}
?>
