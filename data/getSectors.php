<?php

    $username = ""; 
    $password = "";   
    $host = "";
    $database="";
	
	$query = "SELECT DISTINCT IF( major_category_title IS NULL 
				OR major_category_title LIKE  '%unknow%',  'Unknown', IF( major_category_id
				IN ( 4, 5 ) ,  'Health & Human Services', major_category_title ) ) AS sector, COUNT( * ) AS n, SUM( income_amt ) AS inc
				FROM data_eo_bmf AS d
				LEFT JOIN ntee_major_groups g ON LEFT( d.ntee_cd, 1 ) = g.group_letter
				LEFT JOIN ntee_major_categories c ON g.group_category = c.major_category_id
				WHERE foundation NOT 
				IN ( 0, 2, 3, 4 ) 
				GROUP BY IF( major_category_title IS NULL 
				OR major_category_title LIKE  '%unknow%',  'Unknown', IF( major_category_id
				IN ( 4, 5 ) ,  'Health & Human Services', major_category_title ) ) 
				ORDER BY IF( ntee_cd =  ''
				OR ntee_cd IS NULL ,  'Z', LEFT( ntee_cd, 1 ) ) ";
	
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