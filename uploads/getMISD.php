<?php
									require("conn.php");
									$query = "SELECT lname FROM users where position ='Manager' and department = 'MISD'";
									$result = $conn->query($query);	
									
										while($row = $result->fetch_assoc())
										{
											echo "<select id='chkchk' class='form-control'>";
											echo "<option  value='" . $row['lname'] ."'>" . $row['lname'] ."</option>";
											echo "</select>";
										}
									?>