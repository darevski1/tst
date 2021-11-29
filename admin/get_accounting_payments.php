<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');

ConnectToDatabase();

$table   = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_POST['df']) && $_POST['df'] != '' && 
	isset($_POST['dt']) && $_POST['dt'] != ''){
	
	$date_from 	= check_input($_POST['df']);
	$date_to 	= check_input($_POST['dt']);
	
	$query = "SELECT SUM(payment_amount) AS payment_amount, payment_order, DATE(date_time) AS date
			  FROM all_payments
			  WHERE '$date_from' <= DATE(date_time) AND '$date_to' >= DATE(date_time)
			  GROUP BY payment_order, DATE(date_time)";

	$rows = QuerySelect($query, "MYSQLI_ASSOC");

	$json_response = json_encode($rows);

	exit($json_response);
}

exit('3');// invalid arguments