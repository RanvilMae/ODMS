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

  	<?php include 'navigation_superadmin.php';

		
			$nquery=mysqli_query($conn,"select * from `version` ");
			while($file = mysqli_fetch_array($nquery)){
				$id=$file['id'];
		?>

<main role="main" class="container">
  <div class="jumbotron">
    <form action="upload_version.php?id=<?php echo $file['id'] ?>" method="post" enctype="multipart/form-data" >
      <div class="form-group">
           <h3><strong>UPDATE VERSION</strong></h3>
          <hr>
          <br>
		
		<label><strong>Version: </strong></label>
		<input type="text" class="form-control" placeholder="Version" id="version" name="version" required /><br>
		
		<button type="submit" name="sub" class="btn btn-primary float-right"><i class="far fa-edit"></i></button>
		</div>	  
        </form>
 	
		
      </div>
 </main> 	  
	  <main role="main" class="container">
  <div class="jumbotron"> 
  <div>
    <div class="float-right" style="padding-right: 10px;">
    </div>
    <h3><strong>CURRENT VERSION</strong></h3>
        
		<hr>
      </div>
 <div style="overflow-x:auto;">
    <table class="table table-dark">
    <tr>
		
			<td><?php echo $file['version']; ?></td>
		
	  
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
			$id=$_GET['id'];
			$version=$_POST['version'];
	
			mysqli_query($conn, "UPDATE `version` SET `version` = '$version' WHERE `id` = '$id'") ;
$message = "VERSION SUCCESSFULLY UPDATED!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script>window.location = 'upload_version.php'</script>";
 
				
					
}
?>



