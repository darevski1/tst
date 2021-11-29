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

if( isset($_POST['ds'])  && $_POST['ds']  != '' &&
 	isset($_POST['did']) && $_POST['did'] != ''){
	
	$status 	    = check_input($_POST['ds']);
	$donation_id 	= check_input($_POST['did']);

	$query = "UPDATE donations 
				 SET donation_status = '$status'
			   WHERE id = $donation_id";

	$rows = QueryInsert($query);

	if($rows)
		exit("4");

	exit("2");
}

exit('3');// invalid arguments