<?php
require('conn.php');

if (isset($_POST['save'])) {
	$classification=$_GET['classification'];
			if ($classification = 'Outgoing')
				{	
					$id=$_POST['id'];
			$fromw=$_POST['fromw'];
			$pages=$_POST['pages'];
			$subject=$_POST['subject'];
			$date= date('Y-m-d H:i:s');
			$pages=$_POST['pages'];
					mysqli_query($conn, "UPDATE `files` SET `fromw` = '$fromw', `restriction` = 'Outgoing', `subject` = '$subject', `date` = '$date', `pages` = '$pages' WHERE `id` = '$id'") ;
					$message = "FILE SUCCESSFULLY UPDATED!";
					echo "<script type='text/javascript'>alert('$message');</script>";
					echo "<script>window.location = 'viewdata.php'</script>";
				}
			else
				{
			$id=$_POST['id'];
			$fromw=$_POST['fromw'];
			$pages=$_POST['pages'];
			$subject=$_POST['subject'];
			$date= date('Y-m-d H:i:s');
			$pages=$_POST['pages'];
			$restriction=$_POST['restriction'];
					mysqli_query($conn, "UPDATE `files` SET `fromw` = '$fromw', `restriction` = '$restriction', `subject` = '$subject', `date` = '$date', `pages` = '$pages' WHERE `id` = '$id'") ;
					$message = "FILE SUCCESSFULLY UPDATED!";
					echo "<script type='text/javascript'>alert('$message');</script>";
					echo "<script>window.location = 'viewdata.php'</script>";


			
			
				}
}
		if (isset($_POST['save']))
	{
			$filename = $_FILES['myfile']['name'];
			 $file = $_FILES['myfile']['tmp_name'];

		//name of folder where the file is stored

		$destination = "uploads/";

		// overwrite file

		//checking if file exsists
		if(file_exists("uploads/$filename")) unlink("uploads/$filename");

		$movefile = move_uploaded_file($file, $destination.$filename);

	}
	
?>