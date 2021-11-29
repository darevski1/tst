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
	
if(	isset($_POST['s']) && $_POST['s'] != '' && isset($_POST['m']) && $_POST['m'] != '' && isset($_POST['e']) && $_POST['e'] != ''){
	
	$subject = check_input($_POST['s']);
	$message = check_input($_POST['m']);
	$email 	 = check_input($_POST['e']);
	
	$message = nl2br($message);

	// exit("SendEmail($subject, $message, 'contact@darkotest.com', $email)");

	if(SendEmail($subject, $message, 'contact@oaklandassistance.net', $email))
		exit('2'); //success
	
	exit('Email sending failed. <br />Try again.');
}
else
	exit('Invalid arguments');// invalid arguments
