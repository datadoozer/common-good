<?php

    $username = ""; 
    $password = "";   
    $host = "";
    $database="";
	
	$query = "SELECT distinct county, count(*) as n, sum(income_amt) as inc 
			  FROM `town_to_county_crosswalk` c 
			  inner join data_eo_bmf as d 
			  on town = city 
			  where foundation not in (0,2,3,4)
			  group by county 
			  order by county";
	
	$mysqli = new mysqli("$host", "$username", "$password", "$database");
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

	$results = mysqli_query($mysqli, $query) or die("error");
	
	$response = array();
	
	while($row = mysqli_fetch_assoc($results)) {
		$response[] = $row;
	}
	
	$total_n = 0;
	
	$total_rev = 0;
	
	foreach($response as $v) {
		
		$total_n += $v['n'];
		$total_rev += $v['inc'];
		
	}
	$i = 0;
	foreach($response as $v) {
		
		$response[$i]['n'] = (int) $v['n'];
		$response[$i]['inc'] = (int) $v['inc'];
		$response[$i]['n_pct'] = round($v['n']/$total_n, 2);
		$response[$i]['inc_pct'] = round($v['inc']/$total_rev, 2);
		$i++;
	}
	
	
	echo json_encode($response);
?>	