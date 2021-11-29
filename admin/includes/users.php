<?php


function GetUsersPage(){
	
	$return_string = '';
	
	$return_string .= '<div id="content_users" class="container-fluid" style="display:none" >'; 
	$return_string .= '		<h1 class="h3 mb-4 text-gray-800">Users</h1>';

	$return_string .= 		GetFilters("users");
	
	$return_string .= '		<div id="users_table_div" class="d-flex justify-content-center row">';
	$return_string .= 			GetUsersTable();
	$return_string .= '		</div>';
	$return_string .= '</div>';
	
	return $return_string;	
}

function GetUserEmailRow($rows){

	$return_string = '';

	$return_string .= '<td colspan="8">';
	$return_string .= '		<div class="col-md-7 col-sm-12 border-style">';
    $return_string .= '    	<form class="user p-5 " class="bg-gray-100" onsubmit="return false">';
	$return_string .= '			<h5 class="atitle" style="margin-bottom:25px">Send Email to: <b>' . $rows['email'] . '</b></h5>';

    $return_string .= '        <div class="form-group">';
    $return_string .= '            <label for="text">Email Subject:</label>';
    $return_string .= '            <input type="text" class="form-control" id="email_subject_users_' . $rows['unique_id'] . '" 
    									autocomplete="off" placeholder="Enter message subject!">';
    $return_string .= '        </div>';

    $return_string .= '        <div class="form-group mt-4">';
    $return_string .= '            <label for="text">Email Message:</label>';
    $return_string .= '            <textarea name="" class="form-control" id="email_message_users_' . $rows['unique_id'] . '" cols="30" rows="7"></textarea>';
    $return_string .= '        </div>';


    $return_string .= '        <div class="bd-example">';
    $return_string .= '            <button class="btn btn-success" type="button" 
    								onClick="SendEmail(\'' . $rows['unique_id'] . '\', \'users\', \'' . $rows['email'] . '\')">Send</button>';
    $return_string .= '            <button class="btn btn-danger" type="button" 
    									onClick="$(\'#user_email_row_' . $rows['unique_id'] . '\').hide()">Cancel</button>';
    $return_string .= '        </div>';
    $return_string .= '    </form>';
	$return_string .= '		</div>';
	$return_string .= '</td>';

	return $return_string;
}


function GetNewRowUsersTable($rows, $i){
	
	$return_string = '';

	$return_string .= '<tr id="table_row_user_' . $rows['id'] . '">';
	
	// $return_string .= '<th scope="row">' . ($i + 1) . '.</td>';
	$return_string .= '<td>' . $rows['username'] . '</td>'; 
	$return_string .= '<td>' . $rows['email'] . '</td>'; 
	$return_string .= '<td>' . $rows['gender'] . '</td>';
	$return_string .= '<td>' . $rows['street_adress'] . '</td>';
	$return_string .= '<td>' . FromSecondsToTime(intval($rows['hours_need'])) . '</td>';
	$return_string .= '<td>' . FromSecondsToTime(intval($rows['hours_available'])) . '</td>';
	$return_string .= '<td>' . $rows['registered'] . '</td>';
	
	$return_string .= '<td><button type="button" class="btn btn-primary" 
							onClick="$(\'#user_email_row_' . $rows['unique_id'] . '\').toggle()">SEND EMAIL</button></td>';
	
	$return_string .= '</tr>';

	$return_string .= '<tr class="spanedit" id="user_email_row_' . $rows['unique_id'] . '" style="display:none">';
	$return_string .= GetUserEmailRow($rows);
	$return_string .= '</tr>';
	
	return $return_string;
}


function GetUsersRowsFromDB($date_from = "", $date_to = "", $where_field = "", $where_value = ""){

	$where = "";

	if($date_from != "")
		$where .= " AND created_at  >= '$date_from'";

	if($date_to != "")
		$where .= " AND created_at <= '$date_to'";

	if($where_field != "")
		$where .= " AND $where_field LIKE '%$where_value%'";


	$query = "SELECT id, unique_id, CONCAT(first_name, ' ', last_name) AS username, email, 
					 DATE(created_at) AS registered, hours_need, hours_available, gender, street_adress
			  FROM users
			  WHERE 1=1 $where
			  ORDER BY created_at DESC";

	$rows = QuerySelect($query);
		
	return $rows;
}



function GetUsersTable($date_from = "", $date_to = "", $where_field = "", $where_value = ""){
		
	$rows = GetUsersRowsFromDB($date_from, $date_to, $where_field, $where_value);
	
	$return_string = '';
			
	$return_string .= '<table class="table" id="users_table">';
	$return_string .= '    <thead>';
	$return_string .= '        <tr>';
	// $return_string .= '            <th scope="col">#</th>';
	$return_string .= '            <th scope="col">Name</th>';
	$return_string .= '            <th scope="col">Email</th>';
	$return_string .= '            <th scope="col">Gender</th>';
	$return_string .= '            <th scope="col">Address</th>';
	$return_string .= '            <th scope="col">Hours Needed</th>';
	$return_string .= '            <th scope="col">Hours Available</th>';
	$return_string .= '            <th scope="col">Date Registered</th>';
	$return_string .= '            <th scope="col">Send Email</th>';
	$return_string .= '        </tr>';
	$return_string .= '    </thead>';
	$return_string .= '    <tbody  id="user_table_body">';
	
	for($i = 0; $i < count($rows);  $i++)
		$return_string .= GetNewRowUsersTable($rows[$i], $i);
		

	$return_string .= '    </tbody>';
	$return_string .= '</table>';
	
	
	return $return_string;
	
}




?>