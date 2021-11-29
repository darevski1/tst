<?php session_start(); ?>
<?php

include('../../includes/db.php');
include('../../includes/config.php');

ConnectToDatabase();
	

	$table 	 = 'admins';
	$user_id = 'admin_id';
	
	$loged_in = isLogedIn($table, $user_id);

	if(!$loged_in){		
		exit('1');//not logged in
	}
	
	
if( isset($_POST['puid']) && $_POST['puid'] != '' && 
	isset($_POST['ps'])   && $_POST['ps']   != ''){
	

	$project_unique_id 	= check_input($_POST['puid']);
	$project_status  	= check_input($_POST['ps']);


	$query = "UPDATE renovation_estimate_reports
				SET  `status` = '$project_status',
					 updated_at = NOW()
			  WHERE unique_id = '$project_unique_id'";

	$rows = QueryInsert($query);
	
	if($rows)
		exit("2");

					
	exit('4');// database error
}
else
	exit('3');// invalid arguments
