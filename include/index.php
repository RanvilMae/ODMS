<?php require("login.php"); ?>
<?php
	//check if can login again
	if(isset($_SESSION['attempt_again'])){
		$now = time();
		if($now >= $_SESSION['attempt_again']){
			unset($_SESSION['attempt']);
			unset($_SESSION['attempt_again']);
		}
	}

	//set disable if three login attempts has been made
	$disable = '';
	if(isset($_SESSION['attempt']) && $_SESSION['attempt'] >= 3){
		$disable = 'disabled';
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
	  
	  #text {
		  display:none;
		  color:red;
		  }
		  .jumbotron{
		background-image: url("images/bg.png");
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
		
		body, html {
			background-image: url("images/bg.png");
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
        margin-top:1rem;
    }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/floating-labels.css" rel="stylesheet">

	
  </head>
  <body>
<div class="form-signin">
      
      <div class="text-center mb-4" style="font-family: Helvetica;">
      	<strong>ONLINE DOCUMENT MANAGEMENT SYSTEM</strong> <br><br>
        <span><img src="images/LOGOtieza.png" sizes="256x256"></span>
        <br>
        <br>
        <hr>
      </div>
	<form method="POST" name="login">
	
	
	<?PHP


if(isset($_SESSION['attempt']) && $_SESSION['attempt'] >= 3){
	?>
<h3 style="color:#FF0000" align="center">
Restricted : <span id='timer'> </span>
 </h3>
 

 <?php } ?>
	
	
	
			<div class="form-label-group">
				<input type="text" name="tid" class="form-control" placeholder="ID" <?php echo $disable; ?> required autofocus />
				<label>ID Number</label>
				<p id="text"><br>
					WARNING! Caps lock is ON.
				</p>
			</div>

			<div class="form-label-group">
				<input type="password" name="password" class="form-control" placeholder="Password" <?php echo $disable; ?> required />
				<label for="password">Password</label>
				
				

			</div>
			<div class="text-center mb-4">
			<button type="submit" name="login" class="btn btn-lg btn-primary btn-block"  <?php echo $disable; ?>><span class="glyphicon glyphicon-log-in"></span> Login</button>
			</div>
<br><br>
<br>

<div class="row">
<footer class="footer">
    <div class="inner">
    <strong>Copyright &copy; 2019. All rights reserved.<br>Management Information Systems Department.</strong>
    <div class="float-right d-none d-sm-inline-block">
    </div>
    </div>
</footer>
</div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  
  				<script>
var input = document.getElementById("myInput");
var text = document.getElementById("text");
input.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
    text.style.display = "block";
  } else {
    text.style.display = "none"
  }
});
</script>
  
  <script>
 var c=60;
        var t;
        timedCount();
 
        function timedCount()
		{
 
         var hours = parseInt( c / 3600 ) % 24;
         var minutes = parseInt( c / 60 ) % 60;
         var seconds = c % 60;
 
         var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);
 
            
         $('#timer').html(result);
            if(c == 0 )
			{
				//setConfirmUnload(false);
                //$("#quiz_form").submit();
				window.location="index.php";
			}
			
        c = c - 1;
        t = setTimeout(function()
		{
			timedCount()
		},
 1000);
}
 </script>
  
    </body>
</html>