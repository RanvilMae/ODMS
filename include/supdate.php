
<?php
require('conn.php');
if (isset($_POST['save'])) {
			$id=$_POST['id'];
			$tid=$_POST['tid'];
			$fname=$_POST['fname'];
			$fname = strtoupper($fname);
			$lname=$_POST['lname'];
			$lname = strtoupper($lname);
			$mname=$_POST['mname'];
			$mname = strtoupper($mname);
			$email=$_POST['email'];
			$department=$_POST['department'];
			$position=$_POST['position'];
mysqli_query($conn, "UPDATE `users` SET `tid` = '$tid',`fname` = '$fname', `lname`= '$lname', `mname` = '$mname', `email` = '$email', `department` = '$department', `position` = '$position' WHERE `id` = '$id'") ;
$message = "FILE SUCCESSFULLY UPDATED!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script>window.location = 'viewusers.php'</script>";

}

?>