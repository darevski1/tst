
function verifyEmail(e) {

	var status = false;
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;

	if (e.search(emailRegEx) != -1)
		status = true;

	return status;
}

function limitIntegerReal(limitField, zero) {

	if (zero == 1) {
		if (limitField.value != 0)
			limitField.value = limitField.value.replace(/[^\d.]/g, "").replace('-', '').replace(/^[0]+/g, "").replace('.', '');
	} else
		limitField.value = limitField.value.replace(/[^\d.]/g, "").replace('-', '').replace(/^[0]+/g, "").replace('.', '');
}



function PoUpMessageSuccess(message) {

	$("#dialog_success").html(message);
	$("#dialog_success").dialog();
}


function PoUpMessage(message) {

	$("#dialog").html(message);
	$("#dialog").dialog();
}



function LoginCheck() {

	var errorMessage = ''
	var errorMessage2 = ""

	var password = $('#password').val()
	var email = $('#email').val()

	$("#error_message").hide()

	if (email == '')
		errorMessage2 += "-Email<br />"
	else if (!verifyEmail(email) && email != "")
		errorMessage += "-Your email address is not valid! <br />"


	if (password == '')
		errorMessage2 += "-Password<br />"

	if (errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">Please correct the following errors:</p>' + errorMessage;


	if (errorMessage2 != "")
		if (errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;

	if (errorMessage != "") {
		$("#error_message").show()
		$("#error_message").html(errorMessage)
		return false;
	}

	return true;
}




function SaveUserDetails() {

	var errorMessage = ""

	var phone = $('#phone').val();
	var first_name = $('#first_name').val();
	var last_name = $('#last_name').val();

	$("#error_message").hide()

	if (last_name == '')
		errorMessage += "-Last Name<br />"

	if (first_name == '')
		errorMessage += "-First Name<br />"


	if (errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage;

	if (errorMessage != "") {
		$("#error_message").show()
		$("#error_message").html(errorMessage)
	} else {
		$.post("./save/save_user_details.php", { pn: phone, fn: first_name, ln: last_name }, function (data) {

			if (data == 1) {
				$("#error_message").html('You are not logged in');
				$("#error_message").show()
			} else if (data == 4) {
				$("#error_message").html('Missing arguments');
				$("#error_message").show()
			}
			else if (data == 3) {
				$("#navbarDropdownMenuLink").html(first_name);
			} else {
				$("#error_message").html('Something went wrong');
				$("#error_message").show()
			}
		});
	}
}

function ShortSides(side) {

	short_side = "";

}

function GetReport() {

	// property_condition basement_condition name email phone autocomplete

	var errorMessage = ""
	var errorMessage2 = ""

	var phone = $('#phone').val();
	var name = $('#name').val();
	var email = $('#email').val();
	var address = $('#autocomplete').val();
	var basement_condition = $('#basement_condition').val();
	var property_condition = $('#property_condition').val();

	$("#error_message").hide()

	if (address == '')
		errorMessage2 += "-Address<br />"

	if (name == '')
		errorMessage2 += "-Name<br />"

	if (email == '')
		errorMessage2 += "-Email<br />"
	else if (!verifyEmail(email) && email != "")
		errorMessage += "-Your email address is not valid! <br />"


	if (basement_condition == null)
		errorMessage += "-Choose basement condition<br />"

	if (property_condition == null)
		errorMessage += "-Choose property condition<br />"



	if (errorMessage2 != "")
		if (errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;


	if (errorMessage != "") {
		$("#error_message").show()
		$("#error_message").html(errorMessage)
	} else {
		$.post("./save/save_address_search.php", { a: address, p: phone, n: name, e: email, bc: basement_condition, pc: property_condition }, function (data) {

			if (data == 1) {
				$("#error_message").html('You are not logged in');
				$("#error_message").show()
			} else if (data == 4) {
				$("#error_message").html('Missing arguments');
				$("#error_message").show()
			} else if (data == 2) {
				$("#error_message").html('Something went wrong');
				$("#error_message").show()
			} else {
				// console.log(data)
				window.location.replace("../report?suid=" + data);
			}
		});
	}
}











function GetReportRealtor() {

	var errorMessage = ""
	var errorMessage2 = ""

	var phone = $('#phone').val();
	var name = $('#name').val();
	var email = $('#email').val();
	var address = $('#autocomplete').val();
	var basement_condition = $('#basement_condition').val();
	var property_condition = $('#property_condition').val();

	$("#error_message").hide()

	if (address == '')
		errorMessage2 += "-Address<br />"

	if (name == '')
		errorMessage2 += "-Name<br />"

	if (email == '')
		errorMessage2 += "-Email<br />"
	else if (!verifyEmail(email) && email != "")
		errorMessage += "-Your email address is not valid! <br />"


	if (basement_condition == null)
		errorMessage += "-Choose basement condition<br />"

	if (property_condition == null)
		errorMessage += "-Choose property condition<br />"



	if (errorMessage2 != "")
		if (errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;


	if (errorMessage != "") {
		$("#error_message").show()
		$("#error_message").html(errorMessage)
	} else {
		$.post("./save/save_address_search.php", { a: address, p: phone, n: name, e: email, bc: basement_condition, pc: property_condition }, function (data) {

			if (data == 1) {
				$("#error_message").html('You are not logged in');
				$("#error_message").show()
			} else if (data == 4) {
				$("#error_message").html('Missing arguments');
				$("#error_message").show()
			} else if (data == 2) {
				$("#error_message").html('Something went wrong');
				$("#error_message").show()
			} else {
				// console.log(data)
				window.location.replace("../report-realtor?suid=" + data);
			}
		});
	}
}








function GetReportZillow() {

	var errorMessage = ""
	var errorMessage2 = ""

	var phone = $('#phone').val();
	var name = $('#name').val();
	var email = $('#email').val();
	var address = $('#autocomplete').val();
	var basement_condition = $('#basement_condition').val();
	var property_condition = $('#property_condition').val();

	$("#error_message").hide()

	if (address == '')
		errorMessage2 += "-Address<br />"

	if (name == '')
		errorMessage2 += "-Name<br />"

	if (email == '')
		errorMessage2 += "-Email<br />"
	else if (!verifyEmail(email) && email != "")
		errorMessage += "-Your email address is not valid! <br />"


	if (basement_condition == null)
		errorMessage += "-Choose basement condition<br />"

	if (property_condition == null)
		errorMessage += "-Choose property condition<br />"



	if (errorMessage2 != "")
		if (errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;


	if (errorMessage != "") {
		$("#error_message").show()
		$("#error_message").html(errorMessage)
	} else {
		$.post("./save/save_address_search.php", { a: address, p: phone, n: name, e: email, bc: basement_condition, pc: property_condition }, function (data) {

			if (data == 1) {
				$("#error_message").html('You are not logged in');
				$("#error_message").show()
			} else if (data == 4) {
				$("#error_message").html('Missing arguments');
				$("#error_message").show()
			} else if (data == 2) {
				$("#error_message").html('Something went wrong');
				$("#error_message").show()
			} else {
				// console.log(data)
				window.location.replace("../report-zillow?suid=" + data);
			}
		});
	}
}











function ForgotPassword() {

	var errorMessage = ''
	var errorMessage2 = ""

	var email = $('#email').val()

	$("#error_message").hide()

	if (email == '')
		errorMessage2 += "-Email<br />"
	else if (!verifyEmail(email) && email != "")
		errorMessage += "-Your email address is not valid! <br />"

	if (errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">Please correct the following errors:</p>' + errorMessage;


	if (errorMessage2 != "")
		if (errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;

	if (errorMessage != "") {
		$("#error_message").show()
		$("#error_message").html(errorMessage)
		return false;
	}

	$.post("./forgot_password.php", { buid: board_unique_id }, function (data) {

		if (data == 1)
			PoUpMessage('You are not logged in')
		else if (data == 4)
			PoUpMessage('Missing arguments')
		else if (data == 2)
			PoUpMessage('Board does not exist')
		else if (data == 5) {
			PoUpMessage('You are already member of this board')
			$('#join_' + board_unique_id).hide()
			$('#go_to_board_' + board_unique_id).show()
		}
		else if (data == 3) {
			PoUpMessageSuccess("You have successfully joined the board");
			$('#join_' + board_unique_id).hide()
			$('#go_to_board_' + board_unique_id).show()
		} else
			PoUpMessage('Something went wrong')

	});

}

function RegisterCheck() {

	var errorMessage = ''	// dropdown
	var errorMessage2 = ""	// input

	var first_name = $('#first_name').val()
	var last_name = $('#last_name').val()
	var street_adress = $('#street_adress').val()
	var city = $('#city').val()
	var country = $('#country').val()
	var state = $('#state').val()
	var zip_code = $('#zip_code').val()
	var birth_month = $('#birth_month').val()
	var birth_day = $('#birth_day').val()
	var birth_year = $('#birth_year').val()
	var hours_need = $('#hours_need').val()
	var reason = $('#reason').val()
	var email = $('#email').val()
	var password = $('#password').val()



	$("#error_message").hide()

	if (email == '')
		errorMessage2 += "-Email<br />"
	else if (!verifyEmail(email) && email != "")
		errorMessage += "-Your email address is not valid! <br />"

	if (first_name < 1)
		errorMessage += "-First name<br />"

	if (last_name == '')
		errorMessage2 += "-Last name<br />"

	if (street_adress == '')
		errorMessage2 += "-Street adress<br />"

	if (city == '')
		errorMessage2 += "-City<br />"

	if (country == '')
		errorMessage += "-Country<br />"

	if (state == '')
		errorMessage += "-State<br />"

	if (zip_code == '')
		errorMessages += "-Zip code<br />"

	if (birth_month == '')
		errorMessages += "-Birthday month<br />"

	if (birth_day == '')
		errorMessages += "-Birthday day<br />"

	if (birth_year == '')
		errorMessages += "-Birthday year<br />"

	if (hours_need == '')
		errorMessages2 += "-Hours need<br />"

	if (reason == '')
		errorMessages2 += "-Reason<br />"

	if (password == '')
		errorMessage2 += "-Password<br />"
	else if (confirm_pass == '')
		errorMessage2 += "-Retype Password<br />"
	else if (password != confirm_pass)
		errorMessage += "-The passwords do not match<br />";


	if (errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">Please correct the following errors:</p>' + errorMessage;


	if (errorMessage2 != "")
		if (errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;

	if (errorMessage != "") {
		$("#error_message").show()
		$("#error_message").html(errorMessage)
		return false;
	}

	return true;
}

function FinishProfileCheck() {

	var errorMessage = ''
	var errorMessage2 = ""

	var password = $('#password').val()
	var confirm_pass = $('#confirm_pass').val()
	var user_type = $('#user_type').val()

	$("#error_message").hide()

	if (user_type < 1)
		errorMessage += "-You have to select user type<br />"


	if (password == '')
		errorMessage2 += "-Password<br />"
	else if (confirm_pass == '')
		errorMessage2 += "-Retype Password<br />"
	else if (password != confirm_pass)
		errorMessage += "-The passwords do not match<br />";


	if (errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">Please correct the following errors:</p>' + errorMessage;


	if (errorMessage2 != "")
		if (errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;

	if (errorMessage != "") {
		$("#error_message").show()
		$("#error_message").html(errorMessage)
		return false;
	}

	return true;
}


function ForgotCheck() {

	var errorMessage = ''
	var errorMessage2 = ""

	var email = $('#txt_email').val()

	$("#error_message").hide()

	if (email == '')
		errorMessage2 += "-Email<br />"
	else if (!verifyEmail(email) && email != "")
		errorMessage += "-Your email address is not valid! <br />"


	if (errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">Please correct the following errors:</p>' + errorMessage;


	if (errorMessage2 != "")
		if (errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;

	if (errorMessage != "") {
		$("#error_message").show()
		$("#error_message").html(errorMessage)
		return false;
	}

	return true;
}



function ResetPasswordCheck() {

	var errorMessage = ''
	var errorMessage2 = ""

	var password = $('#password').val()
	var confirm_pass = $('#confirm_password').val()

	$("#error_message").hide()

	if (password == '')
		errorMessage2 += "-Password<br />"
	else if (confirm_pass == '')
		errorMessage2 += "-Confirmation Password<br />"
	else if (password != confirm_pass)
		errorMessage += "-The passwords do not match<br />";


	if (errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">Please correct the following errors:</p>' + errorMessage;


	if (errorMessage2 != "")
		if (errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;

	if (errorMessage != "") {
		$("#error_message").show()
		$("#error_message").html(errorMessage)
		return false;
	}

	return true;
}


function ChangePasswordCheck() {

	var errorMessage = ''
	var errorMessage2 = ""

	var old_password = $('#old_password').val()
	var new_password = $('#new_password').val()
	var confirm_pass = $('#confirm_password').val()

	$("#error_message_password").hide()

	if (old_password == '')
		errorMessage2 += "-Old Password<br />"

	if (new_password == '')
		errorMessage2 += "-New Password<br />"
	else if (confirm_pass == '')
		errorMessage2 += "-Confirmation Password<br />"
	else if (new_password != confirm_pass)
		errorMessage += "-The passwords do not match<br />";


	if (errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">Please correct the following errors:</p>' + errorMessage;


	if (errorMessage2 != "")
		if (errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;

	if (errorMessage != "") {
		$("#error_message_password").show()
		$("#error_message_password").html(errorMessage)
		return false;
	}

	return true;
}


function RegisterUserAPI(registered_from, username, email) {

	$.post("./register_user_api.php", { rf: registered_from, u: username, e: email }, function (data) {

		if (data == 1) {
			window.location.replace("../profile");
		} else if (data == 4) {
			$("#error_message").html('Missing arguments');
			$("#error_message").show()
		}
		else if (data == 3) {
			window.location.replace("../profile");
		} else {
			$("#error_message").html('Something went wrong');
			$("#error_message").show()
		}
	});
}




$(document).ready(function () {
	$("#dropdown02").onclick(function () {
		alert("boo")
	})
})