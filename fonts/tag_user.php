<?PHP

session_start();

if (!isset($_SESSION['id'])) {
header('Location: index.php');
}

?>
<?php 
require("conn.php");
include 'filesLogic.php';
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
	  
	  
.notification {
  color: white;
  text-decoration: none;
  position: relative;
}

.notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}
	  
	  
    </style>
    <!-- Custom styles for this template -->
  
  </head>

  
  <body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <a class="navbar-brand" href="home_user.php">
  	Document Management System v1.01  ||  
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      <li class="nav-item">
	</li>
		<a class="nav-link" href="user.php"> PORTAL</a>
		<a class="nav-link" href="view_user.php"> VIEW</a>	
		<a class="nav-link" href="search_user.php"> SEARCH</a>
		<a href="tag_user.php" class="nav-link notification">
		  TAGS
		<!--  <span class="badge">
			<?php
			$id = (int) $_SESSION['id'];
				$count=0;
			
								$query = ("SELECT count(primary_id) FROM tags WHERE track = 0 AND id = $id") or die (mysql_error());
								$fetch = mysqli_fetch_row($query);
								
									for($i = 0; $i < $fetch; $i++)
									{
									  echo $i;
									}
							
								
			
			?>
		  </span> -->
		</a>

     </li>
    </ul>

		<?php
			$id = (int) $_SESSION['id'];
		
			$query = $conn->query ("SELECT * FROM users WHERE id = '$id' ") or die (mysqli_error());
			$fetch = $query->fetch_array ();
		?>
			<div class=" text-monospace float-right dropdown text-decoration-none " style="color:WHITE"><?php include ("clock.php"); ?>
				<a class="text-monospace " href="#" data-toggle="modal" data-target="#exampleModal" style="color:WHITE" ><i class="fas fa-user"></i> <?php echo $fetch['lname']; ?>, <?php echo $fetch['fname']; ?> <?php echo $fetch['mname']; ?>
				</a> 
				<button class="btn btn-danger btn-sm">
				<a data-toggle="modal" data-target="#myModal" href="logout.php" style="text-decoration-none;color:white;">
				<i class="fas fa-power-off"></i></a>
				</button>
			</div>		
				
				
				<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					
					  <div class="modal-header">
					  
						<h5 class="modal-title" id="exampleModalLabel"><strong><i class="fas fa-user"></i> MY PROFILE</strong></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						 <i class="fas fa-window-close"></i>
						</button>
					  </div>
								  
					  <div class="modal-body">
					  <?php
						$query = $conn->query ("SELECT * FROM users WHERE id = '$id' ") or die (mysqli_error());
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
									<tr>
										<th scope="col"><strong>User Level:</strong>
										<th scope="col"><?php echo $fetch['position'];?>
									</tr>
									</table>
								</div>

								<div class="modal-footer" >
									<button class="btn btn-warning btn-sm">
										<a style="text-decoration:none;color:white;" href="change_pass_user.php?id=<?php echo $fetch['id']; ?>">
											CHANGE PASSWORD
										</a>
									</button>

									<button class="btn btn-success btn-sm">
										<a style="text-decoration:none;color:white;" href="profile_user.php?id=<?php echo $fetch['id']; ?>">
											EDIT PROFILE
										</a>
									</button>

								</div>
								</div>	

							</div>
						</div>
					</div>  
				</div>

<div>
	<div class="modal fade" id="myModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">

           <h3 class="modal-title">
           	<strong>
           		LOG OUT
           	</strong>
           </h3>

        	</div>
          
          <div class="modal-body">
				<strong>
					<?php echo $fetch['fname']; ?>
				</strong>
				 <p>are you sure you want to log out?</p>
          </div>
           <div class="modal-footer">
		  <button class="btn btn-danger" >
		  	<a style="text-decoration:none;color:white;"  href="logout.php" >
		  		LOGOUT
		  	</a>
		  </button>
            <button type="button" class="btn btn-info " data-dismiss="modal" onclick="redirectToPrevPage()">
            	Close
            </button>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
 </div>
  
</nav>

 <main role="main" class="container-fluid">

  <div class="jumbotron">

    <div>
       <h3><strong>VIEW DATA</strong></h3>
    </div>
    <div>
      <hr>
    </div>




  <div style="overflow-x:auto;">
    <table class="table table-dark table-bordered">    
<!--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
Download
</button></div>	

Modal for download 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	
      <div class="modal-header">
	  
        <h5 class="modal-title" id="exampleModalLabel">Download</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
      <div class="modal-body">
        Are you sure you want to download all files?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a class="pull-right" href="downloadbulk.php">
		<button type="button" class="btn btn-success" >OK</button></a>
      </div>
    </div>
  </div>
</div>-->

    <tr>
        <td><strong>RECORD ID</strong></td>
        <td><strong>FROM</strong></td>
        <td><strong>SUBJECT</strong></td>
		<td><strong>DATE</strong></td>
		<td><strong>FILE TYPE</strong></td>
		<td align="center"><strong>ACTION</strong></td>
    </tr>
    <?php
	 $id = (int) $_SESSION['id'];
		$query = $conn->query ("SELECT tid FROM `users` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
			$nquery=mysqli_query($conn,"select * from `tags` WHERE tag = '$tid' ORDER BY date DESC ");
			foreach ( $nquery as $get){
			 $id = $get['id'];
			 
			 
		$nquery=mysqli_query($conn,"select * from `files` WHERE id = '$id' ORDER BY date DESC ");
			while($fetch = mysqli_fetch_array($nquery)){
			?>
	 

    <tbody>
	
	
        <tr>
          <td><?php echo $fetch['id']; ?></td>
          <td><?php echo $fetch['fromw']; ?></td>
          <td><?php echo $fetch['subject']; ?></td>
          <td><?php echo $fetch['date']; ?></td>
          <td><?php echo $fetch['restriction']; ?></td>
		   
			 
			 <td align="center">
			 	<div class="btn-group btn-group-justified">
					<button type="button" class="btn btn-primary" title="STATUS">
						<a data-toggle="modal" data-target="#myModall<?php echo $fetch['id']?>" style="text-decoration-none;color:white;">
							<i class="far fa-file"></i>
						</a>
					</button>
					
					<button type="button" class="btn btn-primary" title="DETAILS">
					   <a data-toggle="modal" data-target="#myModal<?php echo $fetch['id']?>" style="text-decoration-none;color:white;">
							<i class="fas fa-info"></i>
						</a>
					</button>
					
					<button onclick="myAjax()" name="confirm"  id="confirm" title="PREVIEW">
						<a href="uploads/<?php echo $fetch['name']?>"    target="_blank"  class="text-decoration-none" style="color:white;">
							<i class="fas fa-eye"></i>	
						</a>
					</button>
					  
						  <script >
						  function myAjax() {
								   $("#confirm").click(function() {
										<?php
											if(ISSET($_POST['confirm']));
										{
											$id = $get['id'];
											$tid = $file['tid'];
											date_default_timezone_set("Asia/Manila");
											$dateviewed= date('Y-m-d H:i:s');
											$query = "UPDATE tags SET track = 1, `dateviewed` = '$dateviewed' WHERE track = 0 AND id='$id' AND tag = '$tid'";
											mysqli_query($conn,$query);
										}?>
									  });
									});
									</script>
					
				</div>
				
				
			</td>
		    <!---Moadal for EDit ----->
			<div class="modal fade" id="myModal<?php echo $fetch['id']?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		
			<form method="POST" action="update.php">
				<div class="modal-header">
					<h3><strong></label>FILE DETAILS</strong></h3>
				</div>
				
				<div class="modal-body">
			<input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
								
								<div class="row" required>
								<div class="col">
									<label for="forw"><strong>For / To:</strong></label>
									<input class="form-control" type="text" name="forw" placeholder="For:" disabled
									value="<?php echo $fetch['forw'];?>" />
								</div><br>
								
								<div class="col">
									<label for="from"><strong>From / Signatory:</strong></label>
									<input class="form-control" type="text" name="fromw" placeholder="From:" disabled
									 value="<?php echo $fetch['fromw'];?>" />
									</div><br>
									</div>
									
								<div class="row" required>
								<div class="col">
									<label><strong>Date:</strong> </label>
									<input class="form-control"  name="date" placeholder="Date:" disabled
									 value="<?php echo $fetch['date']; ?>" />
								</div>
								
								<div class="col">
									<label><strong>Classification:</strong> </label>
									<input name="classification" class="form-control" rows="5"  type="text" placeholder="Classification:" disabled 
									value="<?php echo $fetch['classification'];?>" /></input>
								</div>
								</div>
								<label><strong>Subject:</strong> </label>
									<input class="form-control" type="text" name="subject" placeholder="Subject:" disabled
									 value="<?php echo $fetch['subject'];?>" />
								
								
			<div style="clear:both;"></div>
					<div class="modal-footer">
					
						<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> CLOSE</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
	<?php
			}	}
		?>
		
   </tbody>
    </table>
    <?php
	 $id = (int) $_SESSION['id'];
		$query = $conn->query ("SELECT tid FROM `users` WHERE id = '$id' ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
			$nquery=mysqli_query($conn,"select * from `tags` WHERE tag = '$tid' ORDER BY id DESC");
			foreach ( $nquery as $get){
			 $id = $get['id'];
			 
		$nquery=mysqli_query($conn,"select * from `files` WHERE id = '$id' ORDER BY id DESC");
			while($fetch = mysqli_fetch_array($nquery)){
			?>
<!---Modal for REMARKS ----->
    <div class="modal fade" id="myModall<?php echo $fetch['id']?>" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">

        <h3 class="modal-title">HISTORY</h3>
        </div>
          
          <div class="modal-body">



            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="tablecell" width: "auto !important">DATE</th>
                  <th class="tablecell">STATUS</th>
                </tr>
              </thead>

              <?php 
              $id = $get['id'];
              $query = $conn->query ("SELECT * FROM remarks WHERE id = $id ORDER by date DESC") or die (mysql_error());

              while($fetch = mysqli_fetch_array($query)){


              echo "<tbody>";
              echo "<tr>";
              echo "<td width='50%'>". $fetch['date'] ."</td>";
              echo "<td width='50%'>". $fetch['remarks'] ."</td>";
              echo "</tr>";
              echo "</tbody>";


		}?>

            </table>

          </div>

          <div class="modal-footer">
				<a href="remarks_user_tag.php?id=<?php echo $id?>" class="text-decoration-none">
					<button type="button" class="btn btn-success" >STATUS HISTORY</button>
				</a>
				<button class="btn btn-danger" type="button" data-dismiss="modal">
					CLOSE
				</button>
			</div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
	<?php
			}	}
		?>

 
	
  </main>
  	 <p class="mt-5 mb-3 text-muted text-center">&copy; TIEZA-MISD 2019</p>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
      </body>
</html>

<?php
require('conn.php');
if (isset($_POST['save'])) {
			$id=$_POST['id'];
			$forw=$_POST['forw'];
			$fromw=$_POST['fromw'];
			$tow=$_POST['tow'];
			$re=$_POST['re'];
			$subject=$_POST['subject'];
			$date=$_POST['date'];
			$description=$_POST['description'];
			$signatory=$_POST['signatory'];
mysqli_query($conn, "UPDATE `files` SET `forw` = '$forw', `fromw` = '$fromw', `tow` = '$tow', `re` = '$re', `subject` = '$subject', `date` = '$date', `description` = '$description', `signatory` = '$signatory' WHERE `id` = '$id'");
		$message = "FILE SUCCESSFULLY UPDATED!";
		echo "<script type='text/javascript'>alert('$message');</script>";
			$conn->close();
			
}
?>
