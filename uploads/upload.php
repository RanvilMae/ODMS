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
			background-image: url("images/bg.png");
			height: 100%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
.jumbotron{
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

  </head>
  <body>

<?php include 'navigation_admin.php';?>


 <main role="main" class="container">
  <div class="jumbotron">
    <form action="filesLogic.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
			<h3><strong>UPLOAD</strong></h3>
			<hr>
			
				<?php
								$action = (int) $_SESSION['login'];
								$query = $conn->query ("SELECT * FROM admin WHERE id = '$action' ") or die (mysqli_error());
								$fetch = $query->fetch_array ();
								
						?>
		  
		<input class="form-control" type="text" name="department" id="department" hidden value="<?php echo $fetch['department'];?>">
      <input class="form-control" hidden type="text" name="fname" id="fname"  value="<?php echo $fetch['lname'];?>, <?php echo $fetch['fname'];?> <?php echo $fetch['mname'];?>">
      <input class="form-control" type="text" hidden name="tid" id="tid"   value="<?php echo $fetch['tid'];?>">
      
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
					
					 <select id="sel_depart" name="forw" class="form-control" id="forw" onchange="disableTextBox(this)" required>
						<option>--SELECT--</option>
						<?php 
						// Fetch Department
						$sql_department = "SELECT * FROM department WHERE NOT department = 'EXTERNAL' ORDER BY department ASC";
						$department_data = mysqli_query($conn,$sql_department);
						while($row = mysqli_fetch_assoc($department_data) ){
							$department = $row['department'];
							$narrative = $row['narrative'];
						  
						if ($department == "GSD-CENTRAL RECEIVING"  )
							{
								} else{
							
						
						echo "<option value='".$department."' > <strong>".$department." </strong>  (".$narrative.")</option>"; }

						
						if ($department == "EXTERNAL"  )
							{
								echo "<input type='text' id='text1' class='form-control' placeholder='Please specify' name='for_specific' ></input>";
							}
					
							
						}
						echo "<option value='EXTERNAL' >EXTERNAL   </option>";

						
						?>
					</select>
					<!--	<div class="clear"></div>

				<select id="sel_user" class="form-control" placeholder="Specific (Optional)" name="for_specific">
				
						<option name="for_specific" value="0">N/A</option>
					</select> -->
				</div>
		
	
		
		
				<div class="col">
					<label><strong>From / Signatory:</strong> </label>
					<select id="sel_departf" name="fromw" class="form-control" id="fromw"  onchange="disableTextBox2(this)" required>
						<option value="0">--SELECT--</option>
						<?php 
						// Fetch Department
						$sql_department = "SELECT * FROM department WHERE NOT department = 'EXTERNAL' ORDER BY department ASC";
						$department_data = mysqli_query($conn,$sql_department);
						while($row = mysqli_fetch_assoc($department_data) ){
							$department = $row['department'];
							$narrative = $row['narrative'];
						  if ($department == "GSD-CENTRAL RECEIVING"  )
							{
								} else{
							// Option
						echo "<option value='".$department."' > <strong>".$department." </strong>  (".$narrative.")</option>"; }
						
						if ($department == "EXTERNAL")
							{
								echo "<input type='text' id='text2' class='form-control' placeholder='Please specify' name='from_specific'  ></input>";
							}
						
						}
						
						?>
					</select>
					<div class="clear"></div>

					<!--	<select id="sel_userf" class="form-control" placeholder="Specific (Optional)" name="from_specific">
						<option name="from_specific" >N/A</option>
					</select> -->
				</div>
			</div><br>	 
			
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
					</select>
				</div><br>
		
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
	  </div>	  <br><br><br>

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
        
        
	<script type="text/javascript">
	function disableTextBox(v) {
	  if (v.value == 'EXTERNAL') {
		sel_user.style.display = "none";
		text1.style.display = "block";
	  } else {
		text1.style.display = "none";
		sel_user.style.display = "block";
	  }
	}
	</script>

	<script type="text/javascript">
	function disableTextBox2(v) {
	  if (v.value == 'EXTERNAL') {
		  sel_userf.style.display = "none";
		text2.style.display = "block";
	  } else {
		text2.style.display = "none";
		sel_userf.style.display = "block";
	  }
	}
	</script> 
        
        	<script type="text/javascript">
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
						$("#sel_user").append("<option value='N/A'>N/A</option>");
						
                        for( var i = 0; i<len; i++){
                            var department = response[i]['department'];
							
							var lname = response[i]['lname'];
                            var fname = response[i]['fname'];
							var x = ", ";

                            $("#sel_user").append("<option value='"+lname+""+x+" "+fname+"'>"+lname+""+x+" "+fname+"</option>");

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
						
						$("#sel_userf").append("<option value='N/A'>N/A</option>");
                       for( var i = 0; i<len; i++){
                            var department = response[i]['department'];
							
							var lname = response[i]['lname'];
                            var fname = response[i]['fname'];
							var x = ", ";

                            $("#sel_userf").append("<option value='"+lname+""+x+" "+fname+"'>"+lname+""+x+" "+fname+"</option>");
							
                        }
                    }
                });
            });

        });
    </script>



 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

      </body>
</html>




