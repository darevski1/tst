<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');
include('./includes/schedules_page.php');

ConnectToDatabase();

$table   = 'admins';
$user_id = 'admin_id';
$page_name = "admin";

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_GET['df']) && $_GET['df'] != ''){
	
	$date_from = check_input($_GET['df']);
	
	$date_from = last_monday($date_from);

	exit(GetScheduleTable($date_from));
}

exit('3');// invalid arguments