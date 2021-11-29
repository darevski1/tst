<?php

function GetStaticPagesPage(){
	
	$return_string = '';
	
	$return_string .= '<div id="content_static_pages" class="container-fluid" style="display:none" >'; 
	$return_string .= '		<h1 class="h3 mb-4 text-gray-800">Static Pages</h1>';

	$return_string .= '		<form class="form-inline" onsubmit="return false">           
                               	<div class="form-group mx-sm-3 mb-2">';

    $return_string .= '				<button type="button" class="btn btn-primary" 
    									onClick="$(\'#create_static_page_form_0\').toggle()">Create New Static Page</button>
                                </div>
                            </form>';

	$return_string .= '		<br />';

	$return_string .= 		CreateStaticPageForm();
	
	$return_string .= '		<div id="static_page_table_div" class="d-flex justify-content-center row">';
	$return_string .= 			GetStaticPagesTable(0);
	$return_string .= '		</div>';
	$return_string .= '</div>';
	
	return $return_string;	
}



function CreateStaticPageForm($static_page_id = 0, $where = 'create'){
		
	$static_page_name = '';
	
	$return_string  = '';
	
	$display = 'block';
	
	if($where == 'create')
		$display = 'none';

	
	if($static_page_id != 0){
		
		$query = "SELECT page_name
				  FROM static_pages 
				  WHERE id = $static_page_id";
		
		$rows = QuerySelect($query);
		
		if($rows)
			if(count($rows) > 0){
				$static_page_name = $rows[0]['page_name'];
			}
	}
	

	$return_string  .= '<div class="col-md-7 col-sm-12 border-style" id="' . $where . '_static_page_form_' . $static_page_id . '" 
							 style="display:' . $display . '; margin-bottom:20px;">';
    $return_string  .= '    <form class="user p-3 " class="bg-gray-100" onsubmit="return false">';

    $return_string  .= '        <div class="form-group">';
    $return_string  .= '            <label for="text" class="text-gray-800">Static Page Name:</label>';
    $return_string  .= '            <input type="text" class="form-control" id="static_page_name_txt_' . $static_page_id . '" 
    									autocomplete="off" placeholder="Static Page Name" value="' . $static_page_name . '">';
    $return_string  .= '        </div>';

    $return_string  .= '        <div class="bd-example">';
    $return_string  .= '            <button class="btn btn-success" type="button" 
    										onClick="SaveStaticPageRow(' . $static_page_id . ')">Save</button>';
    $return_string  .= '            <button class="btn btn-danger" type="button" 
    										onClick="ShowEditForm(' . $static_page_id . ', \'course\')">Cancel</button>';
    $return_string  .= '        </div>';

    $return_string  .= '    </form>';
    $return_string  .= '</div>';

	
	return $return_string;
}



function GetNewRowStaticPagesTable($rows){
	
	$return_string = '';

	$return_string .= '<tr id="table_row_static_page_' . $rows['id'] . '">';
	$return_string .= '		<td>' . $rows['page_name'] . '</td>'; 
	$return_string .= '		<td>' . ChangeDateFormatPublicAmerican($rows['created_at']) . '</td>';
	$return_string .= '		<td>' . ChangeDateFormatPublicAmerican($rows['updated_at']) . '</td>';
	$return_string .= '		<td>' . GetStaticPageStatusCombobox($rows['id'], $rows['page_status']) . '</td>'; 

	$return_string .= '		<td><button type="button" class="btn btn-primary" onClick="ShowEditForm(' . $rows['id'] . ', \'static_page\')">EDIT</button></td>';
	$return_string .= '		<td><button type="button" class="btn btn-primary" 
										onClick="EditPage(\'static_page.php?spuid=' . $rows['unique_id'] . '\')">EDIT CONTENT</button></td>';
	$return_string .= '</tr>';

	$return_string .= '<tr class="spanedit" id="edit_static_page_row_' . $rows['id'] . '" style="display:none">';
	$return_string .= '		<td colspan="6">' . CreateStaticPageForm($rows['id'], 'edit') . '</td>';
	$return_string .= '</tr>';
	
	return $return_string;
}


function GetStaticPagesRowsFromDB($static_page_id = 0){

	$where = "";

	if($static_page_id > 0)
		$where = " AND id = $static_page_id";

	$query = "SELECT id, unique_id, page_name,  DATE(created_at) AS created_at, DATE(updated_at) AS updated_at, page_status
			  FROM static_pages
			  WHERE 1=1 $where
			  ORDER BY page_name";
	
	$rows = QuerySelect($query);
		
	return $rows;
}



function GetStaticPagesTable($static_page_id = 0){
		
	$rows = GetStaticPagesRowsFromDB($static_page_id);
	
	$return_string = '';
			
	$return_string .= '<table class="table" id="static_pages_table">';
	$return_string .= '    <thead>';
	$return_string .= '        <tr>';
	$return_string .= '            <th scope="col">Page Name</th>';
	$return_string .= '            <th scope="col">Date Created</th>';
	$return_string .= '            <th scope="col">Date Updated</th>';
	$return_string .= '            <th scope="col">Page Status</th>';
	$return_string .= '            <th scope="col">Edit</th>';
	$return_string .= '            <th scope="col">Edit Content</th>';
	$return_string .= '        </tr>';
	$return_string .= '    </thead>';
	$return_string .= '    <tbody  id="static_page_table_body">';

	for($i = 0; $i < count($rows);  $i++)
		$return_string .= GetNewRowStaticPagesTable($rows[$i], false);

	$return_string .= '    </tbody>';
	$return_string .= '</table>';
	
	return $return_string;
}


function GetStaticPageSectionsDB(){

   	$query = "SELECT id, theme_name
			  FROM static_page_themes
			  ORDER BY theme_name ASC";

	$rows = QuerySelect($query);

	return $rows;

}



function GetStaticPageStatusCombobox($static_page_id, $page_status){

	$html = '<select class="form-control" id="static_page_combo_' . $static_page_id . '" 
					 onchange="ChangeStaticPageStatus(' . $static_page_id . ')">';

	if($page_status == "Public"){
		$html .= '<option value="Public" selected>Public</option>';
		$html .= '<option value="Private">Private</option>';
	}
	else{
		$html .= '<option value="Public">Public</option>';
		$html .= '<option value="Private" selected>Private</option>';
	}
	
    $html .= '</select>';

    return $html;
}


?>