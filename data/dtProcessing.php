<?php
 
/*
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
 // SQL server connection information
$sql_details = array(
    'user' => '',
    'pass' => '',
    'db'   => '',
    'host' => ''
);
 
// DB table to use
$table = 'data_eo_bmf inner join town_to_county_crosswalk on city = town';
$table .= ' left join ntee_major_groups on left(ntee_cd, 1) = group_letter';
 
// Table's primary key
$primaryKey = 'EIN';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'NAME', 'dt' => 0 ),
    //array( 'db' => 'CITY',  'dt' => 1 ),
    array( 'db' => 'county',   'dt' => 1 ),
	array( 'db' => 'group_name',     'dt' => 2 ),
/*
    array(
        'db'        => 'ASSET_AMT',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
			if ($d == "") {
				return $d;
			}
            else return '$'.number_format($d);
        }
    ),
	array(
        'db'        => 'INCOME_AMT',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
			if ($d == "") {
				return $d;
			}
            else return '$'.number_format($d);
        }
    ),
*/
	array(
        'db'        => 'REVENUE_AMT',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
			if ($d == "") {
				return $d;
			}
            else return '$'.number_format($d);
        }
    )	
);
 
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);