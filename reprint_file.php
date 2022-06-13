
<?php 

	include 'conn.php';
	date_default_timezone_set("Asia/Manila");
	if(isset($_POST['save']))  
	{
		$record_id 		= $_POST['record_id'];
		$department = $_POST['department'];
		$docu_id 	= $_POST['docu_id'];
		$tid 		= $_POST['tid'];
		$track		= '0';
		$reprinted		= '0';
			
		$sql = "INSERT INTO reprint_qr (record_id, department, docu_id,  tid, track, reprinted) VALUES ('$record_id', '$department', '$docu_id',   '$tid', '$track', '$reprinted' )";
		$result = mysqli_query($conn,$sql) or die (mysqli_error());
			echo "<script type='text/javascript'>alert('RE-PRINT QR REQUESTEED TO SUPERADMIN!');</script>";
			echo "<script>window.location = 'viewdata.php'</script>";

	}
?>
