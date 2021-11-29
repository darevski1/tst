<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');

ConnectToDatabase();

	
$table 	 = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if(!$loged_in){	
	exit('You are not logged in');
}
	
if(	isset($_POST['s']) && $_POST['s'] != '' && isset($_POST['id']) && $_POST['id'] != '' &&
	isset($_POST['m']) && $_POST['m'] != ''){
	
	$subject = check_input($_POST['s']);
	$message = check_input($_POST['m']);
	$event_id= check_input($_POST['id']);
	
	$message = nl2br($message);

	$query = "SELECT email 
			  FROM users u, scheduled_events_users seu 
			  WHERE scheduled_event_id = $event_id AND user_id = u.id";

	$rows = QuerySelect($query);

	$failed_emails = "";

	for($i = 0; $i < count($rows); $i++){

		if(!SendEmail($subject, $message, 'contact@oaklandassistance.net', $rows[$i]["email"]));
			$failed_emails .= "<br />" . $rows[$i]["email"];
	}
	
	if($failed_emails == "")
		exit("2");
	
	exit("Email sending failed for these email addresses: <br />$failed_emails");
}
else
	exit('Invalid arguments');// invalid arguments
