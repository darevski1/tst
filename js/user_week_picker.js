/*
 * Requires jquery ui
 */
 
 
(function($){
	var $calroot;

    function selectCurrentWeek() {
        window.setTimeout(function () {
            var t = $calroot.find('.ui-datepicker-current-day a');//.addClass('ui-state-active');
			t= t.closest('tr');
			t.find('td>a').addClass('ui-state-active');//.parent().addClass('ui-state-active');
        }, 1);
		
    }
	function onSelect(dateText, inst) { 
		
        var date = $(this).datepicker('getDate');
        startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
        endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
        var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
		$calroot.trigger('weekselected',{
			start:startDate,
			end:endDate,
			weekOf:startDate
		});

        selectCurrentWeek();

		startDate.setDate(startDate.getDate() + 1);
        date_from = startDate.getFullYear() + "-" + (startDate.getMonth() + 1) + "-" + startDate.getDate();

        startDate.setDate(startDate.getDate() + 1);

        // $("#choose_date_button").html(ConvertDateToString(startDate) + " - " + ConvertDateToString(endDate))
        $('#week_picker_id').toggle()
        // GetScheduleEventTable(date_from);
        GetScheduleEventTableMobile(date_from);
        // ApplyDates(startDate, endDate)
    }
	var reqOpt = {
		onSelect:onSelect,
		showOtherMonths: true,
        selectOtherMonths: true
	};
    $.fn.weekpicker = function(options){
		var $this = this;
		$calroot = $this;
		// console.log(this)
		$this.datepicker(reqOpt);
		//events
		$dprow = $this.find('.ui-datepicker');
		
		$dprow.on('mousemove','tr', function() { 
			$(this).find('td a').addClass('ui-state-hover'); 
		});
		$dprow.on('mouseleave','tr', function() { 
			$(this).find('td a').removeClass('ui-state-hover'); 
		});
	};
})(jQuery);



function GetScheduleEventTable(date_from){

	$.get( "./get_schedule_event_table.php", {df: date_from}, function(data) {
        if(data == 3)
            PopUpMessage('Invalid arguments.');
		else if(data == 1)
            PopUpMessage('You are not logged in.');
        else{
        	$("#schedule_table_div").show()
        	$("#schedule_table_div").html(data)
        }
    });

}

current_day = 1

function GetScheduleEventTableMobile(date_from){

	$.get( "./get_schedule_event_mobile.php", {df: date_from}, function(data) {
        if(data == 3)
            PopUpMessage('Invalid arguments.');
		else if(data == 1)
            PopUpMessage('You are not logged in.');
        else{

			current_day = 1
        	$("#schedules_mobile").html(data)
        }
    });
}

function SwipeLeftSchedule(){

	if(current_day > 1){

		$("#day-" + current_day).hide()
		current_day--;
		$("#day-" + current_day).show()
	}
}

function SwipeRightSchedule(){

	if(current_day < 5){

		$("#day-" + current_day).hide()
		current_day++;
		$("#day-" + current_day).show()
	}
}




var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

var weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

function ConvertDateToString(date_value){

	var month = date_value.getUTCMonth();
	var day   = date_value.getUTCDate();
	var year  = date_value.getUTCFullYear();

	month = months[month]

	if(day == 1)
		day += "st";
	else if(day == 2)
		day += "nd";
	else if(day == 3)
		day += "rd";
	else 
		day += "th";

	new_date = month + " " + day + ", " + year;

	return new_date;
}

function ApplyDates(startDate){

	for(i = 1; i <= 5; i++){

		startDate.setDate(startDate.getDate() + 1);

		day_n = startDate.getDay();

		day_name = weekdays[day_n]

		day_name_id = day_name.toLowerCase() + '_column_title';

		new_date = ConvertDateToString(startDate);

		day_date = day_name + "<br />" + new_date;

		$("#" + day_name_id).html(day_date)
	}

}