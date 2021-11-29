<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');
include('./includes/schedules_page.php');

ConnectToDatabase();

$table   = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_GET['d']) && $_GET['d'] != '' && 
	isset($_GET['t']) && $_GET['t'] != ''){
	
	$date = check_input($_GET['d']);
	$time = check_input($_GET['t']);

	exit(GenerateEventModalContent($date, $time));
}

exit('3');// invalid arguments