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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<!-- <script>
history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script> -->

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
			color:white;
	  }	  
	a:hover {
		  text-decoration-none;
		  color:white;
		}
			  a:hover {
  text-decoration-none;
  color:white;
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
		<a class="nav-link active" href="viewdata.php"> VIEW</a>
		<a class="nav-link" href="archive.php"> ARCHIVE</a>	
		<a class="nav-link" href="search.php"> SEARCH</a>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
								
										<form method="POST" action="update_info.php">
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
												</form>

	</div>
</nav>
 <main role="main" class="container-fluid">
  <div class="jumbotron">
        <h3><strong>USERS</strong></h3>

      <hr>

    <div style="overflow-x:auto;">
    <table class="table table-dark">  
    <thead>
        <th>TIEZA ID</th>
        <th>NAME</th>
        <th>EMAIL</th>
		<th>DEPARTMENT</th>
		<th><strong>EDIT</strong></th>
		<th><strong>DELETE</strong></th>
    </thead>
    <tbody>
<?php
$query = $conn->query ("SELECT * FROM users") or die (mysqli_error());
			while($file = mysqli_fetch_array($query)){
			?>
        <tr>
          <td><?php echo $file['tid']; ?></td>
          <td><?php echo $file['username']; ?></td>
          <td><?php echo $file['email']; ?></td>
		  <td><?php echo $file['department']; ?></td>
		   <td> <button type="button" class="btn btn-info">
				   <a data-toggle="modal" data-target="#myModal<?php echo $file['id']?>" style="text-decoration-none;color:white;">
					EDIT</button>
			</a>
			</td>
			
		    <!---Moadal for EDit ----->
			<div class="modal fade" id="myModal<?php echo $file['id']?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		
			<form method="POST" action="update.php">
				<div class="modal-header">
					<h3><strong></label>UPDATE</strong></h3>
				</div>
				<div class="modal-body">
			<label for="forw"><strong>NAME:</strong></label>
			<input type="hidden" name="id" value="<?php echo $file['id']?>"/>
			<input class="form-control col-sm-11" type="text" name="forw" placeholder="For:" 
			value="<?php echo $file['username'];?>" />
		
		
			<label for="from"><strong>EMAIL:</strong></label>
			<input class="form-control col-sm-11" type="text" name="fromw" placeholder="From:" 
			 value="<?php echo $file['email'];?>" />
		
		
			<label for="tow"><strong> DEPARTMENT:</strong></label>
			<input class="form-control col-sm-11" type="text" name="tow" placeholder="To:" 
			 value="<?php echo $file['department'];?>" />
	
		
	
			<div style="clear:both;"></div>
					<div class="modal-footer">
						<button name="save" class="btn btn-primary"> SAVE</button>
						<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> CLOSE</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<td>
<button type="button" name="delete" name="fileToRemove" value="C:\xampp\htdocs\FMS\uploads<?php echo $file['name']?>" class="btn btn-danger">
 <a data-toggle="modal" name="fileToRemove" value="C:\xampp\htdocs\FMS\uploads<?php echo $file['name']?>" data-target="#delete<?php echo $file['id']?>" style="text-decoration-none;color:white;">
DELETE
</button></a></td>
<div class="modal fade" id="delete<?php echo $file['id']?>" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><strong>Delete</h5></strong>
				</div>
				<div class="modal-body">
			Are you sure you want to delete data <strong><?php echo $file['subject'] ?>?</strong>
			<div class="modal-footer">
         <a href="deleteData.php?name=<?php echo $file['name'] ?>"  class="btn btn-danger">DELETE</a>
						 <button type="button" name="delete" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
					</div>
      </div>
    </div>
  </div>
</div>    
     
 
    
	<?php
				} 
		?>



    </tbody>
    </table>
	</div>
  </div>
  	 <p class="mt-5 mb-3 text-muted text-center">&copy; TIEZA-MISD 2019</p>
</main>
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
