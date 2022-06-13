<body>

    <div class="row-fluid">
        <div class="span12">


         

            <div class="container">

<br><br>
							<form method="post" action="delete.php" >
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                            <div class="alert alert-info">
                              
                                <strong><i class="icon-user icon-large"></i>&nbsp;Delete Multiple Data</strong>
								&nbsp;&nbsp;Check the radion Button and click the Delete button to Delete Data 
                            </div>
                            <thead>
						
                                <tr>
                                    <th></th>
                                    <th>FirstName</th>
                                    <th>LastName</th>
                                    <th>MiddleName</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
							require("conn.php");
							$nquery=mysqli_query($conn,"select * from `users`");
							while($fetch = mysqli_fetch_array($nquery)){
							?>
                              
										<tr>
										<td>
										<input name="selector[]" type="checkbox" value="<?php echo $id; ?>">
										</td>
                                         <td><?php echo $fetch['fname'] ?></td>
                                         <td><?php echo $fetch['mname'] ?></td>
                                         <td><?php echo $fetch['lname'] ?></td>
                                </tr>
                         
						          <?php } ?>
                            </tbody>
                        </table>
						<input type="submit" class="btn btn-danger" value="Delete" name="delete">
          
</form>

        </div>
        </div>
        </div>
    </div>



</body>
</html>



