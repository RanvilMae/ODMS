<?PHP

session_start();

if (!isset($_SESSION['id'])) {
header('Location: index.php');
}

?>
<?php
	require("conn.php");
	include("downloadsearch.php");
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

<?php include 'navigation_documents_user.php';?>

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
  <div>
  <h3><strong>TIEZA OFFICIAL DOCUMENTS</strong></h3>
 </div><hr>
 

 <div style="overflow-x:auto;">
    <table class="table table-dark table table-bordered">
    <tr>
        <td><strong>FILENAME</strong></th>
		<td><strong>DATE</strong></th>
        <td align="center"><strong>ACTION</strong></th>
    </tr>
    <tbody>
    <?php
			 $id = (int) $_SESSION['id'];
		{
		 $nquery=mysqli_query($conn,"select * from `documents`  ORDER BY id DESC ");
		while($file = mysqli_fetch_array($nquery)){
	?>
        <tr>
          <td><?php echo $file['name']; ?></td>
          <td><?php echo $file['date']; ?></td>
					<td align="center">	
			<button type="button" class="btn btn-primary" title="PREVIEW">
				<a href="documents/<?php echo $file['name']?>" target="_blank" class="text-decoration-none" style="color:white;">
					<i class="fas fa-eye"></i>
				</a>
			</button>
							 
			</td>
					<?php }}?>


 <?php
			 $id = (int) $_SESSION['id'];
		$query = $conn->query ("SELECT department FROM `users` WHERE id = '$id' ") or die (mysqli_error());
		$fetch = $query->fetch_array ();
		if ($fetch['department']  == 'TTAXD'){
		 $nquery=mysqli_query($conn,"select * from `documents` WHERE department = 'TTAXD' ORDER BY id DESC ");
		while($file = mysqli_fetch_array($nquery)){
	?>
        <tr>
          <td><?php echo $file['id']; ?></td>
          <td><?php echo $file['name']; ?></td>
		  <td><?php echo $file['department']; ?></td>
          <td><?php echo $file['date']; ?></td>
		
			<td align="center">	
			<button type="button" class="btn btn-success"><a href="documents/<?php echo $file['name']?>" target="_blank" class="text-decoration-none" style="color:white;">PREVIEW</a> </button>
							 
			</td>
					<?php }}?>
</tbody>
</table>
</div>
</div>
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

</main>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
      </body>
</html>