<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');
include('../admin/includes/schedules_page.php');

ConnectToDatabase();

$table   = 'users';
$user_id = 'user_id';

$loged_in = isLogedIn($table, $user_id);

$page_name = "profile";

if($loged_in == false){
    exit("1");
}

if( isset($_POST['id']) && $_POST['id'] != '' &&
 	isset($_POST['d'])  && $_POST['d']  != '' &&
 	isset($_POST['t'])  && $_POST['t']  != ''){

	$time 	  = check_input($_POST['t']);
	$date 	  = check_input($_POST['d']);
	$event_id = check_input($_POST['id']);

	$user_id = $_SESSION['user_id'];

	if(UserSignedUpOnEvent($event_id, $user_id))
		exit("4");

	$query = "INSERT INTO scheduled_events_users (scheduled_event_id, user_id, signed_datetime, start_date, start_time)
									 VALUES($event_id, $user_id, NOW(), '$date', '$time')";

	$rows = QueryInsert($query);

	$date = last_monday($date);

	if($rows){

		$query = "UPDATE scheduled_events
					 SET users_aplied = users_aplied + 1
				   WHERE id = $event_id";

		QueryInsert($query);


		UpdateEventStatusIfFull($event_id);

		exit(GetScheduleTable($date));
	}

	exit("2");
}

exit('3');// invalid arguments