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
 	isset($_POST['pt'])   && $_POST['pt']   != '' &&
 	isset($_POST['pc'])   && $_POST['pc']   != ''){
	

	$static_page_id = check_input($_POST['spid']);
	$page_title 	= check_input($_POST['pt']);
	$page_content 	= check_input($_POST['pc']);

	$query = "UPDATE static_pages
				SET  page_title = '$page_title',
					 content 	= '$page_content',
					 updated_at = NOW()
			  WHERE id = $static_page_id";
	
	$rows = QueryInsert($query);

	if($rows)
		exit("4");

	exit("2");
}

exit('3');// invalid arguments