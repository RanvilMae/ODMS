
<?php

	include("conn.php");
	$id = (int) $_SESSION['loginc'];
			
					$query = $conn->query ("SELECT * FROM centraladmin WHERE id = '$id' ") or die (mysqli_error());
					$fetch = $query->fetch_array ();
	$department = $fetch['department'];
	$query=mysqli_query($conn,"select count(id) from `ca_files` WHERE  department = '$department'");
	$row = mysqli_fetch_row($query);

	$rows = $row[0];
	
	$page_rows = 10;

	$last = ceil($rows/$page_rows);

	if($last < 1){
		$last = 1;
	}

	$pagenum = 1;

	if(isset($_GET['pn'])){
		$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
	}

	if ($pagenum < 1) { 
		$pagenum = 1; 
	} 
	else if ($pagenum > $last) { 
		$pagenum = $last; 
	}

	$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	
	$nquery=mysqli_query($conn,"select * from `ca_files` WHERE  department = '$department' ORDER BY id DESC $limit");

	$paginationCtrls = '';

	if($last != 1){
		
	if ($pagenum > 1) {
   
		for($i = $pagenum-9; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" style="text-decoration:none;"> '.$i.'</a> ';
			}
	    }
    }
	
	$paginationCtrls .= ''.$pagenum.'';
	
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" style="text-decoration:none;"> '.$i.'</a>';
		if($i >= $pagenum+19){
			break;
		}
	}

 
	}

?>