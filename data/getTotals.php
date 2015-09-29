<?php

    $username = ""; 
    $password = "";   
    $host = "";
    $database="";
	
	$query = "SELECT count(*) as n FROM `data_eo_bmf`;";

	$mysqli = new mysqli($sql_details["$host"], $sql_details["$user"], $sql_details["$pass"], $sql_details["$db"]);
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

	$total = mysqli_query($mysqli, $query) or die("error");
	
	$row=mysqli_fetch_array($total);
	
	$total_n = $row['n'];
	
	$query = "SELECT count(*) as n FROM `data_eo_bmf` where foundation = 0";
	
	$not3 = mysqli_query($mysqli, $query) or die("error");
	
	$row=mysqli_fetch_array($not3);
	
	$not3_n = $row['n'];

	$query = "SELECT count(*) as n FROM `data_eo_bmf` where foundation not in (0, 2, 3, 4)";
	
	$charities = mysqli_query($mysqli, $query) or die("error");
	
	$row=mysqli_fetch_array($charities);
	
	$char_n = $row['n'];

	$query = "SELECT count(*) as n FROM `data_eo_bmf` where foundation in (2, 3, 4)";
	
	$foundations = mysqli_query($mysqli, $query) or die("error");
	
	$row=mysqli_fetch_array($foundations);
	
	$found_n = $row['n'];
	
	$query = "SELECT CONCAT(MONTH ,  ' ', YEAR ) AS asOf FROM  `latest_extract`";
	
	$latest = mysqli_query($mysqli, $query) or die("error");
	
	$latestDate = mysqli_fetch_array($latest);
	
	$asOf = $latestDate['asOf'];
	
	$query = "SELECT ROUND( SUM( revenue_amt /1000000000 ) , 2 ) AS revTotal FROM  `data_eo_bmf` where foundation not in (0, 2, 3, 4) ";
	
	$revAmt = mysqli_query($mysqli, $query) or die("error");
	
	$revTotal = mysqli_fetch_array($revAmt);
	
	$rev = $revTotal['revTotal'];
	
	$query = "SELECT ROUND( SUM( asset_amt /1000000000 ) , 2 ) AS assetTotal FROM  `data_eo_bmf` where foundation not in (0, 2, 3, 4)";
	
	$assetAmt = mysqli_query($mysqli, $query) or die("error");
	
	$assetTotal = mysqli_fetch_array($assetAmt);
	
	$asset = $assetTotal['assetTotal'];	
	
	$query = "SELECT COUNT( * ) as smallRev FROM  `data_eo_bmf` WHERE foundation NOT IN ( 0, 2, 3, 4 ) AND income_amt <500000";
	
	$smallPC = mysqli_query($mysqli, $query) or die("error");
	
	$smallPCn = mysqli_fetch_array($smallPC);
	
	$smallRev = $smallPCn['smallRev'];

	$smallRevPct = round($smallRev / $char_n, 2) * 100;
	
	$query = "SELECT COUNT( * ) as noRev FROM  `data_eo_bmf` WHERE foundation NOT IN ( 0, 2, 3, 4 ) AND income_amt = 0";
	
	$noPC = mysqli_query($mysqli, $query) or die("error");
	
	$noPCn = mysqli_fetch_array($noPC);
	
	$noRev = $noPCn['noRev'];
	
	$query = "SELECT COUNT( * ) as lessthan100 FROM  `data_eo_bmf` WHERE foundation NOT IN ( 0, 2, 3, 4 ) AND income_amt > 0 and income_amt < 100000";
	
	$lessThan100 = mysqli_query($mysqli, $query) or die("error");
	
	$lessThan100n = mysqli_fetch_array($lessThan100);
	
	$lt100 = $lessThan100n['lessthan100'];
	
	$query = "SELECT COUNT( * ) as btw100and500 FROM  `data_eo_bmf` WHERE foundation NOT IN ( 0, 2, 3, 4 ) AND income_amt >= 100000 and income_amt < 500000";
	
	$btw100and500 = mysqli_query($mysqli, $query) or die("error");
	
	$btw100and500n = mysqli_fetch_array($btw100and500);
	
	$between100and500 = $btw100and500n['btw100and500'];	
	
	$query = "SELECT COUNT( * ) as btw500and1mil FROM  `data_eo_bmf` WHERE foundation NOT IN ( 0, 2, 3, 4 ) AND income_amt >= 500000 and income_amt < 1000000";
	
	$btw500and1million = mysqli_query($mysqli, $query) or die("error");
	
	$btw500and1milN = mysqli_fetch_array($btw500and1million);
	
	$between500and1mil = $btw500and1milN['btw500and1mil'];		
	
	$query = "SELECT COUNT( * ) as btw1and5mil FROM  `data_eo_bmf` WHERE foundation NOT IN ( 0, 2, 3, 4 ) AND income_amt >= 1000000 and income_amt < 5000000";
	
	$btw1and5million = mysqli_query($mysqli, $query) or die("error");
	
	$btw1and5milN = mysqli_fetch_array($btw1and5million);
	
	$between1and5mil = $btw1and5milN['btw1and5mil'];		
	
	$query = "SELECT COUNT( * ) as morethan5mil FROM  `data_eo_bmf` WHERE foundation NOT IN ( 0, 2, 3, 4 ) AND income_amt >= 5000000";
	
	$morethan5million = mysqli_query($mysqli, $query) or die("error");
	
	$morethan5milN = mysqli_fetch_array($morethan5million);
	
	$morethan5mil = $morethan5milN['morethan5mil'];		
	
	$response = array(	
		"total" => $total_n,
		"not3" => $not3_n,
		"c3" => ($total_n - $not3_n),
		"pc" => $char_n,
		"pf" => $found_n,
		"asOf" => $asOf,
		"rev" => $rev,
		"asset" => $asset,
		"smallRev" => $smallRevPct,
		"noRev" => $noRev,
		"lt100" => $lt100,
		"btw100and500" => $between100and500,
		"btw500and1mil" => $between500and1mil,
		"btw1and5mil" => $between1and5mil,
		"moreThan5mil" => $morethan5mil,

	);
	
	echo json_encode($response);
?>	