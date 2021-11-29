<?php session_start(); ?>
<?php

include('./includes/db.php');
include('./includes/config.php');

ConnectToDatabase();

$table   = 'users';
$user_id = 'user_id';

$loged_in = isLogedIn($table, $user_id);


if( isset($_POST['cuid']) && $_POST['cuid'] != ''){
	
	$course_unique_id = check_input($_POST['cuid']);

	$user_id = 0;

	if($loged_in != false)
		$user_id = $_SESSION['user_id'];

	$query = "SELECT unique_id, course_theme_id, theme_name, course_name, course_text, 
					 IFNULL((SELECT active_time_seconds FROM user_courses WHERE user_id = $user_id AND course_id = c.id AND printed = 0), 0) AS active_time
			  FROM courses c, course_themes ct 
			  WHERE unique_id = '$course_unique_id' AND ct.id = course_theme_id";

	$rows = QuerySelect($query);

	if(count($rows) > 0){

	    $results = new stdClass();

	    $results->theme_name  = $rows[0]["theme_name"];
	    $results->course_name = $rows[0]["course_name"];
	    $results->active_time = $rows[0]["active_time"];
	    $results->course_text = $rows[0]["course_text"];


	    $results_json = json_encode($results);

	    exit($results_json);

	}else
		exit('3');

}

exit('4');// invalid arguments