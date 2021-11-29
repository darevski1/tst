<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');

ConnectToDatabase();
	

	$table 	 = 'admins';
	$user_id = 'admin_id';
	
	$loged_in = isLogedIn($table, $user_id);

	if(!$loged_in){		
		exit('1');//not logged in
	}
	
	
if(isset($_POST['id']) && $_POST['id'] && isset($_POST['s']) && $_POST['s'] ){
	
	$row_id 	= check_input($_GET['id']);
	$section 	= check_input($_GET['s']);

	

	exit($result);
}
else
	exit('3');// invalid arguments
