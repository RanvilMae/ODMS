<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<?php
	include ("conn.php");
	
	if(ISSET($_POST['update'])){
		$id = $_POST['id'];
		$newpassword = md5($_POST['newpassword']);
		$confirmpassword = md5($_POST['confirmpassword']);
		$oldpassword = md5($_POST['oldpassword']);
		
		if($newpassword == $confirmpassword){
			$query = $conn->query("SELECT * FROM `users` WHERE `id` = '$id' && `password` = '$oldpassword'") or die($conn->error());
			$valid = $query->num_rows;
			
			if($valid > 0){
				$conn->query("UPDATE `users` SET `password` = '$newpassword' WHERE `id` = '$id'") or die($conn->error());
				echo "<script>alert('PASSWORD UPDATED')</script>";
				echo "<script>window.location = 'logout.php'</script>";
			}else{
				echo "<script>alert('PASSWORD DOES NOT MATCHED TO OLD PASSWORD!')</script>";
				echo "<script>window.location = 'cpm_tm.php'</script>";
			}
			
		}else{
			echo "<script>alert('PASSWORD DOES NOT MATCH!')</script>";
			echo "<script>window.location = 'cpm_tm.php'</script>";
		}
		
		
		
		
		
	}
?>