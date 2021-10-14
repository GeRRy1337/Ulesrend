<?php
    function getStudents($conn){
		$sql = "SELECT * FROM `5/13ice`";
		$result = $conn->query($sql);
		return $result;
	}

	function getIds($conn,$table){
		$sql = "SELECT * FROM ".$table;
		$result = $conn->query($sql);	
		$array=array();

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($array,$row["id"]);
			}
		}
		return $array;
	}
?>