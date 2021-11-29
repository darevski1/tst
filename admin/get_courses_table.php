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

if( isset($_POST['csid']) && $_POST['csid'] != ''){
	
	$course_section_id 	= check_input($_POST['csid']);

	exit(GetCoursesTable($course_section_id));
}

exit('3');// invalid arguments