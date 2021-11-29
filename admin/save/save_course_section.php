<?php session_start(); ?>
<?php

include('../../includes/db.php');
include('../../includes/config.php');
include('../includes/course_sections.php');

ConnectToDatabase();

$table   = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_POST['csid']) && $_POST['csid'] != '' &&
 	isset($_POST['csn'])  && $_POST['csn']  != ''){
	

	$course_section_id 	= check_input($_POST['csid']);
	$section_name 		= check_input($_POST['csn']);

	$course_section_id = intval($course_section_id);

	$query = "INSERT INTO course_themes (theme_name, number_of_courses)
						VALUES('$section_name', 0)";

	if($course_section_id > 0)
		$query = "UPDATE course_themes
					SET  
						 theme_name = '$section_name'
				  WHERE id = $course_section_id";
	
	$rows = QueryInsert($query);

	if($rows)
		exit(GetCourseSectionsTable());

	exit("2");
}

exit('3');// invalid arguments