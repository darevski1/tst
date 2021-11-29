<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');

ConnectToDatabase();

$table   = 'users';
$user_id = 'user_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_POST['ln'])   && $_POST['ln']   != '' &&
 	isset($_POST['fn'])   && $_POST['fn']   != '' &&
  	isset($_POST['sa'])   && $_POST['sa']   != '' &&
  	isset($_POST['zc'])   && $_POST['zc']   != '' &&
  	isset($_POST['po'])   && $_POST['po']   != '' &&
  	isset($_POST['hn'])   && $_POST['hn']   != '' &&
  	isset($_POST['cid'])  && $_POST['cid']  != '' &&
  	isset($_POST['sid'])  && $_POST['sid']  != '' &&
  	isset($_POST['city']) && $_POST['city'] != '' &&
  	isset($_POST['coid']) && $_POST['coid'] != '' &&
  	isset($_POST['r'])    && $_POST['r']    != ''){
	

	$street_adress 	= check_input($_POST['sa']);
	$zip_code 		= check_input($_POST['zc']);
	$probation 		= check_input($_POST['po']);
	$hours_need 	= check_input($_POST['hn']);
	$court_id 		= check_input($_POST['cid']);
	$city 			= check_input($_POST['city']);
	$country_id 	= check_input($_POST['coid']);
	$reason 		= check_input($_POST['r']);
	$first_name   	= check_input($_POST['fn']);
	$last_name 	  	= check_input($_POST['ln']);
	$state_id 	  	= check_input($_POST['sid']);

	$country = GetFieldFromTable("country", "printable_name", $country_id);
	$state 	 = GetFieldFromTable("states", "name", $state_id);

	$user_id = $_SESSION['user_id'];

	$query = "UPDATE users
				SET  
					 first_name = '$first_name',
					 last_name 	= '$last_name',
					 city 		= '$city',
					 country 	= '$country',
					 country_id = '$country_id',
					 state 		= '$state',
					 state_id 	= '$state_id',
					 zip_code 	= '$zip_code',
					 court_id 	= '$court_id',
					 hours_need = '$hours_need',
					 reason 	= '$reason',
					 street_adress = '$street_adress',
					 probation_officer 	= '$probation',
					 updated_at = NOW()
			  WHERE id = $user_id";
	
	$rows = QueryInsert($query);

	if($rows)
		exit('3');

	exit("");
}

exit('4');// invalid arguments