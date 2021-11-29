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

if( isset($_POST['duid']) && $_POST['duid'] != '' &&
 	isset($_POST['dt'])   && $_POST['dt']   != ''){
	
	$document_unique_id = check_input($_POST['duid']);
	$document_content 	= check_input($_POST['dt']);

	$document_id = GetID_FromUniqueID($document_unique_id, "documents");

	if($document_id == 0)
		exit('5');// invalid arguments

	$query = "UPDATE documents
				SET  content = '$document_content',
					 updated_at = NOW()
			  WHERE id = $document_id";
	
	$rows = QueryInsert($query);

	if($rows)
		exit("4");

	exit("2");
}

exit('3');// invalid arguments