<?php


function GetCourseSectionsPage(){
	
	$return_string = '';
	
	$return_string .= '<div id="content_course_sections" class="container-fluid" style="display:none" >'; 
	$return_string .= '		<h1 class="h3 mb-4 text-gray-800">Course Sections</h1>';

	$return_string .= '		<button type="button" class="btn btn-primary" onClick="$(\'#create_course_section_form_0\').toggle()">Create New Section</button>';
	$return_string .= '<br /><br />';
	$return_string .= CreateCourseSectionForm();

	$return_string .= '		<div id="course_sections_table_div" class="d-flex justify-content-center row">';
	$return_string .= 			GetCourseSectionsTable();
	$return_string .= '		</div>';
	$return_string .= '</div>';
	
	return $return_string;	
}


function CreateCourseSectionForm($course_section_id = 0, $where = 'create'){
		
	$section_name = '';
	
	$return_string  = '';
	
	$display = 'block';
	
	if($where == 'create')
		$display = 'none';

	
	if($course_section_id != 0){
		
		$query = "SELECT theme_name
				  FROM course_themes 
				  WHERE id = $course_section_id";
		
		$rows = QuerySelect($query);
		
		if($rows)
			if(count($rows) > 0)
				$section_name = $rows[0]['theme_name'];
			
	}
	
	$return_string  .= '<div class="col-md-7 col-sm-12 border-style"  style="display:' . $display . '; margin-bottom:20px;"
							id="' . $where . '_course_section_form_' . $course_section_id . '">';
    $return_string  .= '    <form class="user p-3 " class="bg-gray-100" onsubmit="return false">';
                        
    $return_string  .= '        <div class="form-group">';
    $return_string  .= '            <label for="text" class="text-gray-800">Section Name:</label>';
    $return_string  .= '            <input type="text" class="form-control" id="course_section_name_txt_' . $course_section_id . '" 
    									autocomplete="off" placeholder="Section Name" value="' . $section_name . '">';
    $return_string  .= '        </div>';

            
    $return_string  .= '        <div class="bd-example">';
    $return_string  .= '            <button class="btn btn-success" type="button" 
    										onClick="SaveCourseSectionRow(' . $course_section_id . ')">Save</button>';
    $return_string  .= '            <button class="btn btn-danger" type="button" 
    										onClick="ShowEditForm(' . $course_section_id . ', \'course_section\')">Cancel</button>';
    $return_string  .= '        </div>';

    $return_string  .= '    </form>';
    $return_string  .= '</div>';

	
	return $return_string;
}


function GetNewRowCourseSectionsTable($rows, $save_project = false){
	
	$return_string = '';

	if(!$save_project)
		$return_string .= '<tr id="table_row_course_section_' . $rows['id'] . '">';
	
	$return_string .= '<td>' . $rows['theme_name'] . '</td>'; 
	$return_string .= '<td>' . $rows['number_of_courses'] . '</td>'; 
	
	$return_string .= '<td><button type="button" class="btn btn-primary" onClick="ShowEditForm(' . $rows['id'] . ', \'course_section\')">EDIT</button></td>';
	
	if(!$save_project){
		$return_string .= '</tr>';
		$return_string .= '<tr class="spanedit" id="edit_course_section_row_' . $rows['id'] . '" style="display:none">'; //
	}else
		$return_string .= '<!--a-->';

	$return_string .= '<td colspan="3">';
	$return_string .= 		CreateCourseSectionForm($rows['id'], 'edit');
	$return_string .= '</td>';
	
	if(!$save_project)
		$return_string .= '</tr>';
	
	return $return_string;
}




function GetCourseSectionsRowsFromDB(){

	$query = "SELECT id, theme_name, number_of_courses
			  FROM course_themes
			  ORDER BY theme_name ASC";

	$rows = QuerySelect($query);
		
	return $rows;
}



function GetCourseSectionsTable(){
		
	$rows = GetCourseSectionsRowsFromDB();
	
	$return_string = '';
			
	$return_string .= '<table class="table" id="users_table">';
	$return_string .= '    <thead>';
	$return_string .= '        <tr>';
	$return_string .= '            <th scope="col">Section Name</th>';
	$return_string .= '            <th scope="col">Number of Courses</th>';
	$return_string .= '            <th scope="col">Edit</th>';
	$return_string .= '        </tr>';
	$return_string .= '    </thead>';
	$return_string .= '    <tbody  id="course_section_table_body">';
	
	for($i = 0; $i < count($rows);  $i++)
		$return_string .= GetNewRowCourseSectionsTable($rows[$i]);
		

	$return_string .= '    </tbody>';
	$return_string .= '</table>';
	
	
	return $return_string;
	
}




?>