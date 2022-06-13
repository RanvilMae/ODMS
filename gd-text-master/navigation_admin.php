<style>  

.notification .badge {
  position: absolute;
  padding: 2px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}
    </style>
    
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
 
   <a data-target="#cl" data-toggle="modal" class="MainNavText navbar-brand" id="MainNavHelp" href="#myModal">
		 <?php 
		$query = $conn->query ("select * from `version` ") or die (mysqli_error());
		$fetch = $query->fetch_array ();
		$id = (int) $_SESSION['login'];
		$query = $conn->query ("SELECT * FROM `admin` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
		$department = $file['department'];
		?>

		Online Document Management System <?php echo $fetch['version']; ?>  ||
   </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      <li class="nav-item">
	</li>
		<a class="nav-link" href="admin.php"> PORTAL</a>
		
		<a class="nav-link" href="home.php"> HOME</a>
		<a class="nav-link" href="upload.php"> UPLOAD</a>

		<div class="btn-group">
			<a class="nav-link" href="viewdata.php"> <?php echo $department ?> FILES</a>
			<a class="nav-link  notification" href="incoming_a.php"> TAGGED FILES
			 	<span class="badge">
					<?php
						$sql = "SELECT COUNT(id) FROM tags WHERE tag = '$tid' AND track = '0' ";  
						$rs_result = mysqli_query($conn, $sql);  
						$row = mysqli_fetch_row($rs_result);  
						$total_records = $row[0];   
							echo $total_records;
					?>
				</span/>
			</a>
		</div>&nbsp;&nbsp;&nbsp;&nbsp;
			<!-- <div class="btn-group">
					
					<div class="nav-link dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration-none;color:white;">
					</div>
					<div class="dropdown-menu">
							<a class="dropdown-item" href="open_a.php"><strong>Open to All</strong></a>
							<a class="dropdown-item" href="res_a.php"><strong>Restricted</strong></a>
							<a class="dropdown-item" href="con_a.php"><strong>Confidential</strong></a>
							<a class="dropdown-item" href="out_a.php"><strong>Outgoing</strong></a>
							
							
						
                    		<a class="dropdown-item notification" href="incoming_a.php"><strong>Incoming</strong><span class="badge">
								<?php
                            		 $id = (int) $_SESSION['login'];
                            			$query = $conn->query ("SELECT * FROM `admin` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
                            		$file = $query->fetch_array ();
                            		$tid = $file['tid'];
                                $sql = "SELECT COUNT(id) FROM tags WHERE tag = '$tid' AND track = '0' ";  
                            				$rs_result = mysqli_query($conn, $sql);  
                            				$row = mysqli_fetch_row($rs_result);  
                            				$total_records = $row[0];   
                            					echo $total_records;
                                ?>
					
							</span></a>
							 <a class="dropdown-item" href="subs_a.php"><strong>Sub Files</strong></a>
							 
					</div>
			</div> -->
	 
		
		
		
		<a class="nav-link" href="archive.php"> ARCHIVE</a>
		<!----	<div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         SEARCH
                </a>
                
                	<?php
					$login = (int) $_SESSION['login'];
					$query = $conn->query ("SELECT department FROM admin WHERE id = '$login' ") or die (mysqli_error());
					$get = $query->fetch_array ();
					$department = $get['department'];
					?>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="search.php"><strong><?php echo $department?> Files</strong></a>
					<a class="dropdown-item" href="search_tags_a.php"><strong>Incoming Files</strong></a>
                </div>
            </div> ----->
							
      </li>
	  
	  
	  
	  
	  
    </ul>
	</div>
	
       <!-- Modal for changelog-->
  <div id="cl" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                   
                    <h4 class="modal-title">CHANGE LOG</h4>
					 <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                   <table class="table table-bordered">
              <thead>
                <tr>
				 <th class="tablecell">NO.</th>
				  <th class="tablecell">CHANGE MODULE</th>
                  <th class="tablecell" width: "auto !important">DESCRIPTION OF CHANGE</th>
                 
                </tr>
              </thead>

              <?php 
              $query = $conn->query ("SELECT * FROM changelog ORDER by id ASC") or die (mysql_error());

              while($fetch = mysqli_fetch_array($query)){


              echo "<tbody>";
              echo "<tr>";
              echo "<td width='10%'>". $fetch['id'] ."</td>";
              echo "<td width='30%'>". $fetch['module'] ."</td>";
              echo "<td width='60%'>". $fetch['desc'] ."</td>";
              echo "</tr>";
              echo "</tbody>";


              }?>

            </table>

                </div>
            </div>

        </div>
    </div>
	
	
	
	
	
			<?php
				$id = (int) $_SESSION['login'];
			
					$query = $conn->query ("SELECT * FROM admin WHERE id = '$id' ") or die (mysqli_error());
					$fetch = $query->fetch_array ();
			?>
					<div class=" text-monospace float-right dropdown text-decoration-none " style="color:WHITE"><?php include ("clock.php"); ?>
			<a class="text-monospace " href="#" data-toggle="modal" data-target="#exampleModal" style="color:WHITE" ><i class="fas fa-user"></i> <?php echo $fetch['lname']; ?>, <?php echo $fetch['fname']; ?> <?php echo $fetch['mname']; ?>
												  </a></div>	
												  
										     <button class="btn btn-danger btn-sm" title="LOG OUT">
			<a data-toggle="modal" data-target="#myModal" href="logout.php" style="text-decoration-none;color:white;">
				<i class="fas fa-power-off"></i></a>
			</button>&nbsp;
		
		<div class="modal fade" id="myModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">

           <h3 class="modal-title"><strong>LOG OUT</strong></h3>
        </div>
          
          <div class="modal-body">
				<strong><?php echo $fetch['fname']; ?></strong> are you sure you want to log out?
          </div>
           <div class="modal-footer">
				<button type="button" class="btn btn-danger"> <a  style="text-decoration:none;color:white;" href="logout.php">
				  <i class="fas fa-sign-out-alt"></i>
				  </a>
			  </button>
             <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="redirectToPrevPage()">
				<i class="fas fa-window-close"></i>
			</button>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
		
		
		</div>
    </div>
  </div>			  
												  
							<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
								
								  <div class="modal-header">
								  
									<h5 class="modal-title" id="exampleModalLabel"><strong>MY PROFILE</strong></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
									</button>
								  </div>
								  
								  <div class="modal-body">
								  <?php
									$query = $conn->query ("SELECT * FROM admin WHERE id = '$id' ") or die (mysqli_error());
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
															<th scope="col"><?php echo $fetch['position'];?><br>
															</tr>
														</table>
														</div>
										
											 
											  
											  	 <div class="modal-footer" >
												  <button class="btn btn-warning btn-sm" title="CHANGE PASSWORD">
													<a style="text-decoration:none;color:white;" href="change_pass.php?id=<?php echo $fetch['id']; ?>">
														<i class="fas fa-unlock-alt"></i>
													</a>
												  </button>
												
												  <button class="btn btn-success btn-sm" title="EDIT PROFILE">
													<a style="text-decoration:none;color:white;"href="profile_admin.php?id=<?php echo $fetch['id']; ?>">
														<i class="fas fa-user-edit"></i>
													</a>
												  </button>
												
												</div>
											</div>	
											</div>
																</div>
															</div>  
														</div>

        </div>
		
      </div>
	  
    </div>
  </div>
  



</header>
</nav>