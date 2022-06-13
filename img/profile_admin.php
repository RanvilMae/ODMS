<?PHP

session_start();

if (!isset($_SESSION['login'])) {
header('Location: index.php');
}

?>
<?php 
require("conn.php");
include("fileslogic.php");
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

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <a data-target="#cl" data-toggle="modal" class="MainNavText navbar-brand" id="MainNavHelp" href="#myModal">
		 <?php 
		$query = $conn->query ("select * from `version` ") or die (mysqli_error());
		$fetch = $query->fetch_array ();
		?>

		Online Document Management System <?php echo $fetch['version']; ?>  ||
   </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
 
		
  
</nav>
		

							<?php
			
								$id = (int) $_SESSION['login'];
			
								$query = $conn->query ("SELECT * FROM admin WHERE id = '$id' ") or die (mysql_error());
								$fetch = $query->fetch_array ();
								{
									$tid=$fetch['tid'];
									$fname=$fetch['fname'];
									$mname=$fetch['mname'];
									$lname=$fetch['lname'];
									$email=$fetch['email'];
									$department=$fetch['department'];
								}
						?>
									
			<main role="main" class="container">
				  <div class="jumbotron">
					<form method="post" action="update_info.php" enctype="multipart/form-data" >
						<div id="form-group">
						<h3><strong>EDIT PROFILE</strong></h3>
							 <hr>
							
								<input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
								
								<div class="row"required>
									<div class="col">
										<label><strong>TIEZA ID Number:</strong></label>
										<input class="form-control" type="text"
										disabled value="<?php echo $tid; ?>"><br>
									</div>
								
									<div class="col">
										<label><strong>Department:</strong></label>
										<input class="form-control" type="text"
										disabled value="<?php echo $department; ?>"><br>
										
									</div>
								</div>
								
								<div class="row">
								<div class="col">
									<label><strong>First Name:</strong></label>
									<input class="form-control" type="text" name="fname" placeholder="first name"
										 value="<?php echo $fname; ?>"><br>
								</div>
								
								<div class="col">
									<label><strong>Middle Name:</strong></label>
									<input class="form-control" type="text" name="mname" placeholder="middle name"
										 value="<?php echo $mname; ?>"><br>
								</div>
								<div class="col">
									<label><strong>Last Name:</strong></label>
									<input class="form-control" type="text" name="lname" placeholder="last name"
										 value="<?php echo $lname; ?>"><br>
								</div>
							</div>
										<label><strong>Email:</strong></label>
										<input  class="form-control" type="email" name="email" placeholder="email"
											 value="<?php echo $email;?>"><br>
									
								
									
								<div style="clear:both;"></div>
								<div class="float-right">
								<button name="update" title="SAVE CHANGES" class="btn btn-success">
									<i class="fas fa-save"></i>
								</button>
								<button type="button" name="cancel" title="CANCEL"  class="btn btn-danger ">	
									<a style="text-decoration:none;color:WHITE;" href="admin.php">
										<i class="fas fa-window-close"></i>
									</a>
								</button>
								</div>
					</form>
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
