<?php 
require("conn.php");
session_start();

if (!isset($_SESSION['tm'])) {
header('Location: index.php');
}

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
			height: 100%;
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
  
<?php
	$id = (int) $_SESSION['tm'];
			
					$query = $conn->query ("SELECT department FROM users WHERE id = '$id' ") or die (mysqli_error());
						$get = $query->fetch_array ();
		$department = $get['department'];
	$sql = "SELECT restriction, count(*) as number FROM files WHERE department = '$department' GROUP BY restriction ";
	
	$query = $conn->query($sql);

?>
	
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
	<script type="text/javascript">  
	google.charts.load('current', {'packages':['corechart']});  
	google.charts.setOnLoadCallback(drawChart);  
	function drawChart(){  
    var data = google.visualization.arrayToDataTable([  
              	['Restriction', 'Number'],  
              			  <?php  
        		        while($row = $query->fetch_assoc()){  
                       		echo "['".$row["restriction"]."', ".$row["number"]."],";  
                      	}
	              	  
              	?>  
         	]);  
    var options = {  
          		title: 'Type of Files Uploaded Percentage',  
          		//is3D:true,  
          		pieHole: 0.4  
         	};  
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
    chart.draw(data, options);  
}  
</script>


<?php
$id = (int) $_SESSION['tm'];
			
		$query = $conn->query ("SELECT department FROM users WHERE id = '$id' ") or die (mysqli_error());
			$get = $query->fetch_array ();
		$department = $get['department'];
		
	$sql = "SELECT restriction, count(*) as number FROM files WHERE department = '$department' GROUP BY restriction ";
	$query = $conn->query($sql);

?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Uploads'],
		  		  <?php 
		  		  
        require("conn.php");
        $sql = "SELECT date, count(*) as number FROM files WHERE department = '$department' GROUP BY Month(date)";
                    if($query)
                    {
                        while($row = $query->fetch_assoc()){  
                       		echo "['".$row["date"]."', ".$row["number"]."],";  
                      	}
                    }	  
              	?>  
		  
        ]);

        var options = {
          title: 'Number of Uploaded Files per Month',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>	
	
	
	
	
  </head>
  <body>

    <?php include 'navigation_topmanager.php';?>

 <main role="main" class="container-fluid">
  <!-- <div class="jumbotron">
    <div align="center">
	   <img src="images/tiezaWorks.jpg"  class="img-fluid"> 
	</div>
</div> -->

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><strong>Dashboard  <?php echo $department;?></strong></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
   <div class="row">

    <!-- FILES -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">UPLOADED FILE/S</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
			   <?php
				include('conn.php'); 
				$sql = "SELECT COUNT(id) FROM files WHERE department = '$department'";  
				$rs_result = mysqli_query($conn, $sql);  
				$row = mysqli_fetch_row($rs_result);  
				$total_records = $row[0];  
				$total_pages = $total_records / 100 * 100;  
				echo $total_pages;
				?>
			  </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-file fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ARCHIVE -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">ARCHIVED FILE/S</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
			  
			  <?php
				include('conn.php'); 
				$sql = "SELECT COUNT(id) FROM archive WHERE department = '$department'";  
				$rs_result = mysqli_query($conn, $sql);  
				$row = mysqli_fetch_row($rs_result);  
				$total_records = $row[0];  
				$total_pages = $total_records / 100 * 100;   
				echo $total_pages;
				?>
			  
			  
			
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-archive fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
  </div>
    <!-- ADMIN
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">NUMBER OF ADMIN</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
				<?php
				include('conn.php'); 
				$sql = "SELECT COUNT(id) FROM admin WHERE department = '$department'";  
				$rs_result = mysqli_query($conn, $sql);  
				$row = mysqli_fetch_row($rs_result);  
				$total_records = $row[0];  
				$total_pages = ceil($total_records); 
				
				echo $total_pages;	
				?>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- USER -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">NUMBER OF USER/S</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
				
			
				<?php
				include('conn.php'); 
				$sql = "SELECT COUNT(id) FROM users WHERE department = '$department'";  
				$rs_result = mysqli_query($conn, $sql);  
				$row = mysqli_fetch_row($rs_result);  
				$total_records = $row[0];  
				$total_pages = ceil($total_records); 
				
				echo $total_pages;	
				?>			
				
			 </div>
            </div>
            <div class="col-auto">
               <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content Row -->

  <div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Uploads Overview</h6>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
         <div id="curve_chart" style="width: 100%; height: 350px"></div>
        </div>
      </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
	<div style="container-fluid" class="mx-auto" >
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Percentage</h6>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
        <!-- Card Body -->
			<div id="piechart" style="height:350px; width: 100%;"></div>
		</div> 
        </div>
      </div>
    </div>
  </div>

</div>


<!-- /.container-fluid -->
</main>

	 <p class="mt-5 mb-3 text-muted text-center">&copy; TIEZA-MISD 2019</p>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
      </body>
</html>