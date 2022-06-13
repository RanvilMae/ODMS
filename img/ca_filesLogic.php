<?php
include 'conn.php';
$sql = "SELECT * FROM files ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$query = $conn->query ("SELECT id FROM files ORDER BY id DESC LIMIT 1") or die (mysqli_error());
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
// Uploads files
$upload_ok = 1;
/*var_dump($_POST);
return false;*/
if(isset($_POST['sub']))  
{  

	$classification=$_POST['classification'];
	$restriction		= $_POST['restriction'];
	$filename 			= $_FILES['myfile']['name'];
	$forw 				= $_POST['forw'];
	$for_specific 		= $_POST['for_specific'];
	$fromw 				= $_POST['fromw'];
	$from_specific		= $_POST['from_specific'];
	$subject 			= $_POST['subject'];
	$date 				= date('Y-m-d H:i:s');	
	$department			= $_POST['department'];
	$d 					= date('dmY');
	$pages				= $_POST['pages'];
	
	$receive 			= '0';
	$category			= $_POST['category'];

	if($classification == 'Incoming')
	{
		$classification2 = 'Outgoing';
	}
	else
	{
		$classification2 = 'Incoming';
		$restriction = 'Outgoing';
	}
	// destination of the file on the server
	$destination = 'uploads/' . $filename;
	

	// get the file extension
	$extension = pathinfo($filename, PATHINFO_EXTENSION);
	// the physical file on a temporary uploads directory on the server
	$file = $_FILES['myfile']['tmp_name'];
	$size = $_FILES['myfile']['size'];
    
	if (!in_array($extension, ['pdf' ,'docx', 'doc']))
	{
	    
		$message = "You file extension must be .pdf, .doc, .docx";
		$upload_ok = 0;
	}
	if ($_FILES['myfile']['size'] > 1e+9) 
	{ // file shouldn't be larger than 100Megabyte
		$message = "File too large!";
		$upload_ok = 0;
	}
	if($upload_ok == 1)
	{
		if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $destination)) 
		{	
		    $sql = "INSERT INTO files (restriction, name, forw, for_specific, fromw, from_specific, subject, date, extension, department, classification, docu_id, pages, classification2,  receive, category) VALUES ('$restriction', '$filename', '$forw', '$for_specific', '$fromw', '$from_specific', '$subject', '$date' , '$extension', '$department',  '$classification','$department$d-$docu_id', '$pages', '$classification2',  '$receive', '$category')";
			$in_ch=mysqli_query($conn,$sql)or die(mysqli_error());
			if(!$in_ch)
			{   
			    var_dump($in_ch);
			    return false;
			}
		}
		
		$result = mysqli_query($conn,"INSERT INTO logs (name, date, fname, tid, department, subject) VALUES ('$filename', '$date', '$fname', '$tid', '$department', '$subject')")or die(mysqli_error());
    	if($result)
    	{
    	    $message = 'File Successfully Uploaded.';
    	    echo "<script type='text/javascript'>alert('".$message."');</script>";
    	    echo "<script type='text/javascript'>window.location = 'cupload.php'</script>";
    	}
    	else
    	{
    	    var_dump($result);
    	    return false;
    	}
	}
	else
	{
	    echo "<script type='text/javascript'>alert('".$message."');</script>";
	}
}
?>



