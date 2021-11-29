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

if( isset($_POST['scuid']) && $_POST['scuid'] != ''){
	
	$selected_course_unique_id = check_input($_POST['scuid']);

	$user_id = $_SESSION['user_id'];

	$selected_courses_ids = explode("###", $selected_course_unique_id);

	$number_of_courses = count($selected_courses_ids);

	$query = "INSERT INTO printed_documents(unique_id, user_id, printed_datetime, number_of_courses)
				VALUES(FLOOR( RAND() * (99999999-10000000) + 10000000), $user_id, NOW(), $number_of_courses)";

	QueryInsert($query);

	$print_id = $mysqli_link->insert_id;

	$courses_ids = "";

	for($i = 0; $i < $number_of_courses; $i++){

		$course_id = GetID_FromUniqueID($selected_courses_ids[$i], "courses");

		$query = "SELECT active_time_seconds, id FROM user_courses WHERE course_id = $course_id AND printed = 0 AND user_id = $user_id";

		$rows = QuerySelect($query);

		$user_course_id = $rows[0]["id"];
		$active_time_seconds = $rows[0]["active_time_seconds"];

		if($courses_ids != "")
			$courses_ids .= ", ";

		$courses_ids .= $course_id;

		$query = "UPDATE users
					 SET hours_need 	 = hours_need - $active_time_seconds,
					 	 hours_available = hours_available - $active_time_seconds
				   WHERE id = $user_id";

		QueryInsert($query);

		$query = "SELECT hours_need FROM users WHERE id = $user_id";

		$rows = QuerySelect($query);

		$hours_remaining_seconds = $rows[0]["hours_need"];

		$query = "INSERT INTO  printed_courses(course_id, print_id, user_id, user_course_id, hours_remaining_seconds)
										VALUES($course_id, $print_id, $user_id, $user_course_id, $hours_remaining_seconds)";

		QueryInsert($query);

	}

	$query = "UPDATE printed_documents
				 SET total_time_seconds = (SELECT SUM(active_time_seconds) FROM user_courses WHERE course_id IN ($courses_ids))
			   WHERE id = $print_id";

	QueryInsert($query);


	$query = "UPDATE user_courses
				 SET printed = 1
			   WHERE course_id IN ($courses_ids)";
			   
	QueryInsert($query);

	exit("2");

}

exit('4');// invalid arguments