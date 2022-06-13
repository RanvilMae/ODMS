<?php 
		include ("conn.php");
		$primary_id= $_GET['primary_id'];
			if(ISSET($_POST['tag']));
			{
				 $primary_id = $_GET["primary_id"];
				 
		date_default_timezone_set("Asia/Manila");
		$viewed= date('Y-m-d H:i:s');
		mysqli_query($conn, "UPDATE subfiles SET track = 1,  `viewed` = '$viewed' WHERE track = 0 AND primary_id = '$primary_id'") ;
			}
		$query = $conn->query ("select * from `subfiles` WHERE primary_id='$primary_id' ORDER BY date DESC ")or die (mysqli_error());
		$fetch = $query->fetch_array ();
		$name = $fetch['name'];
		header("location:subs/$name");
		 
		?>

