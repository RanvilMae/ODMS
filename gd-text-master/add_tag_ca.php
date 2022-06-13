<?PHP

session_start();

if (!isset($_SESSION['loginc'])) {
header('Location: index.php');
}

?>
<?php 
require("conn.php");
include("ca_fileslogic.php");
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

    <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.2.js"></script>
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


<?php include 'navigation_cadmin.php';?>
		

							
									
			<main role="main" class="container">
				<div class="jumbotron">
					<form method="post" action="save_tag_ca.php" enctype="multipart/form-data" >
						<div id="form-group">
						<h3><strong>TAGS</strong></h3>
							 <hr>
								
	 <div class="row">
							<div class="col-md-5">	
                                                				<?php
			
                                									$action = (int) $_SESSION['loginc'];
                                								$query = $conn->query ("SELECT * FROM centraladmin WHERE id = '$action' ") or die (mysqli_error());
                                								$gett = $query->fetch_array ();
                                								?>
                                								<input type="hidden" name="action" value="<?php echo $gett['fname'];?> <?php echo $gett['lname'];?>"/>
												
												<?php
			
								    $id= $_GET['id'];
			
								$query = $conn->query ("SELECT * FROM files WHERE id = '$id' ") or die (mysql_error());
								$fetch = $query->fetch_array ();
								{
									$id=$fetch['id'];
									$subject=$fetch['subject'];
									$date=$fetch['date'];
									$docu_id=$fetch['docu_id'];
								}
						?>
												<input type="hidden" name="id" value="<?php echo $fetch['id'];?>"/>
												<input type="hidden" name="docu_id" value="<?php echo $fetch['docu_id'];?>"/>
												<label><strong>Subject:</strong></label>
												<textarea class="form-control"name="id"
												 disabled rows="3" ><?php echo $subject; ?></textarea><br>
												
												<label><strong>Record ID Number:</strong></label>
												<input class="form-control" type="text" name="id"
												disabled value="<?php echo $docu_id; ?>" /><br>
												
												
												 <label><strong>Date: </strong></label>
												<input class="form-control" name="date" readonly="read-only" value="<?php date_default_timezone_set("Asia/Manila"); echo date("Y-m-d H:i:s");?>"><br> <!--  -->
											
											
												<label><strong>TAGGED TO:</strong></label>
												
												<div style="overflow-x:auto;">
								
									<table class="table table-bordered"  style="border: 2px solid black;">  
												<td align="center" style="border: 2px solid black;"><strong>DATE TAGGED</strong></td> 
												<td align="center" style="border: 2px solid black;" ><strong>TAGGED TO</strong></td>
									<tbody>
			<?php 

              $id = $fetch['id'];
              $docu_id=$fetch['docu_id'];
              $query = $conn->query ("SELECT * FROM tags WHERE id = $id AND docu_id = '$docu_id' ORDER by date DESC") or die (mysql_error());

              foreach ( $query as $fetch){


              echo "<tbody>";
              echo "<tr>";
              echo "<td width='50%' style='border: 2px solid black;'>". $fetch['date'] ."</td>";
             
			  $tag = $fetch['tag'];
			 
				$query = $conn->query ("SELECT * FROM admin WHERE tid = '$tag' ") or die (mysqli_error());
				$row=$query->fetch_array  ();
							$run_num_rows = $query->num_rows;
								if ($run_num_rows > 0 )
									{
                    				foreach ( $query as $fetch){
                    				echo "<td width='50%' style='border: 2px solid black;'>". $fetch['lname'] .", ". $fetch['fname'] ." ". $fetch['mname'] ." - ". $fetch['department'] ."</td>";}
									}else{
									    $tag = $fetch['tag'];
                            			 $query = $conn->query ("SELECT * FROM users WHERE tid = '$tag' ") or die (mysqli_error());
                            				foreach ( $query as $fetch){
                    			    	echo "<td width='50%' style='border: 2px solid black;'>". $fetch['lname'] .", ". $fetch['fname'] ." ". $fetch['mname'] ." - ". $fetch['department'] ."</td>";}
									}
			 
              echo "</tr>";
              echo "</tbody>";


		}?>
									
									
									</tbody>
									</table>
								</div>
												
										</div>		
												
												
												
											
							<div class="col-md-7">				
												
												
							<form method="post"  >
								<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
								<label><strong>TAG TO:</strong></label> 
								<thead>
								</thead>
									<tbody>
										<br>
										<label><input type="checkbox" class="cb-selector" data-for="selector\[" />  Select All</label>
										
										<?php 
										require("conn.php");
										 $id = (int) $_SESSION['loginc'];
										 $query = $conn->query ("SELECT * FROM `admin` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
											$file = $query->fetch_array ();
											$department= $file['department'];
										$nquery=mysqli_query($conn,"select * from `admin` WHERE position = 'KEY PERSONNEL' OR position = 'CENTRAL RECEIVER' OR position = 'TECHNICAL ASSISTANT' ORDER by lname ASC");
										while($fetch = mysqli_fetch_array($nquery)){
										$tid=$fetch['tid'];
										?>

											<tr>
												<td>
													<input name="selector[]" type="checkbox" value="<?php echo $tid; ?>">
													
														<td>
														<?php echo $fetch['lname'] ?>, <?php echo $fetch['fname'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-<strong> <?php echo $fetch['department'] ?></strong>
												</td>

											</tr>

										<?php } ?>	
											
										
										<?php 
										require("conn.php");
										 $id = (int) $_SESSION['loginc'];
										$nquery=mysqli_query($conn,"select * from `users` WHERE position = 'Manager' ORDER by lname ASC");
										while($fetch = mysqli_fetch_array($nquery)){
										$tid=$fetch['tid'];
										?>

											<tr>
												<td>
													<input name="selector[]" type="checkbox" value="<?php echo $tid; ?>">		
													
												</td>

												<td>
														<?php echo $fetch['lname'] ?>, <?php echo $fetch['fname'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-<strong> <?php echo $fetch['department'] ?></strong>
												</td>

											</tr>

										<?php } ?>
                                            
									</tbody>
								</table>
						
						</div>
						
							</div>
								  <hr>
							<div style="clear:both;"></div>
							<div class=" float-right">
													<button name="save" class="btn btn-primary"><i class="fas fa-upload"></i></button>
													
													<a href="#" class="text-decoration-none">
													<button type="button" class="btn btn-danger" onclick="history.back()" ><i class="fas fa-window-close"></i></button>
													  </button></a>
													
												</div>	
							
					
					</form>
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
  	<!-- Script to enable Select all of checkboxes -->	
	<script type='text/javascript'>
	!function($) {
		$('input[type=checkbox][class=cb-selector]').click(function() {
			var cb = $(this),
				name = cb.attr('data-for');
			
			if(name == null)
				return false;
			$('input[type=checkbox][name^='+name+']')
				.prop('checked', cb.prop('checked'))
				.click(function() {
					if(!$(this).prop('checked'))
						cb.prop('checked', false);
				});
		});
	}(jQuery);
	</script>
      </body>
</html>
