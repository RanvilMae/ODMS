<?php
// connect to the database
//$conn = mysqli_connect('localhost', 'root', '', 'tieza_portal');
include 'conn.php';

$sql = "SELECT * FROM forms ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
	date_default_timezone_set("Asia/Manila");
				$date = date('Y-m-d H:i:s');
    // destination of the file on the server
    $destination = 'forms/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'rar', 'xlsx', 'txt', 'jpg', 'jpeg', 'png', 'pdf', 'docx', 'csv'])) {
		$message = "You file extension must be .zip, .xlsx,  .rar,  .txt,  .jpg,  .jpeg,  .png, .pdf, .csv or .docx";
		echo "<script type='text/javascript'>alert('$message');</script>";
    } elseif ($_FILES['myfile']['size'] > 100000000) { 
        $message = "File too large!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		
    } else {
   
        if (move_uploaded_file($file, $destination)) {
              $filename = $_FILES['myfile']['name'];
			$query = $conn->query("SELECT * FROM `forms` WHERE `name` = '$filename'");
			$check = $query->num_rows;
         	if($check == 1)
			{
				$message = "FILE ALREADY EXIST";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}			
					
			
			else
				{
				
					$conn->query ("INSERT INTO forms (name,  size, date) VALUES ('$filename', $size, '$date')")or die(mysqli_error());	
					echo "<script>alert('FILE SAVED!')</script>"; 			
					
				}
			
}
    }
}


// Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM forms WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'forms/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('forms/' . $file['name']));
        readfile('forms/' . $file['name']);

    }

}