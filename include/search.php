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

<?php include 'navigation_admin.php';?>

<script type="text/javascript">
$(function() {
 
    $("search").click(function() {
        // getting the value that user typed
        var searchString    = $("#search").val();
        // forming the queryString
        var data            = 'search='+ searchString;
         
        // if searchString is not empty
        if(searchString) {
            // ajax call
            $.ajax({
                type: "POST",
                url: "search.php",
                data: data,
                beforeSend: function(html) { // this happens before actual call
                    $("#results").html(''); 
                    $("#searchresults").show();
                    $(".word").html(searchString);
               },
               success: function(html){ // this happens after we get results
                    $("#results").show();
                    $("#results").append(html);
              }
            });    
        }
        return false;
    });
});
</script>

	
 <main role="main" class="container-fluid">
  <div class="jumbotron">

   <h3><strong>SEARCH</strong></h3>
   
 <hr>
    
<form method="post">
 <div class="form-row">
			
			<div class="form-group col-md-2">
				<input class="form-control"  type="text" placeholder="Search.." name="search"></input>
			</div>
			<button type="submit" title="SEARCH"  name="save" class="btn btn-primary mb-2"><i class="fas fa-search"></i></button>
				</div>

</form><br>
 <div class="row">
    	<div class="col-lg-12">
    		<table class="table table-dark " id="data_table">
    			<thead> 
    <tr>
        <td><strong>RECORD ID</strong></td>
        <td><strong>FROM</strong></td>
		<td><strong>CATEGORY</strong></td>
        <td><strong>SUBJECT</strong></td>
		<td><strong>DATE</strong></td>
		<td><strong>FILE TYPE</strong></td>
		<td align="center"><strong>ACTION</strong></td>
    </tr>
    			</thead>
    <tbody>
	
<?php
	$count=1;
	$id = (int) $_SESSION['login'];
					
if(isset($_POST['search'])){
					$query = $conn->query ("SELECT * FROM admin WHERE id = '$id' ") or die (mysqli_error());
				$fetch = $query->fetch_array ();
				$department = $fetch['department'];
	$search=$_POST['search'];
	$query="select * from files WHERE 
			forw like '%".$search."%' AND department = '$department'
			OR fromw like '%".$search."%' AND department = '$department'
		OR docu_id like '%".$search."%' AND department = '$department'
		OR name like '%".$search."%' AND department = '$department'
		OR subject like '%".$search."%'  AND department = '$department'
		OR date like '%".$search."%' AND department = '$department'
		OR category like '%".$search."%' AND department = '$department'
		OR restriction like '%".$search."%' AND department = '$department' ORDER BY id DESC";
	$result =  mysqli_query($conn, $query);

  while($file= mysqli_fetch_assoc($result)) { 
   $subject = $file['subject'];
   $classification = $file['classification'];
   ?>
  <tr>
			<tr>
        	<td style="color: black;"><?php echo $file['docu_id']; ?></td>
				          	<td style="color: black;"><?php echo $file['fromw']; ?><br><?php echo $fetch['from_specific']; ?></td>
						  	<td style="color: black;"><?php echo $file['category']; ?></td>
				          	<td style="color: black;"><?php echo $file['subject']; ?></td>
				          	<td style="color: black;"><?php echo $file['date']; ?></td>
				          	<td style="color: black;"><?php echo $file['restriction']; ?></td>

			<td align="center">
				<div class="btn-group btn-group-justified">
						<button type="button" class="btn btn-primary" title="STATUS">
						<a class="notif" data-toggle="modal" data-target="#myModall<?php echo $file['id']?>" style="text-decoration-none;color:white;"><i class="far fa-file"></i><span class="badges count-notif" >
								<?php
                            		 $id = $file['id'];
                                $sql = "SELECT COUNT(id) FROM `remarks` WHERE `id` = '$id'";  
                            				$rs_result = mysqli_query($conn, $sql);  
                            				$row = mysqli_fetch_row($rs_result);  
                            				$total_records = $row[0];   
                            					echo $total_records;
                                ?>
					
							</span></a>
					</button>
					
					
					
				<?php 
						$id = $file['id'];
						$query = $conn->query("SELECT * FROM `subfiles` WHERE `id` = '$id'");
						$row=$query->fetch_array  ();
		
		
						$run_num_rows = $query->num_rows;
							if ($run_num_rows > 0 ){
					?>
					
					<button type="button" class="btn btn-primary" title="SUB FILE">
						<a data-toggle="modal" data-target="#sub<?php echo $file['id']?>" style="text-decoration-none;color:#ff8a80">
						<i class="fas fa-file-upload"></i>
						</a>
					</button>
					
					<?php 
							}
						else {
					?>
						
					  <button type="button" class="btn btn-primary" title="SUB FILE">
						<a data-toggle="modal" data-target="#sub<?php echo $file['id']?>" style="text-decoration-none;color:White;">
						<i class="fas fa-file-upload"></i>
						</a>
					</button>
					<?php 
							}
					
						?>

					<button type="button" class="btn btn-primary" title="EDIT">
						<a data-toggle="modal" data-target="#myModal<?php echo $file['id']?>" style="text-decoration-none;color:white;">
							<i class="far fa-edit"></i>
						</a>
					</button>

					
					
					<button type="button" class="btn btn-primary" title="TAG">
						<a data-toggle="modal" data-target="#tags<?php echo $file['id']?>" style="text-decoration-none;color:white;">
							<i class="fas fa-tags"></i>
						</a>
					</button>
					
					<button type="button" class="btn btn-primary" title="PREVIEW">
						<a href="uploads/<?php echo $fetch['department']?>/<?php echo $file['name']?>" target="_blank" class="text-decoration-none" style="color:white;">
							<i class="fas fa-eye"></i>
						</a>
					</button>
					

					<!---	<button type="button" name="delete" name="fileToRemove" value="C:\xampp\htdocs\FMS\uploads<?php echo $file['name']?>" class="btn btn-primary" title="DELETE">
						<a data-toggle="modal" name="fileToRemove" value="C:\xampp\htdocs\FMS\uploads<?php echo $file['name']?>" data-target="#delete<?php echo $file['id']?>" style="text-decoration-none;color:white;">
							<i class="fas fa-trash-alt"></i>
						</a>
					</button> --->
				</div>
			</td>
				</tr>	
				
				 <!---Modal for EDit ----->
				<div class="modal fade" id="myModal<?php echo $file['id']?>" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
			
							<form method="POST"  enctype="multipart/form-data" action= "save_search.php">>
								<div class="modal-header">
									<h3><strong>UPDATE</strong></h3>
									
								</div>
								<div class="modal-header">
								
									 <p><font face="verdana" color="green" class="float-left"><strong><?php echo $subject?></strong></font></p>
								</div>
								
								<div class="modal-body">
								
								
									<input type="hidden" name="id" value="<?php echo $file['id']?>"/>
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
								<input type="hidden" name="id" value="<?php echo $file['id']?>"/>
								
								<div class="row" required>
								<div class="col">
									<label><strong>Date:</strong> </label>
									<input class="form-control"  name="date" placeholder="Date:" readonly="read-only"
									 value="<?php echo $file['date']; ?>"  /> 
								</div><br>
								
								<div class="col">
									<label for="from"><strong>From / Signatory:</strong></label>
									<input class="form-control" type="text" name="fromw" placeholder="From:" 
									 value="<?php echo $file['fromw'];?>" />
									</div><br>
									</div>
									
								<div class="row" required>
								<div class="col">
									<label><strong>No. of Pages:</strong> </label>
									<input class="form-control"  name="pages" placeholder="Pages:"
									 value="<?php echo $file['pages']; ?>" />
								</div>
								
								<div class="col">
										<label><strong>Classification:</strong> </label>
									<input name="classification" class="form-control" rows="5"  type="text" placeholder="Classification:" 
									value="<?php echo $file['classification'];?>" /></input>
								</div>
								</div>
								
								
								<label for="forw"><strong>For / To:</strong></label>
									<input class="form-control" type="text" name="forw" placeholder="For:" 
									value="<?php echo $file['forw'];?>" />
									
								<strong>Subject:</strong> </label>
									<input class="form-control" type="text" name="subject" placeholder="Subject:" 
									 value="<?php echo $file['subject'];?>" />
								
									 
								<label><strong>File: </strong></label>	
									<input type="file" class="form-control" name="myfile"><br>
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
		<?php $count++; }} ?>

      </tbody>
    </table>
			
<?php
	$count=1;
	$id = (int) $_SESSION['login'];
					
if(isset($_POST['search'])){
					$query = $conn->query ("SELECT * FROM admin WHERE id = '$id' ") or die (mysqli_error());
				$fetch = $query->fetch_array ();
				$department = $fetch['department'];
	$search=$_POST['search'];
	$query="select * from files WHERE 
			forw like '%".$search."%' AND department = '$department'
			OR fromw like '%".$search."%' AND department = '$department'
		OR docu_id like '%".$search."%' AND department = '$department'
		OR name like '%".$search."%' AND department = '$department'
		OR subject like '%".$search."%'  AND department = '$department'
		OR date like '%".$search."%' AND department = '$department'
		OR category like '%".$search."%' AND department = '$department'
		OR restriction like '%".$search."%' AND department = '$department' ORDER BY id DESC";
	$result =  mysqli_query($conn, $query);

  while($file= mysqli_fetch_assoc($result)) { 
   $subject = $file['subject'];
   $classification = $file['classification'];
   ?>
  <tr>			
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
		    
				
	<?php $count++; }} ?>

      </tbody>
    </table>		
	
<?php
	$count=1;
	$id = (int) $_SESSION['login'];
					
if(isset($_POST['search'])){
					$query = $conn->query ("SELECT * FROM admin WHERE id = '$id' ") or die (mysqli_error());
				$fetch = $query->fetch_array ();
				$department = $fetch['department'];
	$search=$_POST['search'];
	$query="select * from files WHERE 
			forw like '%".$search."%' AND department = '$department'
			OR fromw like '%".$search."%' AND department = '$department'
		OR docu_id like '%".$search."%' AND department = '$department'
		OR name like '%".$search."%' AND department = '$department'
		OR subject like '%".$search."%'  AND department = '$department'
		OR date like '%".$search."%' AND department = '$department'
		OR category like '%".$search."%' AND department = '$department'
		OR restriction like '%".$search."%' AND department = '$department' ORDER BY id DESC";
	$result =  mysqli_query($conn, $query);

  while($file= mysqli_fetch_assoc($result)) { 
   $subject = $file['subject'];
   $classification = $file['classification'];
   ?>
  <tr>
   
   <!---Modal for SUB----->
    <div class="modal fade" id="sub<?php echo $file['id']?>" aria-hidden="true">
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
              $id = $file['id'];
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
	
   
				    	
<?php $count++; }} ?>

      </tbody>
    </table>
<?php
	$count=1;
	$id = (int) $_SESSION['login'];
					
if(isset($_POST['search'])){
					$query = $conn->query ("SELECT * FROM admin WHERE id = '$id' ") or die (mysqli_error());
				$fetch = $query->fetch_array ();
				$department = $fetch['department'];
	$search=$_POST['search'];
	$query="select * from files WHERE 
			forw like '%".$search."%' AND department = '$department'
			OR fromw like '%".$search."%' AND department = '$department'
		OR docu_id like '%".$search."%' AND department = '$department'
		OR name like '%".$search."%' AND department = '$department'
		OR subject like '%".$search."%'  AND department = '$department'
		OR date like '%".$search."%' AND department = '$department'
		OR category like '%".$search."%' AND department = '$department'
		OR restriction like '%".$search."%' AND department = '$department' ORDER BY id DESC";
	$result =  mysqli_query($conn, $query);

  while($file= mysqli_fetch_assoc($result)) { 
   $subject = $file['subject'];
   $classification = $file['classification'];
   ?>
  <tr>
  
  
<!---Modal for TAGS----->
    <div class="modal fade" id="tags<?php echo $file['id']?>" aria-hidden="true">
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
				$id = $file['id'];
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
										$query = $conn->query ("SELECT * FROM users WHERE tid = '$tag' ORDER by lname ASC ") or die (mysqli_error());
										while($fetch = mysqli_fetch_array($query))
										{
											echo "<td width='30%'>". $fetch['lname'] .", ". $fetch['fname'] ." ". $fetch['mname'] ." - ". $fetch['department'] ."</td>";
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
		  <!--
				<button type="button" name="add" class="btn btn-primary" title="ADD TAG">
						<a href="tag_admin.php?id=<?php echo $id?>" class="text-decoration-none" style="text-decoration-none;color:white;>" >
							<i class="fas fa-user-plus"></i>
						</a>
				</button>		-->

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
							<a href="tag_toadmin.php?id=<?php echo $id?>" class="text-decoration-none" 		style="text-decoration-none;color:BLack;>">
								&nbsp;&nbsp;&nbsp;<i class="fas fa-user-plus">&nbsp;&nbsp;DEPARTMENT</i>
							</a><br>
							<a href="tag_admin.php?id=<?php echo $id?>" class="text-decoration-none" style="text-decoration-none;color:BLack;>">
									&nbsp;&nbsp;&nbsp;<i class="fas fa-user-plus">&nbsp;&nbsp;<?php echo $department?> PERSONNEL&nbsp;&nbsp;</i>
							</a>
						</div>
					
			
				<button class="btn btn-danger" type="button" data-dismiss="modal"> <i class="fas fa-window-close"></i></button>
				
		  </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
			

<?php $count++; }}?>



<?php
	$count=1;
	$id = (int) $_SESSION['login'];
					
if(isset($_POST['search'])){
					$query = $conn->query ("SELECT * FROM admin WHERE id = '$id' ") or die (mysqli_error());
				$fetch = $query->fetch_array ();
				$department = $fetch['department'];
	$search=$_POST['search'];
	$query="select * from files WHERE 
			forw like '%".$search."%' AND department = '$department'
			OR fromw like '%".$search."%' AND department = '$department'
		OR docu_id like '%".$search."%' AND department = '$department'
		OR name like '%".$search."%' AND department = '$department'
		OR subject like '%".$search."%'  AND department = '$department'
		OR date like '%".$search."%' AND department = '$department'
		OR category like '%".$search."%' AND department = '$department'
		OR restriction like '%".$search."%' AND department = '$department' ORDER BY id DESC";
	$result =  mysqli_query($conn, $query);

  while($file= mysqli_fetch_assoc($result)) { 
   $subject = $file['subject'];
   $classification = $file['classification'];
   ?>
  <tr>
  

    	

<!---Modal for status ----->
    <div class="modal fade" id="myModall<?php echo $file['id']?>" aria-hidden="true">
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
              $id = $file['id'];
              $query = $conn->query ("SELECT * FROM remarks WHERE id = $id ORDER by date DESC") or die (mysql_error());

              while($fetch = mysqli_fetch_array($query)){


              echo "<tbody>";
              echo "<tr>";
              echo "<td width='10%'>". $fetch['status'] ."</td>";
              echo "<td width='35%'>". $fetch['remarks'] ."</td>";
              echo "<td width='25%'>". $fetch['date'] ."</td>";
			  echo "<td width='30%'>". $fetch['action'] ." - ". $fetch['department'] ."</td>";
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

<?php $count++; }} ?>


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
  			$('#data_table').DataTable();
  		});
  	</script>
      </body>
</html>


