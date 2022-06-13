<?PHP

session_start();

if (!isset($_SESSION['tm'])) {
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
						
      </li>
  
</nav>
		

							<?php
			
								    $id= $_GET['id'];
			
								$query = $conn->query ("SELECT * FROM files WHERE id = '$id' ") or die (mysql_error());
								$fetch = $query->fetch_array ();
								{
									$id=$fetch['id'];
									$subject=$fetch['subject'];
									$date=$fetch['date'];
									$docu_id=$fetch['docu_id'];
								}
						?>
									
			<main role="main" class="container">
				<div class="jumbotron">
					<form method="post" action="update_remarks_topmanager.php" enctype="multipart/form-data" >
						<div id="form-group">
						<h3><strong>HISTORY</strong></h3>
							 <hr>
								
	
    <div class="row">
							<div class="col-md-5">
												<input type="hidden" name="id" value="<?php echo $fetch['id'];?>"/>
								
												<label><strong>Record ID Number:</strong></label>
												<input class="form-control" type="text" name="id"
												disabled value="<?php echo $id; ?>" /><br>
												
												
												 <label><strong>Date: </strong></label>
												<input class="form-control" name="date" disabled value="<?php date_default_timezone_set("Asia/Manila"); echo date("Y-m-d H:i:s");?>">
											
											
												<label><strong>Remarks: </strong></label>
												<textarea class="form-control" rows="5" placeholder="Remarks" name="remarks" required ></textarea><br>
												
												<div style="clear:both;"></div>
												
							</div>
							<div class="col-md-7">
								<div style="overflow-x:auto;">
								
									<table class="table table-bordered"  style="border: 2px solid black;">  
												<td align="center" style="border: 2px solid black;"><strong>DATE</strong></td> 
												<td align="center" style="border: 2px solid black;" ><strong>STATUS</strong></td>
									<tbody>
												<?php
							
													$id= $_GET['id'];
							
												$query = $conn->query ("SELECT * FROM remarks WHERE id = '$id' ORDER BY date DESC ") or die (mysql_error());
												while($fetch = mysqli_fetch_array($query)){
												?>
												<td style="border: 2px solid black;"><?php echo $fetch['date']; ?></td>
												<td style="border: 2px solid black;"><?php echo $fetch['remarks']; ?></td>
												</tr>	
												<?php } ?> 
									
									
									</tbody>
									</table>
								</div>
							</div>
    </div>
							<div class=" float-right">
													<button name="save" class="btn btn-primary">SAVE</button>
													<a href="viewdata.php" class="text-decoration-none">
													<button type="button" class="btn btn-danger" ><i class="fas fa-window-close"></i></button>
													  </button></a>
												</div>	
							
						</div>
					</form>
				</div>
					</main>		
							
		


	 <p class="mt-5 mb-3 text-muted text-center">&copy; TIEZA-MISD 2019</p>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
      </body>
</html>
