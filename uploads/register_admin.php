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
 
<main role="main" class="container">
  <div class="jumbotron">
    <form action="register_admin.php" method="post" enctype="multipart/form-data" >
      <div class="form-group">
 <h3><strong>CREATE ACCOUNT FOR ADMIN</strong></h3>
  <hr>
 <form id="info" method="post">
 
	<div class="row"required>
		<div class="col">
			  <label><strong>FIRST NAME:</strong></label>
			  <input type="text" class="form-control" placeholder="Enter First Name" name="fname" /><br>
		</div>
		
		<div class="col">  
		 <label><strong>MIDDLE NAME:</strong></label>
			  <input type="text" class="form-control" placeholder="Enter Middle Name" name="mname" /><br>
		</div>
		<div class="col">
			 <label><strong>LAST NAME:</strong></label>
			  <input type="text" class="form-control" placeholder="Enter Last Name" name="lname" /><br>
		</div>
		</div>
	  <div class="row"required>
		<div class="col">
			 <label><strong>Date: </strong></label>
					<input class="form-control" name="date" disabled value="<?php date_default_timezone_set("Asia/Manila"); echo date("Y-m-d H:i:s");?>">
						
		
		</div>
	
		<div class="col">
			<label><strong>DEPARTMENT:</strong></label>
			<select input name="department" class="form-control" id="department" required>	
	
			<?php
			require("conn.php");
			$query = "SELECT department FROM department ORDER BY department ASC";
			$result = $conn->query($query);	
			
			echo $_GET['department'];
				while($row = $result->fetch_assoc()){
				echo "<option value='" . $row['department'] ."'>" . $row['department'] ."</option>";}
			?>
			</select><br>
		</div>
		</div>
	  
	  <div class="row"required>
		<div class="col">
			  <label><strong>TIEZA ID Number:</strong></label>
			  <input type="text" class="form-control" placeholder="Enter ID Number" name="tid" value="A-" /><br>
		</div>
		
		<div class="col">	  
			  <label><strong>EMAIL:</strong></label>
			  <input type="email" class="form-control"  placeholder="Enter Email" name="email" /><br>
		  
		</div>
		<div class="col">	  
			  <label><strong>POSITION:</strong></label>
			  <select input type="text" class="form-control"  placeholder="Enter position" name="position" ><br>
			
					<?php
					require("conn.php");
					$query = "SELECT position FROM position ORDER BY position ASC";
					$result = $conn->query($query);	
					
					echo $_GET['position'];
						while($row = $result->fetch_assoc()){
						echo "<option value='" . $row['position'] ."'>" . $row['position'] ."</option>";}
					?>
				</select><br>
		</div>
		</div>
	  </div>  
			 
			 <input type="hidden" class="form-control"  placeholder="Enter Password" name="password" value="password"/><br>
		   
		<button type="submit" class="btn btn-primary float-right" name="signup" value="REGISTER"><i class="fas fa-user-plus"></i></button>

	</div>
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
	$position=$_POST['position'];	
	
		
	$query = $conn->query("SELECT * FROM `admin` WHERE `tid` = '$tid'");
	$check = $query->num_rows;
		
		if($check == 1)
			{
				echo "<script>alert('USER ALREADY EXIST')</script>";	 
			}
			
			else
				{
					$conn->query ("INSERT INTO admin ( tid, fname, mname, lname, email, password, date, department, position )
					VALUES ('$tid', '$fname', '$mname',  '$lname', '$email', '$password', '$date', '$department', '$position')") or die(mysqli_error());	
					echo "<script>alert('ADMIN SAVED!')</script>"; 
					exit(); 
				}				
					

}
?>