<?php
				$id = (int) $_SESSION['id'];
			
				include("conn.php");
					$query = $conn->query ("SELECT * FROM users WHERE id = '$id' ") or die (mysqli_error());
					$fetch = $query->fetch_array ();
					$tid = $file['tid'];
					$department = $fetch['department'];
						$nquery=mysqli_query($conn,"select * from `tags` WHERE tag = '$tid'  ORDER BY id DESC ");
							foreach ( $nquery as $get){
							 $id = $get['id'];
								
							}
							$query=mysqli_query($conn,"select count(id) from `files` WHERE `id = '$id' ");
							
	$row = mysqli_fetch_row($query);

	$rows = $row[0];
						
	$page_rows = 5;
							
							
	$last = ceil($rows/$page_rows);
							
	echo $last;
							
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
	
	$nquery=mysqli_query($conn,"select * from `files` WHERE `id = '$id' ORDER BY id DESC $limit");

	$paginationCtrls = '';

	if($last != 1){
		
	if ($pagenum > 1) {
   
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" style="text-decoration:none;"> '.$i.'</a> ';
			}
	    }
    }
	
	$paginationCtrls .= ''.$pagenum.'';
	
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" style="text-decoration:none;"> '.$i.'</a>';
		if($i >= $pagenum+4){
			break;
		}
	}

 
	}
?>