<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');
include('../includes/generators.php');

ConnectToDatabase();

$table   = 'users';
$user_id = 'user_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}


$user_id = $_SESSION['user_id'];

$query = "SELECT COUNT(id) AS number_of_courses, IFNULL(SUM(active_time_seconds), 0) AS total_time_seconds 
		  FROM user_courses 
		  WHERE user_id = $user_id AND printed = 0";

$rows = QuerySelect($query);


$query = "SELECT hours_need, hours_available FROM users WHERE id = $user_id";

$rows2 = QuerySelect($query);

$results = new stdClass();

$results->number_of_courses  = $rows[0]["number_of_courses"];
$results->total_time_seconds = $rows[0]["total_time_seconds"];
$results->hours_available	 = $rows2[0]["hours_available"];
$results->hours_remaining	 = $rows2[0]["hours_need"];
$results->hours_available  	 = GetFieldFromTable("users", "hours_available", $user_id);
$results->printed_table  	 = GetMyPrintedCoursesTable($user_id);
$results->my_courses_table   = GetMyCoursesTable($user_id);

$results_json = json_encode($results);

exit($results_json);
