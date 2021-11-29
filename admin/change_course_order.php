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

if( isset($_POST['csid']) && $_POST['csid'] != '' &&
 	isset($_POST['cid'])  && $_POST['cid']  != '' &&
 	isset($_POST['on'])   && $_POST['on']   != ''){
	

	$course_section_id 	= check_input($_POST['csid']);
	$course_id 			= check_input($_POST['cid']);
	$order_number 		= check_input($_POST['on']);

	$previous_number = GetFieldFromTable("courses", "order_number", $course_id);

	if($previous_number > $order_number)
		$query = "UPDATE courses 
					 SET order_number = order_number + 1 
				   WHERE course_theme_id =  $course_section_id AND order_number >= $order_number AND order_number < $previous_number";
	else if($previous_number < $order_number)
		$query = "UPDATE courses 
					 SET order_number = order_number - 1 
				   WHERE course_theme_id =  $course_section_id AND order_number > $previous_number AND order_number <= $order_number";
	else
		exit("4");

	QueryInsert($query);

	$query = "UPDATE courses 
				 SET order_number = $order_number 
			   WHERE id =  $course_id";


	$rows = QueryInsert($query);

	if($rows)
		exit(GetCoursesTable($course_section_id));

	exit("2");
}

exit('3');// invalid arguments