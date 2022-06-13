<?php 
session_start();
if($_SESSION['id'])
{
	unset($_SESSION['id']); // destroys the specified session.
}

if($_SESSION['m'])
{
	unset($_SESSION['m']); // destroys the specified session.
}

if($_SESSION['tm'])
{
	unset($_SESSION['tm']); // destroys the specified session.
}

if($_SESSION['login'])
{
	unset($_SESSION['login']); // destroys the specified session.
}

session_destroy(); // Destroying All Sessions Yeahhhhh
{
	header("Location: index.php"); // Redirecting To LOGIN PAGE 
}

?>
