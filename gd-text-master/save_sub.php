<?php
	include 'conn.php';
	if(isset($_POST['save']));
	{
		date_default_timezone_set("Asia/Manila");
		$filename 		= $_FILES['myfile']['name'];
		$id 			= $_POST['id'];
		$sub_docu 		= $_POST['sub_docu'];
		$subject 		= $_POST['subject'];
		$department 	= $_POST['department'];
		$date 			= date('Y-m-d H:i:s');	
		$pages 			= $_POST['pages'];
		$action 		= $_POST['action'];
		$remarks 		= $_POST['remarks'];
		$track 			= '0';
		$destination 	= 'subs/' . $filename;
		$extension 		= pathinfo($filename, PATHINFO_EXTENSION);
		$file 			= $_FILES['myfile']['tmp_name'];
		$size 			= $_FILES['myfile']['size'];
		$upload_ok      = 1;

		if ($_FILES['myfile']['size'] > 1e+9) 
		{ // file shouldn't be larger than 100Megabyte
			$message = "File too large!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			$upload_ok = 0;
		}
		if (!in_array($extension, ['pdf' ,'docx', 'doc']))
		{
		    $message = "You file extension must be .zip,  .rar,  .txt,  .csv,  .jpg,  .jpeg,  .png .pdf or .docx";
			echo "<script type='text/javascript'>alert('$message');</script>";
			$upload_ok = 0;
		}
		if($upload_ok == 1)
		{
			$query 		= $conn->query("SELECT * FROM `subfiles` WHERE `name` = '$filename'");
			$check 		= $query->num_rows;
			if($check > 0)
			{
				echo "<script type='text/javascript'>alert('FILE ALREADY EXIST');</script>";
				
						echo "<script>window.location = 'subfile.php?id=$id'</script>";
			}
			else
			{
				if (move_uploaded_file($file, $destination)) {
				    $sql = "INSERT INTO subfiles (id, name, sub_docu, date, pages, action, subject, department, remarks, track) VALUES ('$id', '$filename', '$sub_docu', '$date' , '$pages', '$action', '$subject', '$department', '$remarks', '$track')";
					$result = mysqli_query($conn,$sql)or die(mysqli_error());
					if($result)
					{
						echo "<script>alert('FILE SAVED!')</script>";	
						echo "<script>window.location = 'subfile.php?id=$id'</script>";
					}
					
				}
			}	
		}
		
	}
?>