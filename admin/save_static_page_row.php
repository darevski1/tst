<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');
include('./includes/static_pages.php');

ConnectToDatabase();

$table   = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_POST['spid']) && $_POST['spid'] != '' &&
 	isset($_POST['pn'])   && $_POST['pn']   != ''){
	

	$static_page_id = check_input($_POST['spid']);
	$page_name 		= check_input($_POST['pn']);

	$static_page_id = intval($static_page_id);

	$query = "INSERT INTO static_pages(unique_id, page_name, created_at)
						VALUES(UUID(), '$page_name', NOW())";

	if($static_page_id > 0)
		$query = "UPDATE static_pages
					SET  page_name = '$page_name',
						 updated_at = NOW()
				  WHERE id = $static_page_id";
	
	$rows = QueryInsert($query);

	if($rows)
		exit(GetStaticPagesTable());

	exit("2");
}

exit('3');// invalid arguments