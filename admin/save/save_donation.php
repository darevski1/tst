<?php session_start(); ?>
<?php

include('../../includes/db.php');
include('../../includes/config.php');
include('../includes/donations.php');

ConnectToDatabase();

$table   = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_POST['dn']) && $_POST['dn'] != ''){
	
    $donation_name 	= check_input($_POST['dn']);

    $query = "INSERT INTO donations (unique_id, donation_name, static_page_id, content, created_at)  
                             VALUES (UUID(), '$donation_name', 0, '', NOW())";

    $rows = QueryInsert($query);


    if($rows)
        exit(GetDonationsTable());
    

    exit("2"); //Something went wrong. Try again.
}

exit('3');// invalid arguments
?>