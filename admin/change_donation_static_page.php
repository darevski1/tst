<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');
include('./includes/donations.php');

ConnectToDatabase();

$table   = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_POST['spid']) && $_POST['spid'] != '' &&
 	isset($_POST['did'])  && $_POST['did']  != ''){
	
	$static_page_id = check_input($_POST['spid']);
	$donation_id 	= check_input($_POST['did']);


	if(intval($static_page_id) == 0)
		$static_page_id = "NULL";

	$query = "UPDATE donations 
				 SET static_page_id = $static_page_id
			   WHERE id = $donation_id";

	$rows = QueryInsert($query);

	if($rows)
		exit(GetDonationsTable());

	exit("2");
}

exit('3');// invalid arguments