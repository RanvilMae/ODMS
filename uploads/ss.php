<?php 
require("conn.php");
include 'filesLogic.php';
include('pagination.php');
?>
<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/
?>
<?php
if(isset($_POST['uploads']))
{
$error = ""; //error holder
if(isset($_POST['createzip']))
{
$post = $_POST; 
$file_folder = "uploads/"; // folder to load files
if(extension_loaded('zip'))
{ 
// Checking ZIP extension is available
if(isset($post['uploads']) and count($post['uploads']) > 0)
{ 
// Checking files are selected
$zip = new ZipArchive(); // Load zip library 
$zip_name = time().".zip"; // Zip name
if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE)
{ 
 // Opening zip file to load files
$error .= "* Sorry ZIP creation failed at this time";
}
foreach($post['uploads'] as $file)
{ 
$zip->addFile($file_folder.$file); // Adding files into zip
}
$zip->close();
if(file_exists($zip_name))
{
// push to download the zip
header('Content-type: application/zip');
header('Content-Disposition: attachment; filename="'.$zip_name.'"');
readfile($zip_name);
// remove zip file is exists in temp path
unlink($zip_name);
}

}
else
$error .= "* Please select file to zip ";
}
else
$error .= "* You dont have ZIP extension";
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>FMS</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script>
history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
	

	
</script>
	
<link rel="stylesheet" href="dist/bootstrap.min.css" type="text/css" media="all">
<link href="dist/jquery.bootgrid.css" rel="stylesheet" />
<script src="dist/jquery-1.11.1.min.js"></script>
<script src="dist/bootstrap.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
	  .btn{
			text-decoration-none;
			color:white;"
	  }
	  .header{
		 width: 200px;
		 position: fixed;
		 top:auto;
		 right:0px;
		 left:auto;
		}
 
    </style>
    <!-- Custom styles for this template -->
    <link href="navbar-top.css" rel="stylesheet">
  </head>
  <body>
	
    <!-- Custom styles for this template -->
    <link href="navbar-top.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <a class="navbar-brand" href="#">File Management System  ||  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      <li class="nav-item">
	</li>
		<a class="nav-link" href="ADMIN.php"> HOME</a>
		<a class="nav-link" href="upload.php"> UPLOAD</a>
		<a class="nav-link active" href="viewdata.php"> VIEW</a>
		<a class="nav-link" href="archive.php"> ARCHIVE</a>	
		<a class="nav-link" href="search.php"> SEARCH</a>
		<li class="dropdown">

  <a href="#" class="nav-link" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-plus-square"></i> REGISTRATION<span class="caret"></span></a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a href="register_user.php"><p>User</p></a>
	<a href="register_admin.php"><p>Admin</p></a>
  </ul>
</li>
							<a class="nav-link float-right" href="logout.php" onclick="return confirm('Log Out?')"><div class="float-right"> LOG OUT</a></div>
      </li>
    </ul>
	
  </div>
</nav>
 <main role="main" class="container-fluid">
  <div class="jumbotron">
  <div style="overflow-x:auto;">
    <table class="table table-dark">    
<div class=" header float-right">	
	<a href="search.php" class="text-decoration-none">
  <button type="button" class="btn btn-primary" >Search</button>
		</button></a>
		
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
Download
</button></div>	

<!-- Modal for download -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	
      <div class="modal-header">
	  
        <h5 class="modal-title" id="exampleModalLabel">Download</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
      <div class="modal-body">
        Are you sure you want to download all files?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a class="pull-right" href="downloadbulk.php">
		<button type="button" class="btn btn-success">OK</button></a>
      </div>
    </div>
  </div>
</div>


	  <h1 style="font-size:3vw;">VIEW DATA</h1>
<hr>
<?php 
include('pagination.php');
?>

<div class="btn btn-dark"  id="pagination_controls"><?php echo $paginationCtrls; ?></div>
	<div class="col-lg-2"><br>
	</div>
	<form name="zips" action="" method="post">
    <thead>
        <th><input type="checkbox" id="checkAll" />All</th>
        <th>FILENAME</th>
        <th>SUBJECT</th>
		<th>DATE</th>
		<th>DESCRIPTION</th>
		<th>SIGNATORY</th>
    </thead>
    <tbody>
<?php
			while($file = mysqli_fetch_array($nquery)){
			?>
        <tr>

		<td><input class="chk" name="files[]" type="checkbox" value="<?php echo $file['id'] ?>"></td>
          <td><?php echo $file['name']; ?></td>
          <td><?php echo $file['subject']; ?></td>
          <td><?php echo $file['date']; ?></td>
          <td><?php echo $file['description']; ?></td>
          <td><?php echo $file['signatory']; ?></td>
		   
    
	<?php
			}		
		?>

                </tbody>
                        </table>
<input type="submit" id="submit" name="createzip" value="Download All Seleted Files" >
   </form>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$('#submit').prop("disabled", true);
$("#checkAll").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
	  $('#submit').prop("disabled", false);
	  if ($('.chk').filter(':checked').length < 1){
			$('#submit').attr('disabled',true);}
});

$('input:checkbox').click(function() {
        if ($(this).is(':checked')) {
			$('#submit').prop("disabled", false);
        } else {
		if ($('.chk').filter(':checked').length < 1){
			$('#submit').attr('disabled',true);}
		}
});		
</script>
</body>
</html>
