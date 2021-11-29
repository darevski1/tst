<?php

function GetCoursesPage(){
	
	$return_string = '';
	
	$return_string .= '<div id="content_courses" class="container-fluid" style="display:none" >'; 
	$return_string .= '		<h1 class="h3 mb-4 text-gray-800">Courses</h1>';

	$return_string .= '		<form class="form-inline" onsubmit="return false">           
                               	<div class="form-group mx-sm-3 mb-2">';

    $return_string .= 				GetCourseSectionComboSelect();

    $return_string .= '				<button type="button" class="btn btn-primary" 
    									onClick="$(\'#create_course_form_0\').toggle()">Create New Course</button>
                                </div>
                            </form>';

	$return_string .= '		<br />';
	$return_string .= 		CreateCourseForm();
	
	$return_string .= '		<div id="course_table_div" class="d-flex justify-content-center row">';
	$return_string .= 			GetCoursesTable(0);
	$return_string .= '		</div>';
	$return_string .= '</div>';
	
	return $return_string;	
}



function GetCourseSectionComboSelect(){

   	$rows = GetCourseSectionsDB();

	$html = '<select class="form-control mr-3" id="select_course_section" style="width:200px" onChange="SelectCourseSection()">';

	$html .= '<option value="0">Select Section</option>';

	for($i = 0; $i < count($rows); $i++)
		$html .= '<option value="' . $rows[$i]["id"] . '">' . $rows[$i]["theme_name"] . '</option>';
	
    $html .= '</select>';

    return $html;

}

function CreateCourseForm($course_id = 0, $where = 'create'){
		
	$course_theme_id = 0;
	$course_name 	 = '';
	
	$return_string  = '';
	
	$display = 'block';
	
	if($where == 'create')
		$display = 'none';

	
	if($course_id != 0){
		
		$query = "SELECT course_theme_id, course_name
				  FROM courses 
				  WHERE id = $course_id";
		
		$rows = QuerySelect($query);
		
		if($rows)
			if(count($rows) > 0){
				$course_theme_id = intval($rows[0]['course_theme_id']);
				$course_name 	 = $rows[0]['course_name'];
			}
	}
	

	$return_string  .= '<div class="col-md-7 col-sm-12 border-style" id="' . $where . '_course_form_' . $course_id . '" 
							 style="display:' . $display . '; margin-bottom:20px;">';
    $return_string  .= '    <form class="user p-3 " class="bg-gray-100" onsubmit="return false">';

    $return_string  .= '        <div class="form-group">';
    $return_string  .= '            <label for="text" class="text-gray-800">Course Section:</label>';
    $return_string  .= 				GetCourseSectionCombobox($course_theme_id, $course_id);
    $return_string  .= '        </div>';

    $return_string  .= '        <div class="form-group">';
    $return_string  .= '            <label for="text" class="text-gray-800">Course Name:</label>';
    $return_string  .= '            <input type="text" class="form-control" id="course_name_txt_' . $course_id . '" 
    									autocomplete="off" placeholder="Course Name" value="' . $course_name . '">';
    $return_string  .= '        </div>';
    
    $return_string  .= '        <div class="bd-example">';
    $return_string  .= '            <button class="btn btn-success" type="button" 
    										onClick="SaveCourseRow(' . $course_id . ')">Save</button>';
    $return_string  .= '            <button class="btn btn-danger" type="button" 
    										onClick="ShowEditForm(' . $course_id . ', \'course\')">Cancel</button>';
    $return_string  .= '        </div>';

    $return_string  .= '    </form>';
    $return_string  .= '</div>';

	
	return $return_string;
}



function GetNewRowCoursesTable($rows){
	
	$return_string = '';

	$return_string .= '<tr id="table_row_course_' . $rows['id'] . '">';
	$return_string .= '		<td>' . $rows['theme_name'] . '</td>'; 
	$return_string .= '		<td>' . $rows['course_name'] . '</td>'; 

	$return_string .= '		<td>' . GetCourseOrderCombobox($rows['id'], $rows['course_theme_id'], $rows['number_of_courses'], $rows['order_number']) . '</td>'; 
	$return_string .= '		<td>' . ChangeDateFormatPublicAmerican($rows['created_at']) . '</td>';
	$return_string .= '		<td>' . ChangeDateFormatPublicAmerican($rows['updated_at']) . '</td>';
	$return_string .= '		<td><a href="./edit_pages/edit_course.php?cuid=' . $rows['unique_id'] . '" target="_blank">Edit Content</a></td>'; 
	$return_string .= '		<td><button type="button" class="btn btn-primary" onClick="ShowEditForm(' . $rows['id'] . ', \'course\')">EDIT</button></td>';
	$return_string .= '		<td>' . GetCourseStatusCombobox($rows['id'], $rows['course_status']) . '</td>'; 
	$return_string .= '</tr>';

	$return_string .= '<tr class="spanedit" id="edit_course_row_' . $rows['id'] . '" style="display:none">';
	$return_string .= '		<td colspan="6">' . CreateCourseForm($rows['id'], 'edit') . '</td>';
	$return_string .= '</tr>';
	
	return $return_string;
}


function GetCoursesRowsFromDB($course_section_id){

	$query = "SELECT c.id, unique_id, course_theme_id, course_name, course_text, order_number, number_of_courses, 
					 DATE(created_at) AS created_at, DATE(updated_at) AS updated_at, theme_name, course_status
			  FROM courses c, course_themes ct
			  WHERE course_theme_id = $course_section_id AND course_theme_id = ct.id
			  ORDER BY order_number";
	
	$rows = QuerySelect($query);
		
	return $rows;
}



function GetCoursesTable($course_section_id){
		
	$rows = GetCoursesRowsFromDB($course_section_id);
	
	$return_string = '';
			
	$return_string .= '<table class="table" id="courses_table">';
	$return_string .= '    <thead>';
	$return_string .= '        <tr>';
	$return_string .= '            <th scope="col">Course Section</th>';
	$return_string .= '            <th scope="col">Course Name</th>';
	$return_string .= '            <th scope="col" style="width:100px">Order</th>';
	$return_string .= '            <th scope="col">Date Created</th>';
	$return_string .= '            <th scope="col">Date Updated</th>';
	$return_string .= '            <th scope="col">Edit</th>';
	$return_string .= '            <th scope="col">Edit Content</th>';
	$return_string .= '            <th scope="col">Status</th>';
	$return_string .= '        </tr>';
	$return_string .= '    </thead>';
	$return_string .= '    <tbody  id="course_table_body">';

	for($i = 0; $i < count($rows);  $i++)
		$return_string .= GetNewRowCoursesTable($rows[$i], false);

	$return_string .= '    </tbody>';
	$return_string .= '</table>';
	
	return $return_string;
}

function GetCourseSectionsDB(){

   	$query = "SELECT id, theme_name
			  FROM course_themes
			  ORDER BY theme_name ASC";

	$rows = QuerySelect($query);

	return $rows;

}




function GetCourseSectionCombobox($section_id, $course_id){
   	
   	$rows = GetCourseSectionsDB();

	$html = '<select class="form-control" id="course_section_combo_' . $course_id . '">';
	
	$html .= '<option value="0">Select Section</option>';

	for($i = 0; $i < count($rows); $i++)
		if($rows[$i]["id"] == $section_id)
			$html .= '<option value="' . $rows[$i]["id"] . '" selected>' . $rows[$i]["theme_name"] . '</option>';
		else
			$html .= '<option value="' . $rows[$i]["id"] . '">' . $rows[$i]["theme_name"] . '</option>';
	
    $html .= '</select>';

    return $html;
}





function GetCourseOrderCombobox($course_id, $section_id, $number_of_courses, $order_number){

	$html = '<select class="form-control" id="courses_order_combo_' . $course_id . '" 
					 onchange="ChangeCourseOrder(' . $course_id . ', ' . $section_id . ')">';

	
	for($i = 1; $i <= $number_of_courses; $i++)
		if($order_number == $i)
			$html .= '<option value="' . $i . '" selected>' . $i . '</option>';
		else
			$html .= '<option value="' . $i . '">' . $i . '</option>';
	
	
    $html .= '</select>';

    return $html;
}



function GetCourseStatusCombobox($course_id, $status){

	$html = '<select class="form-control" id="courses_status_combo_' . $course_id . '" 
					 onchange="ChangeCourseStatus(' . $course_id . ')">';

	
	if($status == "Active"){
		$html .= '<option value="Active" selected>Active</option>';
		$html .= '<option value="Inactive">Inactive</option>';
	}else{
		$html .= '<option value="Active">Active</option>';
		$html .= '<option value="Inactive" selected>Inactive</option>';
	}

	
    $html .= '</select>';

    return $html;
}


?>