
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


function limitIntegerDollar(limitField, zero) {
	
	value = limitField.value.replaceAll(',', '');

	if(zero == 1){
		if(limitField.value != 0)	
			value = value.replace(/[^\d.]/g, "").replace('-','').replace(/^[0]+/g, "").replace('.','');
	}else
		value = value.replace(/[^\d.]/g, "").replace('-','').replace(/^[0]+/g, "").replace('.','');

	limitField.value = '$' + value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
}


$('input[name="donation_price"]').keypress(function (event) {
        return isNumberDecimal(event, this)
});

// THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
function isNumberDecimal(evt, element) {

    var charCode = (evt.which) ? evt.which : event.keyCode

    current_value = $(element).val();
    current_dot   = current_value.indexOf('.')

    if($(element).val() == "" && charCode == 48)
    	return false;

    console.log(current_dot)
    console.log(current_value.length)

    if(current_dot != -1 && current_value.length - current_dot > 2)
    	return false

    
    if (            
        (charCode != 46 || current_value.indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
        (charCode < 48 || charCode > 57))
        
        return false;
    
    return true;
}


function DonationCheck(donation_unique_id){

	donation_value = $("#donation_" + donation_unique_id).val();

	if(donation_value == "")
		return false;

}

$('#search_validate').keydown(function (e){
    if(e.keyCode == 13){

    	code = $('#search_validate').val();
    	// window.history.pushState({}, document.title, "/validate/?code=" + code)
        window.location.replace("/validate/?code=" + code);
        // window.location.replace("/lawyer/validate/?code=" + code);
    }
})

function LoginCheck() {

	var errorMessage = ''
	var errorMessage2 = ""

	var password = $('#password').val()
	var email 	 = $('#email').val()

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

	var errorMessage = ''	// dropdown
	var errorMessage2 = ""	// input

	var first_name 		= $('#first_name').val()
	var last_name 		= $('#last_name').val()
	var street_adress 	= $('#street_adress').val()
	var city 			= $('#city').val()
	var country_id 		= $('#country').val()
	var state_id 		= $('#state').val()
	var zip_code 		= $('#zip_code').val()
	var hours_need 		= $('#hours_need').val()
	var reason 			= $('#reason').val()
	var court_id 		= $('#court_id').val()
	var probation 		= $('#probation_officer').val()

	if(state_id == null)
		state_id = 0;

	if(country_id == null)
		country_id = 0;

	$("#error_message").hide()

	if (first_name < 1)
		errorMessage2 += "-First name <br />"

	if (last_name == '')
		errorMessage2 += "-Last name <br />"

	if (street_adress == '')
		errorMessage2 += "-Street adress <br />"

	if (city == '')
		errorMessage2 += "-City <br />"

	if (country_id == 0)
		errorMessage2 += "-Country <br />"

	if((country_id == 38 || country_id == 226) && state_id == 0)
		errorMessage2 += "-State <br />"

	if (zip_code == '')
		errorMessage2 += "-Zip code <br />"

	if (probation == '')
		errorMessage2 += "-Probation Officer <br />"

	if (court_id == '')
		errorMessage2 += "-Court ID/Docket Number <br />"

	if (hours_need == '')
		errorMessage2 += "-Hours need <br />"

	if (reason == '')
		errorMessage2 += "-Reason for doing Community Service <br />"

	if (errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">Please correct the following errors:</p>' + errorMessage;


	if (errorMessage2 != "")
		if (errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;

	if(errorMessage != "") {
		$("#error_message").show()
		$("#error_message").html(errorMessage)
	}else {

		$.post("./save/save_user_details.php", { sa: street_adress, fn: first_name, ln: last_name, city: city, coid: country_id, 
											zc: zip_code, po: probation, cid: court_id, hn: hours_need, r: reason, sid: state_id}, function (data) {

			if (data == 1) {
				$("#error_message").html('You are not logged in');
				$("#error_message").show()
			} else if (data == 4) {
				$("#error_message").html('Missing arguments');
				$("#error_message").show()
			}
			else if (data == 3) {
				
				$("#success_message").show().delay(6000).fadeOut(400)

				$("#reason_txt").html(reason)
				$("#first_name_txt").html(first_name)
				$("#last_name_txt").html(last_name)
				$("#street_adress_txt").html(street_adress)
				$("#city_txt").html(city)
				$("#zip_code_txt").html(zip_code)
				$("#hours_need_txt").html(hours_need)
				$("#court_id_txt").html(court_id)
				$("#probation_txt").html(probation)

				country = ""
				if(country_id > 0)
					country = $("#country option:selected").text();

				state = ""
				if(country_id > 0)
					state = $("#state option:selected").text();


				$("#country_txt").html(country)
				$("#state_txt").html(state)


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

state_id = 0;

function GetStates() {

	country_id = parseInt($("#country").val());


	if(country_id != 38 && country_id != 226){
		$("#state").html('<option value="0" disabled="" selected="">Select State/Province</option>');
		document.getElementById("state").disabled = true;
	}
	else{

		$.post("../get_states.php", { cid: country_id, sid: state_id}, function (data) {

			if(data == 4){
				$("#error_message").html('Missing arguments');
				$("#error_message").show();
			}else{
				document.getElementById("state").disabled = false;
				$("#state").html(data);
			}
		});
	}
}


function ContactUs(){

	var errorMessage = ''
	var errorMessage2 = ""	
			
    var name 	= $('#contact_name').val() 
    var email 	= $('#contact_email').val() 
	var subject = $('#contact_subject').val()
	var message = document.getElementById('contact_message').value.replace(/\n/g, '<br />');

    $("#contact_error_message").hide()
    $("#contact_success_message").hide()

    if(name=='')
		errorMessage2 += "-Name<br />"

    if(subject=='')
		errorMessage2 += "-Subject<br />"

    if(message=='')
		errorMessage2 += "-Message<br />"

	
	if(email=='')
		errorMessage2 += "-Email<br />"	
	else if(!verifyEmail(email) && email != "")
		errorMessage += "-Your email address is not valid! <br />"


	if(errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">Please correct the following errors:</p>' + errorMessage;
	
		
	if(errorMessage2 != "")
		if(errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else			
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
	

	if(errorMessage != ""){
		$("#contact_error_message").show();
		$("#contact_error_message").html(errorMessage)
		return false;
	}


	$.post("contact_us.php", {n: name, s: subject, m: message, e: email}, function(data) {			
			
		if(data == 4){
			$("#contact_error_message").html('Missing arguments');
			$("#contact_error_message").show()
		}	
		else if(data == 3){				
			$("#contact_success_message").html('Your message was successfully sent to us');
			$("#contact_success_message").show().show()(7000).fadeOut();
		}else{
			$("#contact_error_message").html('Something went wrong');
			$("#contact_error_message").show()
		}
	});
}


function RegisterCheck() {

	var errorMessage = ''	// dropdown
	var errorMessage2 = ""	// input

	var first_name 		= $('#first_name').val()
	var last_name 		= $('#last_name').val()
	var street_adress 	= $('#street_adress').val()
	var city 			= $('#city').val()
	var country_id 		= $('#country').val()
	var state_id 		= $('#state').val()
	var zip_code 		= $('#zip_code').val()
	var birth_month 	= $('#birth_month').val()
	var birth_day 		= $('#birth_day').val()
	var birth_year 		= $('#birth_year').val()
	// var hours_need 		= $('#hours_need').val()
	// var reason 			= $('#reason').val()
	var email 			= $('#email').val()
	var password 		= $('#password').val()
	var confirm_pass 	= $('#confirm_pass').val()
	// var court_id 		= $('#court_id').val()
	// var probation 		= $('#probation_officer').val()

	
	$("#error_message").hide()

	if (email == '')
		errorMessage2 += "-Email<br />"
	else if (!verifyEmail(email) && email != "")
		errorMessage += "-Your email address is not valid! <br />"

	if (first_name < 1)
		errorMessage2 += "-First name<br />"

	if (last_name == '')
		errorMessage2 += "-Last name<br />"

	if (street_adress == '')
		errorMessage2 += "-Street adress<br />"

	if (city == '')
		errorMessage2 += "-City<br />"

	if (country_id == null)
		errorMessage2 += "-Country<br />"

	if ($('input[name=gender]:checked').length > 0)
	    gender = $('input[name=gender]:checked').val()
	else
		errorMessage2 += "-Gender<br />"

	if((country_id == 38 || country_id == 226) && state_id == null)
		errorMessage2 += "-State<br />"

	if (zip_code == '')
		errorMessage2 += "-Zip code<br />"

	if (birth_month == '')
		errorMessage2 += "-Birthday month<br />"

	if (birth_day == '')
		errorMessage2 += "-Birthday day<br />"

	if (birth_year == '')
		errorMessage2 += "-Birthday year<br />"

	// if (probation == '')
	// 	errorMessage2 += "-Probation Officer<br />"

	// if (court_id == '')
	// 	errorMessage2 += "-Court ID/Docket Number<br />"


	// if (hours_need == '')
	// 	errorMessage2 += "-Hours need<br />"

	// if (reason == '')
	// 	errorMessage2 += "-Reason for doing Community Service<br />"

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


function ForgotPasswordCheck() {

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

	return true;
}



function ResetPasswordCheck() {

	var errorMessage = ''
	var errorMessage2 = ""

	var password 	 = $('#password').val()
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


function PopUpMessageSuccess(message){

	$("#popup_modal_message_success").html(message);
    document.getElementById("popup_modal_button_success").click()
}

function PopUpMessage(message){

	$("#popup_modal_message_error").html(message);
    document.getElementById("popup_modal_button_error").click()
}

course_active_time = 0

function GetCourse(course_unique_id){

	$.post("../get_course.php", { cuid: course_unique_id}, function (data) {

		if(data == 4)
			PopUpMessage('Missing arguments');
		else if(data == 1)
			PopUpMessage('You are not logged in');
		else if(data == 3)
			return false;
		else{

			json_data = JSON.parse(data);

			course_active_time = json_data.active_time;

			$("#course_text").html(json_data.course_text)
			$("#course_name").html(json_data.course_name)
			$("#course_timer").html(FromSecondsToTime(json_data.active_time))

		}
	});
}

function CheckLastCourse(){

	if(course_unique_id == "")
		document.getElementById("v_pills_courses_tab").click()
}

function GetMyCoursesData(){

	$.get("./get_my_courses_data.php", {}, function (data) {
		
		if(data == 1)
			PopUpMessage('You are not logged in');
		else{

			json_data = JSON.parse(data);

			$("#hours_paid_stat").html(FromSecondsToTime(json_data.hours_available))
			$("#remaining_hours_stat").html(FromSecondsToTime(json_data.hours_remaining))
			$("#number_of_courses_stat").html(json_data.number_of_courses)
			$("#my_courses_table").html(json_data.my_courses_table)
			$("#my_printed_documents_table").html(json_data.printed_table)
			$("#total_time_stat").html(FromSecondsToTime(json_data.total_time_seconds))
			// course_active_time = json_data.total_time_seconds

		}
	});
}

function GetMyCoursesDataMobile(){

	$.get("./get_my_courses_data_mobile.php", {}, function (data) {
		
		if(data == 1)
			PopUpMessage('You are not logged in');
		else{

			json_data = JSON.parse(data);

			$("#hours_paid_stat_mobile").html(FromSecondsToTime(json_data.hours_available))
			$("#remaining_hours_stat_mobile").html(FromSecondsToTime(json_data.hours_remaining))
			$("#number_of_courses_stat_mobile").html(json_data.number_of_courses)
			$("#my_courses_table_mobile").html(json_data.my_courses_table)
			$("#my_printed_documents_table_mobile").html(json_data.printed_table)
			$("#total_time_stat_mobile").html(FromSecondsToTime(json_data.total_time_seconds))
			// course_active_time = json_data.total_time_seconds

		}
	});
}

function AddZero(number){

	if(number < 10)
		return "0" + number;

	return number;
}

function FromSecondsToTime(time_seconds){

	minutes = "00"
	hours 	= "00"
	seconds = AddZero(time_seconds)

	if(time_seconds >= 60)
		seconds = AddZero(time_seconds % 60)

	if(time_seconds >= 60)
		minutes = AddZero(Math.floor((time_seconds - seconds) / 60) % 60)
	if(time_seconds >= 3600)
		hours 	= AddZero(Math.floor(time_seconds / 3600))

	return hours + ":" + minutes + ":" + seconds;
}


var global_timer = 30;


function setTimerMessages(){
	
	global_timer = setTimeout(function(){
		
		CheckUnreadMessages();			
		
	}, (10*1000));
}


function PlayTimer(){

	$("#course_timer").html(FromSecondsToTime(course_active_time++))

	global_timer = setTimeout(function(){
		
		PlayTimer();			
		
	}, (1000));
}

play = false;

function PlayTime(){

 	$('#pause_button').attr("style", "display: flex !important")
 	$('#play_button').attr("style",  "display: none !important")

 	InactivityTime();

	play = true;
	PlayTimer();
}


function PlayTimeSample(){

 	$('#pause_button').attr("style", "display: flex !important")
 	$('#play_button').attr("style",  "display: none !important")

	play = true;
	PlayTimer();
}

function PauseTime(){

	play = false;
	clearTimeout(global_timer);
	$('#play_button').attr( "style", "display: flex !important")
 	$('#pause_button').attr("style", "display: none !important")
}


function SubmitCourse(){

	course_review = document.getElementById('course_review_txt').value.replace(/\n/g, '<br />');

	if(course_review == "")
		PopUpMessage('Please write at the bottom of the course what you have learned from this course.');
	else if(course_review.length < 500)
		PopUpMessage('Text must be at least 500 characters');
	else
		$.post("../submit_course_time.php", { cuid: course_unique_id, ct: course_active_time, cr: course_review}, function (data) {

			if(data == 4)
				PopUpMessage('Missing arguments');
			else if(data == 1)
				PopUpMessage('You are not logged in');
			else if(data == 2){
				PopUpMessageSuccess('You have successfully submited your time');
				GetMyCoursesData()
			}
			else
				PopUpMessage('Something went wrong. Try again');
		});
}

function PrintDocument(){

	var selected_course_unique_id = "";
	var selected_time_seconds = 0;

	$('#my_courses_table input:checked').each(function() {

		if(selected_course_unique_id != "")
			selected_course_unique_id += "###";

		value = $(this).attr('value');

		values = value.split("##")

		unique_id = values[0];
		time_seconds = parseInt(values[1]);

	    selected_course_unique_id += unique_id;
	    selected_time_seconds += time_seconds;
	});

	if(selected_course_unique_id == "")
		PopUpMessage("Please select the course that you want to be printed")
	else if(selected_time_seconds < 3600)
		PopUpMessage("You must have at least 1 hour of total time from the selected courses")
	else{

		total_hours_seconds = hmsToSecondsOnly($("#hours_paid_stat").html())

		selected_time_seconds -= selected_time_seconds % 3600

		if(total_hours_seconds < selected_time_seconds)
			PopUpMessage("Your total time of the selected courses exceeds your available hours for print.<br /><br />Go to <b>Pricing Plans</b> to get more hours for print.")
		else{

			$.post("../print_courses.php", { scuid: selected_course_unique_id}, function (data) {

				if(data == 4)
					PopUpMessage('Missing arguments');
				else if(data == 1)
					PopUpMessage('You are not logged in');
				else if(data == 2){
					PopUpMessageSuccess('You have successfully printed your documents');
					GetMyCoursesData();
				}
				else
					PopUpMessage('Something went wrong. Try again');
			});
		}
	}
}

function hmsToSecondsOnly(str) {
    var p = str.split(':'),
        s = 0, m = 1;

    while (p.length > 0) {
        s += m * parseInt(p.pop(), 10);
        m *= 60;
    }

    return s;
}

function KeepAliveConfirm(){

	PlayTime()
	$("#keep_alive_close").click()

	clearTimeout(keep_alive_timer);
}

function StopTimers(){

	if(typeof time !== 'undefined'){
		PauseTime()
		clearTimeout(time);
		clearTimeout(keep_alive_timer);
	}
}

function KeepAliveNotConfirmed(){

	$("#keep_alive_close").click()
    document.getElementById("v_pills_courses_tab").click()
}

var keep_alive_timer;
var time;


function InactivityTime() {

	// events
	window.onload = resetTime;
	window.onclick = resetTime;
	window.onkeypress = resetTime;
	window.ontouchstart = resetTime;
	window.onmousemove = resetTime;
	window.onmousedown = resetTime;
	window.addEventListener('scroll', resetTime, true);

	function alertUser(){
	   
	    $("#keep_alive_button").click()

	    PauseTime()

	    keep_alive_timer = setTimeout(KeepAliveNotConfirmed, 1000 * 45); // 10 seconds
	}

	function resetTime() {

	    clearTimeout(time);
	    
	    if(play)
	    	time = setTimeout(alertUser, 3 * 60 * 1000); // 10 seconds
	}
}


function ValidateCode(){

	code = $("#validate").val()

	$("#error_message").hide();
	$("#result_text").hide();

	if(code == ""){
		$("#error_message").html("Please enter code");
		$("#error_message").show();
	}else{
		$.post("./validate.php", { vc: code}, function (data) {

			if(data == 4){
				$("#error_message").html("Missing arguments");
				$("#error_message").show();
			}
			else if(data == 2){
				$("#result_text").html("Document with Verification Code <b>" + code + "</b> does not exists");
				$("#result_text").show();
			}
			else if(data == 3){

				html = 'Here are the documents with Verification Code <b>' + code + '</b><br />';
				html += '<a href="../official-document/?uid=' + code + '" target="_blank">Official Document</a><br />'
				html += '<a href="../service-log/?uid=' + code + '" target="_blank">Service Log</a>'

				$("#result_text").html(html);
				$("#result_text").show();
			}
			else{
				$("#error_message").html("Something went wrong. Try again");
				$("#error_message").show();
			}
		});
	}
}

function GenerateEventModalContent(date, time){

	$.get( "./get_event_modal_content.php", {d: date, t: time}, function(data) {
        if(data == 3)
            PopUpMessage('Invalid arguments.');
		else if(data == 1)
            PopUpMessage('You are not logged in.');
		else if(data == 2)
            PopUpMessage('The Event does not exists.');
        else
        	$("#modal_join_content").html(data)

    });
}


function JoinEvent(event_id, date, time){

	document.getElementById('submit_link').href = encodeURI("./?id=" + event_id + "&d=" + date + "&t=" + time + "&section=schedule")

	document.getElementById('submit_link').click()
}



function Donate(donation_unique_id){

	donation_amount = parseInt($("#donation_" + donation_unique_id).val())

	if($.isNumeric(donation_amount)){
		
		document.getElementById('submit_link').href = encodeURI("./?duid=" + donation_unique_id + "&da=" + donation_amount)

		document.getElementById('submit_link').click()

	}else
        PopUpMessage('Please enter amount.');

}


function DonateStaticPage(donation_unique_id, page_unique_id){

	donation_amount = parseInt($("#donation_" + donation_unique_id).val())

	if($.isNumeric(donation_amount)){
		
		document.getElementById('submit_link').href = encodeURI("./?uid=" + page_unique_id + "&duid=" + donation_unique_id + "&da=" + donation_amount)

		document.getElementById('submit_link').click()

	}else
        PopUpMessage('Please enter amount.');

}