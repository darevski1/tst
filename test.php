<?php


include('./includes/db.php');
include('./includes/config.php');

ConnectToDatabase();


	$query = "SELECT title, price FROM scheduled_events";

	$rows = QuerySelect($query);

	// for($j = 0; $j < count($rows); $j++){

	// 	$event_price = round(floatval($rows[$j]["price"]) * 1.03, 2);
	// 	echo str_replace('.', "", strval($event_price)) . "<br />";
	// }


	$hours_need = "";

	echo intval($hours_need);
?>
