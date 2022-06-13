
<?php

	include("conn.php");
$count=1; 
if(isset($_POST['search'])){
	$search=$_POST['search'];
	$query=mysqli_query($conn,"select * from files WHERE fromw like '%".$search."%' ||  subject like '%".$search."%' ||  date like '%".$search."%' || restriction like '%".$search."%'");
	$row = mysqli_fetch_row($query);

	
	$rows = $row[0];
	
	$page_rows = 5;

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
	
	$nquery=mysqli_query($conn,"select * from files WHERE fromw like '%".$search."%' ||  subject like '%".$search."%' ||  date like '%".$search."%' || restriction like '%".$search."%'");

	$paginationCtrls = '';

	if($last != 1){
		
	if ($pagenum > 1) {
   
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
			}
	    }
    }
	
	$paginationCtrls .= ''.$pagenum.' &nbsp; ';
	
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
		if($i >= $pagenum+4){
			break;
		}
	}

 
	}
}
?>