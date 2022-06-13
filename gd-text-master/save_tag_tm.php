
<?php 

	include 'conn.php';
	$sql 		= "SELECT * FROM tagto_personnels ORDER BY id DESC";
	$result 	= mysqli_query($conn, $sql);
	$files  	= mysqli_fetch_all($result, MYSQLI_ASSOC);
	date_default_timezone_set("Asia/Manila");
	if(isset($_POST['save']))  
	{
		$id 	= $_POST['id'];
		$docu_id 	= $_POST['docu_id'];
		$date 	= date('Y-m-d H:i:s');
		$tag 	= $_POST['selector'];
		$action = $_POST['action'];
        $error  = 0;
		$N = count($tag);
		for($i=0; $i < $N; $i++)
		{
			$check 		= mysqli_query($conn,"SELECT * FROM tagto_personnels WHERE id = '$id' AND tag = '$tag[$i]'");
			$checkrows 	= mysqli_num_rows($check);
   			if($checkrows > 0)
   			{
				$message = "ERROR! TAG EXIST!";
				echo "<script type='text/javascript'>alert('$message');</script>";
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
   			else
   			{
		    	$sql = "INSERT INTO tagto_personnels (id, tag, date, action, docu_id) VALUES ('$id', '$tag[$i]', '$date','$action', '$docu_id') ";
				$result = mysqli_query($conn,$sql) or die (mysqli_error());
				if(!$result)
				{
				    $error++;
				}
			}
		}
		
		if($error == 0)
		{
			echo "<script type='text/javascript'>alert('TAG SAVED');</script>";
				
			echo "<script>window.location = 'add_tag_tm.php?id=".$id."'</script>";
		}
	}
?>
