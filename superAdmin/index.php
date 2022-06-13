
<?php

	include('conn.php');
	if (isset($_POST['login']))
{
	$email = stripslashes($_REQUEST['email']); // removes backslashes
	$email = mysqli_real_escape_string($conn,$email); //escapes special characters in a string
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn,$password);
	
	$email=$_POST['email'];
	$password=$_POST['password'];
	$query = $conn->query("SELECT * FROM `superadmin` WHERE `email` = '$email' AND password='".md5($password)."'");
		$row=$query->fetch_array  ();
	$run_num_rows = $query->num_rows;
					if ($run_num_rows > 0 )
						{
							session_start ();
							$_SESSION['login'] = $row['id'];
							header ('location:sadmin.php');
							
						}
						
					
					else
					{
						
				echo "<script>alert('PASSWORD INCORRECT OR YOU ARE NOT YET REGISTERED!')</script>";
					}
					
}

?>
<!DOCTYPE html>
<html lang="en">
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TIEZA-MISD">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>TIEZA Portal</title>

    <link rel="icon" href="images/tiezaportal.ico" type="image/gif" sizes="16x16">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/floating-labels/">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/floating-labels.css" rel="stylesheet">
  </head>
<div class="form-signin">
      <div class="text-center mb-4">
        <span><img src="images/PORTAL.ico"></span>
        <br>
        <br>
          <h1 class="h3 mb-3">TIEZA PORTAL</h1>
        <hr>
      </div>
		<form action="" method="post" name="login">
		<div class="form-label-group">
		<input type="text" name="email" class="form-control" placeholder="Email" required autofocus />
		<label for="username">Email</label>
		</div>

		<div class="form-label-group">
		<input type="password" name="password" class="form-control" placeholder="Password" required />
		 <label for="password">Password</label>
		</div>
	  <input type="submit" class="btn btn-lg btn-primary btn-block" name="login" value="Login">
	 
 <p class="mt-5 mb-3 text-muted text-center">&copy; TIEZA-MISD 2019</p>

</body>
</html>
