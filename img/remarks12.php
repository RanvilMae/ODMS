<?PHP

session_start();

if (!isset($_SESSION['login'])) {
header('Location: index.php');
}

?>
<?php 
require("conn.php");
include 'filesLogic.php';
include('pagination_admin.php');
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
    </style>
    <!-- Custom styles for this template -->
  
  </head>
  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <a class="navbar-brand" href="#">Document Management System   ||  </a>
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
		<a class="nav-link active" href="viewdata.php"> VIEW</a>
		<a class="nav-link" href="archive.php"> ARCHIVE</a>	
		<a class="nav-link" href="search.php"> SEARCH</a>
								
      </li>
    </ul>

		<?php
				$id = (int) $_SESSION['login'];
			
					$query = $conn->query ("SELECT * FROM admin WHERE id = '$id' ") or die (mysqli_error());
					$fetch = $query->fetch_array ();
			?>
				<div class=" text-monospace float-right dropdown text-decoration-none " style="color:WHITE">	
				<strong>WELCOME:</strong> <a class="text-monospace " href="#" data-toggle="modal" data-target="#exampleModal" style="color:WHITE" ><?php echo $fetch['fname']; ?> <?php echo $fetch['mname']; ?> <?php echo $fetch['lname']; ?></a></div>
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
								
										<div style="overflow-x:auto;">
											<div class="modal-body">
												<table class="table">
												<tr>
																<th scope="col"><strong>TIEZA ID Number:</strong>
																<th scope="col"><?php echo $fetch['tid'];?><br>
															</tr>
															<tr>
																<th scope="col"><strong>First Name:</strong>
																<th scope="col"><?php echo $fetch['fname'];?><br>
															</tr>
																<tr>
																<th scope="col"><strong>Middle Name:</strong>
																<th scope="col"><?php echo $fetch['mname'];?><br>
															</tr>
																<tr>
																<th scope="col"><strong>Last Name:</strong>
																<th scope="col"><?php echo $fetch['lname'];?><br>
															</tr>
															<tr>
																<th scope="col"><strong>Email:</strong>
																<th scope="col"><?php echo $fetch['email'];?><br>
															</tr>
															<tr>	
															<th scope="col"><strong>Department:</strong>
															<th scope="col"><?php echo $fetch['department'];?><br>
															</tr>
															<tr>
															<th scope="col"><strong>Date Registered:</strong>
															<th scope="col"><?php echo $fetch['date'];?><br>
															</tr>
														</table>
														</div>
												
												
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
</nav>
 <main role="main" class="container-fluid">
  <div class="jumbotron">
    <div class="float-right">   
        <a href="search.php" class="text-decoration-none">
         <button type="button" class="btn btn-primary" >SEARCH</button>
      </button></a>
	  	<?php
		if ($fetch['department']== 'MISD'){
			?>
				<a href="downloadbulk_tm_MISD.php" class="btn btn-success">DOWNLOAD</a>
		<?php } ?>
		<?php
		if ($fetch['department']== 'TTAXD'){
			?>
				<a href="downloadbulk_tm_TTAXD.php" class="btn btn-success">DOWNLOAD</a>
		<?php } ?>
   </div>
    <div>
       <h3><strong>VIEW DATA</strong></h3>
    </div>
    <div>
      <hr>
    </div>
    <?php 
    include('pagination_admin.php');
    ?>
    <div class="btn btn-dark" style="text-decoration-none;font-size:150%;"  id="pagination_controls"><?php echo $paginationCtrls; ?></div>
      <div class="col-lg-2"><br>
    </div>

      <hr>
  <div style="overflow-x:auto;">
    <table class="table table-dark">    

<!--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
Download
</button></div>	

<!-- Modal for download 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	
      <div class="modal-header">
	  
        <h5 class="modal-title" id="exampleModalLabel">Download</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
      <div class="modal-body">
        Are you sure you want to download all files?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a class="pull-right" href="downloadbulk.php">
		<button type="button" class="btn btn-success" >OK</button></a>
      </div>
    </div>
  </div>
</div>-->

    
    <tr>
        <td><strong>RECORD ID</strong></td>
        <td><strong>FROM</strong></td>
        <td><strong>SUBJECT</strong></td>
		<td><strong>DATE</strong></td>
		<td><strong>FILE TYPE</strong></td>
		<td align="center"><strong>ACTION</strong></td>
    </tr>
    <tbody>

	
	<!--- MISD -->
	 <?php
	 $id = (int) $_SESSION['login'];
		$query = $conn->query ("SELECT department FROM `admin` WHERE id = '$id' ") or die (mysqli_error());
		$fetch = $query->fetch_array ();
		if ($fetch['department']  == 'MISD'){
			$nquery=mysqli_query($conn,"select * from `files` WHERE department = 'MISD'  ORDER BY id DESC $limit");
			while($fetch = mysqli_fetch_array($nquery)){
			?>
	
        <tr>
          <td><?php echo $fetch['id']; ?></td>
          <td><?php echo $fetch['fromw']; ?></td>
          <td><?php echo $fetch['subject']; ?></td>
          <td><?php echo $fetch['date']; ?></td>
          <td><?php echo $fetch['restriction']; ?></td>
		   
			 <td align="center">

				<button type="button" class="btn btn-info">
				<a data-toggle="modal" data-target="#myModal<?php echo $fetch['id']?>" style="text-decoration-none;color:white;">
						REMARKS</a></button>
					&nbsp;
				
			</a>
			</td>
	
		   <!---Moadal for EDit ----->
				<div class="modal fade" id="myModal<?php echo $fetch['id']?>" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
			
							<form method="POST" action="update.php">
								<div class="modal-header">
									<h3><strong></label>UPDATE</strong></h3>
								</div>
								<div class="modal-body">
								
								<?php 
									$id = $fetch['id'];
									$query = $conn->query ("SELECT * FROM remarks WHERE id = $id ORDER by date DESC") or die (mysql_error());
									while($fetch = mysqli_fetch_array($query)){
										
											
											echo $fetch['date'];
											echo "</br>";
											echo $fetch['remarks'];
											echo "</br>";echo "</br>";
									
									}?>
									
								
								</div>
							
							
								</div>
							</form>
						</div>
					</div>
				</div>
			
			
	<?php
		}		}
		?>


    </tbody>
    </table>
	
  </div>
  </main>
  	 <p class="mt-5 mb-3 text-muted text-center">&copy; TIEZA-MISD 2019</p>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
      </body>
</html>

<?php
require('conn.php');
if (isset($_POST['save'])) {
			$id=$_POST['id'];
			$forw=$_POST['forw'];
			$fromw=$_POST['fromw'];
			$tow=$_POST['tow'];
			$re=$_POST['re'];
			$subject=$_POST['subject'];
			$date=$_POST['date'];
			$description=$_POST['description'];
			$signatory=$_POST['signatory'];
mysqli_query($conn, "UPDATE `files` SET `forw` = '$forw', `fromw` = '$fromw', `tow` = '$tow', `re` = '$re', `subject` = '$subject', `date` = '$date', `description` = '$description', `signatory` = '$signatory' WHERE `id` = '$id'");
		$message = "FILE SUCCESSFULLY UPDATED!";
		echo "<script type='text/javascript'>alert('$message');</script>";
			$conn->close();
			
}
?>
