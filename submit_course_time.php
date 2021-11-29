<?php session_start(); ?>
<?php

include('./includes/db.php');
include('./includes/config.php');

ConnectToDatabase();

$table   = 'users';
$user_id = 'user_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_POST['cuid']) && $_POST['cuid'] != '' &&
	isset($_POST['ct'])   && $_POST['ct']   != '' &&
	isset($_POST['cr'])   && $_POST['cr']   != ''){
	
	$course_unique_id = check_input($_POST['cuid']);
	$course_time 	  = check_input($_POST['ct']);
	$course_review 	  = check_input($_POST['cr']);

	$course_id = GetID_FromUniqueID($course_unique_id, "courses");

	$user_id = $_SESSION['user_id'];

	$query = "SELECT id
			  FROM user_courses
			  WHERE user_id = '$user_id' AND course_id = $course_id AND printed = 0";

	$rows = QuerySelect($query);

	$query = "INSERT INTO user_courses(user_id, course_id, active_time_seconds, last_time_active, first_time_taken, course_review)
								VALUES($user_id, $course_id, $course_time, NOW(), NOW(), '$course_review')";

	if(count($rows) > 0)
		$query = "UPDATE user_courses
					 SET active_time_seconds = $course_time,
					 	 last_time_active 	 = NOW(),
					 	 course_review 	 	 = '$course_review'
				   WHERE id = " . $rows[0]["id"];

	QueryInsert($query);

	exit("2");

}

exit('4');// invalid arguments