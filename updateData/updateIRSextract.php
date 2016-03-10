<?php

// load scraping library

require 'simple_html_dom.php';

// get latest extract Month and Year

	$html = file_get_html('http://www.irs.gov/Charities-&-Non-Profits/Exempt-Organizations-Business-Master-File-Extract-EO-BMF');

	$modified = $html->find("meta[name='modified']", 0)->content;

	$extractYear = (int) substr($modified, 0, 4);

	$extractMonth = (int) substr($modified, 5,8);

	$extractMonthName = date("F", mktime(0, 0, 0, $extractMonth, 10));

// if newer than latest extract, get csv:

	$username = ""; 
	$password = "";   
	$host = "";
	$database="";
	
	$mysqli = new mysqli("$host", "$username", "$password", "$database");
	
	$query = "SELECT * FROM  `latest_extract`";

	$mostRecent = mysqli_query($mysqli, $query) or die("error");
	
	$row=mysqli_fetch_array($mostRecent);
	
	$dbMonthName = $row['month'];

	$dbYear = $row['year'];
	
	$dbDate = date_parse($dbMonthName);
	
	if($extractYear >= $dbYear || ($extractYear == $dbYear && $extractMonth > $dbDate['month'])) {
		
		// create temp table in database
		
		$query = "CREATE TABLE `temp_upload` LIKE `data_eo_bmf`";
	
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		
		define('CSV_PATH','http://www.irs.gov/pub/irs-soi/');

		$csv_path = CSV_PATH . "eo_vt.csv";

		$csvfile = fopen($csv_path, 'r');
		
		$i = 0;
		
		$query = "INSERT INTO temp_upload VALUES(";
		
		while (($data = fgetcsv($csvfile, 1000, ",")) !==FALSE){
		
			$i++;
			
			foreach($data as $key=>$value) {
				$data[$key] = "'" . addslashes($value) . "'";
			}
			
			$rows[] = implode(", ", $data);
		}
		
		array_splice($rows, 0, 1);
		
		$query .= implode("),(", $rows);
		$query .= ")";
		fclose($csvfile);
		
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli) );
		
		// check if IRS data now codes reclassified EINs
		
		$query = "CREATE TABLE tmp_delete_us
				  SELECT DISTINCT t.ein, t.ntee_cd
				  FROM temp_upload t
				  INNER JOIN reclassified_ntee_codes r
				  on t.EIN = r.EIN
				  WHERE t.ntee_cd <> '' AND LEFT(t.ntee_cd, 1) <> 'Z'";
				  
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli)) ;		  
		
		$query = "SELECT * FROM tmp_delete_us";
		
		$coded = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli)) ;
		
		$rowcount = mysqli_num_rows($coded);

		if (sizeof($rowcount) > 0) {
		
			$query = "DELETE FROM reclassified_ntee_codes
					  WHERE ein in (select ein from tmp_delete_us)";
					  
			mysqli_query($mysqli, $query) or die(mysqli_error($mysqli)) ;		  
		
		}
		
		$query = "DROP TABLE `tmp_delete_us`";
	
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		
		// update temp table with reclassified NTEE codes
		
		$query = "UPDATE temp_upload t
				  INNER JOIN reclassified_ntee_codes r
				  ON t.ein = r.ein
				  SET t.ntee_cd = r.ntee_cd
				  WHERE t.ntee_cd <> r.ntee_cd AND (t.ntee_cd = '' OR left(t.ntee_cd, 1) = 'Z')"; 
		
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli)) ;
		
		//add new data to archive
		
		$query = "INSERT INTO data_eo_bmf_archive
				  SELECT t.* 
				  FROM  `temp_upload` t
				  LEFT JOIN data_eo_bmf_archive a ON t.ein = a.ein
				  AND t.tax_period = a.tax_period
				  WHERE a.tax_period IS NULL ";
		
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli)) ;
		
		//update existing data
		
		$query = "UPDATE data_eo_bmf_archive a
				  INNER JOIN `temp_upload` t 
				  ON t.ein = a.ein and t.tax_period = a.tax_period
				  SET a.asset_amt = t.asset_amt, a.income_amt = t.income_amt, a.revenue_amt = t.revenue_amt, a.ntee_cd = t.ntee_cd
				  where t.asset_amt <> a.asset_amt OR t.income_amt <> a.income_amt OR
				  t.revenue_amt <> a.revenue_amt OR t.ntee_cd <> a.ntee_cd";

		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));		  
		
		//replace source data with temp data
		
		$query = "TRUNCATE data_eo_bmf";
		
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

		$query = "INSERT INTO data_eo_bmf
				SELECT * FROM temp_upload";
				
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

		// update extract date
		
		$query = "TRUNCATE latest_extract";
		
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

		$query = "INSERT INTO latest_extract
				  VALUES ('$extractMonthName', $extractYear)";
				  
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		
		$query = "DROP TABLE `temp_upload`";
	
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));				
		
		
	}

?>