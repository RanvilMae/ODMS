
<?php
require('conn.php');
if (isset($_POST['update'])) {
		$id=$_POST['id'];
			$tid=$_POST['tid'];
			$fname=$_POST['fname'];
			$fname = strtoupper($fname);
			$lname=$_POST['lname'];
			$lname = strtoupper($lname);
			$mname=$_POST['mname'];
			$email=$_POST['email'];
			$password=md5($_POST['password']);
			$department=$_POST['department'];
mysqli_query($conn, "UPDATE `superadmin` SET `tid` = '$tid', `fname` = '$fname', `mname` = '$mname', `lname` ='$lname', `email` = '$email', `department` = '$department', `password` = '$password' WHERE `id` = '$id'") ;
$message = "SUPER ADMIN SUCCESSFULLY UPDATED!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script>window.location = 'viewsuperadmins.php'</script>";

}

?>