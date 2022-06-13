<?php 
require("conn.php");
?>
<?PHP

session_start();

if (!isset($_SESSION['log'])) {
header('Location: index.php');
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

    <link rel="icon" href="images/TIEZAlogo.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="bootsratp/css/all.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
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
  </head>

  <body>
    <header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted">TIEZA portal is a web-based platform that collects information from different sources into a single user interface and presents to users the most relevant information needed.
			It helps users to bring information from multiple sources together, allowing content to be shared amongst a variety of departments.
		  </div>
       <div class="col-sm-4 offset-md-1 py-4">
			  <center><h4 style="color:WHITE;" >For inquiries and concerns</h4></center>
			  <div class="list-group">
				<div href="#" class="list-group-item">
				  <h6 class="list-group-item-heading">Please create a ticket using ITSR</h6>
				</div>
				 <div href="#" class="list-group-item">
				  <h6 class="list-group-item-heading">Please dial loc. 609</h6>
				</div>
				 <div href="#" class="list-group-item">
				  <h5 class="list-group-item-heading">Please email:</h5>
				  
				  
				  <h6 class="list-group-item-heading">&nbsp;&nbsp;<strong>Systems / Database concerns:</strong></h6>
				  <p class="list-group-item-text" style="color:blue;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i> infosysdev@tieza.gov.ph</p>
				  
				  <h6 class="list-group-item-heading">&nbsp;&nbsp;<strong>Network & Computer concerns:</strong></h6>
				  <p class="list-group-item-text" style="color:blue;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i> netcompservices@tieza.gov.ph</p>
				  
				   <h6 class="list-group-item-heading">&nbsp;&nbsp;<strong>IS Planning / Inventory concerns:</strong></h6>
				  <p class="list-group-item-text" style="color:blue;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i> isplanning@tieza.gov.ph</p>
				  
				  <h6 class="list-group-item-heading">&nbsp;&nbsp;<strong>Email / Web concers:</strong></h6>
				  <p class="list-group-item-text" style="color:blue;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i> webmaster@tieza.gov.ph</p>
				</div>
			</div><br>

			<?php
				$id = (int) $_SESSION['log'];
			
					$query = $conn->query ("SELECT * FROM superadmin WHERE id = '$id' ") or die (mysqli_error());
					$fetch = $query->fetch_array ();
			?>
				<div class=" text-monospace float-right dropdown text-decoration-none " style="color:WHITE"><?php include ("clock.php"); ?>
			<a class="text-monospace " href="#" data-toggle="modal" data-target="#exampleModal" style="color:WHITE" ><i class="fas fa-user"></i> <?php echo $fetch['lname']; ?>, <?php echo $fetch['fname']; ?> <?php echo $fetch['mname']; ?>
												  </a></div>	
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
									$query = $conn->query ("SELECT * FROM superadmin WHERE id = '$id' ") or die (mysqli_error());
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
															</tr>
															<th scope="col"><strong>Position:</strong>
															<th scope="col"><?php echo $fetch['position'];?>
															</tr>
														</table>
														</div>
												
												<div class="modal-footer" >
												  <button class="btn btn-warning btn-sm"><a style="text-decoration:none;color:WHITE;" href="change_pass_s.php?id=<?php echo $fetch['id']; ?>"><i class="fas fa-unlock-alt"></i></a></button>
												
												  <button class="btn btn-success btn-sm"><a style="text-decoration:none;color:WHITE;" href="profile_sadmin.php?id=<?php echo $fetch['id']; ?>"><i class="fas fa-user-edit"></i></a></button>
												
												</div>
												
											</div>	
											</div>
																</div>
															</div>  
														</div>

        </div>
		
      </div>
	  
    </div>
  </div>
  
  
<div class="navbar navbar-dark bg-dark shadow-sm ">
    <div class="container d-flex justify-content-between float-right">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <span style="padding-right: 3px;"><i class="fas fa-network-wired"></i></span>
        <strong>TIEZA PORTAL</strong>
      </a>
	  
		<div class="float-right">
      <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
	&nbsp;

	  

	     <button class="btn btn-danger btn-sm">
			<a data-toggle="modal" data-target="#myModal" href="logout.php" style="text-decoration-none;color:white;">
				<i class="fas fa-power-off"></i></a>
			</button>&nbsp;
		
		<div class="modal fade" id="myModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">

           <h3 class="modal-title"><strong>LOG OUT</strong></h3>
        </div>
          
          <div class="modal-body">
				<strong><?php echo $fetch['fname']; ?></strong> are you sure you want to log out?
          </div>
            <div class="modal-footer">
		  <button class="btn btn-danger" > <a style="text-decoration:none;color:white;"  href="logout.php" ><i class="fas fa-sign-out-alt"></i></a></button>
            <button type="button" class="btn btn-info " data-dismiss="modal" onclick="redirectToPrevPage()"><i class="fas fa-window-close"></i></button>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
		
		
		</div>
    </div>
  </div>
</header>

<main role="main" class="flex-shrink-0">

  <div class="album py-5 bg-light">
    <div class="container">

        <div class="row">
         
          <div class="col-sm">
          <a href="shome.php" style="text-decoration: none;">
          <div class="card text-white mb-3" style="background-color: #448AFF;">
              <div class="card-header"></div>
              <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="h5 font-weight text-uppercase mb-1"><strong>DMS</strong></div>
                  <div class="font-weight mb-1">DOCUMENT MANAGEMENT SYSTEM</br></br></div>
                </div>
                <div class="col-auto">
                  <i class="far fa-file fa-3x"></i>
                </div>
              </div>
              </div>
            </div>
          </a>
          </div>
          <div class="col-sm">
       <a href="http://attendance.tieza.gov.ph" target="_blank" style="text-decoration: none;">
            <div class="card text-white mb-3" style="background-color: #607D8B;">
              <div class="card-header"></div>
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 font-weight text-uppercase mb-1"><strong>ONLINE ATTENDANCE SYSTEM</strong></div>
                    <div class="font-weight mb-1">ONLINE ATTENDANCE</br></br></div>
                  </div>
                  <div class="col-auto">
                    <i class="far fa-clock fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm">
          <a href="documents_sadmin.php" style="text-decoration: none;">
          <div class="card text-white mb-3" style="background-color: #37474f;">
              <div class="card-header"></div>
              <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="h5 font-weight text-uppercase mb-1"><strong>TIEZA OFFICIAL DOCUMENTS</strong></div>
                  <div class="font-weight mb-1">DOWNLOADABLE</br></br></div>
                </div>
                <div class="col-auto">
                  <i class="far fa-file fa-3x"></i>
                </div>
              </div>
              </div>
            </div>
          </a>
          </div>
          <div class="col-sm">
       <a href="forms_sadmin.php" style="text-decoration: none;">
            <div class="card text-white mb-3" style="background-color: #00796B;">
              <div class="card-header"></div>
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 font-weight text-uppercase mb-1"><strong>TIEZA OFFICIAL FORMS</strong></div>
                    <div class="font-weight mb-1">DOWNLOADABLE</br></br></div>
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

<div class="row">
<footer class="footer">
    <div class="inner">
    <strong>Copyright &copy; 2019. All rights reserved.<br>Management Information Systems Department.</strong>
    <div class="float-right d-none d-sm-inline-block">
    </div>
    </div>
</footer>
</div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>
