<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');
include('./includes/courses.php');

ConnectToDatabase();

$table   = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_POST['donataion_name']) && $_POST['donataion_name'] != ''){
	
         $donataion_name 	= check_input($_POST['donataion_name']);
         $content 		    = '';
         $donation_status    = 'Inactive';
         
         $query = "INSERT INTO donations (donataion_name, static_page_id, content, unique_id, donation_status, created_at)  VALUES ('$donataion_name', '1', '$content', UUID(), '$donation_status', NOW())";
         
         $rows = QueryInsert($query);
        }
?>