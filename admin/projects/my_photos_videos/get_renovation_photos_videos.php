<?php session_start(); ?>
<?php

include('../../../includes/db.php');
include('../../../includes/config.php');
include('../../../my-account/my_photos_videos/generators.php');

ConnectToDatabase();

$table   = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_POST['reuid']) 	&& $_POST['reuid'] 	!= '' &&
 	isset($_POST['t']) 		&& $_POST['t'] 		!= ''){
	
	$renovation_unique_id = check_input($_POST['reuid']);
	$table   = check_input($_POST['t']);
	
	$renovation_id = GetID_FromUniqueID($renovation_unique_id, 'renovation_estimate_reports');

	$html = GetRenovationPhotosVideos($renovation_id, $table, '../../my-account/');
	
	exit($html);
}

exit('4');// invalid arguments