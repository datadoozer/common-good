<?php

	require_once("connect.php")
	
	$query = "SELECT *
			  FROM bls_qcew";
	
	$mysqli = new mysqli("$host", "$username", "$password", "$database");
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

	$results = mysqli_query($mysqli, $query) or die("error");
	
	$response = array();
	
	while($row = mysqli_fetch_assoc($results)) {
		$response[] = $row;
	}
	
	$i = 0;
	
	
	echo json_encode($response);
?>	