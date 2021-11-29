<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');

ConnectToDatabase();


if( isset($_POST['n']) && $_POST['n'] != '' &&
 	isset($_POST['s']) && $_POST['s'] != '' &&
  	isset($_POST['m']) && $_POST['m'] != '' &&
  	isset($_POST['e']) && $_POST['e'] != ''){
	
	$name 	 = check_input($_POST['n']);
	$subject = check_input($_POST['s']);
	$message = check_input($_POST['m']);
	$email 	 = check_input($_POST['e']);

	$user_id = 0;

	$loged_in = isLogedIn("users", $user_id);

	if($loged_in)
		$user_id = $_SESSION['user_id'];

	ContactUs($name, $email, $subject, $message);

	exit('3');
}

exit('4');// invalid arguments