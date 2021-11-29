// JavaScript Document

function verifyEmail(e) {

	var status = false;
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;

	if (e.search(emailRegEx) != -1)
		status = true;

	return status;
}

function conss(variable) {
	console.log(variable)
}

function EditPage(site_page) {

	var win = window.open('edit_pages/' + site_page, '_blank');
	win.focus();
}

function PoUpMessageSuccess(message) {

	$("#popup_modal_message_success_admin").html(message);
	document.getElementById("popup_modal_button_success_admin").click()
}

function PoUpMessage(message) {

	$("#popup_modal_message_error_admin").html(message);
	document.getElementById("popup_modal_button_error_admin").click()
}

function SendEventEmailToAll(event_id) {

	subject = $("#event_email_subject").val()
	message = $("#event_email_message").val()

	has_error = false;

	if (subject == "") {
		PoUpMessage('Enter Email Subject!');
		has_error = true;
	}

	if (message == "") {
		PoUpMessage('Enter Email Message!');
		has_error = true;
	}

	message = message.replace(/(?:\r\n|\r|\n)/g, '<br>');

	if (!has_error)
		$.post("./send_event_emails.php", { id: event_id, s: subject, m: message }, function (data) {

			if (data == 3)
				PoUpMessage('Invalid arguments');
			else if (data == 2)
				PoUpMessage('Database error');
			else if (data == 1)
				PoUpMessage('You are not logged in');
			else if (data == 4)
				PoUpMessage('Database error');
			else {

				PoUpMessageSuccess('The email is sent to all users from this event.');
				$('#send_email_to_all_div').hide()
			}
		});

}


function ChangeCourseOrder(course_id, course_section_id) {

	order_number = $("#courses_order_combo_" + course_id).val()

	$.post("./change_course_order.php", { cid: course_id, csid: course_section_id, on: order_number }, function (data) {

		if (data == 3)
			PoUpMessage('Invalid arguments');
		else if (data == 2)
			PoUpMessage('Database error');
		else if (data == 1)
			PoUpMessage('You are not logged in');
		else {

			$('#course_table_div').html(data)
		}
	});

}



function ChangeCourseStatus(course_id) {
	console.log("ChangeCourseStatus")
	course_status = $("#courses_status_combo_" + course_id).val()

	$.post("./change_course_status.php", { cid: course_id, cs: course_status }, function (data) {

		if (data == 3)
			PoUpMessage('Invalid arguments');
		else if (data == 2)
			PoUpMessage('Database error');
		else if (data == 1)
			PoUpMessage('You are not logged in');
		else if (data == 4) {

		}
		else
			PoUpMessage('Something went wrong');

	});

}
function ChangeDonationStatus(donation_id) {

	donation_status = $("#donation_status_combo_" + donation_id).val()

	$.post("./change_donation_status.php", { did: donation_id, ds: donation_status }, function (data) {

		if (data == 3)
			PoUpMessage('Invalid arguments');
		else if (data == 2)
			PoUpMessage('Database error');
		else if (data == 1)
			PoUpMessage('You are not logged in');
		else if (data == 4) {

		}
		else
			PoUpMessage('Something went wrong');

	});

}

function CheckForDuplicate(array, pom) {

	for (i = 0; i < array.length; i++)
		if (array[i] == pom)
			return true;

	return false;
}



function SaveEditPageRow(edit_page_id) {

	title = $("#page_title_txt_" + edit_page_id).val()
	name = $("#page_name_txt_" + edit_page_id).val()

	$.post("./save/save_site_page.php", { t: title, n: name, epid: edit_page_id }, function (data) {
		if (data == 3)
			PoUpMessage('Invalid arguments');
		else if (data == 2)
			PoUpMessage('Database error');
		else if (data == 1)
			PoUpMessage('You are not logged in');
		else if (data == 4)
			PoUpMessage('Database error');
		else {
			elements = data.split('<!--a-->');
			if (elements.length > 1) {
				$("#table_row_edit_page_" + edit_page_id).html(elements[0]);
				$("#edit_edit_page_row_" + edit_page_id).html(elements[1]);
				$("#edit_edit_page_row_" + edit_page_id).hide()
			}
		}
	});
}


function SendEmail(unique_id, section, email) {

	subject = $("#email_subject_" + section + "_" + unique_id).val()
	message = $("#email_message_" + section + "_" + unique_id).val()

	has_error = false;

	if (subject == "") {
		PoUpMessage('Enter Email Subject!');
		has_error = true;
	}

	if (message == "") {
		PoUpMessage('Enter Email Message!');
		has_error = true;
	}

	message = message.replace(/(?:\r\n|\r|\n)/g, '<br>');

	if (!has_error)
		$.post("./send_email.php", { s: subject, m: message, e: email }, function (data) {
			if (data == 2) {

				PoUpMessageSuccess("The Email was successfully sent!");
				$('#' + section + "_email_row_" + unique_id).hide()

			} else {
				PoUpMessage(data);
			}
		});

}

function SaveEditPage(page_id) {

	jsonObj = [];

	$('input[name="edit_page_values"]').each(function () {

		id = $(this).attr('id')
		id = id.replace("page_text_value_", "")
		value = $(this).val();

		item = {}
		item["id"] = id;
		item["value"] = value;

		jsonObj.push(item);
	});

	$('textarea[name="edit_page_values"]').each(function () {

		id = $(this).attr('id')
		id = id.replace("page_text_value_", "")
		value = $(this).val().replace(/\n/g, '<br />');

		item = {}
		item["id"] = id;
		item["value"] = value;

		jsonObj.push(item);
	});

	$.post("./save_page_values.php", { j: jsonObj, pid: page_id }, function (data) {

		if (data == 3)
			PopUpMessage('Invalid arguments');
		else if (data == 2)
			PopUpMessageSuccess('Successfully updated data');
		else if (data == 1)
			PopUpMessage('You are not logged in');
		else {
			console.log(data)
		}
	});
}



function ChangeSideMenu(id_name) {

	side_menu_elements = document.getElementsByClassName('admin_side_menu');

	for (i = 0; i < side_menu_elements.length; i++) {

		if (side_menu_elements[i].id == 'side_menu_' + id_name) {
			side_menu_elements[i].className = 'active admin_side_menu nav-item';

			document.getElementById('content_' + id_name).style.display = 'block';
		}
		else {
			side_menu_elements[i].className = 'admin_side_menu  nav-item';
			content_ids = side_menu_elements[i].id.split('side_menu_')
			content_id = 'content_' + content_ids[1];
			document.getElementById(content_id).style.display = 'none';
		}
	}
}


function ShowEditForm(element_id, type, element_unique_id) {

	id_pom = 'create_' + type + '_form_';
	display = 'block';

	if (element_id > 0) {
		id_pom = 'edit_' + type + '_row_';
		display = 'table-row';
	}

	display_val = document.getElementById(id_pom + element_id).style.display

	if (display_val == 'none')
		document.getElementById(id_pom + element_id).style.display = display;
	else
		document.getElementById(id_pom + element_id).style.display = 'none';
}


function DeleteRow(id, section) {


	$.post("./delete_row.php", { id: id, s: section }, function (data) {
		if (data == 3)
			PoUpMessage('Invalid arguments');
		else if (data == 2)
			PoUpMessageSuccess('Successfully updated data');
		else if (data == 1)
			PoUpMessage('You are not logged in');
		else {
			console.log(data)
		}
	});

}

function SelectCourseSection() {

	course_section_id = $("#select_course_section").val()

	$.post("./get_courses_table.php", { csid: course_section_id }, function (data) {
		if (data == 3)
			PoUpMessage('Invalid arguments.');
		else if (data == 1)
			PoUpMessage('You are not logged in.');
		else
			$("#course_table_div").html(data)

	});
}

function SaveCourseSectionRow(course_section_id) {

	section_name = $("#course_section_name_txt_" + course_section_id).val()

	if (section_name == "")
		PoUpMessage('Enter Course Section Name');
	else
		$.post("./save/save_course_section.php", { csid: course_section_id, csn: section_name }, function (data) {
			if (data == 3)
				PoUpMessage('Invalid arguments.');
			else if (data == 2)
				PoUpMessage('Something went wrong. Try again.');
			else if (data == 1)
				PoUpMessage('You are not logged in.');
			else {
				$("#course_sections_table_div").html(data)
				PoUpMessageSuccess("Section was successfully saved.")
				$("#create_course_section_form_0").hide()
				$("#course_section_name_txt_0").val("")
			}
		});
}


function SaveCourseRow(course_id) {

	course_name = $("#course_name_txt_" + course_id).val()
	section_id = $("#course_section_combo_" + course_id).val()

	if (course_name == "")
		PoUpMessage('Enter Course Name');
	else if (section_id == 0)
		PoUpMessage('Select Course Section');
	else
		$.post("./save/save_course.php", { csid: section_id, csn: course_name, cid: course_id }, function (data) {
			if (data == 3)
				PoUpMessage('Invalid arguments.');
			else if (data == 2)
				PoUpMessage('Something went wrong. Try again.');
			else if (data == 1)
				PoUpMessage('You are not logged in.');
			else {
				$("#course_table_div").html(data)

				PoUpMessageSuccess("Course was successfully saved.")

				$("#create_course_form_0").hide()
				$("#course_name_txt_0").val("")
				$("#select_course_section").val(section_id)

			}
		});
}

function SaveDonation() {

	donation_name = $("#donation_name").val();
	
	if(donation_name == "")
		PoUpMessage('Enter Donataion Name');
	else
		$.post("./save/save_donation.php", { dn: donation_name }, function (data) {
			if (data == 3)
				PoUpMessage('Invalid arguments.');
			else if (data == 2)
				PoUpMessage('Something went wrong. Try again.');
			else if (data == 1)
				PoUpMessage('You are not logged in.');
			else {
				PoUpMessageSuccess("Donation was successfully created.")
				$("#donations_table_div").html(data)
			}
			
		});
}

function SaveStaticPage(static_page_id) {

	page_title = $("#static_page_title").val()
	page_content = $("#static_page_content").val()

	$.post("../save/save_static_page.php", { spid: static_page_id, pt: page_title, pc: page_content }, function (data) {
		if (data == 3)
			PopUpMessage('Invalid arguments.');
		else if (data == 2)
			PopUpMessage('Something went wrong. Try again.');
		else if (data == 1)
			PopUpMessage('You are not logged in.');
		else if (data == 4)
			PopUpMessageSuccess('Your changes was successfully saved');
	});
}

function SaveStaticPageRow(static_page_id) {

	page_name = $("#static_page_name_txt_" + static_page_id).val()

	if (page_name == "")
		PoUpMessage('Enter Page Name');
	else
		$.post("./save/save_static_page_row.php", { spid: static_page_id, pn: page_name }, function (data) {
			if (data == 3)
				PoUpMessage('Invalid arguments.');
			else if (data == 2)
				PoUpMessage('Something went wrong. Try again.');
			else if (data == 1)
				PoUpMessage('You are not logged in.');
			else {

				$("#static_page_table_div").html(data)

				PoUpMessageSuccess("Static Page <b>" + page_name + "</b> was successfully saved.")

				$("#create_static_page_form_0").hide()
				$("#static_page_name_txt_0").val("")
			}
		});
}


function ChangeStaticPageStatus(static_page_id) {

	page_status = $("#static_page_combo_" + static_page_id).val()

	$.post("./save/save_static_page_status.php", { spid: static_page_id, ps: page_status }, function (data) {
		if (data == 3)
			PoUpMessage('Invalid arguments.');
		else if (data == 2)
			PoUpMessage('Something went wrong. Try again.');
		else if (data == 1)
			PoUpMessage('You are not logged in.');
		else {

			PoUpMessageSuccess("Page Status was successfully saved.")
		}
	});

}


function SaveEvent(date, time) {

	status = $("#event_status").val()
	number_of_users = $("#event_number_of_users").val()
	title = $("#event_title").val()
	description = document.getElementById('event_description').value.replace(/\n/g, '<br />');
	price = $("#event_price").val()

	var errorMessage = ''
	var errorMessage2 = ""

	if (status == '')
		errorMessage += "-Select Status<br />"

	if (number_of_users == 0)
		errorMessage += "-Number of total users must be bigger than 0<br />"

	if (price == 0)
		errorMessage += "-Signup Price must be bigger than 0<br />"

	if (title == '')
		errorMessage2 += "-Event Title<br />"

	if (description == '')
		errorMessage2 += "-Event Description<br />"

	if (errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">Please correct the following errors:</p>' + errorMessage;


	if (errorMessage2 != "")
		if (errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;

	if (errorMessage != "")
		PoUpMessage(errorMessage);
	else
		$.post("./save/save_event_details.php", { s: status, nu: number_of_users, tt: title, dd: description, p: price, d: date, t: time }, function (data) {
			if (data == 3)
				PoUpMessage('Invalid arguments.');
			else if (data == 2)
				PoUpMessage('Something went wrong. Try again.');
			else if (data == 1)
				PoUpMessage('You are not logged in.');
			else {
				$("#schedule_table_div").html(data);
				document.getElementById("modal_close_button").click()
			}
		});


}

function SaveCourseText(course_id) {

	course_text = $("#course_text").val()

	$.post("./save_course_text.php", { cid: course_id, ct: course_text }, function (data) {
		if (data == 3)
			alert('Invalid arguments.');
		else if (data == 2)
			alert('Something went wrong. Try again.');
		else if (data == 1)
			alert('You are not logged in.');
		else if (data == 4)
			alert('Your changes was successfully saved');
	});
}

function SaveDonationText(donation_id) {

	donation_name = $("#donation_name").val()
	donation_text = $("#donation_text").val()

	$.post("./save_donation_text.php", { did: donation_id, dn: donation_name, dt: donation_text }, function (data) {
		if (data == 3)
			alert('Invalid arguments.');
		else if (data == 2)
			alert('Something went wrong. Try again.');
		else if (data == 1)
			alert('You are not logged in.');
		else if (data == 4)
			alert('Your changes was successfully saved');
	});
}

function SaveDocumentText(document_unique_id) {

	document_text = $("#document_text").val()

	$.post("../save_document.php", { duid: document_unique_id, dt: document_text }, function (data) {
		if (data == 3)
			alert('Invalid arguments.');
		else if (data == 2)
			alert('Something went wrong. Try again.');
		else if (data == 1)
			alert('You are not logged in.');
		else if (data == 4)
			alert('Your changes was successfully saved');
	});
}

function GenerateEventModalContent(date, time) {

	$.get("./get_event_modal_content.php", { d: date, t: time }, function (data) {
		if (data == 3)
			PoUpMessage('Invalid arguments.');
		else if (data == 1)
			PoUpMessage('You are not logged in.');
		else
			$("#event_modal_content").html(data)
	});
}

function GetScheduleEventTable(date_from) {

	$.get("./get_schedule_event_table.php", { df: date_from }, function (data) {
		if (data == 3)
			PoUpMessage('Invalid arguments.');
		else if (data == 1)
			PoUpMessage('You are not logged in.');
		else
			$("#schedule_table_div").html(data)
	});
}


function OpenEventDetails(date, time) {

	$.get("./get_event_details_table.php", { d: date, t: time }, function (data) {
		if (data == 3)
			PoUpMessage('Invalid arguments.');
		else if (data == 1)
			PoUpMessage('You are not logged in.');
		else {

			html_data = data.split("##%%$$#$#");

			$("#event_details_table_div").html(html_data[0]);
			$("#send_email_to_all_div").html(html_data[1]);
			$("#send_email_to_all_div").hide();
			document.getElementById('side_menu_event_details').click()
		}
	});

}


function limitIntegerReal(limitField, zero) {

	if (zero == 1) {
		if (limitField.value != 0)
			limitField.value = limitField.value.replace(/[^\d.]/g, "").replace('-', '').replace(/^[0]+/g, "").replace('.', '');
	} else
		limitField.value = limitField.value.replace(/[^\d.]/g, "").replace('-', '').replace(/^[0]+/g, "").replace('.', '');

}

function ChangeDonationStaticPage(donation_id){

	static_page_id = $("#donation_static_page_combo_" + donation_id).val()

	$.post("./change_donation_static_page.php", { did: donation_id, spid: static_page_id }, function (data) {

		if(data == 3)
			PoUpMessage('Invalid arguments.');
		else if (data == 1)
			PoUpMessage('You are not logged in.');
		else if (data == 2)
			PoUpMessage('Something went wrong. Try again');
		else{
			$("#donations_table_div").html(data);
		}
	});

}
