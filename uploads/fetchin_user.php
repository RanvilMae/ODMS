<?php
		include ("conn.php");
		$primary_id= $_GET['primary_id'];
			if(ISSET($_POST['tag']));
			{
				 $primary_id = $_GET["primary_id"];
		date_default_timezone_set("Asia/Manila");
		$dateviewed= date('Y-m-d H:i:s');
		mysqli_query($conn, "UPDATE tagto_personnels SET track = 1,  `dateviewed` = '$dateviewed' WHERE track = 0 AND primary_id = '$primary_id'") ;
			}
		$query = $conn->query ("select * from `tagto_personnels` WHERE primary_id='$primary_id' ORDER BY date DESC ")or die (mysqli_error());
		$file = $query->fetch_array ();
		$id = $file['id'];
		$query = $conn->query ("select * from `files` WHERE id='$id' ORDER BY date DESC ")or die (mysqli_error());
		$fetch = $query->fetch_array ();
		$name = $fetch['name'];
		$department = $fetch['department'];
		header("location:uploads/$department/$name");
		 
		?>

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
	
		 
		?>