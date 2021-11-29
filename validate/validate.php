<?php

include('../includes/db.php');
include('../includes/config.php');

ConnectToDatabase();
	
if( isset($_POST['vc']) && $_POST['vc'] != ''){
	
	$document_unique_id = check_input($_POST['vc']);

	$document_id = GetID_FromUniqueID($document_unique_id, "printed_documents");
	
	if($document_id == 0)
		exit("2"); // wrong verification code
	else
		exit("3"); // document exists
}

exit('4');// invalid arguments
