
<?php 
	include('conn.php');
?>
<?PHP

session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TIEZA-MISD">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>TIEZA Portal</title>

    <link rel="icon" href="images/tiezaportal.ico" type="image/gif" sizes="16x16">
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
  </head>
  <body>
    <header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras efficitur tincidunt sodales. Nam vulputate elit id tortor tempor, eu iaculis risus pulvinar. Aliquam tincidunt risus magna, sed sollicitudin dui imperdiet ut. Praesent tempus fringilla diam vel placerat. Curabitur vel lacus vitae elit rhoncus malesuada. Nam in pharetra urna.</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <center><h4 class="text-white">For inquiries and concerns</h4></center>
          <ul class="list-unstyled">
            <li class="list-group-item">Please create a ticket at: ITSR</li>
            <li class="list-group-item">Call us at: Loc. 609</li>
            <li class="list-group-item">Email us at: mis@tieza.gov.ph</li><br>


<!-------
		<?php
				$id = (int) $_SESSION['id'];
			
					$query = $conn->query ("SELECT * FROM users WHERE id = '$id' ") or die (mysqli_error());
					$fetch = $query->fetch_array ();
			?>
	
		<div class=" text-monospace float-right dropdown text-decoration-none " style="color:WHITE"><a style="color:WHITE" class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<strong>WELCOME,</strong>
			<?php
					echo $fetch['username'];
				?>
			</a>
                      </a>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                       <a class="dropdown-item " href="a.php"><strong>EDIT PROFILE</strong></a>
                       <a class="dropdown-item" href="logout.php"><strong>LOGOUT</strong></a>
	
                      </div>
                    </div>

	</div>
	<div >
					</div> ---->
	

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
											<div class="modal-body">
												
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
												</form>
											</div>
																</div>
															</div>  
														</div>


								</div>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <span style="padding-right: 3px;"><i class="fas fa-network-wired"></i></span>
        <strong>TIEZA PORTAL</strong>
      </a>
	  

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main role="main" class="flex-shrink-0">

  <div class="album py-5 bg-light">
    <div class="container">

        <div class="row">
          <div class="col-sm">
          <a href="home.php" style="text-decoration: none;">
          <div class="card text-white mb-3" style="background-color: #448AFF;">
              <div class="card-header"></div>
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 font-weight text-uppercase mb-1">FMS</div>
                    <div class="font-weight mb-1">FILE MANAGEMENT SYSTEM</div>
                  </div>
                  <div class="col-auto">
                    <i class="far fa-folder-open fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
          </div>
          <div class="col-sm">
          <a href="http://192.168.2.165/frame.html" style="text-decoration: none;">
          <div class="card text-white mb-3" style="background-color: #607D8B;">
              <div class="card-header"></div>
              <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="h5 font-weight text-uppercase mb-1">ALAS</div>
                  <div class="font-weight mb-1">TIME KEEPING</div>
                </div>
                <div class="col-auto">
                  <i class="far fa-clock fa-3x"></i>
                </div>
              </div>
              </div>
            </div>
          </a>
          </div>
          <div class="col-sm">
		   <a href="forms_admin.php" style="text-decoration: none;">
            <div class="card text-white mb-3" style="background-color: #00796B;">
              <div class="card-header"></div>
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 font-weight text-uppercase mb-1">FORMS</div>
                    <div class="font-weight mb-1">TIEZA FORMS</div>
                  </div>
                  <div class="col-auto">
                    <i class="far fa-file fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>
  </div>

</main>

<footer class="footer mt-auto py-3">
  <div class="container">
    <span class="text-muted"><p>&copy; TIEZA-MISD 2019</p></span>
  </div>
</footer>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>
