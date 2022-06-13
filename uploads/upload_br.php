
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
			background-image: url("images/bg.png");
			height: 100%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
.jumbotron{
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

<?php include 'navigation_admin_br.php';?>

<main role="main" class="container">
  <div class="jumbotron">
    <form action="brlogic.php" method="post" enctype="multipart/form-data" >
      <div class="form-group">
			<h3><strong>UPLOAD BOARD RESOLUTION</strong></h3>
			<hr>
		
		<div class="row" required>
			<div class="col">
					<label><strong>Category:</strong> </label>
					<input class="form-control" placeholder="Board Resolution" name="category" readonly="read-only" value="Board Resolution" /><br>
			</div>
			<div class="col">
				<label><strong>Date: </strong></label>
				<input class="form-control" name="date" required readonly="read-only" value="<?php date_default_timezone_set("Asia/Manila"); echo date("Y-m-d H:i:s");?>" ><br>
			</div>
			<div class="col">
				<label><strong>BR Date: </strong></label>
				<input type="date" class="form-control" name="br_date" required><br>
			</div>
		</div>
		
		<div class="row" required>
			<div class="col">
			<label><strong>No. of Pages:</strong> </label>
					<input type="number" class="form-control" placeholder="No. of Pages" min="1" max="1000" name="page" required /><br>
			</div><br>
			<div class="col">
			<label><strong>BR Number:</strong> </label>
					<input type="text" class="form-control" placeholder="BR #" min="1" max="100000" name="br_no" required /><br>
			</div>
			</div>
		</div>

		<label><strong>Subject: </strong></label>
					<input type="text" class="form-control" placeholder="Subject" name="subject" required><br>

		<label><strong>File: </strong></label>	
        <input type="file" class="form-control" id="exampleFormControlFile1" name="myfile"><br>
		
		
		<button type="submit" title="UPLOAD" name="sub" class="btn btn-primary float-right"><i class="fas fa-upload"></i></button>
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

