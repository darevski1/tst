<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');
include('./includes/schedules_page.php');

ConnectToDatabase();

$table   = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

$page_name = "admin";

if($loged_in == false){
    exit("1");
}

if( isset($_POST['s'])  && $_POST['s']  != '' &&
 	isset($_POST['d'])  && $_POST['d']  != '' &&
 	isset($_POST['t'])  && $_POST['t']  != '' &&
 	isset($_POST['p'])  && $_POST['p']  != '' &&
 	isset($_POST['nu']) && $_POST['nu'] != '' &&
 	isset($_POST['tt']) && $_POST['tt'] != '' &&
 	isset($_POST['dd']) && $_POST['dd'] != ''){

	$status = check_input($_POST['s']);
	$title 	= check_input($_POST['tt']);
	$time 	= check_input($_POST['t']);
	$date 	= check_input($_POST['d']);
	$price 	= check_input($_POST['p']);

	$description 	 = check_input($_POST['dd']);
	$number_of_users = check_input($_POST['nu']);

	$event_id = 0;

	$rows = GetEventByDateTime($date, $time);

	$query = "INSERT INTO scheduled_events (event_date, start_time, title, description, event_status, price, number_of_users, created_at)
									 VALUES('$date', '$time', '$title', '$description', '$status', $price, $number_of_users, NOW())";

	if(count($rows) > 0){

		$event_id = $rows[0]["id"];

		$query = "UPDATE scheduled_events
					 SET 
						 title 			 = '$title',
						 description 	 = '$description',
						 event_status	 = '$status',
						 price 			 = $price,
						 number_of_users = $number_of_users,
						 updated_at 	 = NOW()
				   WHERE id = $event_id";
	}

	
	$rows = QueryInsert($query);

	$date = last_monday($date);

	if($rows){

		UpdateEventStatusIfFull($event_id);
		
		exit(GetScheduleTable($date));
	}

	exit("2");
}

exit('3');// invalid arguments