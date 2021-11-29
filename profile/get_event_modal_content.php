<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');
include('../admin/includes/schedules_page.php');

ConnectToDatabase();

$table   = 'users';
$user_id = 'user_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_GET['d']) && $_GET['d'] != '' && 
	isset($_GET['t']) && $_GET['t'] != ''){
	
	$date = check_input($_GET['d']);
	$time = check_input($_GET['t']);


	$title 		 = '';
	$description = '';
	$price	 	 = 0;
	$event_id	 = 0;

	$rows = GetEventByDateTime($date, $time);

	if(count($rows) > 0){
		$event_id 		 = $rows[0]['id'];
		$title 			 = $rows[0]['title'];
		$description 	 = $rows[0]['description'];
		$price 	 		 = round(floatval($rows[0]['price']) * 1.03, 2);
	}else
		exit("2");

	$return_html = '<div class="modal-header">
						<h5 class="modal-title">' . $title . '</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Event Price: <b>$' . $price . '</b><br /><br />
						Event Description: <br /> <b>' . $description . '</b>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn cancel_btn " data-bs-dismiss="modal" id="modal_cancel_button">Cancel</button>
						<button type="button" class="btn join_btn" onclick="JoinEvent(' . $event_id . ', \'' . $date . '\', \'' . $time . '\')">Join</button>
					</div>';

	exit($return_html);
}

exit('3');// invalid arguments
