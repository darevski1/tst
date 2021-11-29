<?php


function GetEditDocumentsPage(){
	
	$return_string = '';
	
	$return_string .= '<div id="content_edit_documents" class="container-fluid" style="display:none" >'; 
	$return_string .= '		<h1 class="h3 mb-4 text-gray-800">Documents</h1>';
	$return_string .= '		<br/>';
		
	$return_string .= '		<div id="edit_document_table_div" class="d-flex justify-content-center row">';
	$return_string .= 			GetEditDocumentsTable();
	$return_string .= '		</div>';
	$return_string .= '</div>';
	
	return $return_string;	
}




function GetNewRowEditDocumentsTable($rows, $save_project = false){
	
	$return_string = '';

	$return_string .= '<tr id="table_row_edit_document_' . $rows['id'] . '">';
	
	$return_string .= '<td>' . $rows['document_name'] . '</td>'; 
	$return_string .= '<td>' . $rows['updated_at'] . '</td>';
	
	$return_string .= '<td><button type="button" class="btn btn-primary" onClick="EditPage(\'edit_official_document.php?duid=' . $rows['unique_id'] . '\')">EDIT CONTENT</button></td>';
	
	$return_string .= '</tr>';
	
	return $return_string;
}


function GetEditDocumentsRowsFromDB(){

	$query = "SELECT id, unique_id, document_name, content, updated_at
			  FROM documents
			  ORDER BY document_name ASC";
	
	$rows = QuerySelect($query);
		
	return $rows;
}



function GetEditDocumentsTable(){
		
	$rows = GetEditDocumentsRowsFromDB();
	
	$return_string = '';
			
	$return_string .= '<table class="table" id="edit_documents_table">';
	$return_string .= '    <thead>';
	$return_string .= '        <tr>';
	$return_string .= '            <th scope="col">Name</th>';
	$return_string .= '            <th scope="col">Updated</th>';
	$return_string .= '            <th scope="col">Edit Content</th>';
	$return_string .= '        </tr>';
	$return_string .= '    </thead>';
	$return_string .= '    <tbody  id="edit_document_table_body">';
	
	for($i = 0; $i < count($rows);  $i++)
		$return_string .= GetNewRowEditDocumentsTable($rows[$i], false);
		

	$return_string .= '    </tbody>';
	$return_string .= '</table>';
	
	
	return $return_string;
	
}




?>