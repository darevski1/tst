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
	
	$("#dialog_success").html(message);
	$("#dialog_success").dialog();
	
	setTimeout(function(){
        $('#dialog_success').dialog('close');                
    }, 5000);
}

function PoUpMessage(message){
	
	$("#dialog").html(message);
	$("#dialog").dialog();
		
	setTimeout(function(){
        $('#dialog').dialog('close');                
    }, 5000);
}

function CheckForDuplicate(array, pom){
	
	for(i = 0; i < array.length; i++)
		if(array[i] == pom)
			return true;
	
	return false;
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





function limitIntegerReal(limitField, zero) {
	
	if(zero == 1){
		if(limitField.value != 0)	
			limitField.value = limitField.value.replace(/[^\d.]/g, "").replace('-','').replace(/^[0]+/g,"").replace('.','');
	}else
		limitField.value = limitField.value.replace(/[^\d.]/g, "").replace('-','').replace(/^[0]+/g,"").replace('.','');	
}




