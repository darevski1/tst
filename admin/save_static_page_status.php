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

if( isset($_POST['spid']) && $_POST['spid'] != '' &&
 	isset($_POST['ps'])   && $_POST['ps']   != ''){
	

	$static_page_id = check_input($_POST['spid']);
	$page_status 	= check_input($_POST['ps']);


	$query = "UPDATE static_pages
				SET  page_status = '$page_status',
					 updated_at = NOW()
			  WHERE id = $static_page_id";
	
	$rows = QueryInsert($query);

	if($rows)
		exit("");

	exit("2");
}

exit('3');// invalid arguments