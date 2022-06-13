<?php
// connect to the database
//$conn = mysqli_connect('localhost', 'root', '', 'fms');
include 'conn.php';

$sql = "SELECT * FROM archive ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
			$date=$_POST['date'];
    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'rar', 'txt', 'csv', 'jpg', 'jpeg', 'png', 'pdf', 'docx'])) {
		$message = "You file extension must be .zip,  .rar,  .txt,  .csv,  .jpg,  .jpeg,  .png .pdf or .docx";
		echo "<script type='text/javascript'>alert('$message');</script>";
    } elseif ($_FILES['myfile']['size'] > 2e+6) { // file shouldn't be larger than 100Megabyte
        $message = "File too large!";
		echo "<script type='text/javascript'>alert('$message');</script>";
	
		
    } else {
   
        if (move_uploaded_file($file, $destination)) {
              $filename = $_FILES['myfile']['name'];
			$query = $conn->query("SELECT * FROM `archive` WHERE `name` = '$filename'");
			$check = $query->num_rows;
         	if($check == 1)
			{
				
				$message = "FILE ALREADY EXIST!";
				echo "<script type='text/javascript'>alert('$message');</script>";
			
			}			
					
			
			else
				{
				
					$conn->query ("INSERT INTO archive (name, date) VALUES ('$filename', '$date')")or die(mysqli_error());	
					$message = "FILE SUCCESSFULLY SAVED!";
				echo "<script type='text/javascript'>alert('$message');</script>";	
		
				}

			
}	
    }
	
}


