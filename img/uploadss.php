
<?PHP

session_start();

if (!isset($_SESSION['login'])) {
header('Location: index.php');
}

?>
<?php 
require("conn.php");
include 'fileslogic.php';
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TIEZA Portal</title>
	
	 <script src="jquery-1.12.0.min.js" type="text/javascript"></script>
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
 
    <script type="text/javascript">
        $(document).ready(function(){

            $("#sel_depart").change(function(){
                var department = $(this).val();

                $.ajax({
                    url: 'getUsers.php',
                    type: 'post',
                    data: {depart:department},
                    dataType: 'json',
                    success:function(response){

                        var len = response.length;

                        $("#sel_user").empty();
                        for( var i = 0; i<len; i++){
                            var department = response[i]['department'];
                            var fname = response[i]['fname'];
							var lname = response[i]['lname'];

                            $("#sel_user").append("<option value='"+fname+" "+lname+"'>"+fname+" "+lname+"</option>");

                        }
                    }
                });
            });

        });
    </script>
	
	<script type="text/javascript">
        $(document).ready(function(){

            $("#sel_departf").change(function(){
                var department = $(this).val();

                $.ajax({
                    url: 'getUsers.php',
                    type: 'post',
                    data: {depart:department},
                    dataType: 'json',
                    success:function(response){

                        var len = response.length;

                        $("#sel_userf").empty();
                        for( var i = 0; i<len; i++){
                            var department = response[i]['department'];
                            var fname = response[i]['fname'];
							var lname = response[i]['lname'];

                            $("#sel_userf").append("<option value='"+fname+" "+lname+"'>"+fname+" "+lname+"</option>");

                        }
                    }
                });
            });

        });
    </script>
	
	
	<script>
    function disableRadioValue(v) {
        if (v.value == 'Outgoing')
		{
			chk.disabled = true;
			chk1.disabled = true;
			chk2.disabled = true;
		}
        else
		{
			chk.disabled = false;
			chk1.disabled = false;
			chk2.disabled = false;
		}
    }
</script>
  </head>
  <body>

<?php include 'navigation_admin.php';?>

<main role="main" class="container">
  <div class="jumbotron">
    <form method="post" enctype="multipart/form-data" >
      <div class="form-group">
			<h3><strong>UPLOAD</strong></h3>
			<hr>
		  
		<input class="form-control" type="text" name="department" id="department" placeholder="Department" hidden value="<?php echo $fetch['department'];?>">
      <input class="form-control" type="text" name="fname" id="fname" hidden value="<?php echo $fetch['lname'];?>, <?php echo $fetch['fname'];?> <?php echo $fetch['mname'];?>">
      <input class="form-control" type="text" name="tid" id="tid"  hidden value="<?php echo $fetch['tid'];?>">
      
	<div class="row" required>
		<div class="col">
			<p><input type="radio" id="chk" name="restriction" value="Open to All" required />
			<label id="o"><strong>Open to All</strong></label></p>
		</div><br>
		<div class="col">
			<p><input type="radio" id="chk1" name="restriction" value="Restricted" required /> 
			<label id="oo"><strong>Restricted</strong></label></p>
		</div><br>
		<div class="col">
			<p><input type="radio" id="chk2" name="restriction" value="Confidential" required /> 
			<label id="ooo"><strong>Confidential</strong></label></p>
		</div><br>
	</div>
			<div class="row" required>
			<div class="col">
			<label><strong>Classification:</strong> </label>
				 <select class="form-control"  id="sel"  name="classification"  onchange="disableRadioValue(this)">
				 <option >--SELECT--</option>
					  <option value="Outgoing">Outgoing</option>
					  <option value="Incoming">Incoming</option>
				  </select>
			</div><br>
			<div class="col">
				<label><strong>Date: </strong></label>
				<input class="form-control" name="date" required readonly="read-only" value="<?php date_default_timezone_set("Asia/Manila"); echo date("Y-m-d H:i:s");?>" ><br>
			</div>
		</div>



			<div class="row"required>
				<div class="col">
					<label><strong>For / To:</strong> </label>
					
					 <select id="sel_depart" name="forw" class="form-control" id="forw" required>
						<option value="0">--SELECT--</option>
						<?php 
						// Fetch Department
						$sql_department = "SELECT * FROM department";
						$department_data = mysqli_query($con,$sql_department);
						while($row = mysqli_fetch_assoc($department_data) ){
							$department = $row['department'];
						  
							// Option
							echo "<option value='".$department."' >".$department."</option>";
						}
						?>
					</select>
					<div class="clear"></div>

					<select id="sel_user" class="form-control" placeholder="Specific (Optional)" name="for_specific">
						<option value="0">N/A</option>
					</select>
					
				</div>
		
		
		
				<div class="col">
					<label><strong>From / Signatory:</strong> </label>
					<select id="sel_departf" name="fromw" class="form-control" id="fromw" required>
						<option value="0">--SELECT--</option>
						<?php 
						// Fetch Department
						$sql_department = "SELECT * FROM department";
						$department_data = mysqli_query($con,$sql_department);
						while($row = mysqli_fetch_assoc($department_data) ){
							$department = $row['department'];
						  
							// Option
							echo "<option value='".$department."' >".$department."</option>";
						}
						?>
					</select>
					<div class="clear"></div>

					<select id="sel_userf" class="form-control" placeholder="Specific (Optional)" name="from_specific">
						<option value="0">N/A</option>
					</select>
			
				</div>
			</div>		 
			
			<div class="row"required>
				<div class="col">
					<label><strong>Category: </strong></label>
					<select input name="category" class="form-control" id="category" required>	
	
							<?php
							require("conn.php");
							$query = "SELECT category FROM category ORDER BY category ASC";
							$result = $conn->query($query);	
							
								echo " <option >--SELECT--</option>";
								while($row = $result->fetch_assoc())
								{
									echo "<option value='" . $row['category'] ."'>" . $row['category'] ."</option>";
								}
							?>
					</select><br>
				</div>
		
				<div class="col">
					<label><strong>No. of Pages:</strong> </label>
					<input type="number" class="form-control" placeholder="No. of Pages" min="1" max="1000" name="pages" required /><br>
				</div>
			</div>	
			
		<label><strong>Subject / Re: </strong></label>
					<input type="text" class="form-control" placeholder="Subject" name="subject" required><br>

		<label><strong>File: </strong></label>	
        <input type="file" class="form-control" id="exampleFormControlFile1" name="myfile"><br>
		
		
		<button type="submit" title="UPLOAD" name="sub" class="btn btn-primary float-right"><i class="fas fa-upload"></i></button>
	  </div>	  
	</form>
  </div>
</main>
  	 <p class="mt-5 mb-3 text-muted text-center">&copy; TIEZA-MISD 2019</p>

      </body>
</html>

