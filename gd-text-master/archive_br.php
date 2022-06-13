<?PHP

session_start();

if (!isset($_SESSION['login'])) {
header('Location: index.php');
}

?>
<?php 
include 'logic_br.php';
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

<?php include 'navigation_admin_br.php';?>

<div class="container">
  <div class="jumbotron">
    <form action="archive_br.php" method="post" enctype="multipart/form-data" >
          <h3><strong>ARCHIVE</strong></h3>
          <hr>
          
					<input class="form-control" type="text" name="department" placeholder="Department" hidden
									value="<?php echo $fetch['department'];?>" ><br>
			
 <label><strong>Date: </strong></label>
      <input class="form-control" name="date" disabled value="<?php date_default_timezone_set("Asia/Manila"); echo date("Y-m-d H:i:s");?>"><br>
			
	  
	  <label><strong>File:</strong></label>
          <input type="file" class="form-control" id="exampleFormControlFile1" name="myfile" required><br>
	<button type="submit" name="save" title="UPLOAD"  class="btn btn-primary float-right"><i class="fas fa-upload"></i></button>
		  	</div>	  
        </form>

<!-- Modal for upload-->
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>DOWNLOAD</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        Are you sure you want to upload file?
      </div>
      <div class="modal-footer">
	  	<button type="submit" name="save" class="btn btn-success"><i class="fas fa-upload"></i></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	
      </div>
    </div>
  </div>
</div>
</div>

<main role="main" class="container">
  <div class="jumbotron"> 
  <div>
 
    <h3><strong>DATA ARCHIVED</strong></h3>
        
		<hr>
      </div>
 <div style="overflow-x:auto;">
    <table class="table table-dark">
    <tr >
        <td><strong>ID</strong></td>
        <td><strong>FILENAME</strong></td>
		<td><strong>DATE</strong></td>
        <td 	align="center"><strong>ACTION</strong></td>
    </tr>
    <tbody>
		<?php
		$id = (int) $_SESSION['login'];
			
					$query = $conn->query ("SELECT * FROM admin WHERE id = '$id' ") or die (mysqli_error());
					$fetch = $query->fetch_array ();
					$department = $fetch['department'];
					$nquery=mysqli_query($conn,"select * from `br_archive` WHERE department = '$department' ORDER BY id DESC ");
					while($file = mysqli_fetch_array($nquery)){
		?>
        <tr>
          <td><?php echo $file['id']; ?></td>
          <td><?php echo $file['name']; ?></td>
		   <td><?php echo $file['date']; ?></td>
<td align="center">

		
<button type="button" name="delete" name="fileToRemove" class="btn btn-success">
 <a data-toggle="modal" name="fileToRemove" data-target="#download<?php echo $file['id']?>" style="text-decoration-none;color:white;">
		<i class="fas fa-download"></i>
</button></a>
</td>
	   </tr>

	   <!----MODAL FOR DOWNLOAD-->
			<div class="modal fade" id="download<?php echo $file['id']?>" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><strong>DOWNLOAD</h5></strong>
				</div>
				<div class="modal-body">
			Are you sure you want to download <strong><?php echo $file['name'] ?>?</strong>
			<div style="clear:both;"></div>
			<div class="modal-footer">
         <a href="download_archive.php?file_id=<?php echo $file['id'] ?>"  class="btn btn-success"><i class="fas fa-download"></i></a>
						 <button type="button" name="delete" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
					</div>
      </div>
    </div>
  </div>
</div> 
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