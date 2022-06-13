<?php
require('conn.php');
$id= $_GET['id'];
$nquery=mysqli_query($conn,"select * from `files` WHERE id = '$id'");
while($fetch = mysqli_fetch_array($nquery)){
	$classification= $fetch['classification'];
			$id=$_POST['id'];
			$forw=$_POST['forw'];
			$department=$_POST['department'];
			$for_specific=$_POST['for_specific'];
			$fromw=$_POST['fromw'];
			$from_specific=$_POST['from_specific'];
			$pages=$_POST['pages'];
			$subject=$_POST['subject'];
			$category=$_POST['category'];
			$restriction=$_POST['restriction'];
					mysqli_query($conn, "UPDATE `files` SET `forw` = '$forw', `for_specific` = '$for_specific', `fromw` = '$fromw', `from_specific` = '$from_specific',`pages` = '$pages', `subject` = '$subject',  `restriction` = '$restriction', `category` = '$category' WHERE `id` = '$id'") ;
			
				}

		if (isset($_POST['save']))
	{
			$filename = $_FILES['myfile']['name'];
			 $file = $_FILES['myfile']['tmp_name'];

		//name of folder where the file is stored

		$destination = "uploads/$department";

		// overwrite file

        	//checking if file exsists
        if(file_exists("$destination/$filename")) unlink("$destination/$filename");
        
        //Place it into your "uploads" folder mow using the move_uploaded_file() function
        move_uploaded_file($file, "$destination/$filename");


					$message = "FILE SUCCESSFULLY UPDATED!";
					echo "<script type='text/javascript'>alert('$message');</script>";
					echo "<script>window.location = 'viewdata.php'</script>";
	}



	
?>