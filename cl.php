

<?php

	include('conn.php');
	if (isset($_POST['save']))
{

	$module=$_POST['module'];
		
	$desc=$_POST['desc'];	
		
	$query = $conn->query("SELECT * FROM `changelog` WHERE `desc` = '$desc'");
	$check = $query->num_rows;
		
		if($check == 1)
			{
				echo "<script>alert('CHANGE LOG ALREADY EXIST!')</script>";	 
			}
			
			else
				{
					$conn->query ("INSERT INTO changelog ( module, desc)
					VALUES ('$module', '$desc')") or die(mysqli_error());	
					echo "<script>alert('DEPARTMENT SAVED!')</script>"; 
					exit(); 
				}				
					
}
?>