<?php session_start(); ?>
<?php

include('../../includes/db.php');
include('../../includes/config.php');
include('./users.php');
include('./printed_documents.php');
include('./contactus.php');

ConnectToDatabase();
	

	$table 	 = 'admins';
	$user_id = 'admin_id';
	
	$loged_in = isLogedIn($table, $user_id);

	if(!$loged_in){		
		exit('1');//not logged in
	}
	
	
if( isset($_GET['s'])  && $_GET['s'] != '' && 
	isset($_GET['df']) &&
	isset($_GET['dt']) &&
	isset($_GET['wf']) &&
	isset($_GET['wv'])){
	
	$section 	 = check_input($_GET['s']);
	$date_from 	 = check_input($_GET['df']);
	$date_to 	 = check_input($_GET['dt']);
	$where_field = check_input($_GET['wf']);
	$where_value = check_input($_GET['wv']);

	$date_from 	= ChangeDateFormatDB($date_from);
	$date_to 	= ChangeDateFormatDB($date_to);
	
	$return_data = "";

	$sections_username = ["users", "printed_documents"];

	if(in_array($section, $sections_username) && $where_field == "username")
		$where_field = "CONCAT(first_name, ' ', last_name)";

	switch ($section) {
		case 'users':
			$return_data = GetUsersTable($date_from, $date_to, $where_field, $where_value);
			break;
		
		case 'printed_documents':
			$return_data = GetPrintedDocumentsTable($date_from, $date_to, $where_field, $where_value);
			break;

		case 'contactus':
			$return_data = GetContactUsTable($date_from, $date_to, $where_field, $where_value);
			break;
		
		default:
			# code...
			break;
	}
	
	exit($return_data);
}
else
	exit('3');// invalid arguments
