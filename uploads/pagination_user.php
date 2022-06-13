<?php
	 
 
	
if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
	} else {
		$page_no = 1;
        }
				
	$total_records_per_page = 10;
    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "1"; 
				 $id = (int) $_SESSION['id'];
			$query = $conn->query ("SELECT * FROM `users` WHERE id = '$id' ORDER BY date DESC ") or die (mysqli_error());
		$file = $query->fetch_array ();
		$tid = $file['tid'];
		$department = $fetch['department'];
					$nquery=mysqli_query($conn,"select * from `tags` WHERE tag = '$tid'  ORDER BY id DESC LIMIT $offset, $total_records_per_page  ");
			foreach ( $nquery as $get){
			 $track = $get['track'];
			 $primary_id = $get['primary_id'];
			 $id = $get['id'];
    $result = mysqli_query($conn,"SELECT * FROM `files` WHERE restriction = 'Open to All' AND  id = '$id' ORDER by id DESC  ");
    foreach ( $result as $fetch){
		$did = $fetch['id'];
	
		$result_count = mysqli_query($conn,"SELECT COUNT(id) As total_records FROM `tags` WHERE id = '$did'");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	
	$second_last = $total_no_of_pages - 1; // total page minus 1
			}
			}
			?>