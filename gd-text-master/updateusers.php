
<?php
require('conn.php');
if (isset($_POST['update'])) {
			$id=$_POST['id'];
			$fname=$_POST['fname'];
			$mname=$_POST['mname'];
			$lname=$_POST['lname'];
			$tid=$_POST['tid'];
			$email=$_POST['email'];
			$department=$_POST['department'];
mysqli_query($conn, "UPDATE `users` SET `tid` = '$tid', `fname` = '$fname', `lname` = '$lname', `mname` = '$mname', `email` = '$email', `department` = '$department' WHERE `id` = '$id'") ;
$message = "FILE SUCCESSFULLY UPDATED!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script>window.location = 'searchusers.php'</script>";

}

?>