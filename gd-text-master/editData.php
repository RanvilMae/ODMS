<?php
		require("conn.php");
		
		$userid=$_GET["userid"];

		$query="select * from data where userid='". $userid ."'";
			if($result = $conn->query($query)){
				while($row = $result->fetch_assoc()){
				$arr[]=array('userid' =>$row['userid'],
				'forw'=>$row['forw'],
				'fromw' =>$row['fromw'],
				'subject' =>$row['subject'],
				'date' =>$row['date'],
				'description' =>$row['description'],
				'signatory' =>$row['signatory']
				);
			}
				$result->free();
		}
		print (json_encode($arr));
		$conn->close();

?>