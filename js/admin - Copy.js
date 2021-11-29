// JavaScript Document

function verifyEmail(e){
	
	var status = false;     
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	
	if (e.search(emailRegEx) != -1)          
		status = true;
	
	return status;
}

function EditPage(site_page){

	var win = window.open('edit_pages/' + site_page, '_blank');
  	win.focus();
}

function PoUpMessageSuccess(message){
	
	$("#popup_modal_message_success_admin").html(message);
    document.getElementById("popup_modal_button_success_admin").click()
}

function PoUpMessage(message){
	
	$("#popup_modal_message_error_admin").html(message);
    document.getElementById("popup_modal_button_error_admin").click()
}



function CheckForDuplicate(array, pom){
	
	for(i = 0; i < array.length; i++)
		if(array[i] == pom)
			return true;
	
	return false;
}




function ApplyFilters(section){

	date_from = $("#" + section + "_date_from").val()
	date_to   = $("#" + section + "_date_to").val()

	switch(section) {
		case "dashboard":
			UpdateDashboard();
			break;
		case "ddd":
			// code block
			break;
		default:
			column = "";
			search = "";

			search = $("#" + section + "_search_value").val()

			if($("#" + section + "_search_field").length)
				column = $("#" + section + "_search_field").val();
			
			if(search != "" && column == ""){
				PoUpMessage('Choose column');
				return false;
			}

			if(search == "")
				column == "";

			$.get( "./includes/get_new_data.php", {s: section, df: date_from, dt: date_to, wf: column, wv: search}, function(data) {
		        if(data == 3)
		            PoUpMessage('Invalid arguments');
				else if(data == 1)
		            PoUpMessage('You are not logged in');
		        else{
		            $("#" + section + "_table_div").html(data)

		        }
		    });	

	}

}



function SaveEditPageRow(edit_page_id){
	
	title = $("#page_title_txt_" + edit_page_id).val()
	name  = $("#page_name_txt_"  + edit_page_id).val()

	$.post( "./save/save_site_page.php", {t: title, n: name, epid: edit_page_id}, function(data) {
        if(data == 3)
            PoUpMessage('Invalid arguments');
        else if(data == 2)
            PoUpMessage('Database error');
		else if(data == 1)
            PoUpMessage('You are not logged in');
        else if(data == 4)
            PoUpMessage('Database error');
        else{
        	elements = data.split('<!--a-->');
			if(elements.length > 1){		
				$("#table_row_edit_page_" + edit_page_id).html(elements[0]);					
				$("#edit_edit_page_row_"  + edit_page_id).html(elements[1]);
				$("#edit_edit_page_row_"  + edit_page_id).hide()
			}
        }
    });		
}


function SendEmail(unique_id, section, email){

	subject = $("#email_subject_" + section + "_" + unique_id).val()
	message = $("#email_message_" + section + "_" + unique_id).val()

	has_error = false;
	
	if(subject == ""){
		PoUpMessage('Enter Email Subject!');
		has_error = true;
	}
	
	if(message == ""){
		PoUpMessage('Enter Email Message!');
		has_error = true;
	}
	
	message = message.replace(/(?:\r\n|\r|\n)/g, '<br>');
	
	if(!has_error)
		$.post("./send_email.php", {s: subject, m: message, e:email}, function(data) {			
				if(data == 2){
					
					PoUpMessageSuccess("The Email was successfully sent!");
					$('#' + section + "_email_row_" + unique_id).hide()
					
				}else{
					PoUpMessage(data);
				}	
			});	
	
}

function SaveEditPage(page_id){

	jsonObj = [];

	$('input[name="edit_page_values"]').each(function(){
	        
	        id = $(this).attr('id')
	        id = id.replace("page_text_value_", "")
	        value = $(this).val();

	        item = {}
        	item ["id"] = id;
        	item ["value"] = value;

        	jsonObj.push(item);
	});

	$('textarea[name="edit_page_values"]').each(function(){
	        
	        id = $(this).attr('id')
	        id = id.replace("page_text_value_", "")
	        value = $(this).val().replace(/\n/g, '<br />');

	        item = {}
        	item ["id"] = id;
        	item ["value"] = value;

        	jsonObj.push(item);
	});

	$.post( "./save/save_page_values.php", {j: jsonObj, pid: page_id}, function(data) {
        if(data == 3)
            PopUpMessage('Invalid arguments');
        else if(data == 2)
            PopUpMessageSuccess('Successfully updated data');
		else if(data == 1)
            PopUpMessage('You are not logged in');
        else{
        	console.log(data)
        }
    });
}


	
function ChangeSideMenu(id_name){
	
	side_menu_elements = document.getElementsByClassName('admin_side_menu');

	for(i = 0; i < side_menu_elements.length; i++){
		
		if(side_menu_elements[i].id == 'side_menu_' + id_name){
			side_menu_elements[i].className = 'active admin_side_menu nav-item';
						
			document.getElementById('content_' + id_name).style.display = 'block';
		}
		else{
			side_menu_elements[i].className = 'admin_side_menu  nav-item';
			content_ids = side_menu_elements[i].id.split('side_menu_')
			content_id = 'content_'+content_ids[1];
			document.getElementById(content_id).style.display = 'none';
		}			
	}
}


function ShowEditForm(element_id, type, element_unique_id){
	
	id_pom = 'create_' + type + '_form_';
	display = 'block';
	
	if(element_id > 0){	
		id_pom = 'edit_' + type + '_row_';
		display = 'table-row';		
	}
		
	display_val = document.getElementById(id_pom + element_id).style.display
	
	if(display_val == 'none')		
		document.getElementById(id_pom + element_id).style.display = display;
	else
		document.getElementById(id_pom + element_id).style.display = 'none';	
}


function DeleteRow(id, section){


	$.post( "./delete_row.php", {id: id, s: section}, function(data) {
        if(data == 3)
            PoUpMessage('Invalid arguments');
        else if(data == 2)
            PoUpMessageSuccess('Successfully updated data');
		else if(data == 1)
            PoUpMessage('You are not logged in');
        else{
        	console.log(data)
        }
    });		

}

function SelectCourseSection(){

	course_section_id = $("#select_course_section").val()

	$.post( "./get_courses_table.php", {csid: course_section_id}, function(data) {
        if(data == 3)
            PoUpMessage('Invalid arguments.');
		else if(data == 1)
            PoUpMessage('You are not logged in.');
        else
        	$("#course_table_div").html(data)
        
    });		
}

function SaveCourseSectionRow(course_section_id){

	section_name = $("#course_section_name_txt_" + course_section_id).val()

	if(section_name == "")
        PoUpMessage('Enter Course Section Name');
    else
		$.post( "./save/save_course_section.php", {csid: course_section_id, csn: section_name}, function(data) {
	        if(data == 3)
	            PoUpMessage('Invalid arguments.');
	        else if(data == 2)
	            PoUpMessage('Something went wrong. Try again.');
			else if(data == 1)
	            PoUpMessage('You are not logged in.');
	        else{
	        	$("#course_sections_table_div").html(data)
	        	PoUpMessageSuccess("Section was successfully saved.")
	        	$("#create_course_section_form_0").hide()
				$("#course_section_name_txt_0").val("")
	        }
	    });		
}


function SaveCourseRow(course_id){

	course_name = $("#course_name_txt_" + course_id).val()
	section_id  = $("#course_section_combo_" + course_id).val()

	if(course_name == "")
        PoUpMessage('Enter Course Name');
    else if(section_id == 0)
        PoUpMessage('Select Course Section');
    else
		$.post( "./save/save_course.php", {csid: section_id, csn: course_name, cid: course_id}, function(data) {
	        if(data == 3)
	            PoUpMessage('Invalid arguments.');
	        else if(data == 2)
	            PoUpMessage('Something went wrong. Try again.');
			else if(data == 1)
	            PoUpMessage('You are not logged in.');
	        else{
	        	$("#course_table_div").html(data)
	        	PoUpMessageSuccess("Course was successfully saved.")
	        	$("#create_course_form_0").hide()
				$("#course_name_txt_0").val("")
	 			$("#select_course_section").val(section_id)

	        }
	    });		
}


function SaveCourseText(course_id){

	course_text = tinymce.get("course_text").getContent();

	$.post( "./save/save_course_text.php", {cid: course_id, ct: course_text}, function(data) {
        if(data == 3)
            PopUpMessage('Invalid arguments.');
        else if(data == 2)
            PopUpMessage('Something went wrong. Try again.');
		else if(data == 1)
            PopUpMessage('You are not logged in.');
        else if(data == 4)
            PopUpMessageSuccess('Your changes was successfully saved');
        
    });	

}

function limitIntegerReal(limitField, zero) {
	
	if(zero == 1){
		if(limitField.value != 0)	
			limitField.value = limitField.value.replace(/[^\d.]/g, "").replace('-','').replace(/^[0]+/g,"").replace('.','');
	}else
		limitField.value = limitField.value.replace(/[^\d.]/g, "").replace('-','').replace(/^[0]+/g,"").replace('.','');

}




