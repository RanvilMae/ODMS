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

 <main role="main" class="container-fluid">
  <div class="jumbotron">  
        
		<div class="dropdown float-right">
		  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-download"></i>
		  </button>
		  <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
			<a class="dropdown-item" href="download_bulk_br.php?department=<?php echo $fetch['department']?>" target="_blank" >BULK</a>
			<a  class="dropdown-item" data-toggle="modal" data-target="#tags<?php echo $fetch['id']?>">
			BY DATE
			</a>
		  </div>
		</div>
		
		<!---Modal for TAGS----->
    <div class="modal fade" id="tags<?php echo $fetch['id']?>" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">

          <h3 class="modal-title">DOWNLOAD</h3>
        </div>
          
          <div class="modal-body">

            <div class="Container">
    <div>
    <form method="POST" action= "download_bydate.php">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">   
          <h4 class="modal-title"><b>Select Date Between</b></h4>
        </div>
        <div class="modal-body">
		
		<div class="row">
									<div class="col" required>
										<input type="date" class="form-control" id="date1" name="date1" required />
									</div>
									<label for="attribute2" class="control-label"><strong>TO</strong></label>
									<div class="col" required>
										<input type="date" class="form-control" id="date2" name="date2" required />
									</div><br>
								</div>
		
		
		          
        </div>
                 <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i></button>

					<a href="download_bydate.php" target="_blank" class="text-decoration-none">
					<button title="PREVIEW"  type="submit" class="btn btn-success"  name="submit" >
						<i class="fas fa-share-square"></i>
					</button>
				</a>
		
				</div>
      </div>
      </form>
    </div>
  </div>

            </table>

          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

		
    <div>
       <h3><strong>VIEW DATA</strong></h3>
    </div>
    <div>
      <hr>
    </div>

	</ul>
      <hr>
  <div style="overflow-x:auto;">
    <table class="table table-dark" id="data_table">
    <thead>    
	    <tr >
	        <th width="15%"><strong>BR Number</strong></th>
					<th width="10%"><strong>CATEGORY</strong></th>
	        <th width="30%"><strong>SUBJECT</strong></th>
					<th width="10%"><strong>DATE</strong></th>
					<th align="center" width="15%"><strong>ACTION</strong></th>
	    </tr>
  	</thead>
    <tbody>

		<?php
			include('conn.php');
						$id = (int) $_SESSION['login'];
			$nquery=mysqli_query($conn,"select * from `board_resolution`  ORDER by id DESC ");
			while($fetch = mysqli_fetch_array($nquery)){
				$id = $fetch['id'];
				$subject = $fetch['subject'];
    ?>
	
        <tr>
          <td style="color: black;"><?php echo $fetch['br_no']; ?></td>
		  		<td style="color: black;"><?php echo $fetch['category']; ?></td>
          <td style="color: black;"><?php echo $fetch['subject']; ?></td>
          <td style="color: black;"><?php echo $fetch['date']; ?></td>
		   
					 <td align="center">
					 	<div class="btn-group btn-group-justified">
							
							<button type="button" class="btn btn-primary" title="PREVIEW">
								<a href="board resolutions/<?php echo $fetch['name']?>" target="_blank" class="text-decoration-none" style="color:white;">
									<i class="fas fa-eye"></i>
								</a>
							</button>
						
							<button type="button" name="delete" value="C:\xampp\htdocs\ss\archive<?php echo $fetch['name']?>" class="btn btn-primary" title="DELETE">
								<a data-toggle="modal" data-target="#delete<?php echo $fetch['id']?>" style="text-decoration-none;color:white;">
									<i class="fas fa-trash-alt"></i>
								</a>
						</button>
						</div>
					</td>
		
		  <!----MODAL FOR DELETE-->
	   <div class="modal fade" id="delete<?php echo $fetch['id']?>" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
						<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"><strong>DELETE</strong></h5>
						</div>
						<div class="modal-body">
							
							Are you sure you want to delete <strong><?php echo $fetch['subject'] ?></strong>?
							<div class="modal-footer">
				        <a href="deletedata_br.php?name=<?php echo $fetch['name'] ?>"   class="btn btn-primary"><i class="fas fa-trash-alt"></i></a>
								<button type="button" class="btn btn-danger" data-dismiss="modal">
									<i class="fas fa-window-close"></i>
								</button>
							</div>
		      	</div>
		    </div>
 			</div>
</div>
		     <!---Modal for EDit ----->
				<div class="modal fade" id="myModal<?php echo $fetch['id']?>" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
			
							<form method="POST"  enctype="multipart/form-data">
								<div class="modal-header">
									<h3><strong>UPDATE</strong></h3>
									
								</div>
								<div class="modal-header">
								
									 <p><font face="verdana" color="green" class="float-left"><strong><?php echo $subject?></strong></font></p>
								</div>
								
								<div class="modal-body">
								
								
									<input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
								<?php
								
										if ($classification == 'Incoming'){
											
								?>
								<div class="row">
									<div class="col" required>
										<p><input type="radio" id="chk" name="restriction" value="Open to All" required /> <label><strong>Open to All</strong></label></p>
									</div><br>
									<div class="col" required>
										<p><input type="radio" id="chk1" name="restriction" value="Restricted" required /> <label><strong>Restricted</strong></label></p>
									</div><br>
									<div class="col" required>
										<p><input type="radio" id="chk2" name="restriction" value="Confidential" required /> <label><strong>Confidential</strong></label></p>
									</div>
								</div>
								<?php } ?>
								
								
								
								<div class="row" required>
								<div class="col">
									<label for="forw"><strong>For / To:</strong></label>
									<input class="form-control" type="text" name="forw" placeholder="For:" 
									value="<?php echo $fetch['forw'];?>" />
								</div><br>
								
								<div class="col">
									<label for="from"><strong>From / Signatory:</strong></label>
									<input class="form-control" type="text" name="fromw" placeholder="From:" 
									 value="<?php echo $fetch['fromw'];?>" />
									</div><br>
								</div>
								
									<div class="form-row">
									<div class="form-group col-md-6">
									 	<label><strong>Date:</strong> </label>
									<input class="form-control"  name="date" placeholder="Date:" readonly="read-only"
									 value="<?php echo $fetch['date']; ?>"  /> <!--  -->
									</div>
									<div class="form-group col-md-4">
									 <label><strong>Classification:</strong> </label>
									<input name="classification" class="form-control" rows="5"  type="text" placeholder="Classification:" 
									value="<?php echo $fetch['classification'];?>" /></input>
									</div>
									<div class="form-group col-md-2">
									  <label><strong># Pages:</strong> </label>
									<input class="form-control"  name="pages" placeholder="Pages:"
									 value="<?php echo $fetch['pages']; ?>" />
										</div>
								</div>
								
								<label><strong>Subject:</strong></label>
												<textarea class="form-control" name="subject"
												 rows="3" ><?php echo $fetch['subject']; ?></textarea><br>
								
									<label><strong>File: </strong></label>	
									<input type="file" class="form-control" name="myfile">
									
								
								
							
									<div style="clear:both;"></div>
										<div class="modal-footer">
										<button type="submit" name="save" class="btn btn-primary"><i class="fas fa-upload"></i></button>
											<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> <i class="fas fa-window-close"></i></button>
										</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			
		 <?php
			}
        ?>

      </tbody>
    </table>

<?php
include('conn.php');
					$id = (int) $_SESSION['login'];
		
		$nquery=mysqli_query($conn,"select * from `board_resolution`  ORDER by id DESC ");
		while($fetch = mysqli_fetch_array($nquery)){
			$id = $fetch['id'];
			$subject = $fetch['subject'];
		
					
    ?>
	
	 <!---Modal for SUB FILE ----->
    <div class="modal fade" id="mysub<?php echo $fetch['id']?>" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">

          <h3 class="modal-title">SUB FILES</h3>
		
		
        </div>
          
          <div class="modal-body">
  <p><font face="verdana" color="green" class="float-left"><strong><?php echo $subject?></strong></font></p>


            <table class="table table-bordered">
              <thead>
                <tr>
				  <th class="tablecell">FILE NAME</th>
				  <th class="tablecell">PAGES</th>
                  <th class="tablecell" width: "auto !important">DATE</th>
				  <th class="tablecell">DEPARTMENT</th>
				  <th class="tablecell">EMPLOYEE / OFFICER</th>
				   <th class="tablecell">PREVIEW</th>
                 
                </tr>
              </thead>

              <?php 
              $id = $fetch['id'];
              $query = $conn->query ("SELECT * FROM subfiles WHERE id = $id ORDER by date DESC") or die (mysql_error());

              while($fetch = mysqli_fetch_array($query)){
				  $name = $fetch['name'];


              echo "<tbody>";
              echo "<tr>";
              echo "<td width='35%'>". $fetch['sub_docu'] ."</td>";
			  echo "<td width='10%'>". $fetch['pages'] ."</td>";
              echo "<td width='25%'>". $fetch['date'] ."</td>";
			  echo "<td width='25%'>". $fetch['department'] ."</td>";
			  echo "<td width='30%'>". $fetch['action'] ."</td>";
			  echo "<td width='30%'>";
			  echo "<button type='button' class='btn btn-primary' title='PREVIEW'>";
						echo "<a href='subs/$name' target='_blank' class='text-decoration-none' style='color:white;'>";
							echo "<i class='fas fa-eye'></i>";
						echo "</a>";
					echo "</button>";
			echo"</td>";
              echo "</tr>";
              echo "</tbody>";


              }?>

            </table>

          </div>

			<div class="modal-footer">
				<a href="download_subfiles.php?id=<?php echo $id?>" target="_blank" class="text-decoration-none">
					<button title="PREVIEW" type="button" class="btn btn-success" >
						<i class="fas fa-file-pdf"></i>
					</button>
				</a>
				<a href="subfile.php?id=<?php echo $id?>" class="text-decoration-none">
					<button type="button" title="ADD SUB FILE" class="btn btn-primary" >
						<i class="fas fa-folder-plus"></i>
					</button>
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
			}
        ?>

      </tbody>
    </table>

<?php
include('conn.php');
					$id = (int) $_SESSION['login'];
		
		$nquery=mysqli_query($conn,"select * from `board_resolution`  ORDER by id DESC ");
		while($fetch = mysqli_fetch_array($nquery)){
			$id = $fetch['id'];
			$subject = $fetch['subject'];
		
					
    ?>

    <!---Modal for REMARKS ----->
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
				  <th class="tablecell">EMPLOYEE / OFFICER</th>
                 
                </tr>
              </thead>

              <?php 
              $id = $fetch['id'];
              $query = $conn->query ("SELECT * FROM remarks WHERE id = $id ORDER by date DESC") or die (mysql_error());

              while($fetch = mysqli_fetch_array($query)){


              echo "<tbody>";
              echo "<tr>";
              echo "<td width='10%'>". $fetch['status'] ."</td>";
              echo "<td width='35%'>". $fetch['remarks'] ."</td>";
              echo "<td width='25%'>". $fetch['date'] ."</td>";
			  echo "<td width='30%'>". $fetch['action'] ."</td>";
              echo "</tr>";
              echo "</tbody>";


              }?>

            </table>

          </div>

			<div class="modal-footer">
				<a href="download_status.php?id=<?php echo $id?>" target="_blank" class="text-decoration-none">
					<button title="PREVIEW" type="button" class="btn btn-success" >
						<i class="fas fa-file-pdf"></i>
					</button>
				</a>
				<a href="remarks.php?id=<?php echo $id?>" class="text-decoration-none">
					<button type="button" class="btn btn-primary" >
						<i class="far fa-file"></i>
					</button>
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
        } 
        ?>
		
		
<?php
include('conn.php');
					$id = (int) $_SESSION['login'];
		
		$nquery=mysqli_query($conn,"select * from `board_resolution`  ORDER by id DESC ");
		while($fetch = mysqli_fetch_array($nquery)){
			$id = $fetch['id'];
			$subject = $fetch['subject'];
		
					
    ?>
	
<!---Modal for TAGS----->
    <div class="modal fade" id="tags<?php echo $fetch['id']?>" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">

          <h3 class="modal-title">TAGS</h3>
        </div>
          
          <div class="modal-body">
				 <p><font face="verdana" color="green" class="float-left"><strong><?php echo $subject?></strong></font></p>
            <table class="table table-bordered">
              <thead>
                <tr>
				<th class="tablecell">TAGGED TO</th>
				 <th class="tablecell">TAGGED DATE</th>
				  <th class="tablecell">ACTION</th>
                  <th class="tablecell" >VIEWED DATE</th>
				 
				  
                 
                </tr>
              </thead>

               <?php 
				$id = $fetch['id'];
				$query = $conn->query ("SELECT * FROM tags WHERE id = $id ") or die (mysql_error());
				
				foreach ( $query as $get){
					$track = $get['track'];
					$tag = $get['tag'];
					if ($track==1){
					
							echo "<tbody>";
					echo "<tr>";
					$query = $conn->query ("SELECT * FROM users WHERE tid = '$tag' ORDER by lname ASC ") or die (mysqli_error());
					while($fetch = mysqli_fetch_array($query)){
				echo "<td width='30%'>". $fetch['lname'] .", ". $fetch['fname'] ." ". $fetch['mname'] ." - ". $fetch['department'] ."</td>";}
						echo "<td width='20%'>". $get['date'] ."</td>";
						echo "<td width='10%'> VIEWED</td>";
						echo "<td width='20%'>". $get['dateviewed'] ."</td>";
						
						
				
				}
				else{
					echo "<tbody>";
					echo "<tr>";
					$query = $conn->query ("SELECT * FROM users WHERE tid = '$tag' ") or die (mysqli_error());
				while($fetch = mysqli_fetch_array($query)){
				echo "<td width='30%'>". $fetch['lname'] .", ". $fetch['fname'] ." ". $fetch['mname'] ."</td>";}
				echo "<td width='20%'>". $get['date'] ."</td>";
						echo "<td width='10%'></td>";
						echo "<td width='20%'>". $get['dateviewed'] ."</td>";
						
						
				}
				}
					 
			 
				
					
              echo "</tr>";
              echo "</tbody>";
						
						
			
		
			?>

            </table>
			
			
			
			
			

          </div>

          <div class="modal-footer">
		  
				<button type="button" name="delete" class="btn btn-secondary btn-lg" title="REMOVE TAG">
						<a href="remove_tag.php?id=<?php echo $id?>" class="text-decoration-none" style="text-decoration-none;color:white;>" >
							<i class="fas fa-trash-alt"></i>
						</a>
				</button>
		  <!--
				<button type="button" name="add" class="btn btn-primary" title="ADD TAG">
						<a href="tag_admin.php?id=<?php echo $id?>" class="text-decoration-none" style="text-decoration-none;color:white;>" >
							<i class="fas fa-user-plus"></i>
						</a>
				</button>		-->

					<button name="add" title="ADD TAG" class="btn btn-primary btn-sm nav-link dropdown-toggle dropdown-toggle-split " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration-none;color:white;">
						<i class="fas fa-user-plus"></i>
					</button>
					<div class="dropdown-menu">
							<a href="tag_TTAXD.php?id=<?php echo $id?>" class="text-decoration-none" 		style="text-decoration-none;color:BLack;>">
								&nbsp;&nbsp;&nbsp;<i class="fas fa-user-plus">&nbsp;&nbsp;TTAXD</i>
							</a><br>
							<a href="tag_MISD.php?id=<?php echo $id?>" class="text-decoration-none" style="text-decoration-none;color:BLack;>">
								&nbsp;&nbsp;&nbsp;<i class="fas fa-user-plus">&nbsp;&nbsp;MISD</i>
							</a><br>
							<a href="tag_admin.php?id=<?php echo $id?>" class="text-decoration-none" style="text-decoration-none;color:BLack;>">
									&nbsp;&nbsp;&nbsp;<i class="fas fa-user-plus">&nbsp;&nbsp;USER</i>
							</a>
					</div>
			
				<button class="btn btn-danger btn-lg" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span><i class="fas fa-window-close"></i></button>
		  </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


 <?php
		} 
		
        ?>
		
  </div>
  </main>
  	 <p class="mt-5 mb-3 text-muted text-center">&copy; TIEZA-MISD 2019</p>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
   <script type="text/javascript" src="datatable/datatable.js"></script>
  	<script type="text/javascript">
  		$(document).ready(function () {
  			$('#data_table').DataTable( {
  			    "order": [[ 4, "desc"]]
  			}
  			    );
  		});
  	</script>
  </body>
</html>

<?php
require('conn.php');

if (isset($_POST['save'])) {
	
			if ($classification = 'Outgoing')
				{	
					$id=$_POST['id'];
			$fromw=$_POST['fromw'];
			$pages=$_POST['pages'];
			$subject=$_POST['subject'];
			$date= date('Y-m-d H:i:s');
			$pages=$_POST['pages'];
					mysqli_query($conn, "UPDATE `files` SET `fromw` = '$fromw', `restriction` = 'Outgoing', `subject` = '$subject', `date` = '$date', `pages` = '$pages' WHERE `id` = '$id'") ;
					$message = "FILE SUCCESSFULLY UPDATED!";
					echo "<script type='text/javascript'>alert('$message');</script>";
					echo "<script>window.location = 'viewdata.php'</script>";
				}
			else
				{
			$id=$_POST['id'];
			$fromw=$_POST['fromw'];
			$pages=$_POST['pages'];
			$subject=$_POST['subject'];
			$date= date('Y-m-d H:i:s');
			$pages=$_POST['pages'];
			$restriction=$_POST['restriction'];
					mysqli_query($conn, "UPDATE `files` SET `fromw` = '$fromw', `restriction` = '$restriction', `subject` = '$subject', `date` = '$date', `pages` = '$pages' WHERE `id` = '$id'") ;
					$message = "FILE SUCCESSFULLY UPDATED!";
					echo "<script type='text/javascript'>alert('$message');</script>";
					echo "<script>window.location = 'viewdata.php'</script>";

				}
}
		if (isset($_POST['save']))
	{
			$filename = $_FILES['myfile']['name'];
			 $file = $_FILES['myfile']['tmp_name'];

		//name of folder where the file is stored

		$destination = "uploads/";

		// overwrite file

		//checking if file exsists
		if(file_exists("uploads/$filename")) unlink("uploads/$filename");

		$movefile = move_uploaded_file($file, $destination.$filename);

	}
	
?>
