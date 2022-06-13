<?php 

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

  	<?php include 'navigation_superadmin.php';?>

<main role="main" class="container">
  <div class="jumbotron">
    <form action="upload_dept.php" method="post" enctype="multipart/form-data" >
      <div class="form-group">
           <h3><strong>ADD DEPARTMENT</strong></h3>
          <hr>
          <br>
		
		<label><strong>Department: </strong></label>
		<input type="text" class="form-control" placeholder="Department" id="department" name="department" required /><br>
		
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
    <h3><strong>DEPARTMENT</strong></h3>
        
		<hr>
      </div>
 <div style="overflow-x:auto;">
    <table class="table table-dark">
    <tr>
        <td><strong>DEPARTMENT</strong></td>
        <td><strong>DESCRIPTION</strong></td>
        <td  align="center"><strong>ACTION</strong></td>
    </tr>
    <tbody>
		<?php
		
			$nquery=mysqli_query($conn,"select * from `department` ORDER BY department ASC ");
			while($file = mysqli_fetch_array($nquery)){
		?>
        <tr>
			<td><?php echo $file['department']; ?></td>
			<td><?php echo $file['narrative']; ?></td>
			<td align="center">
			<button type="button" name="delete" value="C:\xampp\htdocs\ss\archive<?php echo $file['department']?>" class="btn btn-danger" title="DELETE">
				<a data-toggle="modal" data-target="#delete<?php echo $file['id']?>" style="text-decoration-none;color:white;">
					<i class="fas fa-trash-alt"></i>
				</a>
			</button>
		</tr>
	   <!----MODAL FOR DELETE-->
	   <div class="modal fade" id="delete<?php echo $file['id']?>" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><strong>DELETE</strong></h5>
				</div>
				<div class="modal-body">
			Are you sure you want to delete <strong><?php echo $file['department'] ?></strong>?
			<div class="modal-footer">
         <a href="delete_dept.php?department=<?php echo $file['department'] ?>"   class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
						 <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
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
<?php

	include('conn.php');
	if (isset($_POST['sub']))
{
	$department=$_POST['department'];	
		
	$query = $conn->query("SELECT * FROM `department` WHERE `department` = '$department'");
	$check = $query->num_rows;
		
		if($check == 1)
			{
				echo "<script>alert('DEPARTMENT ALREADY EXIST!')</script>";	 
			}
			
			else
				{
					$conn->query ("INSERT INTO department (department)
					VALUES ('$department')") or die(mysqli_error());	
					echo "<script>alert('DEPARTMENT SAVED!')</script>"; 
					echo "<script>window.location = 'upload_dept.php'</script>";
				}				
					
}
?>



