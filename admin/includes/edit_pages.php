<?php


function GetEditPagesPage(){
	
	$return_string = '';
	
	$return_string .= '<div id="content_edit_pages" class="container-fluid" style="display:none" >'; 
	$return_string .= '		<h1 class="h3 mb-4 text-gray-800">Public Pages</h1>';
	$return_string .= '		<br/>';
		
	$return_string .= '		<div id="edit_page_table_div" class="d-flex justify-content-center row">';
	$return_string .= 			GetEditPagesTable();
	$return_string .= '		</div>';
	$return_string .= '</div>';
	
	return $return_string;	
}




function CreateEditPageForm($edit_page_id = 0, $where = 'create'){
		
	$page_title = '';
	$page_name 	= '';
	$unique_id 	= '';
	
	$return_string  = '';
	
	$display = 'block';
	
	if($where == 'create')
		$display = 'none';

	
	if($edit_page_id != 0){
		
		$query = "SELECT id, unique_id, page_name, page_title
				  FROM site_pages 
				  WHERE id = $edit_page_id";
		
		$rows = QuerySelect($query);
		
		if($rows)
			if(count($rows) > 0){
				$page_title = $rows[0]['page_title'];
				$page_name 	= $rows[0]['page_name'];
				$unique_id 	= $rows[0]['unique_id'];	
			}
	}
	
	$return_string  .= '<div class="col-md-7 col-sm-12 border-style" id="create_edit_page_form_' . $edit_page_id . '" style="display:' . $display . '">';
    $return_string  .= '    <form class="user p-5 " class="bg-gray-100" onsubmit="return false">';
                        
    $return_string  .= '        <div class="form-group">';
    $return_string  .= '            <label for="text">Page Name:</label>';
    $return_string  .= '            <input type="text" class="form-control" id="page_name_txt_' . $edit_page_id . '" 
    									autocomplete="off" placeholder="Page Name" value="' . $page_name . '">';
    $return_string  .= '        </div>';

    $return_string  .= '        <div class="form-group">';
    $return_string  .= '            <label for="text">Page Title:</label>';
    $return_string  .= '            <input type="text" class="form-control" id="page_title_txt_' . $edit_page_id . '" 
    									autocomplete="off" placeholder="Page Title" value="' . $page_title . '">';
    $return_string  .= '        </div>';
            
    $return_string  .= '        <div class="bd-example">';
    $return_string  .= '            <button class="btn btn-success" type="button" 
    										onClick="SaveEditPageRow(' . $edit_page_id . ')">Save</button>';
    $return_string  .= '            <button class="btn btn-danger" type="button" 
    										onClick="ShowEditForm(' . $edit_page_id . ', \'edit_page\')">Cancel</button>';
    $return_string  .= '        </div>';

    $return_string  .= '    </form>';
    $return_string  .= '</div>';

	
	return $return_string;
}



function GetNewRowEditPagesTable($rows, $save_project = false){
	
	$return_string = '';

	if(!$save_project)
		$return_string .= '<tr id="table_row_edit_page_' . $rows['id'] . '">';
	
	$return_string .= '<td>' . $rows['page_name'] . '</td>'; 
	$return_string .= '<td>' . $rows['page_title'] . '</td>'; 
	$return_string .= '<td><a href="' . $rows['page_link'] . '" target="_blank">URL</a></td>'; 
	$return_string .= '<td>' . $rows['updated_at'] . '</td>';
	
	$return_string .= '<td><button type="button" class="btn btn-primary" onClick="ShowEditForm(' . $rows['id'] . ', \'edit_page\')">EDIT</button></td>';
	$return_string .= '<td><button type="button" class="btn btn-primary" onClick="EditPage(\'' . $rows['edit_link'] . '?spuid=' . $rows['unique_id'] . '\')">EDIT CONTENT</button></td>';
	
	if(!$save_project){
		$return_string .= '</tr>';
		$return_string .= '<tr class="spanedit" id="edit_edit_page_row_' . $rows['id'] . '" style="display:none">'; //
	}else
		$return_string .= '<!--a-->';

	$return_string .= '<td colspan="6">';
	$return_string .= 		CreateEditPageForm($rows['id'], 'edit');
	$return_string .= '</td>';
	
	if(!$save_project)
		$return_string .= '</tr>';
	
	return $return_string;
}


function GetEditPagesRowsFromDB($edit_page_id = 0){
	
	$where = "";

	if($edit_page_id != 0)
		$where = " AND id = $edit_page_id";

	$query = "SELECT id, unique_id, page_name, page_title, page_link, edit_link, updated_at
			  FROM site_pages
			  WHERE 1 = 1 $where
			  ORDER BY page_name ASC";
	


	$rows = QuerySelect($query);
		
	return $rows;
}



function GetEditPagesTable(){
		
	$rows = GetEditPagesRowsFromDB();
	
	$return_string = '';
			
	$return_string .= '<table class="table" id="edit_pages_table">';
	$return_string .= '    <thead>';
	$return_string .= '        <tr>';
	$return_string .= '            <th scope="col">Name</th>';
	$return_string .= '            <th scope="col">Title</th>';
	$return_string .= '            <th scope="col">URL</th>';
	$return_string .= '            <th scope="col">Updated</th>';
	$return_string .= '            <th scope="col">Edit</th>';
	$return_string .= '            <th scope="col">Edit Content</th>';
	$return_string .= '        </tr>';
	$return_string .= '    </thead>';
	$return_string .= '    <tbody  id="edit_page_table_body">';
	
	for($i = 0; $i < count($rows);  $i++)
		$return_string .= GetNewRowEditPagesTable($rows[$i], false);
		

	$return_string .= '    </tbody>';
	$return_string .= '</table>';
	
	
	return $return_string;
	
}




?>