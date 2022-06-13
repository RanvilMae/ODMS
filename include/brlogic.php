<?php
include 'conn.php';
require "vendor/autoload.php";
use Endroid\QrCode\QrCode;
$sql = "SELECT * FROM board_resolution ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$query = $conn->query ("SELECT id FROM board_resolution ORDER BY id DESC LIMIT 1") or die (mysqli_error());
	if($query)
{
	$fetch = $query->fetch_array ();
	if($fetch)
	{
		$docu_id = $fetch['id']+1;
	}
	else
	{
		$docu_id = 1;
	}
	$d = date('Ymd');
}
date_default_timezone_set("Asia/Manila");

$$upload_ok = 1;
/*var_dump($_POST);
return false;*/
if(isset($_POST['sub']))  
{  
 
	$d = date('dmY');
	$filename = $_FILES['myfile']['name'];
	$subject=$_POST['subject'];
									date_default_timezone_set("Asia/Manila");
									$date = date('Y-m-d H:i:s');
	$page=$_POST['page'];
								$category=$_POST['category'];
	$br_no=$_POST['br_no'];
	$br_date=$_POST['br_date'];
								
	$destination = 'board resolutions/' . $filename;

						// get the file extension
	$extension = pathinfo($filename, PATHINFO_EXTENSION);

						// the physical file on a temporary uploads directory on the server
	$file = $_FILES['myfile']['tmp_name'];
	$size = $_FILES['myfile']['size'];

		if (!in_array($extension, ['pdf' ,'docx', 'doc'])) 
		{
			$message = "You file extension must be .pdf, .doc, .docx";
			echo "<script type='text/javascript'>alert('$message');</script>";
		} elseif ($_FILES['myfile']['size'] > 1e+9) { 
		$message = "File too large!";
		echo "<script type='text/javascript'>alert('$message');</script>";
						
							
		} else 
			{
					   
				if (move_uploaded_file($file, $destination)) 
					{	
						$in_ch=mysqli_query($conn,"INSERT INTO board_resolution (br_id, name, subject, date, page, category, br_no, br_date ) VALUES ('BR$d-$br_id', '$filename', '$subject', '$date' ,  '$page', '$category', '$br_no', '$br_date')")or die(mysqli_error());	
								
							$message = "FILE UPLOADED!";
								echo "<script type='text/javascript'>alert('$message');</script>";
								echo "<script>window.location = 'upload_br.php'</script>";
										
						}
				}
						
						
}
						
								

// if(isset($_POST['sub']))  
// {  
// $host="96.44.174.18";//host name  
// $username="tiezagov_tieza_portal"; //database username  
// $word=")SCCZqTZ3M,b";//database word  
// $db_name="tiezagov_tieza_portal";//database name  
// $tbl_name="logs"; //table name  
// $conn=mysqli_connect("$host", "$username", "$word","$db_name")or die("cannot connect");//connection string  

// 								$filename = $_FILES['myfile']['name'];
// 								date_default_timezone_set("Asia/Manila");
// 								$date = date('Y-m-d H:i:s');		
// 								$fname=$_POST['fname'];
// 								$tid=$_POST['tid'];
// 								$department=$_POST['department'];
// 								$subject=$_POST['subject'];
							
// 							$conn->query("INSERT INTO logs (name, date, fname, tid, department, subject) VALUES ('$filename', '$date', '$fname', '$tid', '$department', '$subject')")or die(mysqli_error());	
// 										$message = "FILE SUCCESSFULLY SAVED!";
// 									echo "<script type='text/javascript'>alert('$message');</script>";	
							
// 							}

								




?>



