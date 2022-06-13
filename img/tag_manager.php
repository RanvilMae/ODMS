<?PHP

session_start();

if (!isset($_SESSION['m'])) {
header('Location: index.php');
}

?>
<?php 
require("conn.php");
include 'filesLogic.php';
include('pagination_manager.php');
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

  	<?php include 'navigation_manager.php';?>

 <main role="main" class="container-fluid">

  <div class="jumbotron">

 
	  <!--
	   	<?php
		if ($fetch['department']== 'MISD'){
		?>
			<a href="downloadbulk_manager_MISD.php" class="btn btn-success">DOWNLOAD</a> 
		<?php } ?>
  
		<?php
		if ($fetch['department']== 'TTAXD'){?>
				<a href="downloadbulk_manager_TTAXD.php" class="btn btn-success">DOWNLOAD</a>
		<?php } ?>
		-->

    <div>
       <h3><strong>VIEW DATA</strong></h3>
    </div>
    <div>
      <hr>
    </div>
<div class="btn btn-dark" style="text-decoration-none;font-size:150%;"  id="pagination_controls"><?php echo $paginationCtrls; ?></div>
      <div class="col-lg-2"><br>
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
  
    <tr >
        <td><strong>RECORD ID</strong></td>
        <td><strong>FROM</strong></td>
        <td><strong>SUBJECT</strong></td>
		<td><strong>DATE</strong></td>
		<td><strong>FILE TYPE</strong></td>
		<td align="center"><strong>ACTION</strong></td>
    </tr>
  <?php
	 $id = (int) $_SESSION['m'];
			$query = $conn->query ("SELECT tid FROM `users` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
			$nquery=mysqli_query($conn,"select * from `tags` WHERE tag = '$tid' ORDER BY date DESC ");
			foreach ( $nquery as $get){
			 $id = $get['id'];
			 $primary_id = $get['primary_id'];
			 
			 
		$nquery=mysqli_query($conn,"select * from `files` WHERE id = '$id' ORDER BY date DESC ");
			while($fetch = mysqli_fetch_array($nquery)){
				$id = $get['id'];
				$tid = $file['tid'];
			?>

    <tbody>
	
	
        <tr>
          <td><?php echo $fetch['docu_id']; ?></td>
          <td><?php echo $fetch['fromw']; ?></td>
          <td><?php echo $fetch['subject']; ?></td>
          <td><?php echo $fetch['date']; ?></td>
          <td><?php echo $fetch['restriction']; ?></td>
		   
			 <?php 
				$query = $conn->query ("SELECT * FROM tags WHERE id = $id and tag='$tid' ORDER by date DESC") or die (mysql_error());
				$gett = $query->fetch_array ();
				$track = $gett['track'];
				if ($track == 0){
				
				?>
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
					
					<button  class="btn btn-primary" id="myButton" title="PREVIEW">
						<a href="fetch.php?primary_id=<?php echo $primary_id?>" target="_blank"  class="text-decoration-none" style="color:#ff8a80;">
							<i class="fas fa-eye"></i>	
						</a>
					</button>
				</div>
			</td>
			<?php }
					else{
				?>
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
					
					<button  class="btn btn-primary" id="myButton" title="PREVIEW">
						<a href="fetch.php?primary_id=<?php echo $primary_id?>" target="_blank"  class="text-decoration-none" style="color:white;">
							<i class="fas fa-eye"></i>	
						</a>
					</button>
				</div>
			</td>
				
				<?php }
					
				?>
			
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
					
						<button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
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
	 $id = (int) $_SESSION['m'];
		$query = $conn->query ("SELECT tid FROM `users` WHERE id = '$id' ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
			$nquery=mysqli_query($conn,"select * from `tags` WHERE tag = '$tid'");
			foreach ( $nquery as $get){
			 $id = $get['id'];
			 
			 
		$nquery=mysqli_query($conn,"select * from `files` WHERE id = '$id'  ORDER BY id DESC");
			while($fetch = mysqli_fetch_array($nquery)){
				 $subject = $fetch['subject'];
			?>
	
<!---Modal for STATUS ----->
     <div class="modal fade" id="myModall<?php echo $fetch['id']?>" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">

          <h3 class="modal-title">HISTORY</h3>
        </div>
          
          <div class="modal-body">
<p><font face="verdana" color="green" class="float-left"><strong><?php echo $subject?></strong></font></p>


            <table class="table table-bordered">
              <thead>
                <tr>
				 <th class="tablecell">STATUS</th>
                  <th class="tablecell">REMARKS</th>
                  <th class="tablecell" width: "auto !important">DATE</th>
                </tr>
              </thead>

              <?php 
              $id = $fetch['id'];
              $query = $conn->query ("SELECT * FROM remarks WHERE id = $id ORDER by date DESC") or die (mysql_error());

              while($fetch = mysqli_fetch_array($query)){


              echo "<tbody>";
              echo "<tr>";
              echo "<td width='20%'>". $fetch['status'] ."</td>";
              echo "<td width='50%'>". $fetch['remarks'] ."</td>";
              echo "<td width='30%'>". $fetch['date'] ."</td>";
              echo "</tr>";
              echo "</tbody>";


              }?>

            </table>

          </div>

			<div class="modal-footer">
				<a href="remarks_manager_tag.php?id=<?php echo $id?>" class="text-decoration-none">
					<button type="button" class="btn btn-success" ><i class="far fa-file"></i></i></button>
				</a>
				<button class="btn btn-danger" type="button" data-dismiss="modal">
				<i class="fas fa-window-close"></i>
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
