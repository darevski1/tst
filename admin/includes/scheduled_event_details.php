<?php


function GetEventDetailsPage(){
	
	$return_string = '';
	
	$return_string .= '<div id="content_event_details" class="container-fluid" style="display:none" >'; 
	$return_string .= '		<h1 class="h3 mb-4 text-gray-800">Event Details </h1>';
	
	$return_string .= '		<button type="button" class="btn btn-primary" onClick="$(\'#send_email_to_all_div\').toggle()">Send Email to All</button>';
	$return_string .= '		<br /><br />';
	$return_string .= '		<div id="send_email_to_all_div" class=" mb-5"></div>';
	// $return_string .= 		GetFormSendEmailToAll();

	$return_string .= '		<div id="event_details_table_div" class="d-flex justify-content-center row">';
	// $return_string .= 			GetEventDetailsTable();
	$return_string .= '		</div>';
	$return_string .= '</div>';
	
	return $return_string;	
}

function GetFormSendEmailToAll($event_id){

	$return_string = '';

	$return_string .= '<div class="col-md-7 col-sm-12 border-style">';
    $return_string .= '    	<form class="user p-4 " class="bg-gray-100" onsubmit="return false">';
	$return_string .= '			<h5 class="atitle" style="margin-bottom:25px; color:#333">Send Email to All:</h5>';

    $return_string .= '        <div class="form-group">';
    $return_string .= '            <label for="text" style="color:#333">Email Subject:</label>';
    $return_string .= '            <input type="text" class="form-control" id="event_email_subject" 
    									autocomplete="off" placeholder="Enter message subject!">';
    $return_string .= '        </div>';

    $return_string .= '        <div class="form-group mt-4">';
    $return_string .= '            <label for="text" style="color:#333">Email Message:</label>';
    $return_string .= '            <textarea class="form-control" cols="30" rows="7" 
    										 id="event_email_message"></textarea>';
    $return_string .= '        </div>';

    $return_string .= '        <div class="bd-example">';
    $return_string .= '            <button class="btn btn-success" type="button" 
    									onClick="SendEventEmailToAll(' . $event_id . ')">Send</button>';
    $return_string .= '            <button class="btn btn-danger" type="button" 
    									onClick="$(\'#send_email_to_all_div\').hide()">Cancel</button>';
    $return_string .= '        </div>';
    $return_string .= '    </form>';
	$return_string .= '</div>';

	return $return_string;
}

function GetEventDetailEmailRow($rows){

	$return_string = '';

	$return_string .= '<td colspan="6">';
	$return_string .= '		<div class="col-md-7 col-sm-12 border-style">';
    $return_string .= '    	<form class="user p-5 " class="bg-gray-100" onsubmit="return false">';
	$return_string .= '			<h5 class="atitle" style="margin-bottom:25px">Send Email to: <b>' . $rows['email'] . '</b></h5>';

    $return_string .= '        <div class="form-group">';
    $return_string .= '            <label for="text">Email Subject:</label>';
    $return_string .= '            <input type="text" class="form-control" id="email_subject_event_details_' . $rows['unique_id'] . '" 
    									autocomplete="off" placeholder="Enter message subject!">';
    $return_string .= '        </div>';

    $return_string .= '        <div class="form-group mt-4">';
    $return_string .= '            <label for="text">Email Message:</label>';
    $return_string .= '            <textarea name="" class="form-control" id="email_message_event_details_' . $rows['unique_id'] . '" cols="30" rows="7"></textarea>';
    $return_string .= '        </div>';


    $return_string .= '        <div class="bd-example">';
    $return_string .= '            <button class="btn btn-success" type="button" 
    								onClick="SendEmail(\'' . $rows['unique_id'] . '\', \'event_details\', \'' . $rows['email'] . '\')">Send</button>';
    $return_string .= '            <button class="btn btn-danger" type="button" 
    									onClick="$(\'#event_detail_email_row_' . $rows['unique_id'] . '\').hide()">Cancel</button>';
    $return_string .= '        </div>';
    $return_string .= '    </form>';
	$return_string .= '		</div>';
	$return_string .= '</td>';

	return $return_string;
}


function GetNewRowEventDetailsTable($rows, $i){
	
	$return_string = '';

	$return_string .= '<tr id="table_row_event_detail_' . $rows['id'] . '">';
	
	$return_string .= '<td>' . $rows['username'] . '</td>'; 
	$return_string .= '<td>' . $rows['email'] . '</td>'; 
	$return_string .= '<td>' . $rows['gender'] . '</td>';
	$return_string .= '<td>' . $rows['street_adress'] . '</td>';
	$return_string .= '<td>' . $rows['registered'] . '</td>';
	
	$return_string .= '<td><button type="button" class="btn btn-primary" 
							onClick="$(\'#event_detail_email_row_' . $rows['unique_id'] . '\').toggle()">SEND EMAIL</button></td>';
	
	$return_string .= '</tr>';

	$return_string .= '<tr class="spanedit" id="event_detail_email_row_' . $rows['unique_id'] . '" style="display:none">';
	$return_string .= GetEventDetailEmailRow($rows);
	$return_string .= '</tr>';
	
	return $return_string;
}


function GetEventDetailsRowsFromDB($date = "", $time = "", $where_field = "", $where_value = ""){

	$where = "";

	if($where_field != "")
		$where .= " AND $where_field LIKE '%$where_value%'";


	$query = "SELECT u.id, u.unique_id, CONCAT(first_name, ' ', last_name) AS username, email, 
					 DATE(signed_datetime) AS registered, gender, street_adress
			  FROM users u, scheduled_events_users seu
			  WHERE start_date = '$date' AND start_time = '$time' AND user_id = u.id $where
			  ORDER BY created_at DESC";

	$rows = QuerySelect($query);
		
	return $rows;
}



function GetEventDetailsTable($date = "", $time = "", $where_field = "", $where_value = ""){
		
	$rows = GetEventDetailsRowsFromDB($date, $time, $where_field, $where_value);
	
	$return_string = '';
			
	$return_string .= '<table class="table" id="event_details_table">';
	$return_string .= '    <thead>';
	$return_string .= '        <tr>';
	$return_string .= '            <th scope="col">Name</th>';
	$return_string .= '            <th scope="col">Email</th>';
	$return_string .= '            <th scope="col">Gender</th>';
	$return_string .= '            <th scope="col">Address</th>';
	$return_string .= '            <th scope="col">Date SignedUp</th>';
	$return_string .= '            <th scope="col">Send Email</th>';
	$return_string .= '        </tr>';
	$return_string .= '    </thead>';
	$return_string .= '    <tbody  id="event_detail_table_body">';
	
	for($i = 0; $i < count($rows);  $i++)
		$return_string .= GetNewRowEventDetailsTable($rows[$i], $i);
		

	$return_string .= '    </tbody>';
	$return_string .= '</table>';
	
	
	return $return_string;
	
}

?>