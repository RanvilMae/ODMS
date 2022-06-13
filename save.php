<?php
require('conn.php');
if (isset($_POST['save'])) {
			$forw=$_POST['forw'];
			$fromw=$_POST['fromw'];
			$tow=$_POST['tow'];
			$re=$_POST['re'];
			$subject=$_POST['subject'];
			$date=$_POST['date'];
			$description=$_POST['description'];
			$signatory=$_POST['signatory'];
if (isset($_POST['save'])) {
	
	
		 $sql = "INSERT INTO files ( forw, fromw, tow, re, subject, date, description, signatory) VALUES ('$forw', '$fromw', '$tow', '$re', '$subject', '$date','$description', '$signatory')";
            if (mysqli_query($conn, $sql)) {

				echo '<script language="javascript">';
				echo 'alert("Successfully saved!")';
				echo '</script>';
				
            }
        } else {
			echo '<script language="javascript">';
			echo 'alert("Failed to upload file")';
			echo '</script>';
        }
	header("location: viewData.php");
}
?>
