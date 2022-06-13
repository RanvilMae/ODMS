

<?php

		include ("conn.php");
			if(ISSET($_POST['save']));
			{
				
$host="96.44.174.18";
$username="tiezagov_tieza_portal"; 
$word=")SCCZqTZ3M,b";  
$db_name="tiezagov_tieza_portal"; 
$tbl_name="subfile"; 
$conn=mysqli_connect("$host", "$username", "$word","$db_name")or die("cannot connect");  


								$filename = $_FILES['myfile']['name'];
								$id=$_POST['id'];
								$sub_docu=$_POST['sub_docu'];
								$subject=$_POST['subject'];
								$department=$_POST['department'];
									date_default_timezone_set("Asia/Manila");
									$date = date('Y-m-d H:i:s');	
								$pages=$_POST['pages'];
								$action=$_POST['action'];
								
						
						$destination = 'subs/' . $filename;

						$extension = pathinfo($filename, PATHINFO_EXTENSION);

						$file = $_FILES['myfile']['tmp_name'];
						$size = $_FILES['myfile']['size'];

						if (!in_array($extension, ['pdf' ,'docx', 'doc'])) {
							$message = "You file extension must be .pdf, .doc, .docx";
							echo "<script type='text/javascript'>alert('$message');</script>";
						} elseif ($_FILES['myfile']['size'] > 1e+9) { // file shouldn't be larger than 100Megabyte
							$message = "File too large!";
							echo "<script type='text/javascript'>alert('$message');</script>";
						
							
						} else 
						{
					   
							if (move_uploaded_file($file, $destination)) 
							{	
								
								$in_ch=mysqli_query($conn,"INSERT INTO subfiles (id, name, sub_docu, date, pages, action, subject, department) VALUES ('$id', '$filename', '$sub_docu', '$date' , '$pages', '$action', '$subject', '$department')")or die(mysqli_error());	
								
												$message = "FILE UPLOADED!";
								echo "<script type='text/javascript'>alert('$message');</script>";
								echo "<script>window.location = 'view_topmanager.php'</script>";
										
									}
						}
				
				

				}

?>