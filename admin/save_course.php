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
 	isset($_POST['csn'])  && $_POST['csn']  != '' &&
 	isset($_POST['cid'])  && $_POST['cid']  != ''){
	

	$course_section_id 	= check_input($_POST['csid']);
	$course_name 		= check_input($_POST['csn']);
	$course_id 			= check_input($_POST['cid']);

	$course_id = intval($course_id);

	

	if($course_id > 0)
		$query = "UPDATE courses
					SET  course_name = '$course_name',
						 course_theme_id = $course_section_id,
						 updated_at = NOW()
				  WHERE id = $course_id";
	else{

		$query = "UPDATE course_themes
					 SET number_of_courses = number_of_courses + 1
				   WHERE id = $course_section_id";
				   
		QueryInsert($query);

		$query = "SELECT (COUNT(id) + 1) AS order_number
				  FROM courses 
				  WHERE course_theme_id = $course_section_id";

		$rows = QuerySelect($query);

		$order_number = $rows[0]["order_number"];

		$query = "INSERT INTO courses(unique_id, course_name, course_theme_id, course_text, order_number, created_at)
						VALUES(UUID(), '$course_name', $course_section_id, '', $order_number, NOW())";
	}
	
	$rows = QueryInsert($query);

	if($rows)
		exit(GetCoursesTable($course_section_id));

	exit("2");
}

exit('3');// invalid arguments