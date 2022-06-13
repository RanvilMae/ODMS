<?PHP

session_start();

if (!isset($_SESSION['log'])) {
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

<?php include 'navigation_superadmin.php';?>


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

   <h3><strong>SEARCH ADMINS</strong></h3>
 <hr>
    
<form method="post">

<input type="text" placeholder="Search.." name="search"></input>
		<a href="filesLogic.php?id=<?php echo $row["id"]; ?>"></a>&nbsp;
			<button type="submit" name="save"  class="btn btn-primary" ><i class="fas fa-search"></i></button>
	<br><br>
	  <div style="overflow-x:auto;">
	      <table class="table table-dark">  
</form>

   <tr>
        <td><strong>ID #</strong></td>
        <td><strong>NAME</strong></td>
        <td><strong>EMAIL</strong></td>
		<td><strong>DATE</strong></td>
		<td><strong>DEPARTMENT</strong></td>
		<td align="center"><strong>ACTION</strong></td>
    </tr>
	 <tbody>
<?php
	$count=1;
if(isset($_POST['search'])){
	$search=$_POST['search'];
	$query="select * from admin WHERE tid like '%".$search."%' || fname like '%".$search."%' || lname like '%".$search."%' || mname like '%".$search."%' ||  email like '%".$search."%' ||  date like '%".$search."%' || department like '%".$search."%'";
	$result =  mysqli_query($conn, $query);

  while($file= mysqli_fetch_assoc($result)) {
	  ?>
   <tr>
          <td><?php echo $file['tid']; ?></td>
          <td><?php  echo $file['fname'];?> <?php  echo $file['mname'];?> <?php echo $file['lname'];?></td>
          <td><?php echo $file['email']; ?></td>
		  <td><?php echo $file['date']; ?></td>
          <td><?php echo $file['department']; ?></td>
		  <td align="center">

		  	<div class="btn-group btn-group-justified">
		  	<button type="button" class="btn btn-primary" title="EDIT">
				<a data-toggle="modal" data-target="#myModal<?php echo $file['id']?>" style="text-decoration-none;color:white;">
					<i class="far fa-edit"></i>
				</a>
				</button>
				<button type="button" name="changepass"  class="btn btn-primary" title="CHANGE PASSWORD">
					<a data-toggle="modal" name="fileToRemove" data-target="#changepass<?php echo $file['id']?>" style="text-decoration-none;color:white;">
						<i class="fa fa-key" aria-hidden="true"></i>

					</a>
				</button>
				<button type="button" name="delete" name="fileToRemove" class="btn btn-primary" title="DELETE">
				<a data-toggle="modal" name="fileToRemove" data-target="#delete<?php echo $file['id']?>" style="text-decoration-none;color:white;">
					<i class="fas fa-trash-alt"></i>
				</a>
				</button>
			</div>
			
			</td>
			
		    <!---Moadal for EDit ----->
			<div class="modal fade" id="myModal<?php echo $file['id']?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		
			<form method="POST" action="updateadmins.php">
				<div class="modal-header">
					<h3><strong></label>UPDATE</strong></h3>
				</div>
				<div class="modal-body">
			
			<input type="hidden" name="id" value="<?php echo $file['id']?>"/>
		<div class="row"required>
								<div class="col">
									<label><strong>First Name:</strong></label>
									<input class="form-control" type="text" name="fname" placeholder="first name"
										 value="<?php echo $file['fname']; ?>"><br>
								</div>
								
								<div class="col">
									<label><strong>Middle Name:</strong></label>
									<input class="form-control" type="text" name="mname" placeholder="middle name"
										 value="<?php echo $file['mname']; ?>"><br>
								</div>
								<div class="col">
									<label><strong>Last Name:</strong></label>
									<input class="form-control" type="text" name="lname" placeholder="last name"
										value="<?php echo $file['lname']; ?>"><br>
								</div>
							</div>
			
			<label for="email"><strong>EMAIL:</strong></label>
			<input class="form-control" type="text" name="email"
			value="<?php echo $file['email'];?>" />
		
			<label for="tid"><strong>ID #:</strong></label>
			<input class="form-control" type="text" name="tid"
			 value="<?php echo $file['tid'];?>" />
		
			<label for="date"><strong>DATE:</strong></label>
			<input class="form-control" type="text" name="date" 
			 value="<?php echo $file['date'];?>" />
		
		
			<label for="department"><strong> DEPARTMENT:</strong></label>
			<input class="form-control" type="text" name="department" 
			 value="<?php echo $file['department'];?>" />
			 
			<label for="position"><strong>POSITION:</strong></label>
			<input class="form-control " type="text" name="position" 
			 value="<?php echo $file['position'];?>" />
			 
			 <label for="position"><strong>PASSWORD:</strong></label>
			<input class="form-control" type="password" name="password" placeholder="********"
			  />

		
		
			<div style="clear:both;"></div>
					<div class="modal-footer">
						<button name="update" class="btn btn-primary"> <i class="fas fa-save"></i></button>
						<button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<div class="modal fade" id="delete<?php echo $file['id']?>" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><strong>Delete</h5></strong>
				</div>
				<div class="modal-body">
			Are you sure you want to delete data <strong><?php  echo $file['fname'];?> <?php  echo $file['mname'];?> <?php echo $file['lname'];?>?</strong>
			<div class="modal-footer">
         <a href="deleteusers.php?id=<?php echo $file['id'] ?>"  class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
						 <button type="button" name="delete" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
					</div>
      </div>
    </div>
  </div>
</div>    
    
  <div class="modal fade" id="changepass<?php echo $file['id']?>" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><strong>CHANGE PASSWORD</h5></strong>
				</div>
				<div class="modal-body">
			Are you sure you want to change the password of <strong><?php echo $file['fname'] ?>?</strong>
			<div class="modal-footer">
         <a href="changepassa.php?id=<?php echo $file['id'] ?>"  class="btn btn-primary"><i class="fas fa-key"></i></a>
						 <button type="button"  class="btn btn-secondary" data-dismiss="modal">
						     <i class="fas fa-window-close"></i>
						 </button>
					</div>
      </div>
    </div>
  </div>
</div>    
<?php $count++; }} ?>

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