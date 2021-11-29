<?php session_start(); ?>
<?php
require_once('../../includes/config.php');
require_once('../../includes/db.php');
require_once('./generators.php');

ConnectToDatabase();


$logged_user_id = -1;

	$table   = 'admins';
	$user_id = 'admin_id';

	$loged_in_admin = isLogedIn($table, $user_id);

	if($loged_in_admin)
		$logged_user_id = 0;



if($logged_user_id >= 0){	
	if(	isset($_POST['cruid']) && $_POST['cruid'] != ''){
						
		$chat_room_unique_id = check_input($_POST['cruid']);
				
		$query = "SELECT renovation_id, number_of_messages
				  FROM chat_rooms
				  WHERE unique_id = '$chat_room_unique_id'";

		$rows = QuerySelect($query);

		if(count($rows) > 0){

			$messages = GetMessages($rows[0]['renovation_id'], $logged_user_id);

			$number_of_messages = $rows[0]['number_of_messages'];

			exit($messages . '@#$#@#$' . $number_of_messages);
		}
				
		exit('3');
	
	}else
		exit('2');		
}
else
	exit('1');
?>
