<?php

	require_once("connect.php")
	
   $org = $_POST["org"];
  
   if ($org == "all") {
	
		$query = "SELECT 
				sum(case 
						when income_amt = '' || income_amt <= 0
						then 1 
						else 0 
						end) 
				as '0',
				sum(case 
						when income_amt > 0 && income_amt < 100000 
						then 1 
						else 0 
						end) 
				as '1',
				sum(case 
						when income_amt >= 100000 && income_amt < 500000 
						then 1 
						else 0 
						end) 
				as '2',				
				sum(case 
						when income_amt >= 500000 && income_amt < 1000000 
						then 1 
						else 0 
						end) 
				as '3',
				sum(case 
						when income_amt >= 1000000 && income_amt < 5000000 
						then 1 
						else 0 
						end) 
				as '4',	
				sum(case 
						when income_amt >= 5000000
						then 1 
						else 0 
						end) 
				as '5'
				FROM `data_eo_bmf` 
			
			";
    }
	
	else {
		
		$where = "WHERE Foundation";
		
		if ($org == "notc3") {
			
			$where .= " = 0";
		}
		
		else if ($org == "c3") {
			
			$where .= " <> 0";
		}
		
		else if ($org == "found") {
			
			$where .= " in (2,3,4)";
		}
		
		else if ($org == "char") {
			
			$where .= " not in (0, 2, 3, 4)";
		}
		
		$query = "SELECT 
				sum(case 
						when income_amt = '' || income_amt <= 0
						then 1 
						else 0 
						end) 
				as '0',
				sum(case 
						when income_amt > 0 && income_amt < 100000 
						then 1 
						else 0 
						end) 
				as '1',
				sum(case 
						when income_amt >= 100000 && income_amt < 500000 
						then 1 
						else 0 
						end) 
				as '2',				
				sum(case 
						when income_amt >= 500000 && income_amt < 1000000 
						then 1 
						else 0 
						end) 
				as '3',
				sum(case 
						when income_amt >= 1000000 && income_amt < 5000000 
						then 1 
						else 0 
						end) 
				as '4',	
				sum(case 
						when income_amt >= 5000000
						then 1 
						else 0 
						end) 
				as '5'
				FROM `data_eo_bmf` 
				$where
			
			";		
		
	}	
  
	$mysqli = new mysqli("$host", "$username", "$password", "$database");
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}	
	
	$results = mysqli_query($mysqli, $query) or die("error");
	
	$response = array();
	
	while($row = mysqli_fetch_assoc($results)) {
		$response = $row;
	}
	
	$total = 0;
	
	foreach($response as $v) {
		
		$total += $v;
		
	}
	
	$data = array();
	$xValues = ["No income", "Less than $100k", "$100k to $499k", "$500k to $999k", "$1M to $4.9M", "$5M +"];	
	$i = 0;
	foreach ($response as $v) {
		$data[$i]["inc_class"] = $xValues[$i];
		$data[$i]["n"] = (int) $v;
		$data[$i]["pct"] = round($v/$total,2);
		$i++;
	}
	
	echo json_encode($data);
?>	