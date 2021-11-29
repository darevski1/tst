<?php session_start(); ?>
<?php

include('../../includes/db.php');
include('../../includes/config.php');
include('../includes/edit_pages.php');

ConnectToDatabase();
	

	$table 	 = 'admins';
	$user_id = 'admin_id';
	
	$loged_in = isLogedIn($table, $user_id);

	if(!$loged_in){		
		exit('1');//not logged in
	}
	
	
if( isset($_POST['t']) && isset($_POST['epid']) && $_POST['epid'] != '' &&
	isset($_POST['n']) && $_POST['n'] != ''){
	
	$site_page_id = check_input($_POST['epid']);

	$title = check_input($_POST['t']);
	$name  = check_input($_POST['n']);


	$query = "UPDATE site_pages
				SET  page_title = '$title',
					 page_name  = '$name',
					 updated_at = NOW()
			  WHERE id = $site_page_id";

	$rows = QueryInsert($query);
	
	if($rows){
		
		$rows = GetEditPagesRowsFromDB($site_page_id);
				
		if(is_array($rows))
			if(count($rows) > 0){
				$table_row = GetNewRowEditPagesTable($rows[0], true, 0);
				exit($table_row);
			}				
		exit('4');// database error
	}

	exit("2");
}
else
	exit('3');// invalid arguments
