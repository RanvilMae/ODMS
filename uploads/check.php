<?php include 'conn.php';?>
<?PHP

session_start();

if (!isset($_SESSION['login'])) {
header('Location: index.php');
}

?>
<?php
	require("conn.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>FMS</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<!-- <script>
history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script> -->
 <link rel="icon" href="images/ss.png" type="image/gif" sizes="48x48">
<link rel="stylesheet" href="dist/bootstrap.min.css" type="text/css" media="all">
<link href="dist/jquery.bootgrid.css" rel="stylesheet" />
<script src="dist/jquery-1.11.1.min.js"></script>
<script src="dist/bootstrap.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
	  .btn{
			text-decoration-none;
			color:white;"
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
    </style>
    <!-- Custom styles for this template -->
    <link href="navbar-top.css" rel="stylesheet">
  </head>
  <body>
	
    <!-- Custom styles for this template -->
    <link href="navbar-top.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <a class="navbar-brand" href="home.php">File Management System  ||  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      <li class="nav-item">
	</li>
		<a class="nav-link" href="admin.php"> PORTAL</a>
		<a class="nav-link" href="upload.php"> UPLOAD</a>
		<a class="nav-link" href="viewdata.php"> VIEW</a>
		<a class="nav-link" href="archive.php"> ARCHIVE</a>	
		<a class="nav-link" href="search.php"> SEARCH</a>
					         <div class="dropdown">
                      <a class="nav-link dropdown-toggle active" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        REGISTRATION
                      </a>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="register_user.php">User</a>
                        <a class="dropdown-item" href="register_admin.php">Admin</a>
                      </div>
                    </div>
									
      </li>
    </ul>
	<?php
				$id = (int) $_SESSION['login'];
			
					$query = $conn->query ("SELECT * FROM admin WHERE id = '$id' ") or die (mysqli_error());
					$fetch = $query->fetch_array ();
			?>
				<div class=" text-monospace float-right dropdown text-decoration-none " style="color:WHITE">	
				<strong>WELCOME:</strong> <a class="text-monospace " href="index.php" data-toggle="modal" data-target="#exampleModal" style="color:WHITE" ><?php echo $fetch['username']; ?></a></div>
					<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
								
								  <div class="modal-header">
								  
									<h5 class="modal-title" id="exampleModalLabel"><strong>MY PROFILE</strong></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
									</button>
								  </div>
								  
								  <div class="modal-body">
								  <?php
									$query = $conn->query ("SELECT * FROM admin WHERE id = '$id' ") or die (mysqli_error());
									$fetch = $query->fetch_array ();
									?>			
											<div class="modal-body ">
												<div style="overflow-x:auto;">
																
																<table>
															<tr>
																<strong>TIEZA ID Number:</strong>&nbsp;<?php echo $fetch['tid'];?><br>
															</tr><br>
															<tr>
																<strong>Name:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fetch['username'];?></div><br>
															</tr><br>
															<tr>
																<strong>Email:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fetch['email'];?></td></div><br>
															</tr><br>
															<tr>
																<strong>Department:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fetch['department'];?></div><br>
															</tr><br>
															<tr>
																<strong>Date Registered:</strong>&nbsp;&nbsp;&nbsp;<?php echo $fetch['date'];?></div><br>
															</tr>
														</table><br>
												<div class="modal-footer" >
												  <button class="btn btn-warning btn-sm"><a style="text-decoration:none;color:white;" href="change_pass.php?id=<?php echo $fetch['id']; ?>">CHANGE PASSWORD</a></button>
												
												  <button class="btn btn-success btn-sm"><a style="text-decoration:none;color:white;"href="profile_admin.php?id=<?php echo $fetch['id']; ?>">EDIT PROFILE</button></a>
												
												<button class="btn btn-danger btn-sm"> <a style="text-decoration:none;color:white;" href="logout.php">LOGOUT</a></button>
											
												</div>
											  </div>
											</div>	
											
																</div>
															</div>  
														</div>
												

	</div>
</nav>

	<?php
			
		$id = (int) $_SESSION['login'];
			
		$query = $conn->query ("SELECT * FROM admin WHERE id = '$id' ") or die (mysql_error());
		$fetch = $query->fetch_array ();
	{
		$username=$fetch['username'];}
		str_replace($fetch['password'], "********", $fetch['password'])
		?>


<main role="main" class="container">
  <div class="jumbotron">
      <div class="form-group">
 <h3><strong>CREATE ACCOUNT FOR USER</strong></h3>
  <hr>  
   <form action="" method="post" enctype="multipart/form-data">  

      
      <input type="checkbox" name="techno[]" value="1"> <label>Confidential</label>

      
     <input type="checkbox" name="techno[]" value="2"> <label>Highly Confidential</label>
	
	
     <input type="checkbox" name="techno[]" value="3"> <label>Open to All</label><br>
     
	<label><strong>TIEZA ID Number:</strong></label>
      <input type="text" class="form-control" placeholder="Enter ID Number" name="idn" required /><br>	 
   
	<label><strong>User Name:</strong></label>
      <input type="text" class="form-control" placeholder="Enter Full Name" name="username" required /><br>
     
	 <label><strong>Email:</strong></label>
      <input type="email" class="form-control"  placeholder="Enter Email" name="email" required /><br>
	 
	 <label><strong>Password:</strong></label>
      <input type="password" class="form-control"  placeholder="Enter Password" name="password" required /><br>
	 
	 <label><strong>Confirm Password:</strong></label>
		<input  class="form-control" type="password" name="confirmpassword" placeholder="******" /><br> 
	 
   <label><strong>Date:</strong></label>
      <input type="date" class="form-control" name="date" required><br>
  
      <label><strong>Department</strong></label>
      <input type="text" class="form-control"  placeholder="Enter Department" name="department" required><br>

	 
  <input type="submit" value="submit" name="sub"></td> 

</div>  
</form>  
<?php  
if(isset($_POST['sub']))  
{  
$host="96.44.174.18";//host name  
$username="tiezagov_tieza_portal"; //database username  
$word=")SCCZqTZ3M,b";//database word  
$db_name="tiezagov_tieza_portal";//database name  
$tbl_name="topmanager"; //table name  
$con=mysqli_connect("$host", "$username", "$word","$db_name")or die("cannot connect");//connection string  
$checkbox1=$_POST['techno'];  
$chk="";  
$password=md5($_POST['password']);
$confirmpassword = md5($_POST['confirmpassword']);
$username=$_POST['username'];
$email=$_POST['email'];
$date=$_POST['date'];
$department=$_POST['department'];
$idn=$_POST['idn'];

	if($password == $confirmpassword){	
		
	$query = $conn->query("SELECT * FROM `topmanager` WHERE `email` = '$email'");
	$check = $query->num_rows;
		
		if($check == 1)
			{
				echo "<script>alert('EMAIL ALREADY EXIST')</script>";	 
			}
			
			else{
					foreach($checkbox1 as $chk1)  
					   {  
						  $chk .= $chk1;  
					   }  
					$in_ch=mysqli_query($con,"INSERT INTO topmanager(restriction, password, username, email, date, department, idn) values ('$chk', '$password', '$username', '$email', '$date', '$department', '$idn')");  
					echo "<script>alert('USER SAVED!')</script>"; 
					exit(); 
			}
	}else{
			echo "<script>alert('PASSWORD DOES NOT MATCH!')</script>";
			echo "<script>window.location = 'register_user.php'</script>";
		} 

}  
?>  
</body>  
</html>  