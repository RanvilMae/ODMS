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
	<link rel="stylesheet" type="text/css" href="datatable/datatable.css">
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

	<?php
			
		$id = (int) $_SESSION['log'];
			
		$query = $conn->query ("SELECT * FROM superadmin WHERE id = '$id' ") or die (mysql_error());
		$fetch = $query->fetch_array ();
	{
		$fname=$fetch['fname'];
		$mname=$fetch['mname'];
		$lname=$fetch['lname'];
		}
		str_replace($fetch['password'], "********", $fetch['password'])
		?>


<main role="main" class="container">
  <div class="jumbotron">
    <form action="record_delete.php" method="post" enctype="multipart/form-data" >
      <div class="form-group">
 <h3><strong>DOCUMENT DELETION</strong></h3>
  <hr>
 
	  <table class="table table-info" id="data_table">
												    			<thead>
												    				<tr>
																      <th width="25%"><strong>RECORD ID</strong></th>
																      <th width="20%"><strong>DOCU ID</strong></th>
																      <th width="20%"><strong>FILE NAME</strong></th>
																      <th width="20%"><strong>DATE</strong></th>
																			<th align="center" width="15%"><strong>ACTION</strong></th>
																    </tr>
												    			</thead>
												    			<tbody>
												    						<?php
											    					include('conn.php');
																	$nquery		= mysqli_query($conn,"select * from `files` ORDER by id DESC LIMIT 100");
																	while($fetch = mysqli_fetch_array($nquery)){
																		$id = $fetch['id'];
											    				?>
											    					<tr>
															        <td style="color: BLACK;"><?php echo $fetch['id']; ?></td>
															        <td style="color: BLACK;"><?php echo $fetch['docu_id']; ?><br></td>
																	  	<td style="color: BLACK;"><?php echo $fetch['name']; ?></td>
																	  	<td style="color: BLACK;"><?php echo $fetch['date']; ?></td>
															          	
																	  	<td align="center">
																		 		<div >
																							<a href="record_delete.php?id=<?php echo $fetch['id']; ?>" target="_blank" class="text-decoration-none">
																							<button title="REPRINTING QR" type="button" class="btn btn-danger" >
																								<i class="fa fa-trash" aria-hidden="true"></i>
																							</button>
																						</a>
																				</div>
																	  	</td>
																	  </tr>

																<?php }?>
												    			</tbody>
												    		</table>

		   


	</div>
	</form>
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
   <script type="text/javascript" src="datatable/datatable.js"></script>
  	<script type="text/javascript">
  		$(document).ready(function () {
  			$('#data_table').DataTable( {
  			}
  			    );
  		});
  	</script>
      </body>
</html>
