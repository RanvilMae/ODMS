<?php
		include ("conn.php");
			if(ISSET($_POST['tag']));
			{
				 $primary_id = $_GET["primary_id"];
		date_default_timezone_set("Asia/Manila");
		$dateviewed= date('Y-m-d H:i:s');
		mysqli_query($conn, "UPDATE tags SET track = 1,  `dateviewed` = '$dateviewed' WHERE track = 0 AND primary_id = '$primary_id'") ;
			}
		$query = $conn->query ("select * from `tags` WHERE primary_id='$primary_id' ORDER BY date DESC ")or die (mysqli_error());
		$file = $query->fetch_array ();
		$id = $file['id'];
		$query = $conn->query ("select * from `files` WHERE id='$id' ORDER BY date DESC ")or die (mysqli_error());
		$fetch = $query->fetch_array ();
		$name = $fetch['name'];
		header("location:uploads/$name");
		 
		?>

