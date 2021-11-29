<?php


function GetSchedulesPage(){

	$return_html = '<div class="p-2" id="content_schedules" style="display:none">
						<h2 class="mt-4 black">Schedule Events</h2>
						<div class="col-sm-12">
						      <div class="form-group">
								  <button type="button" class="btn btn-outline-sec"
								  	onclick="$(\'#week_picker_id\').toggle()">
								  Choose Week
								</button>
						        <div class="input-group date align-items-center">
						          <div class="week-picker" id="week_picker_id" style="margin-top:10px"></div>
						          </div>
						        </div>
						      </div>
						<hr class="mt-4">
						<div class="table-responsive" id="schedule_table_div">';
	
	$return_html .= '	</div>';
	$return_html .= '</div>';

	$return_html .= GetCreateEventModal();
	
	return $return_html;	

}


function GenerateOpenEventCard($title, $total_seats, $users_aplied, $date, $time, $event_id){

	global $page_name;

	$available_seats = $total_seats - $users_aplied;

	if($page_name == "admin")
		return '<div class="card openc carder">
					<div class="card-body">
						<h6 class="card-titles ms-title">' . $title . '</h6>
						<p class="schedule-text ms2-title ms-p">Seats left: <b>' . $available_seats . '</b> from <b>' . $total_seats . '</b></p>
						<p class="schedule-text ms2-title ms-p">Status: <b>Open</b></p>
						<button type="button" class="btn join_btn btns"
								onclick="OpenEventDetails(\'' . $date . '\', \'' . $time . '\')">See Details</button>
					</div>
				</div>';
	else{

		$user_id = $_SESSION["user_id"];

		$user_signed_up = UserSignedUpOnEvent($event_id, $user_id);

		if($user_signed_up)
			return '<div class="card openb carder">
						<div class="card-body">
							<h6 class="card-titleg ms-title">' . $title . '</h6>
							<p class="scheduleg-text ms2-title ms-p">Seats left: <b>' . $available_seats . '</b> from <b>' . $total_seats . '</b></p>
							<p class="scheduleg-text ms2-title ms-p"><b>Already signed up</b></p>
						</div>
					</div>';
						
		else
			return '<div class="card openc carder">
						<div class="card-body">
							<h6 class="card-titles ms-title">' . $title . '</h6>
							<p class="schedule-text ms2-title ms-p">Seats left: <b>' . $available_seats . '</b> from <b>' . $total_seats . '</b></p>
							<button type="button" class="btn join_btn btns"  data-bs-toggle="modal" data-bs-target="#modal_join" 
									onclick="GenerateEventModalContent(\'' . $date . '\', \'' . $time . '\')">Join now</button>
						</div>
					</div>';
	}

}

function GenerateClosedEventCard($title, $page = "admin"){

	if($page == "admin")
		return '<div class="card opend carder" >
					<div class="card-body">
						<h6 class="card-titled ms-title ms2-title">' . $title . '</h6>
						<p class="schedules-text ms2">Status: <b>Closed</b></p>
					</div>
				</div>';
}

function GenerateFullEventCard($title, $total_seats, $page = "admin"){

	if($page == "admin")
		return '<div class="card openl carder">
					<div class="card-body">
						<h6 class="card-titlel ms-title">' . $title . '</h6>
						<p class="schedule-text ms2-title ms-p">Total Seats: <b>' . $total_seats . '</b></p>
						<p class="schedule-text ms2-title ms-p">Status: <b>Full</b></p>
					</div>
				</div>';
}

function GenerateFinishedEventCard($title, $page = "admin"){

	if($page == "admin")
		return '<div class="card openb carder" >
					<div class="card-body">
						<h6 class="card-titleg ms-title">' . $title . '</h6>
						<p class="scheduleg-text ms2 ms2-title ms-p">Status: <b>Finished</b></p>
					</div>
				</div>';
}



function GetEventRowsDB($dates){

	$db_dates = "";

	for($i = 0; $i < count($dates); $i++){

		if($db_dates != "")
			$db_dates .= ", ";

		$db_dates .= "'" . $dates[$i] . "'";
	}

	$query = "SELECT id, title, description, number_of_users, price, users_aplied, event_date, start_time,
					 IF(DATE(NOW()) > event_date, 'Finished', event_status) AS event_status
			  FROM scheduled_events
			  WHERE event_date IN ($db_dates)
			  ORDER BY event_date, start_time ASC";

	$rows = QuerySelect($query);

	return $rows;
}

function GetEventTableCell($date, $time, $rows){

	$return_html = '';
	$event_status = '';

	$time .= ":00";

	for($i = 0; $i < count($rows); $i++){

		if($rows[$i]["event_date"] == $date && $rows[$i]["start_time"] == $time){

			$title 			 = $rows[$i]["title"];
			$number_of_users = intval($rows[$i]["number_of_users"]);
			$users_aplied 	 = intval($rows[$i]["users_aplied"]);
			$event_id 		 = $rows[$i]["id"];

			switch ($rows[$i]["event_status"]){
				case 'Open':
					$return_html .= GenerateOpenEventCard($title, $number_of_users, $users_aplied, $date, $time, $event_id);
					$event_status = 'Open';
					break;
				case 'Full':
					$return_html .= GenerateFullEventCard($title, $number_of_users);
					$event_status = 'Full';
					break;
				case 'Closed':
					$return_html .= GenerateClosedEventCard($title);
					$event_status = 'Closed';
					break;
				case 'Finished':
					$return_html .= GenerateFinishedEventCard($title);
					$event_status = 'Finished';
					break;
			}
		}
	}
	
	global $page_name;

	if($page_name == "admin"){
		$today = date("Y-m-d");

		if($today <= $date){

			$button_name = "Create";

			if($event_status != "")
				$button_name = "Edit";

			$return_html .= '<button type="button" class="btn btn-outline-sec" data-toggle="modal" data-target="#EventModal" 
									onclick="GenerateEventModalContent(\'' . $date . '\', \'' . $time . '\')">
									' . $button_name . ' Event
							</button>';
		}
	}else{
		if($return_html == "")
			$return_html = "/";
	}

	return $return_html;
}


function GetScheduleTableRows($dates){

	$event_time_rows = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];

	$event_rows = GetEventRowsDB($dates);

	$return_html = '';

	for($i = 0; $i < count($event_time_rows) - 1; $i++){
		$return_html .= '<tr>
							<td>' . $event_time_rows[$i] . 'h - ' . $event_time_rows[$i + 1] . 'h </td>
							<td>' . GetEventTableCell($dates[0], $event_time_rows[$i], $event_rows) . '</td>
							<td>' . GetEventTableCell($dates[1], $event_time_rows[$i], $event_rows) . '</td>
							<td>' . GetEventTableCell($dates[2], $event_time_rows[$i], $event_rows) . '</td>
							<td>' . GetEventTableCell($dates[3], $event_time_rows[$i], $event_rows) . '</td>
							<td>' . GetEventTableCell($dates[4], $event_time_rows[$i], $event_rows) . '</td>
						</tr>';
	}

	return $return_html;

}

function GetScheduleTable($date_from){

	$week_dates = GetWeekDates($date_from);
	$dates = GenerateDBDates($date_from);

	$return_html = '<table class="table table-bordered schedule-table">
						<thead>
							<tr>
							<th scope="col">
		                        <div class="d-flex">
			                        <div class="col time d-flex justify-content-center align-items-center">time</div>
			                        <div class="col day d-flex justify-content-center align-items-center">day</div>
		                        </div>
	                        </th>
							<th scope="col" style="width:18%" id="monday_column_title">Monday<br />' . $week_dates[0] . '</th>
	                        <th scope="col" style="width:18%" id="tuesday_column_title">Tuesday<br />' . $week_dates[1] . '</th>
	                        <th scope="col" style="width:18%" id="wednesday_column_title">Wednesday<br />' . $week_dates[2] . '</th>
	                        <th scope="col" style="width:18%" id="thursday_column_title">Thursday<br />' . $week_dates[3] . '</th>
	                        <th scope="col" style="width:18%" id="friday_column_title">Friday<br />' . $week_dates[4] . '</th>
							</tr>
						</thead>
						<tbody>';

	$return_html .= GetScheduleTableRows($dates);

	$return_html .= '	</tbody>
					</table>';

	return $return_html;
}


function GetWeekDates($date_from){

	$dates = [];

	$date = new DateTime($date_from);

	for($i = 0; $i < 5; $i++){
	    
	    $day   = $date->format('jS');
	    $month = $date->format('M');
	    $year  = $date->format('Y');

	    $dates[] = $month . " " . $day . ", " . $year;

	    $date->modify('+1 day');
	}

	return $dates;
}



function GenerateDBDates($date_from){

	$dates = [];

	$date = new DateTime($date_from);

	for($i = 0; $i < 5; $i++){

	    $dates[] = $date->format('Y-m-d');

	    $date->modify('+1 day');
	}

	return $dates;
}

function GetCreateEventModal(){
	
	return '<div class="modal fade" id="EventModal" tabindex="-1" aria-labelledby="EventModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content" id="event_modal_content">
						
					</div>
				</div>
			</div>';
}

function GetEventByDateTime($date, $time){

	$query = "SELECT id, title, description, number_of_users, event_status, users_aplied, price
			  FROM scheduled_events
			  WHERE event_date = '$date' AND start_time = '$time'";

	// echo $query;

	$rows = QuerySelect($query);

	return $rows;
}

function GenerateEventModalContent($date, $time){

	$type			 = 'Create';
	$title 			 = '';
	$description 	 = '';
	$event_status	 = '';
	$number_of_users = 0;
	$price 			 = 0;
	$users_aplied	 = 0;

	$status_selected = ["Open" => "", "Full" => "", "Closed" => "", "Finished" => ""];

	$rows = GetEventByDateTime($date, $time);

	if(count($rows) > 0){
		$type 			 = 'Edit';
		$title 			 = $rows[0]['title'];
		$description 	 = $rows[0]['description'];
		$number_of_users = intval($rows[0]['number_of_users']);
		$event_status 	 = $rows[0]['event_status'];
		$price 	 		 = $rows[0]['price'];
		$users_aplied 	 = intval($rows[0]['users_aplied']);
	}

	if($number_of_users > 0 && $number_of_users <= $users_aplied)
		$event_status = "Full";

	if($event_status != "")
		$status_selected[$event_status] = " selected";

	$return_html = '<div class="modal-header">
						<h5 class="modal-title black">' . $type . ' event</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label for="event_status" class="black">Event Status</label>
								<select class="form-control" name="event_status" id="event_status">
									<option value=""> Select Status </option>
									<option value="Open" ' 		. $status_selected["Open"] 		. '>Open</option>
									<option value="Full" ' 		. $status_selected["Full"] 		. '>Full</option>
									<option value="Closed" ' 	. $status_selected["Closed"] 	. '>Closed</option>
								</select>
							</div>

							<div class="form-group">
								<label for="event_number_of_users" class="black">Number of total users:</label>
								<input type="number" min="0" class="form-control" name="event_number_of_users" 
										id="event_number_of_users" value="' . $number_of_users . '">
							</div>
							<div class="form-group">
								<label for="event_price" class="black">Signup Price:</label>
								<input type="number" min="0" class="form-control" name="event_price" 
										id="event_price" value="' . $price . '">
							</div>
							<div class="form-group">
								<label for="event_title" class="black">Event Title:</label>
								<input type="text" class="form-control" name="event_title" 
										id="event_title" value="' . $title . '">
							</div>
							<div class="form-group">
								<label for="description" class="black">Event Description:</label>
								<textarea class="form-control" id="event_description" rows="3">' . $description . '</textarea>
							</div>

							<button type="button" class="btn btn-secondary" data-dismiss="modal" id="modal_close_button">Close</button>
							<button type="button" class="btn btn-primary" onclick="SaveEvent(\'' . $date . '\', \'' . $time . '\')">Save changes</button>
						</form>
					</div>

					<div class="modal-footer">
					</div>';

	return $return_html;
}


function GetScheduleTableMobile($date_from){

	$week_dates = GetWeekDates($date_from);
	$dates 		= GenerateDBDates($date_from);

	$return_html = "";

	for($i = 1; $i < 6; $i++){
		if($i == 1)
			$return_html .= '<div class="wrap-schedule" id="day-' . $i . '">';
		else
			$return_html .= '<div class="wrap-schedule" id="day-' . $i . '" style="display:none">';

        $return_html .= '<div class="block-timer d-flex justify-content-center align-items-center">Monday<br />' . $week_dates[0] . '</div>';

        $return_html .= GetScheduleTableRowsMobile($dates[$i-1]) . '</div>';
	}

	return $return_html;
}


function GetScheduleTableRowsMobile($date){

	$event_time_rows = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];


	$event_rows = GetEventRowsMobileDB($date);

	$return_html = '';

	for($i = 0; $i < count($event_time_rows) - 1; $i++){
		$return_html .= '<div class="card card-schedule d-flex align-items-center "> 
                            <div class="mt-2"><b>Time: </b>' . $event_time_rows[$i] . 'h - ' . $event_time_rows[$i+1] . 'h</div>
                            <div class="sc-option mt-2 mb-2"> ' . GetEventTableCellMobile($date, $event_time_rows[$i], $event_rows) . ' </div>
                         </div>';

	}

	return $return_html;
}

function GetEventRowsMobileDB($date){

	$query = "SELECT id, title, description, number_of_users, price, users_aplied, event_date, start_time,
					 IF(DATE(NOW()) > event_date, 'Finished', event_status) AS event_status
			  FROM scheduled_events
			  WHERE event_date = '$date'
			  ORDER BY event_date, start_time ASC";

	$rows = QuerySelect($query);



	return $rows;
}


function GetEventTableCellMobile($date, $time, $rows){

	$return_html = '';
	$event_status = '';

	$time .= ":00";

	for($i = 0; $i < count($rows); $i++){

		if($rows[$i]["event_date"] == $date && $rows[$i]["start_time"] == $time){

			$title 			 = $rows[$i]["title"];
			$number_of_users = intval($rows[$i]["number_of_users"]);
			$users_aplied 	 = intval($rows[$i]["users_aplied"]);
			$event_id 		 = $rows[$i]["id"];

			switch ($rows[$i]["event_status"]){
				case 'Open':
					$return_html .= GenerateOpenEventCardMobile($title, $number_of_users, $users_aplied, $date, $time, $event_id);
					$event_status = 'Open';
					break;
				case 'Full':
					$return_html .= GenerateFullEventCardMobile($title, $number_of_users);
					$event_status = 'Full';
					break;
				case 'Closed':
					$return_html .= GenerateClosedEventCardMobile($title);
					$event_status = 'Closed';
					break;
				case 'Finished':
					$return_html .= GenerateFinishedEventCardMobile($title);
					$event_status = 'Finished';
					break;
			}
		}
	}

	if($return_html == "")
		$return_html = "/";
	

	return $return_html;
}




function GenerateOpenEventCardMobile($title, $total_seats, $users_aplied, $date, $time, $event_id){

	global $page_name;

	$available_seats = $total_seats - $users_aplied;

	$user_id = $_SESSION["user_id"];

	$user_signed_up = UserSignedUpOnEvent($event_id, $user_id);

	if($user_signed_up)
		return '<div class="card openb cardersa">
					<div class="card-body">
						<h6 class="card-titlel ms-title">' . $title . '</h6>
						<p class="schedulel-text ms2-title ms-p">Seats left: <b>' . $available_seats . '</b> from <b>' . $total_seats . '</b></p>
						<p class="schedulel-text ms2-title ms-p"><b>Already signed up</b></p>
					</div>
				</div>';
	else
		return '<div class="card openc cardersa">
					<div class="card-body">
						<h6 class="card-titles ms-title">' . $title . '</h6>
						<p class="schedulew-text ms2-title ms-p">Seats left: <b>' . $available_seats . '</b> from <b>' . $total_seats . '</b></p>
						<button type="button" class="btn join_btn btns"  data-bs-toggle="modal" data-bs-target="#modal_join" 
								onclick="GenerateEventModalContent(\'' . $date . '\', \'' . $time . '\')">Join now</button>
					</div>
				</div>';

}

function GenerateClosedEventCardMobile($title){

	return '<div class="card opend cardersa">
                <div class="card-body">
                    <h6 class="card-titled ms-title">' . $title . '</h6>
                    <p class="schedules-text ms2 ms2-title ms-p">Status: <b>Closed</b></p>
                </div>
            </div>';
}

function GenerateFullEventCardMobile($title, $total_seats){

	return '<div class="card openl cardersa">
                <div class="card-body">
                    <h6 class="card-titleg ms-title">' . $title . '</h6>
					<p class="scheduleg-text ms2-title ms-p">Total Seats: <b>' . $total_seats . '</b></p>
                    <p class="scheduleg-text ms2 ms2-title ms-p">Status: <b>Full</b></p>
                </div>
            </div>';
}

function GenerateFinishedEventCardMobile($title){

	return '<div class="card openb cardersa">
                <div class="card-body">
                    <h6 class="card-titlel ms-title">' . $title . '</h6>
                    <p class="schedulel-text ms2 ms2-title ms-p">Status: <b>Finished</b></p>
                </div>
            </div>';
}
