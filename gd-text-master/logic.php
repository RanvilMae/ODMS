<?php 
// connect to the database
//$conn = mysqli_connect('localhost', 'root', '', 'tieza_portal');
include 'conn.php';

$sql = "SELECT * FROM archive ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
		date_default_timezone_set("Asia/Manila");
				$date = date('Y-m-d H:i:s');
	$department=$_POST['department'];
    // destination of the file on the server
    $destination = 'archive/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'rar', 'txt', 'csv', 'jpg', 'jpeg', 'png', 'pdf', 'docx'])) {
		$message = "You file extension must be .zip,  .rar,  .txt,  .csv,  .jpg,  .jpeg,  .png .pdf or .docx";
		echo "<script type='text/javascript'>alert('$message');</script>";
    } elseif ($_FILES['myfile']['size'] > 100000000) { 
        $message = "File too large!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		
    } else {
   
        if (move_uploaded_file($file, $destination)) {
              $filename = $_FILES['myfile']['name'];
			$query = $conn->query("SELECT * FROM `archive` WHERE `name` = '$filename'");
			$check = $query->num_rows;
         	if($check == 1)
			{
				$message = "FILE ALREADY EXIST";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}			
					
			
			else
				{
				
					$conn->query ("INSERT INTO archive (name,  size, date, department) VALUES ('$filename', $size,'$date','$department')")or die(mysqli_error());	
					echo "<script>alert('FILE SAVED!')</script>"; 			
					
				}
			
}
    }
}


// Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM archive WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'archive/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('archive/' . $file['name']));
        readfile('archive/' . $file['name']);

        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE archive SET downloads=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);
        exit;
    }

}