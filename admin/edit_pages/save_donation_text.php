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

if( isset($_POST['dn'])  && $_POST['dn']  != '' &&
    isset($_POST['dt'])  && $_POST['dt']  != '' &&
 	isset($_POST['did']) && $_POST['did'] != ''){
	
	$donation_name   = check_input($_POST['dn']);
	$donation_text 	 = check_input($_POST['dt']);
	$donation_id 	 = check_input($_POST['did']);

	$query = "UPDATE donations 
				SET  
                 donation_name = '$donation_name',
                 content       = '$donation_text'
			    WHERE id = $donation_id";

	$rows = QueryInsert($query);

	if($rows)
		exit("4");

	exit("2");
}

exit('3');// invalid arguments