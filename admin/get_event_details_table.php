<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');
include('./includes/scheduled_event_details.php');
include('./includes/schedules_page.php');

ConnectToDatabase();

$table   = 'admins';
$user_id = 'admin_id';
$page_name = "admin";

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_GET['d']) && $_GET['d'] != '' && 
	isset($_GET['t']) && $_GET['t'] != '' ){
	
	$date = check_input($_GET['d']);
	$time = check_input($_GET['t']);

	$rows = GetEventByDateTime($date, $time);

	$event_id = $rows[0]["id"];

	$return_data = GetEventDetailsTable($date, $time) . "##%%$$#$#" . GetFormSendEmailToAll($event_id);

	exit($return_data);
}

exit('3');// invalid arguments