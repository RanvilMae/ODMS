<?PHP

session_start();

if (!isset($_SESSION['log'])) {
header('Location: index.php');
}

?>
<?php 
require("conn.php");
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

    <link rel="icon" href="images/TIEZAlogo.png" type="image/gif" sizes="16x16">
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
	 	 body, html {
			background-image: url("bg.png");
			height: 100%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
.jumbotron{
		background-image: url("bg.png");
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
       .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        font-size: 15px;
        background-color: #007acc;
        color: white;
        text-align: center;
        height: 4rem;
    }

    </style>
    <!-- Custom styles for this template -->
  
  </head>
  <body>

<?php include 'navigation_superadmin.php';?>

	<?php
			
		$id = (int) $_SESSION['log'];
			
		$query = $conn->query ("SELECT * FROM superadmin WHERE id = '$id' ") or die (mysql_error());
		$fetch = $query->fetch_array ();
	{
		$fname=$fetch['fname'];
		$mname=$fetch['mname'];
		$lname=$fetch['lname'];
		}
		str_replace($fetch['password'], "********", $fetch['password'])
		?>


<main role="main" class="container">
  <div class="jumbotron">
    <form action="qr_printing.php" method="post" enctype="multipart/form-data" >
      <div class="form-group">
 <h3><strong>PRINT QR</strong></h3>
  <hr>
 
	  
	  <div class="row"required>
			  <label><strong>QR Code:</strong></label>
			  <input type="text" class="form-control" placeholder="Enter QR Code" name="qrCode" required />
		</div>  <br>
		   
		<button type="submit" class="btn btn-primary float-right" name="sub" >
			<i class="fas fa-print"></i>
		</button>

	</div>
	</form>
</div>
	<div class="row">
<footer class="footer">
    <div class="inner">
    <strong>Copyright &copy; 2019. All rights reserved.<br>Management Information Systems Department.</strong>
    <div class="float-right d-none d-sm-inline-block">
    </div>
    </div>
</footer>
</div>

</main>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
      </body>
</html>
<?php

	include('conn.php');
	if (isset($_POST['signup']))
{
	$position=$_POST['position'];
	$tid=$_POST['tid'];
	$fname=$_POST['fname'];
	$fname = strtoupper($fname);
	$lname=$_POST['lname'];
	$lname = strtoupper($lname);
	$mname=$_POST['mname'];
	$mname = strtoupper($mname);
	$email=$_POST['email'];
	$password=md5($_POST['password']);
		date_default_timezone_set("Asia/Manila");
				$date = date('Y-m-d H:i:s');
	$department=$_POST['department'];
		
	$query = $conn->query("SELECT * FROM `users` WHERE  tid = '$tid'");
	$check = $query->num_rows;
		
		if($check == 1)
			{
				echo "<script>alert('USER ALREADY EXIST')</script>";	 
			}
			
			else
				{
					$conn->query ("INSERT INTO users (position, tid, fname, lname, mname, email, password, date, department )
					VALUES ('$position', '$tid', '$fname', '$lname', '$mname', '$email', '$password', '$date', '$department')") or die(mysqli_error());	
					echo "<script>alert('USER SAVED!')</script>"; 
					exit(); 
				}				
					
}

?>