

<?php

		include ("conn.php");
			if(ISSET($_POST['save']));
			{
				$id=$_POST['id'];
				$received_date=$_POST['received_date'];
				date_default_timezone_set("Asia/Manila");
				$date = date('Y-m-d H:i:s');
				$receivedby=$_POST['receivedby'];
				$action=$_POST['action'];
				$tid=$_POST['tid'];
				$department=$_POST['department'];
			

				
			$conn->query("INSERT INTO receiving (id, received_date, date, receivedby, action,tid, department) VALUES ('$id', '$received_date', '$date', '$receivedby', '$action', '$tid', '$department')") or die (mysqli_error());
			$message = "RECEIVING SAVED!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo "<script>window.location = 'receiving.php?id=$id'</script>";

				}

?>