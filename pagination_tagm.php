<?php
				$id = (int) $_SESSION['m'];
				include("conn.php");
			$query = $conn->query ("SELECT tid, department, id FROM `users` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
		$id = $file['id'];
		$department = $file['department'];
		$nquery=mysqli_query($conn,"select count(id) from `tags` WHERE tag = '$tid' ") or die (mysqli_error());
		$row = mysqli_fetch_row($nquery);

			$query=mysqli_query($conn,"select count(id) from `files` WHERE id = '$id' AND department = '$department'");
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
	
	$nquery=mysqli_query($conn,"select * from `files` WHERE id = '$id' AND department = '$department' ORDER BY id DESC $limit");

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