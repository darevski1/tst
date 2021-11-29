<?php session_start(); ?>
<?php
require_once('../../includes/config.php');
require_once('../../includes/db.php');

ConnectToDatabase();

		$username 	= 'Matt Mullins';
		$email 		= 'matt@admin.com';
		
		$password 	= GenerateHashedString('mattoakland123', '1756');
		
		
		$query = "INSERT INTO admins(unique_id, username, email, password)
					VALUES(UUID(), '" . $username . "', '" . $email . "', '" . $password . "')";
		
		$rows = QueryInsert($query);
		
		if($rows)			
			exit('2'); // success
		
		
		

?>
