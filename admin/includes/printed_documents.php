<?php


function GetPrintedDocumentsPage(){
	
	$return_string = '';
	
	$return_string .= '<div id="content_printed_documents" class="container-fluid" style="display:none" >'; 
	$return_string .= '		<h1 class="h3 mb-4 text-gray-800">Printed Documents</h1>';

	$return_string .= 		GetFilters("printed_documents");

	$return_string .= '		<div id="printed_documents_table_div" class="d-flex justify-content-center row">';
	$return_string .= 			GetPrintedDocumentsTable();
	$return_string .= '		</div>';
	$return_string .= '</div>';
	
	return $return_string;	
}



function GetNewRowPrintedDocumentsTable($rows){
	
	$return_string = '';

	$return_string .= '<tr>';
	
	$return_string .= '		<td>' . $rows['unique_id'] . '</td>'; 
	$return_string .= '		<td>' . $rows['username'] . '</td>'; 
	$return_string .= '		<td>' . $rows['number_of_courses'] . '</td>'; 
	$return_string .= '		<td>' . FromSecondsToTime(intval($rows['total_time_seconds'])) . '</td>'; 
	$return_string .= '		<td>' . ChangeDateFormatPublicAmerican($rows['printed_datetime']) . '</td>'; 
	$return_string .= '		<td><a href="../official-document?uid=' . $rows['unique_id'] . '" target="_blank">Official Document</a></td>'; 
	$return_string .= '		<td><a href="../service-log?uid=' . $rows['unique_id'] . '" target="_blank">Service Log</a></td>'; 
	
	$return_string .= '</tr>';
	
	return $return_string;
}

function GetPrintedDocumentsRowsFromDB($date_from = "", $date_to = "", $where_field = "", $where_value = ""){

	$where = "";

	if($date_from != "")
		$where .= " AND printed_datetime  >= '$date_from'";

	if($date_to != "")
		$where .= " AND printed_datetime <= '$date_to'";

	if($where_field != "")
		$where .= " AND $where_field LIKE '%$where_value%'";

	$query = "SELECT total_time_seconds, number_of_courses, DATE(printed_datetime) AS printed_datetime, pd.unique_id, 
					 CONCAT(first_name, ' ', last_name) AS username
              FROM printed_documents pd, users u
              WHERE u.id = user_id $where
              ORDER BY printed_datetime DESC";

	$rows = QuerySelect($query);
		
	return $rows;
}

function GetPrintedDocumentsTable($date_from = "", $date_to = "", $where_field = "", $where_value = ""){
		
	$rows = GetPrintedDocumentsRowsFromDB($date_from, $date_to, $where_field, $where_value);
	
	$return_string = '';
			
	$return_string .= '<table class="table" id="users_table">';
	$return_string .= '    <thead>';
	$return_string .= '        <tr>';
	$return_string .= '            <th scope="col">Document Number</th>';
	$return_string .= '            <th scope="col">Username</th>';
	$return_string .= '            <th scope="col">Number of Courses</th>';
	$return_string .= '            <th scope="col">Total Time</th>';
	$return_string .= '            <th scope="col">Date Printed</th>';
	$return_string .= '            <th scope="col">Official Document</th>';
	$return_string .= '            <th scope="col">Service Log</th>';
	$return_string .= '        </tr>';
	$return_string .= '    </thead>';
	$return_string .= '    <tbody  id="printed_document_table_body">';
	
	for($i = 0; $i < count($rows);  $i++)
		$return_string .= GetNewRowPrintedDocumentsTable($rows[$i]);
		

	$return_string .= '    </tbody>';
	$return_string .= '</table>';
	
	
	return $return_string;
	
}




?>