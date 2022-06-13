<?php
		include ("conn.php");
		$id= $_GET['id'];
			if(ISSET($_POST['tag']));
			{
				 $id = $_GET["id"];
				 
		date_default_timezone_set("Asia/Manila");
		$receive_date= date('Y-m-d H:i:s');
		mysqli_query($conn, "UPDATE files SET receive = 1,  `receive_date` = '$receive_date' WHERE receive = 0 AND id = '$id'") ;
			}
		$query = $conn->query ("select * from `files` WHERE id='$id' ORDER BY date DESC ")or die (mysqli_error());
		$fetch = $query->fetch_array ();
		$name = $fetch['name'];
		header("location:uploads/$name");
		 
		?>
		
<?php
		include ("conn.php");
		$id= $_GET['id'];
			if(ISSET($_POST['tag']));
			{
				 $id= $_GET['id'];
		date_default_timezone_set("Asia/Manila");
		$dateviewed= date('Y-m-d H:i:s');
		mysqli_query($conn, "UPDATE tags SET track = 1,  `dateviewed` = '$dateviewed' WHERE track = 0 AND id = '$id'") ;
			}
	 
		?>


