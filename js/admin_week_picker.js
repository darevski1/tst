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
        endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 7);
        var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
		$calroot.trigger('weekselected',{
			start:startDate,
			end:endDate,
			weekOf:startDate
		});
        selectCurrentWeek();
      
        // ApplyDates(startDate, endDate)
		startDate.setDate(startDate.getDate() + 1);
        date_from = startDate.getFullYear() + "-" + (startDate.getMonth() + 1) + "-" + startDate.getDate();
        

		$(this).toggle()

		element_id = $(this).attr('id');

		if(element_id == "week_picker_id")
        	GetScheduleEventTable(date_from);
        else{

	        startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 2);
	        endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 8);

        	date_from_american = ConvertDateToAmericanStandard(startDate, false)
        	date_to_american   = ConvertDateToAmericanStandard(endDate, false)

        	console.log(date_from_american)
        	console.log(date_to_american)

        	$("#next_week_date").html(date_from_american + "-" + date_to_american)

        	date_from 	= AddZerosToDate(startDate, true);
        	date_to 	= AddZerosToDate(endDate, true);

	        startDate.setDate(startDate.getDate() - 1)
        	GetWeeklyPaymentsSite(date_from, date_to, startDate)
        }
    }
	var reqOpt = {
		onSelect:onSelect,
		showOtherMonths: true,
        selectOtherMonths: true
	};
    $.fn.weekpicker = function(options){
		var $this = this;
		$calroot = $this;
		
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


function ConvertDateToAmericanStandard(original_date, with_year){

	year 	= original_date.getUTCFullYear()
	month 	= original_date.getUTCMonth()
	day 	= original_date.getUTCDate()

	month++;

	if(month < 10)
		month = "0" + month

	if(day < 10)
		day = "0" + day

	if(with_year)
		return month + "/" + day + "/" + year;
	else
		return month + "/" + day;
}


function AddZerosToDate(original_date, with_year){

	year 	= original_date.getUTCFullYear()
	month 	= original_date.getUTCMonth()
	day 	= original_date.getUTCDate()

	month++;

	if(month < 10)
		month = "0" + month

	if(day < 10)
		day = "0" + day

	if(with_year)
		return year + "-" + month + "-" + day;
	else
		return month + "-" + day;
}



var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

var weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

function ConvertDateToString(date_value, without_year){

	var month = date_value.getUTCMonth();
	var day   = date_value.getUTCDate();
	var year  = date_value.getUTCFullYear();

	month++;
	
	month = months[month]

	if(day == 1)
		day += "st";
	else if(day == 2)
		day += "nd";
	else if(day == 3)
		day += "rd";
	else 
		day += "th";

	if(without_year == true)
		new_date = month + " " + day;
	else
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