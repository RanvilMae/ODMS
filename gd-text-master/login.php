<?php
include 'conn.php';
session_start();
	if(isset($_POST['login'])){
		//set login attempt if not set
		if(!isset($_SESSION['attempt']))
			{
				$_SESSION['attempt'] = 0;
			}
        
		$tid = stripslashes($_REQUEST['tid']); // removes backslashes
		$tid = mysqli_real_escape_string($conn,$tid); //escapes special characters in a string
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($conn,$password);
		$tid=$_POST['tid'];
		$password=$_POST['password'];
		
        
			//get the user with the email
		$query = $conn->query("SELECT * FROM `users` WHERE `tid` = '$tid' AND password='".md5($password)."' AND position ='Rank and File'");
		/*var_dump($conn).'<br>';
		var_dump($_POST).'<br>';
		var_dump($query);
		return false;*/
		$row=$query->fetch_array  ();
		
		$run_num_rows = $query->num_rows;
			if ($run_num_rows > 0 ){
				$password = $row['password'];
					if ($password != '5f4dcc3b5aa765d61d8327deb882cf99' ){
									$_SESSION['id'] = $row['id'];
									header ('location:user.php');
									unset($_SESSION['attempt']);
								}
				elseif ($password = '5f4dcc3b5aa765d61d8327deb882cf99' ){
									$_SESSION['cid'] = $row['id'];
									header ('location:cpm_user.php');
									unset($_SESSION['attempt']);
								}
			}
			else
				{				
				$tid = stripslashes($_REQUEST['tid']); // removes backslashes
				$tid = mysqli_real_escape_string($conn,$tid); //escapes special characters in a string
				$password = stripslashes($_REQUEST['password']);
				$password = mysqli_real_escape_string($conn,$password);
				$tid=$_POST['tid'];
				$password=$_POST['password'];
				$query = $conn->query("SELECT * FROM `users` WHERE `tid` = '$tid' AND password='".md5($password)."' AND position ='Supervisory' ");
				$row=$query->fetch_array  ();
				$run_num_rows = $query->num_rows;
					if ($run_num_rows > 0 ){
						$password = $row['password'];
							if ($password != '5f4dcc3b5aa765d61d8327deb882cf99' ){
									$_SESSION['m'] = $row['id'];
									header ('location:manager.php');
									unset($_SESSION['attempt']);
								}
							elseif ($password = '5f4dcc3b5aa765d61d8327deb882cf99' ){
									$_SESSION['cm'] = $row['id'];
									header ('location:cpm_m.php');
									unset($_SESSION['attempt']);
								}
						}
			else
				{				
				$tid = stripslashes($_REQUEST['tid']); // removes backslashes
				$tid = mysqli_real_escape_string($conn,$tid); //escapes special characters in a string
				$password = stripslashes($_REQUEST['password']);
				$password = mysqli_real_escape_string($conn,$password);
				$tid=$_POST['tid'];
				$password=$_POST['password'];
				$query = $conn->query("SELECT * FROM `users` WHERE `tid` = '$tid' AND password='".md5($password)."' AND position ='Manager' ");
				$row=$query->fetch_array  ();
				$run_num_rows = $query->num_rows;
					if ($run_num_rows > 0 ){	
						$password = $row['password'];
							if ($password != '5f4dcc3b5aa765d61d8327deb882cf99' ){
									$_SESSION['tm'] = $row['id'];
									header ('location:topmanager.php');
									unset($_SESSION['attempt']);
								}
							elseif ($password = '5f4dcc3b5aa765d61d8327deb882cf99' ){
									$_SESSION['ctm'] = $row['id'];
									header ('location:cpm_tm.php');
									unset($_SESSION['attempt']);
								}
						}
			
			else
				{				
				$tid = stripslashes($_REQUEST['tid']); // removes backslashes
				$tid = mysqli_real_escape_string($conn,$tid); //escapes special characters in a string
				$password = stripslashes($_REQUEST['password']);
				$password = mysqli_real_escape_string($conn,$password);
				$tid=$_POST['tid'];
				$password=$_POST['password'];
				$query = $conn->query("SELECT * FROM `admin` WHERE `tid` = '$tid' AND password='".md5($password)."'");
				$row=$query->fetch_array  ();
				$run_num_rows = $query->num_rows;
					if ($run_num_rows > 0 ){	
						$password = $row['password'];
							if ($password != '5f4dcc3b5aa765d61d8327deb882cf99' ){
									$_SESSION['login'] = $row['id'];
									header ('location:admin.php');
									unset($_SESSION['attempt']);
								}
							elseif ($password = '5f4dcc3b5aa765d61d8327deb882cf99' ){
									$_SESSION['clogin'] = $row['id'];
									header ('location:cpm_a.php');
									unset($_SESSION['attempt']);
								}
						}
			else
				{				
				$tid = stripslashes($_REQUEST['tid']); // removes backslashes
				$tid = mysqli_real_escape_string($conn,$tid); //escapes special characters in a string
				$password = stripslashes($_REQUEST['password']);
				$password = mysqli_real_escape_string($conn,$password);
				$tid=$_POST['tid'];
				$password=$_POST['password'];
				$query = $conn->query("SELECT * FROM `centraladmin` WHERE `tid` = '$tid' AND password='".md5($password)."'");
				$row=$query->fetch_array  ();
				$run_num_rows = $query->num_rows;
					if ($run_num_rows > 0 ){	
						$password = $row['password'];
							if ($password != '5f4dcc3b5aa765d61d8327deb882cf99' ){
									$_SESSION['loginc'] = $row['id'];
									header ('location:centraladmin.php');
									unset($_SESSION['attempt']);
								}
							elseif ($password = '5f4dcc3b5aa765d61d8327deb882cf99' ){
									$_SESSION['clogin'] = $row['id'];
									header ('location:cpm_ca.php');
									unset($_SESSION['attempt']);
								}
						}
						
			else
				{				
				$tid = stripslashes($_REQUEST['tid']); // removes backslashes
				$tid = mysqli_real_escape_string($conn,$tid); //escapes special characters in a string
				$password = stripslashes($_REQUEST['password']);
				$password = mysqli_real_escape_string($conn,$password);
				$tid=$_POST['tid'];
				$password=$_POST['password'];
				$query = $conn->query("SELECT * FROM `superadmin` WHERE `tid` = '$tid' AND password='".md5($password)."'");
				$row=$query->fetch_array  ();
				$run_num_rows = $query->num_rows;
					if ($run_num_rows > 0 ){	
						$password = $row['password'];
							if ($password != '5f4dcc3b5aa765d61d8327deb882cf99' ){
									$_SESSION['log'] = $row['id'];
									header ('location:superadmin.php');
									unset($_SESSION['attempt']);
								}
							elseif ($password = '5f4dcc3b5aa765d61d8327deb882cf99' ){
									$_SESSION['clog'] = $row['id'];
									header ('location:cpm_s.php');
									unset($_SESSION['attempt']);
								}
						}
		
			else{
					$_SESSION['attempt'] += 1;
					if($_SESSION['attempt'] == 3)
					{
						$_SESSION['attempt_again'] = time() + (1*60);
						
					}
					
				echo "<script>alert('PASSWORD INCORRECT OR YOU ARE NOT YET REGISTERED!')</script>";
				
				
					}
				}
			}
		}
}
	}
	}
	
?>