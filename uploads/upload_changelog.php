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
    </style>
    <!-- Custom styles for this template -->
  
  </head>
  <body>

  	<?php include 'navigation_superadmin.php';?>

<main role="main" class="container">
  <div class="jumbotron">
    <form action="upload_changelog.php" method="post" enctype="multipart/form-data" >
      <div class="form-group">
           <h3><strong>ADD CHANGE LOG</strong></h3>
          <hr>
          <br>
		  
		  
		  <div class="row" required>
		<div class="col">
					<label><strong>Date: </strong></label>
												<input class="form-control" name="date" readonly="read-only" value="<?php date_default_timezone_set("Asia/Manila"); echo date("Y-m-d H:i:s");?>">
		</div><br>
		<div class="col">
			<label><strong>MODULE: </strong></label>
		<input type="text" class="form-control" placeholder="Module" id="module" name="module" required /><br>
	</div>
	</div>	
		
		<label><strong>DESCRIPTION: </strong></label>
		<textarea type="text" class="form-control" placeholder="Description" id="description" name="description" required ></textarea><br>

		<button type="submit" name="sub" class="btn btn-primary float-right"><i class="fas fa-upload"></i></button>
		</div>	  
        </form>
 	
		
      </div>
 </main> 	  
	  <main role="main" class="container">
  <div class="jumbotron"> 
  <div>
    <div class="float-right" style="padding-right: 10px;">
    </div>
    <h3><strong>CHANGE LOG</strong></h3>
        
		<hr>
      </div>
 <div style="overflow-x:auto;">
    <table class="table table-dark">
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>MODULE</strong></td>
		<td><strong>DESCRIPTION</strong></td>
    </tr>
    <tbody>
		<?php
		
			$nquery=mysqli_query($conn,"select * from `changelog` ORDER BY id ASC");
			while($file = mysqli_fetch_array($nquery)){
		?>
        <tr>
			<td><?php echo $file['id']; ?></td>
			<td><?php echo $file['module']; ?></td>
			<td><?php echo $file['desc']; ?></td>
			<td align="center">
			
		</tr>

					<?php }?>

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

	include('conn.php');
	if (isset($_POST['sub']))
{
	$module=$_POST['module'];	
	$description=$_POST['description'];
	date_default_timezone_set("Asia/Manila");
	$date = date('Y-m-d H:i:s');
		
	$query = $conn->query("SELECT * FROM `changelog` WHERE `module` = '$module'");
	$check = $query->num_rows;
		
		if($check == 1)
			{
				echo "<script>alert('CHANGE LOG ALREADY EXIST!')</script>";	 
			}
			
			else
				{
					$conn->query ("INSERT INTO changelog (module, description, date)
					VALUES ('$module', '$description', '$date')") or die(mysqli_error());	
					echo "<script>alert('CHANGE LOG SAVED!')</script>"; 
					echo "<script>window.location = 'upload_changelog.php'</script>"; 
				}				
					
}
?>



