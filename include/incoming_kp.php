<?PHP

session_start();

if (!isset($_SESSION['login'])) {
header('Location: index.php');
}

?>
<?php 
require("conn.php");
include 'filesLogic.php';
include('pagination_admin_kp.php');
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
    <meta http-equiv="refresh" content="30">
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

<?php include 'navigation_admin.php';?>

 <main role="main" class="container-fluid">
  <div class="jumbotron">  
        <a href="search.php" class="text-decoration-none float-right">&nbsp;
         <button type="button" title="SEARCH"  class="btn btn-primary" ><i class="fas fa-search"></i></button>
      </button></a>

		<div class="dropdown float-right">
		  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-download"></i>
		  </button>
		  <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
			<a class="dropdown-item" href="download_bulk.php?department=<?php echo $fetch['department']?>" target="_blank" >BULK</a>
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
   	<?php
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
	
	include('conn.php');
	 $id = (int) $_SESSION['login'];
	 $query = $conn->query ("SELECT * FROM `admin` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$department = $file['department'];
	$result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM `files` where forw = '$department' ");
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
	</ul>
      <hr>
  <div style="overflow-x:auto;">
    <table class="table table-dark">    

    
    <tr >
        <td width="15%"><strong>RECORD ID</strong></td>
        <td width="20%"><strong>FROM</strong></td>
		<td width="10%"><strong>CATEGORY</strong></td>
        <td width="30%"><strong>SUBJECT</strong></td>
		<td width="10%"><strong>DATE</strong></td>
		<td width="10%"><strong>FILE TYPE</strong></td>
		<td align="center" width="15%"><strong>ACTION</strong></td>
    </tr>
    <tbody>

	<?php
include('conn.php');
		 $id = (int) $_SESSION['login'];
			$query = $conn->query ("SELECT * FROM `admin` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
					$nquery=mysqli_query($conn,"select * from `tags` WHERE tag = '$tid' ORDER BY id DESC LIMIT $offset, $total_records_per_page   ");
			foreach ( $nquery as $get){
			 $track = $get['track'];
			 $primary_id = $get['primary_id'];
			 $id = $get['id'];
			 
    $result = mysqli_query($conn,"SELECT * FROM `ca_files` WHERE id = '$id'  ");
    foreach ( $result as $fetch){
		
			$id = $fetch['id'];
			$subject = $fetch['subject'];
			$classification = $fetch['classification'];
			$receive = $fetch['receive']
		
	
    ?>

	
         <tr>
        <td ><?php echo $fetch['docu_id']; ?></td>
          <td><?php echo $fetch['fromw']; ?><br></td>
		  <td><?php echo $fetch['category']; ?></td>
          <td><?php echo $fetch['subject']; ?></td>
          <td><?php echo $fetch['date']; ?></td>
          <td><?php echo $fetch['classification2']; ?></td>
		   
			 <td align="center">
			 	<div class="btn-group btn-group-justified">
					<button type="button" class="btn btn-primary" title="STATUS">
						<a data-toggle="modal" data-target="#myModall<?php echo $fetch['id']?>" style="text-decoration-none;color:white;">
							<i class="far fa-file"></i>
						</a>
					</button>
					
					<?php 
						$id = $fetch['id'];
						$query = $conn->query("SELECT * FROM `subfiles` WHERE `id` = '$id'");
						$row=$query->fetch_array  ();
		
		
						$run_num_rows = $query->num_rows;
							if ($run_num_rows > 0 ){
					?>
					
					<button type="button" class="btn btn-primary" title="SUB FILE">
						<a data-toggle="modal" data-target="#mysub<?php echo $fetch['id']?>" style="text-decoration-none;color:#ff8a80">
						<i class="fas fa-file-upload"></i>
						</a>
					</button>
					
					<?php 
							}
						else {
					?>
						
					  <button type="button" class="btn btn-primary" title="SUB FILE">
						<a data-toggle="modal" data-target="#mysub<?php echo $fetch['id']?>" style="text-decoration-none;color:White;">
						<i class="fas fa-file-upload"></i>
						</a>
					</button>
					<?php 
							}
					
						?>

					<button type="button" class="btn btn-primary" title="EDIT">
						<a data-toggle="modal" data-target="#myModal<?php echo $fetch['id']?>" style="text-decoration-none;color:white;">
							<i class="far fa-edit"></i>
						</a>
					</button>
						
					<button type="button" class="btn btn-primary" title="TAG">
						<a data-toggle="modal" data-target="#tags<?php echo $fetch['id']?>" style="text-decoration-none;color:white;">
							<i class="fas fa-tags"></i>
						</a>
					</button>

					</button>
					
				<?php 
					
				if ($track == 0){
				?>
					   <button  class="btn btn-primary" id="myButton" title="PREVIEW">
						<a href="fetch_kp.php?primary_id=<?php echo $primary_id?>" target="_blank"  class="text-decoration-none" style="color:#ff8a80;">
							<i class="fas fa-eye"></i>	
						</a>
						</button>
						<script>
						$(document).ready(function(){
							$("#myButton").click(function(){
								location.reload(true);
							});
						});
						</script>
				<?php }
					else
					{
						?>
					<button class="btn btn-primary" id="myyButton" title="PREVIEW">
						<a href="fetch_kp.php?primary_id=<?php echo $primary_id?>" target="_blank"  class="text-decoration-none" style="color:white;">
							<i class="fas fa-eye"></i>	
						</a>
					</button>
					<script>
						$(document).ready(function(){
							$("#myyButton").click(function(){
								location.reload(true);
							});
						});
						</script>
					<?php 
			}
					
						?>
					
					
				
							
					<button type="button" name="delete" value="C:\xampp\htdocs\ss\archive<?php echo $fetch['name']?>" class="btn btn-primary" title="DELETE">
						<a data-toggle="modal" data-target="#delete<?php echo $fetch['id']?>" style="text-decoration-none;color:white;">
							<i class="fas fa-trash-alt"></i>
						</a>
				</button>
				</div>
			</td>
		
		  
			<?php }}?>
		
		
		
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
         <a href="deletedata.php?name=<?php echo $fetch['name'] ?>"   class="btn btn-primary"><i class="fas fa-trash-alt"></i></a>
						 <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
					</div>
      </div>
    </div>
  </div>
</div>

	<?php
include('conn.php');
		 $id = (int) $_SESSION['login'];
			$query = $conn->query ("SELECT * FROM `admin` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
					$nquery=mysqli_query($conn,"select * from `tags` WHERE tag = '$tid' ORDER BY id DESC LIMIT $offset, $total_records_per_page   ");
			foreach ( $nquery as $get){
			 $track = $get['track'];
			 $primary_id = $get['primary_id'];
			 $id = $get['id'];
			 
    $result = mysqli_query($conn,"SELECT * FROM `ca_files` WHERE id = '$id'  ");
    foreach ( $result as $fetch){
		
			$id = $fetch['id'];
			$subject = $fetch['subject'];
			$classification = $fetch['classification'];
			$receive = $fetch['receive']
		
	
    ?>
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
									<div class="col">
									 	<label><strong>Date:</strong> </label>
									<input class="form-control"  name="date" placeholder="Date:" readonly="read-only"
									 value="<?php echo $fetch['date']; ?>"  /> <!--  -->
									</div>
									<div class="col">
									 <label><strong>Classification:</strong> </label>
									<input name="classification" class="form-control" rows="5"  type="text" placeholder="Classification:" 
									value="<?php echo $fetch['classification'];?>" /></input>
									</div>
								</div><br>
								
								<div class="form-row">
									<div class="col">
									 <label><strong>Category:</strong> </label>
									<input class="form-control"  name="category"
									 value="<?php echo $fetch['category']; ?>" />
									</div>
									
									<div class="col">
									 <label><strong># Pages:</strong> </label>
									<input class="form-control"  name="pages" placeholder="Pages:"
									 value="<?php echo $fetch['pages']; ?>" />
									</div>
								</div><br>
								
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
			}}
        ?>

      </tbody>
    </table>

	<?php
include('conn.php');
		 $id = (int) $_SESSION['login'];
			$query = $conn->query ("SELECT * FROM `admin` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
					$nquery=mysqli_query($conn,"select * from `tags` WHERE tag = '$tid' ORDER BY id DESC LIMIT $offset, $total_records_per_page   ");
			foreach ( $nquery as $get){
			 $track = $get['track'];
			 $primary_id = $get['primary_id'];
			 $id = $get['id'];
			 
    $result = mysqli_query($conn,"SELECT * FROM `ca_files` WHERE id = '$id'  ");
    foreach ( $result as $fetch){
		
			$id = $fetch['id'];
			$subject = $fetch['subject'];
			$classification = $fetch['classification'];
			$receive = $fetch['receive']
		
	
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
				  $track = $fetch['track'];
				  $primary_id = $fetch['primary_id'];


              echo "<tbody>";
              echo "<tr>";
              echo "<td width='35%'>". $fetch['sub_docu'] ."</td>";
			  echo "<td width='10%'>". $fetch['pages'] ."</td>";
              echo "<td width='25%'>". $fetch['date'] ."</td>";
			  echo "<td width='25%'>". $fetch['department'] ."</td>";
			  echo "<td width='30%'>". $fetch['action'] ."</td>";
			  echo "<td width='30%'>";
					?>
						<?php 
					
				if ($track == 0){
				?>
					   
					<button  type='button' class='btn btn-primary' title='PREVIEW'>
						<a href="fetch_sub.php?primary_id=<?php echo $primary_id?>" target="_blank"  class="text-decoration-none" style="color:#ff8a80;">
							<i class="fas fa-eye"></i>	
						</a>
					</button>
				<?php }
					else
					{
						?>
					
					<button  class="btn btn-primary"  title="PREVIEW">
						<a href="fetch_sub.php?primary_id=<?php echo $primary_id?>" target="_blank"  class="text-decoration-none" style="color:white">
							<i class="fas fa-eye"></i>	
						</a>
						</button>
					<?php 
			}	
					
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
			}}
        ?>

      </tbody>
    </table>

	<?php
include('conn.php');
		 $id = (int) $_SESSION['login'];
			$query = $conn->query ("SELECT * FROM `admin` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
					$nquery=mysqli_query($conn,"select * from `tags` WHERE tag = '$tid' ORDER BY id DESC LIMIT $offset, $total_records_per_page   ");
			foreach ( $nquery as $get){
			 $track = $get['track'];
			 $primary_id = $get['primary_id'];
			 $id = $get['id'];
			 
    $result = mysqli_query($conn,"SELECT * FROM `ca_files` WHERE id = '$id'  ");
    foreach ( $result as $fetch){
		
			$id = $fetch['id'];
			$subject = $fetch['subject'];
			$classification = $fetch['classification'];
			$receive = $fetch['receive']
		
	
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
			} }
        ?>
		
	<?php
include('conn.php');
		 $id = (int) $_SESSION['login'];
			$query = $conn->query ("SELECT * FROM `admin` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
					$nquery=mysqli_query($conn,"select * from `tags` WHERE tag = '$tid' ORDER BY id DESC LIMIT $offset, $total_records_per_page   ");
			foreach ( $nquery as $get){
			 $track = $get['track'];
			 $primary_id = $get['primary_id'];
			 $id = $get['id'];
			 
    $result = mysqli_query($conn,"SELECT * FROM `ca_files` WHERE id = '$id'  ");
    foreach ( $result as $fetch){
		
			$id = $fetch['id'];
			$subject = $fetch['subject'];
			$classification = $fetch['classification'];
			$receive = $fetch['receive']
		
	
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
				$docu_id=$fetch['docu_id'];
				$query = $conn->query ("SELECT * FROM tags WHERE id = $id AND docu_id = '$docu_id'") or die (mysql_error());
				
				
				foreach ( $query as $get)
				{
					$track = $get['track'];
					$tag = $get['tag'];
					if ($track==1)
						{
						
							echo "<tbody>";
							echo "<tr>";
							
							$query = $conn->query("SELECT * FROM admin WHERE tid = '$tag' ORDER by lname ASC ");
							$row=$query->fetch_array  ();
							$run_num_rows = $query->num_rows;
								if ($run_num_rows > 0 )
									{
										$query = $conn->query ("SELECT * FROM admin WHERE tid = '$tag' ORDER by lname ASC ") or die (mysqli_error());
										while($fetch = mysqli_fetch_array($query))
										{
											echo "<td width='30%'>". $fetch['lname'] .", ". $fetch['fname'] ." ". $fetch['mname'] ." - ". $fetch['department'] ."</td>";
										}
											echo "<td width='20%'>". $get['date'] ."</td>";
											echo "<td width='10%'> VIEWED</td>";
											echo "<td width='20%'>". $get['dateviewed'] ."</td>";
									}
									else
									{
									    $id = $fetch['id'];
                        				$query = $conn->query ("SELECT * FROM tags WHERE id = $id ") or die (mysql_error());
                        				
                        				
                        				foreach ( $query as $get)
                        				{
                        					$track = $get['track'];
                        					$tag = $get['tag'];
										$query = $conn->query ("SELECT * FROM admin WHERE tid = '$tag' ORDER by lname ASC ") or die (mysqli_error());
										while($fetch = mysqli_fetch_array($query))
										{
											echo "<td width='30%'>". $fetch['lname'] .", ". $fetch['fname'] ." ". $fetch['mname'] ." - ". $fetch['department'] ."</td>";
										}
											echo "<td width='20%'>". $get['date'] ."</td>";
											echo "<td width='10%'> VIEWED</td>";
											echo "<td width='20%'>". $get['dateviewed'] ."</td>";
									}
									}
							
						}
					else
						{
							echo "<tbody>";
							echo "<tr>";
							$query = $conn->query("SELECT * FROM users WHERE tid = '$tag' ORDER by lname ASC ");
							$row=$query->fetch_array  ();
							$run_num_rows = $query->num_rows;
								if ($run_num_rows > 0 )
									{
										$query = $conn->query ("SELECT * FROM users WHERE tid = '$tag' ") or die (mysqli_error());
										while($fetch = mysqli_fetch_array($query)){
										echo "<td width='30%'>". $fetch['lname'] .", ". $fetch['fname'] ." ". $fetch['mname'] ." - ". $fetch['department'] ."</td>";}
										echo "<td width='20%'>". $get['date'] ."</td>";
										echo "<td width='10%'></td>";
										echo "<td width='20%'>". $get['dateviewed'] ."</td>";
									}
								else
								{
									$query = $conn->query ("SELECT * FROM admin WHERE tid = '$tag' ") or die (mysqli_error());
										while($fetch = mysqli_fetch_array($query)){
										echo "<td width='30%'>". $fetch['lname'] .", ". $fetch['fname'] ." ". $fetch['mname'] ." - ". $fetch['department'] ."</td>";}
										
										echo "<td width='20%'>". $get['date'] ."</td>";
										echo "<td width='10%'></td>";
										echo "<td width='20%'>". $get['dateviewed'] ."</td>";
								}
								
						
						}
				}
					 
			 
				
					
              echo "</tr>";
              echo "</tbody>";
						
						
			
		
			?>
			
			
			
			
			
			

            </table>
			
          </div>

          <div class="modal-footer">
		  
				<a href="download_trail.php?id=<?php echo $id?>" target="_blank" class="text-decoration-none">
					<button title="AUDIT TRAIL" type="button" class="btn btn-success" >
						<i class="fas fa-file-pdf"></i>
					</button>
				</a>
		  
				<button type="button" name="delete" class="btn btn-secondary" title="REMOVE TAG">
						<a href="remove_tag.php?id=<?php echo $id?>" class="text-decoration-none" style="text-decoration-none;color:white;>" >
							<i class="fas fa-trash-alt"></i>
						</a>
				</button>

					<button name="add" title="ADD TAG" class="btn btn-primary nav-link dropdown-toggle dropdown-toggle-split " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration-none;color:white;">
						<i class="fas fa-user-plus"></i>
					</button>
					
					<?php
					$login = (int) $_SESSION['login'];
					$query = $conn->query ("SELECT department FROM admin WHERE id = '$login' ") or die (mysqli_error());
					$get = $query->fetch_array ();
					$department = $get['department'];
					?>
						<div class="dropdown-menu">
							<a href="tag_tosector.php?id=<?php echo $id?>" class="text-decoration-none" 		style="text-decoration-none;color:BLack;>">
								&nbsp;&nbsp;&nbsp;<i class="fas fa-user-plus">&nbsp;&nbsp;SECTOR</i>
							</a><br>
							<a href="tag_todept_kp.php?id=<?php echo $id?>" class="text-decoration-none" style="text-decoration-none;color:BLack;>">
									&nbsp;&nbsp;&nbsp;<i class="fas fa-user-plus">&nbsp;&nbsp;DEPARTMENT</i>
							</a>
						</div>
			
				<button class="btn btn-danger" type="button" data-dismiss="modal"> <i class="fas fa-window-close"></i></button>
				
		  </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


 <?php
		} }
		
        ?>
		
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
