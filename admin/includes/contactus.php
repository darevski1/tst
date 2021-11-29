<?php


function GetContactUsPage(){
	
	$return_string = '';
	
	$return_string .= '<div id="content_contactus" class="container-fluid" style="display:none" >'; 
	$return_string .= '		<h1 class="h3 mb-4 text-gray-800">Contact Us</h1>';

	$return_string .= 		GetFilters("contactus");
		
	$return_string .= '		<div id="contactus_table_div" class="d-flex justify-content-center row">';
	$return_string .= 			GetContactUsTable();
	$return_string .= '		</div>';
	$return_string .= '</div>';
	
	return $return_string;	
}

function GetContactUsEmailRow($rows){

	$return_string = '';

	$return_string .= '<td colspan="6">';
	$return_string .= '		<div class="col-md-7 col-sm-12 border-style">';
    $return_string .= '    	<form class="user p-5 " class="bg-gray-100" onsubmit="return false">';
	$return_string .= '			<h5 class="atitle" style="margin-bottom:25px">Send Email to: <b>' . $rows['email'] . '</b></h5>';

    $return_string .= '        <div class="form-group">';
    $return_string .= '            <label for="text">Email Subject:</label>';
    $return_string .= '            <input type="text" class="form-control" id="email_subject_contactus_' . $rows['id'] . '" 
    									autocomplete="off" placeholder="Enter message subject!">';
    $return_string .= '        </div>';

    $return_string .= '        <div class="form-group mt-4">';
    $return_string .= '            <label for="text">Email Message:</label>';
    $return_string .= '            <textarea name="" class="form-control" id="email_message_contactus_' . $rows['id'] . '" cols="30" rows="7"></textarea>';
    $return_string .= '        </div>';

	
    $return_string .= '        <div class="bd-example">';
    $return_string .= '            <button class="btn btn-success" type="button" 
    								onClick="SendEmail(\'' . $rows['id'] . '\', \'contactus\', \'' . $rows['email'] . '\')">Send</button>';
    $return_string .= '            <button class="btn btn-danger" type="button" 
    									onClick="$(\'#contactus_email_row_' . $rows['id'] . '\').hide()">Cancel</button>';
    $return_string .= '        </div>';
    $return_string .= '    </form>';
	$return_string .= '		</div>';
	$return_string .= '</td>';

	return $return_string;
}

function GetContactUsDetailsRow($rows){

	$return_string = '';

	$message = str_replace("<br />", '&#13;&#10;', $rows['message']);

	$return_string .= '<td colspan="6">';
	$return_string .= '		<div class="col-md-7 col-sm-12 border-style">';
    $return_string .= '    	<form class="user p-5 " class="bg-gray-100" onsubmit="return false">';
	$return_string .= '			<h5 class="atitle" style="margin-bottom:25px">Email Sent From: <b>' . $rows['email'] . '</b></h5>';

    $return_string .= '        <div class="form-group">';
    $return_string .= '            <label for="text">Email Subject:</label>';
    $return_string .= '            <input type="text" class="form-control" readonly value="' . $rows['subject'] . '">';
    $return_string .= '        </div>';

    $return_string .= '        <div class="form-group mt-4">';
    $return_string .= '            <label for="text">Email Message:</label>';
    $return_string .= '            <textarea name="" class="form-control" readonly cols="30" rows="7">' . $message . '</textarea>';
    $return_string .= '        </div>';

    $return_string .= '    </form>';
	$return_string .= '		</div>';
	$return_string .= '</td>';

	return $return_string;
}


function GetNewRowContactUsTable($rows){
	
	$return_string = '';

	$return_string .= '<tr id="table_row_contactus_' . $rows['id'] . '">';
	
	$return_string .= '<td>' . $rows['name'] . '</td>'; 
	$return_string .= '<td>' . $rows['email'] . '</td>'; 
	$return_string .= '<td>' . $rows['subject'] . '</td>'; 
	$return_string .= '<td>' . ChangeDateFormatPublicAmerican($rows['send_at'])  . '</td>';
	
	$return_string .= '<td><button type="button" class="btn btn-primary" 
							onClick="$(\'#contactus_details_row_' . $rows['id'] . '\').toggle()">DETAILS</button></td>';
	$return_string .= '<td><button type="button" class="btn btn-primary" 
							onClick="$(\'#contactus_email_row_' . $rows['id'] . '\').toggle()">SEND EMAIL</button></td>';
	
	$return_string .= '</tr>';

	$return_string .= '<tr class="spanedit" id="contactus_email_row_' . $rows['id'] . '" style="display:none">';
	$return_string .= GetContactUsEmailRow($rows);
	$return_string .= '</tr>';

	$return_string .= '<tr class="spanedit" id="contactus_details_row_' . $rows['id'] . '" style="display:none">';
	$return_string .= GetContactUsDetailsRow($rows);
	$return_string .= '</tr>';
	
	return $return_string;
}


function GetContactUsRowsFromDB($date_from = "", $date_to = "", $where_field = "", $where_value = ""){

	$where = "";

	if($date_from != "")
		$where .= " AND '$date_from' <= send_at ";

	if($date_to != "")
		$where .= " AND '$date_to'   >= send_at ";

	if($where_field != "")
		$where .= " AND $where_field LIKE '%$where_value%'";

	$query = "SELECT id, name, email, subject, DATE(send_at) AS send_at, message
			  FROM contact_us
			  WHERE 1=1 $where
			  ORDER BY send_at DESC";

	$rows = QuerySelect($query);
		
	return $rows;
}



function GetContactUsTable($date_from = "", $date_to = "", $where_field = "", $where_value = ""){
		
	$rows = GetContactUsRowsFromDB($date_from, $date_to, $where_field, $where_value);
	
	$return_string = '';
			
	$return_string .= '<table class="table" id="contactus_table">';
	$return_string .= '    <thead>';
	$return_string .= '        <tr>';
	$return_string .= '            <th scope="col">Name</th>';
	$return_string .= '            <th scope="col">Email</th>';
	$return_string .= '            <th scope="col">Subject</th>';
	$return_string .= '            <th scope="col">Date Sent</th>';
	$return_string .= '            <th scope="col" style="width:140px">Details</th>';
	$return_string .= '            <th scope="col" style="width:150px">Send Email</th>';
	$return_string .= '        </tr>';
	$return_string .= '    </thead>';
	$return_string .= '    <tbody  id="contactus_table_body">';
	
	for($i = 0; $i < count($rows);  $i++)
		$return_string .= GetNewRowContactUsTable($rows[$i]);
		

	$return_string .= '    </tbody>';
	$return_string .= '</table>';
	
	
	return $return_string;
	
}




?>