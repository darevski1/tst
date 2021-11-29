<?php session_start(); ?>
<?php
require_once('../../includes/config.php');
require_once('../../includes/db.php');
require_once('generators.php');

ConnectToDatabase();

	$logged_user_id = -1;


	$table   = 'admins';
	$user_id = 'admin_id';

	$loged_in_admin = isLogedIn($table, $user_id);

	if($loged_in_admin)
		$logged_user_id = 0;
	


if($logged_user_id >= 0){	
		
		if(	isset($_POST['txt'])   && $_POST['txt']   != '' &&
			isset($_POST['cruid']) && $_POST['cruid'] != ''){
			
			$chat_room_unique_id = check_input($_POST['cruid']);
			$text_message 		 = check_input(nl2br($_POST['txt']));
			
			$text_message_raw = nl2br($_POST['txt']);			
						
			$query = "SELECT renovation_id, user_id_from, user_id_to, IF(user_id_to = $logged_user_id, 0, not_seen + 1) AS not_seen 
					  FROM chat_rooms 
					  WHERE unique_id = '$chat_room_unique_id'";
			
			$rows = QuerySelect($query);
							
			if(count($rows) > 0){

				$renovation_id = $rows[0]['renovation_id'];
				$not_seen 	   = $rows[0]['not_seen'];

				if($rows[0]['user_id_from'] == $logged_user_id)
					$user_id = $rows[0]['user_id_to'];
				else
					$user_id = $rows[0]['user_id_from'];
			}else
				exit('3');
			
							

			$query = "UPDATE chat_rooms 
					  SET 
						user_id_from 	= $logged_user_id, 
						user_id_to 		= $user_id, 
						message 		= N'$text_message',
						not_seen 		= $not_seen,
						time_sent 		= NOW(),
						number_of_messages = number_of_messages + 1
					  WHERE unique_id = '$chat_room_unique_id'";
			
			QueryInsert($query);				
						
			
			$query = "INSERT INTO messages(renovation_id, user_id_from, user_id_to, message, time_sent)
							VALUES('$renovation_id', $logged_user_id, $user_id, N'$text_message', NOW())";
			
			QueryInsert($query);
			
			$html = CreateNewHomeUserMessage($text_message_raw);
			
			exit($html); // successfull
					
		}else		
			exit('2');				
}else
	exit('1');
?>
