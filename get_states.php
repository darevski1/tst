<?php session_start(); ?>
<?php

include('./includes/db.php');
include('./includes/config.php');
include('./includes/generators.php');

ConnectToDatabase();

if( isset($_POST['cid']) && $_POST['cid'] != '' &&
	isset($_POST['sid']) && $_POST['sid'] != ''){
	
	$country_id = check_input($_POST['cid']);
	$state_id 	= check_input($_POST['sid']);

	exit(GetStatesSelect($country_id, $state_id));
}

exit('4');// invalid arguments