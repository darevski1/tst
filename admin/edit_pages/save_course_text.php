<?php session_start(); ?>
<?php

include('../../includes/db.php');
include('../../includes/config.php');

ConnectToDatabase();

$table   = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_POST['ct'])  && $_POST['ct']  != '' &&
 	isset($_POST['cid']) && $_POST['cid'] != ''){
	
	$course_text = check_input($_POST['ct']);
	$course_id 	 = check_input($_POST['cid']);

	$query = "UPDATE courses
				SET  course_text = '$course_text',
					 updated_at = NOW()
			  WHERE id = $course_id";
	
	$rows = QueryInsert($query);

	if($rows)
		exit("4");

	exit("2");
}

exit('3');// invalid arguments