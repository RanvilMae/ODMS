<?PHP

session_start();

if (!isset($_SESSION['tm'])) {
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

	<link rel="stylesheet" type="text/css" href="datatable/datatable.css">
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
 .count-notif{
      vertical-align:middle;
      margin-left:-10px;
      margin-top: -15px;
      font-size:13px;
      color: white;
      
    } 
.notif .badges {
    position: absolute;
    padding: 0px 6px;
    border-radius: 100%;
    background-color: white;
     color: red;
}
    </style>
    <!-- Custom styles for this template -->
  
  </head>
  <body>

  <?php include 'navigation_topmanager.php';?>
  
 <main role="main" class="container-fluid">

  <div class="jumbotron">

  <div class="float-right"> 
    <a href="search_topmanager.php" class="text-decoration-none">
    <button type="button" class="btn btn-primary" title="SEARCH" ><i class="fas fa-search"></i></button>
      </button></a>

   </div>
    <div>
       <h3><strong>VIEW DATA</strong></h3>
    </div>
    <div>
      <hr>
    </div>
	    <div class="row">
    	<div class="col-lg-12">
    		<table class="table table-dark " id="data_table">
    			<thead>
    				<tr>
				        <th width="15%"><strong>RECORD ID</strong></th>
				        <th width="20%"><strong>FROM</strong></th>
						<th width="10%"><strong>CATEGORY</strong></th>
				        <th width="30%"><strong>SUBJECT</strong></th>
						<th width="10%"><strong>DATE</strong></th>
						<th width="10%"><strong>FILE TYPE</strong></th>
						<th align="center" width="15%"><strong>ACTION</strong></th>
				    </tr>
    			</thead>
    			<tbody>
<?php
include('conn.php');
					$id = (int) $_SESSION['tm'];
				$query = $conn->query ("SELECT * FROM `users` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
		$department = $fetch['department'];
					$nquery=mysqli_query($conn,"select * from `tagto_personnels` WHERE tag = '$tid' ORDER by id DESC ");
			foreach ( $nquery as $get){
			 $track = $get['track'];
			 $primary_id = $get['primary_id'];
			 $id = $get['id'];
    $result = mysqli_query($conn,"SELECT * FROM `files` WHERE restriction = 'Open to All' AND  id = '$id'  ");
    foreach ( $result as $fetch){
		$did = $fetch['id'];
		$subject = $fetch['subject'];
	
    ?>
		
				
	
	                    <tr>
				          	<td style="color: black;"><?php echo $fetch['docu_id']; ?></td>
				          	<td style="color: black;"><?php echo $fetch['fromw']; ?><br><?php echo $fetch['from_specific']; ?></td>
						  	<td style="color: black;"><?php echo $fetch['category']; ?></td>
				          	<td style="color: black;"><?php echo $fetch['subject']; ?></td>
				          	<td style="color: black;"><?php echo $fetch['date']; ?></td>
				          	<td style="color: black;"><?php echo $fetch['restriction']; ?></td>
				          	<td align="center">
			  	<div class="btn-group btn-group-justified">
			 		<button type="button" class="btn btn-primary" title="STATUS">
			 		<a class="notif" data-toggle="modal" data-target="#myModall<?php echo $fetch['id']?>" style="text-decoration-none;color:white;"><i class="far fa-file"></i><span class="badges count-notif" >
								<?php
                            		 $id = $fetch['id'];
                                $sql = "SELECT COUNT(id) FROM `remarks` WHERE `id` = '$id'";  
                            				$rs_result = mysqli_query($conn, $sql);  
                            				$row = mysqli_fetch_row($rs_result);  
                            				$total_records = $row[0];   
                            					echo $total_records;
                                ?>
					
							</span></a>
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
			 		
			 		
			 		<button type="button" class="btn btn-primary" title="DETAILS">
			 		   <a data-toggle="modal" data-target="#myModal<?php echo $fetch['id']?>" style="text-decoration-none;color:white;">
			 				<i class="fas fa-info"></i>
			 			</a>
					
			 		</button>
					
					<button type="button" class="btn btn-primary" title="TAG">
						<a data-toggle="modal" data-target="#tags<?php echo $fetch['id']?>" style="text-decoration-none;color:white;">
							<i class="fas fa-tags"></i>
						</a>
					</button>
					
					
			 		<?php 
					
				if ($track == 0){
				?>
					   <button  class="btn btn-primary" id="myButton" title="PREVIEW">
						<a href="fetchin_user.php?primary_id=<?php echo $primary_id?>" target="_blank"  class="text-decoration-none" style="color:#ff8a80;">
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
						<a href="fetchin_user.php?primary_id=<?php echo $primary_id?>" target="_blank"  class="text-decoration-none" style="color:white;">
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
				</div>
			 </td>
			 </tr>
			 
			   <!---Modal for EDit ----->
			<div class="modal fade" id="myModal<?php echo $fetch['id']?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		
			<form method="POST" action="update.php">
				<div class="modal-header">
					<h3><strong></label>FILE DETAILS</strong></h3>
				</div>
				
			<div class="modal-body">
			<p><font face="verdana" color="green" ><strong><?php echo $subject?></strong></font></p>
									<input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
								
								<div class="row" required>
								<div class="col">
									<label><strong>Date:</strong> </label>
									<input class="form-control"  name="date" placeholder="Date:" disabled
									 value="<?php echo $fetch['date']; ?>" />
								</div><br>
								
								<div class="col">
									<label for="from"><strong>From / Signatory:</strong></label>
									<input class="form-control" type="text" name="fromw" placeholder="From:" disabled
									 value="<?php echo $fetch['fromw'];?>" />
									</div><br>
									</div>
									
								<div class="row" required>
								<div class="col">
									<label><strong>No. of Pages:</strong> </label>
									<input class="form-control"  name="pages" placeholder="Pages:" disabled
									 value="<?php echo $fetch['pages']; ?>" />
								</div>
								
								<div class="col">
									<label><strong>Classification:</strong> </label>
									<input name="classification" class="form-control" rows="5"  type="text" placeholder="Classification:" disabled
									value="<?php echo $fetch['classification'];?>" /></input>
								</div>
								</div>
								
								
								<label for="forw"><strong>For / To:</strong></label>
									<input class="form-control" type="text" name="forw" placeholder="For:" disabled
									value="<?php echo $fetch['forw'];?>" />
								
								<label><strong>Subject:</strong></label>
												<textarea class="form-control"name="id"
												 disabled rows="3" ><?php echo $subject; ?></textarea><br>
							
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
    	</div>
    </div>
	

<?php
include('conn.php');
					$id = (int) $_SESSION['tm'];
				$query = $conn->query ("SELECT * FROM `users` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
		$department = $fetch['department'];
					$nquery=mysqli_query($conn,"select * from `tagto_personnels` WHERE tag = '$tid' ORDER by id DESC ");
			foreach ( $nquery as $get){
			 $track = $get['track'];
			 $primary_id = $get['primary_id'];
			 $id = $get['id'];
    $result = mysqli_query($conn,"SELECT * FROM `files` WHERE restriction = 'Open to All' AND  id = '$id' LIMIT 10  ");
    foreach ( $result as $fetch){
		$did = $fetch['id'];
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
				  <th class="tablecell">REMARKS</th>
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
			  echo "<td width='25%'>". $fetch['remarks'] ."</td>";
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
				<a href="download_subfiles_tm.php?id=<?php echo $id?>" target="_blank" class="text-decoration-none">
					<button title="PREVIEW" type="button" class="btn btn-success" >
						<i class="fas fa-file-pdf"></i>
					</button>
				</a>
				<a href="subfile_tm.php?id=<?php echo $id?>" class="text-decoration-none">
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
	mysqli_close($conn);
    ?>
	 	</tbody>
    		</table>
    	</div>
    </div>
	

<?php
include('conn.php');
					$id = (int) $_SESSION['tm'];
				$query = $conn->query ("SELECT * FROM `users` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
		$department = $fetch['department'];
					$nquery=mysqli_query($conn,"select * from `tagto_personnels` WHERE tag = '$tid' ORDER by id DESC ");
			foreach ( $nquery as $get){
			 $track = $get['track'];
			 $primary_id = $get['primary_id'];
			 $id = $get['id'];
    $result = mysqli_query($conn,"SELECT * FROM `files` WHERE restriction = 'Open to All' AND  id = '$id' LIMIT 10  ");
    foreach ( $result as $fetch){
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
				<a href="remarks_topmanager_tag.php?id=<?php echo $id?>" class="text-decoration-none">
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
			}}
	mysqli_close($conn);
    ?>
		</tbody>
    		</table>
    	</div>
    </div>
	

<?php
include('conn.php');
					$id = (int) $_SESSION['tm'];
				$query = $conn->query ("SELECT * FROM `users` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
		$department = $fetch['department'];
					$nquery=mysqli_query($conn,"select * from `tagto_personnels` WHERE tag = '$tid' ORDER by id DESC ");
			foreach ( $nquery as $get){
			 $track = $get['track'];
			 $primary_id = $get['primary_id'];
			 $id = $get['id'];
    $result = mysqli_query($conn,"SELECT * FROM `files` WHERE restriction = 'Open to All' AND  id = '$id' LIMIT 10  ");
    foreach ( $result as $fetch){
		$did = $fetch['id'];
		$subject = $fetch['subject'];
	
    ?>
<!---Modal for TAGS----->
    <div class="modal fade" id="tags<?php echo $fetch['id']?>" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <div class="modal-header">
            <h3 class="modal-title">TAGS</h3>
          </div>
		  <div> 
		    <p><font face="verdana" color="green" class="float-left"><strong>&nbsp;<?php echo $subject?></strong></font></p>
		  </div>
          
          <div class="modal-body">
				 <p><font face="Britannic Bold" class="float-left"><strong>DEPARTMENTS</strong></font></p>
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
										while($fetchh = mysqli_fetch_array($query))
										{
											echo "<td width='30%'>". $fetchh['lname'] .", ". $fetch['fname'] ." ". $fetchh['mname'] ." - ". $fetchh['department'] ."</td>";
										}
											echo "<td width='20%'>". $get['date'] ."</td>";
											echo "<td width='10%'> VIEWED</td>";
											echo "<td width='20%'>". $get['dateviewed'] ."</td>";
									}
									else
									{
										$query = $conn->query ("SELECT * FROM admin WHERE tid = '$tag' ORDER by lname ASC ") or die (mysqli_error());
										while($fetchh = mysqli_fetch_array($query))
										{
											echo "<td width='30%'>". $fetchh['lname'] .", ". $fetch['fname'] ." ". $fetch['mname'] ." - ". $fetchh['department'] ."</td>";
										}
											echo "<td width='20%'>". $get['date'] ."</td>";
											echo "<td width='10%'> VIEWED</td>";
											echo "<td width='20%'>". $get['dateviewed'] ."</td>";
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
										while($fetchh = mysqli_fetch_array($query)){
										echo "<td width='30%'>". $fetchh['lname'] .", ". $fetchh['fname'] ." ". $fetchh['mname'] ." - ". $fetchh['department'] ."</td>";}
										echo "<td width='20%'>". $get['date'] ."</td>";
										echo "<td width='10%'></td>";
										echo "<td width='20%'>". $get['dateviewed'] ."</td>";
									}
								else
								{
									$query = $conn->query ("SELECT * FROM admin WHERE tid = '$tag' ") or die (mysqli_error());
										while($fetchh = mysqli_fetch_array($query)){
										echo "<td width='30%'>". $fetchh['lname'] .", ". $fetchh['fname'] ." ". $fetchh['mname'] ." - ". $fetchh['department'] ."</td>";}
										
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
            
            <?php 
            include('conn.php');
		    $id = (int) $_SESSION['tm'];
            $query = $conn->query ("SELECT * FROM `users` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		    $file = $query->fetch_array ();
		    $tid = $file['tid'];
		    $department = $file['department'];
			$nquery=mysqli_query($conn,"select * from `tagto_personnels` WHERE tag = '$tid' ");
					$row=$nquery->fetch_array  ();
					$run_num_rows = $query->num_rows;
					if ($run_num_rows > 0 )
						{
								    
			?>
            
			 <p><font face="Britannic Bold"  class="float-left"><strong><?php echo $department;?> PERSONNEL/S</strong></font></p>
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
				$query = $conn->query ("SELECT * FROM tagto_personnels WHERE id = $id ") or die (mysql_error());
				
				foreach ( $query as $get)
				{
					$track = $get['track'];
					$tag = $get['tag'];
					if ($track==1)
						{
						
							echo "<tbody>";
							echo "<tr>";
							
							$query = $conn->query("SELECT * FROM users WHERE tid = '$tag' ORDER by lname ASC ");
							$row=$query->fetch_array  ();
							$run_num_rows = $query->num_rows;
								if ($run_num_rows > 0 )
									{
										$query = $conn->query ("SELECT * FROM users WHERE tid = '$tag' ORDER by lname ASC ") or die (mysqli_error());
										while($fetchh = mysqli_fetch_array($query))
										{
											echo "<td width='30%'>". $fetchh['lname'] .", ". $fetchh['fname'] ." ". $fetchh['mname'] ." - ". $fetchh['department'] ."</td>";
										}
											echo "<td width='20%'>". $get['date'] ."</td>";
											echo "<td width='10%'> VIEWED</td>";
											echo "<td width='20%'>". $get['dateviewed'] ."</td>";
									}
									else
									{
										$query = $conn->query ("SELECT * FROM users WHERE tid = '$tag' ORDER by lname ASC ") or die (mysqli_error());
										while($fetchh = mysqli_fetch_array($query))
										{
											echo "<td width='30%'>". $fetchh['lname'] .", ". $fetchh['fname'] ." ". $fetchh['mname'] ." - ". $fetchh['department'] ."</td>";
										}
											echo "<td width='20%'>". $get['date'] ."</td>";
											echo "<td width='10%'> VIEWED</td>";
											echo "<td width='20%'>". $get['dateviewed'] ."</td>";
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
										while($fetchh = mysqli_fetch_array($query)){
										echo "<td width='30%'>". $fetchh['lname'] .", ". $fetchh['fname'] ." ". $fetchh['mname'] ." - ". $fetchh['department'] ."</td>";}
										echo "<td width='20%'>". $get['date'] ."</td>";
										echo "<td width='10%'></td>";
										echo "<td width='20%'>". $get['dateviewed'] ."</td>";
									}
								else
								{
									$query = $conn->query ("SELECT * FROM admin WHERE tid = '$tag' ") or die (mysqli_error());
										while($fetchh = mysqli_fetch_array($query)){
										echo "<td width='30%'>". $fetchh['lname'] .", ". $fetchh['fname'] ." ". $fetchh['mname'] ." - ". $fetchh['department'] ."</td>";}
										
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
            
            <?php 
						}
				else{
				    
				}
            ?>
            
            
            
            
            
            
			
          </div>

           <div class="modal-footer">
				<button type="button" name="add" class="btn btn-primary" title="ADD TAG">
						<a href="add_tag_user.php?id=<?php echo $id?>" class="text-decoration-none" style="text-decoration-none;color:white;>" >
							<i class="fas fa-user-plus"></i>
						</a>
				</button>		
				
				
				<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span><i class="fas fa-window-close"></i></button>
		  </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    </tbody>
    </table>
	<?php
			}}
	mysqli_close($conn);
    ?>
    	</tbody>
    		</table>
    	</div>
    </div>
	
	</main>
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
