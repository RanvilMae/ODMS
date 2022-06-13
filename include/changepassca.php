
<?php
require('conn.php');
				$id = $_GET['id'];
	$password=md5('password');
mysqli_query($conn, "UPDATE `centraladmin` SET `password` = '$password' WHERE `id` = '$id'") ;
$message = "PASSWORD SUCCESSFULLY CHANGED!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script>window.location = 'viewusers.php'</script>";


?>