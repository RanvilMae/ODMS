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
      <div class="form-group">
 <h3><strong>PRINT QR</strong></h3>
  <hr>
 
	  
	  <table class="table table-dark " id="data_table">
    			<thead>
    				<tr>
				        <th width="15%"><strong>DOCU ID</strong></th>
				        <th width="30%"><strong>RECORD ID</strong></th>
								<th width="30%"><strong>TIEZA ID</strong></th>
				        <th width="30%"><strong>DEPARTMENT</strong></th>
								<th width="20%"><strong>DATE</strong></th>
								<th align="center" width="15%"><strong>ACTION</strong></th>
				    </tr>
    			</thead>
    			<tbody>
    				<?php
    					include('conn.php');
						$nquery		= mysqli_query($conn,"select * from `reprint_qr` WHERE `track` = '0' AND `reprinted` = '0' ORDER by id");
						while($fetch = mysqli_fetch_array($nquery)){
							$id = $fetch['id'];
    				?>
    					<tr>
				        <td style="color: WHITE;"><?php echo $fetch['docu_id']; ?></td>
				        <td style="color: WHITE;"><?php echo $fetch['record_id']; ?><br></td>
						  	<td style="color: WHITE;"><?php echo $fetch['tid']; ?></td>
				          	<td style="color: WHITE;"><?php echo $fetch['department']; ?><br></td>
						  	<td style="color: WHITE;"><?php echo $fetch['track']; ?></td>
						  	<td align="center">
							 		<div >
										<!-- Button trigger modal -->
											<button type="button" class="btn btn-primary" title="ACTIVATE REPRINTING">
												<a data-toggle="modal" data-target="#exampleModal<?php echo $fetch['id']?>" style="text-decoration-none;color:WHITE;">
													<i class="fa fa-print" aria-hidden="true"></i>
												</a>
											</button>
									</div>
						  	</td>
						  		<!-- Modal -->
												<div class="modal fade" id="exampleModal<?php echo $fetch['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												  <div class="modal-dialog" role="document">
												    <div class="modal-content">
												    	<form method="POST" action="reprint_qrcode.php?id=<?php echo $fetch['id']?>" enctype="multipart/form-data">
												      <div class="modal-header">
												        <h5 class="modal-title" id="exampleModalLabel">ACTIVATION</h5>
												        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
												          <span aria-hidden="true">&times;</span>
												        </button>
												      </div>
												      <div class="modal-body" >
												      		<input type="text" name="id" value="<?php echo $fetch['id']?>"/>
												      		<input type="text" name="docu_id" value="<?php echo $fetch['docu_id']?>"/>
													      	<input type="text" name="record_id" value="<?php echo $fetch['record_id']?>"/>
													       	<p style="text-decoration-none;color:BLACK;" >
													       		Are you sure you want to activate QR printing of <strong> <?php echo $fetch['record_id']?> </strong>
													       	</p> 
												      </div>
												      <div class="modal-footer">
												        <button type="submit" name="save" class="btn btn-primary">Proceed</button>
												      </div>
												    </div>
												  </div>
												  </form>
												</div>
											</div>
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
      </body>
</html>
