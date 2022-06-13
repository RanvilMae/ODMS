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
    </style>
    <!-- Custom styles for this template -->
  
  </head>
  <body>

  <?php include 'navigation_user.php';?>
  
 <main role="main" class="container-fluid">

  <div class="jumbotron">

  <div class="float-right"> 
    <a href="search_user.php" class="text-decoration-none">
    <button type="button" class="btn btn-primary" title="SEARCH" ><i class="fas fa-search"></i></button>
      </button></a>

   </div>
    <div>
       <h3><strong>VIEW DATA</strong></h3>
    </div>
    <div>
      <hr>
    </div>
	<?php
if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
	} else {
		$page_no = 1;
        }

	$total_records_per_page = 5;
    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

	$result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM `files` WHERE restriction = 'Open to All'");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1
	?>
<div>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>



<ul class="pagination">
    
	<li <?php if($page_no <= 1){ echo "class='page-item disabled'"; } ?>>
		<a class="page-link" tabindex="-1" <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 10) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li class='page-item'><a>...</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 10 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
        echo "<li class='page-item'><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li class='page-item'><a>...</a></li>";
	   echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
        echo "<li class='page-item'><a class='page-link'>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li class='page-item' <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a class='page-link' <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>
  <div style="overflow-x:auto;">
    <table class="table table-dark table-bordered">    

   <tr>
        <td><strong>RECORD ID #</strong></td>
        <td><strong>FROM</strong></td>
        <td><strong>SUBJECT</strong></td>
		<td><strong>DATE</strong></td>
		<td><strong>RESTRICTION</strong></td>
		<td align="center"><strong>ACTION</strong></td>
    </tr>
    <tbody>

<?php
include('conn.php');

    $result = mysqli_query($conn,"SELECT * FROM `files` WHERE restriction = 'Open to All' ORDER by id DESC LIMIT $offset, $total_records_per_page ");
    while($fetch = mysqli_fetch_array($result)){
		$did = $fetch['id'];
		$subject = $fetch['subject'];
		
	
    ?>
	<tr>
	 <td><?php echo $fetch['docu_id']; ?></td>
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
			 		<?php 
						 $id = (int) $_SESSION['id'];
			$query = $conn->query ("SELECT * FROM `users` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
		$department = $fetch['department'];
					$nquery=mysqli_query($conn,"select * from `tags` WHERE tag = '$tid' AND id = '$did' ORDER BY id DESC ");
			foreach ( $nquery as $get){
			 $track = $get['track'];
			 $primary_id = $get['primary_id'];
				if ($track == 0){
				?>
					   <button  class="btn btn-primary" id="myButton" title="PREVIEW">
						<a href="fetch.php?primary_id=<?php echo $primary_id?>" target="_blank"  class="text-decoration-none" style="color:#ff8a80;">
							<i class="fas fa-eye"></i>	
						</a>
						</button>
				<?php }
					else
					{
						?>
					<button  class="btn btn-primary" id="myButton" title="PREVIEW">
						<a href="fetch.php?primary_id=<?php echo $primary_id?>" target="_blank"  class="text-decoration-none" style="color:white;">
							<i class="fas fa-eye"></i>	
						</a>
					</button>
					<?php 
			}
					
						?>
				</div>
			 </td>
			 </tr>
			 
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
							
			</script>
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
			}}
	mysqli_close($conn);
    ?>
	 </tbody>
    </table>
	
	
	<?php
include('conn.php');

if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
	} else {
		$page_no = 1;
        }

	$total_records_per_page = 10;
    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

	$result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM `files` WHERE restriction = 'Open to All'");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1
    $result = mysqli_query($conn,"SELECT * FROM `files` WHERE restriction = 'Open to All' ORDER by id DESC LIMIT $offset, $total_records_per_page ");
    while($fetch = mysqli_fetch_array($result)){
		$did = $fetch['id'];
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
 <p><font face="verdana" color="green" ><strong><?php echo $subject?></strong></font></p>


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
			  echo "<td width='10%'>". $fetch['status'] ."</td>";
			  echo "<td width='35%'>". $fetch['remarks'] ."</td>";
              echo "<td width='25%'>". $fetch['date'] ."</td>";
              echo "</tr>";
              echo "</tbody>";


              }?>

            </table>

          </div>

          <div class="modal-footer">
				
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
	mysqli_close($conn);
    ?>
	
</tbody>
</table>


    </tbody>
    </table>
	</main>
  </div>
  	 <p class="mt-5 mb-3 text-muted text-center">&copy; TIEZA-MISD 2019</p>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
      </body>
</html>
