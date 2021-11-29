<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');
include('./includes/courses.php');

ConnectToDatabase();

$table   = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_POST['cs'])  && $_POST['cs']  != '' &&
 	isset($_POST['cid']) && $_POST['cid'] != ''){
	
	$status 	= check_input($_POST['cs']);
	$course_id 	= check_input($_POST['cid']);

	$query = "UPDATE courses 
				 SET course_status = '$status'
			   WHERE id = $course_id";

	$rows = QueryInsert($query);

	if($rows)
		exit("4");

	exit("2");
}

exit('3');// invalid arguments