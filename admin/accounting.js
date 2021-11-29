

var short_months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];


function ConvertDateToStringShort(date_value){

	var month = date_value.getMonth();
	var day   = date_value.getDate();

	month = short_months[month]

	new_date = day + "-" + month;

	return new_date;
}

function InsertRowsInFirstTable(html_rows){

	table_html = $("#first_table_body").html()

	rows_html = table_html.split("</tr>");

	new_table_html = ""

	for(i = 0; i < 4; i++)
		new_table_html += rows_html[i];

	new_table_html += html_rows;

	$("#first_table_body").html(new_table_html)

	return true;
}

function GetWeeklyPaymentsSite(date_from, date_to, startDate){

	$.post( "./get_accounting_payments.php", {df: date_from, dt: date_to}, function(data) {

        if(data == 3)
            PoUpMessage('Invalid arguments.');
        else if(data == 2)
            PoUpMessage('Something went wrong. Try again.');
		else if(data == 1)
            PoUpMessage('You are not logged in.');
        else{
        	
        	var response_array = JSON.parse(data);

            html = GenerateSitePaymentsRows(response_array, startDate)

            
	        startDate.setDate(startDate.getDate() - 1)
            ChangeDaysDates(startDate)

            if(InsertRowsInFirstTable(html))
				CalculateTable_1_Percent()

        }
    });		
}

function ChangeDaysDates(startDate){

	for(k = 1; k <= 7; k++){

		startDate.setDate(startDate.getDate() + 1)


        pom_date = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate());
		date_string = ConvertDateToStringShort(pom_date, true)

		$("#day_" + k + "_cell").html(date_string);
	}
}

number_of_payment_site_rows = 0;

function GenerateSitePaymentsRows(rows_array, startDate){

	html = "";

	payment_rows = GetSitePaymentsRows(rows_array);

	number_of_payment_site_rows = payment_rows.length;

	for(j = 0; j < payment_rows.length; j++){

		current_sum = 0;

		html += "<tr>"
		html += 	"<td>" + payment_rows[j] + "</td>";

		for(i = 1; i <= 7; i++){

			startDate.setDate(startDate.getDate() + 1)
			date = AddZerosToDate(startDate, true);

			amount = GetAmountFromPaymentArray(rows_array, payment_rows[j], date);

			current_sum += amount;

			html += "<td>$" + amount.toString() + "</td>";
		}

		startDate.setDate(startDate.getDate() - 7)

		html += 	"<td id='payment_row_" + j + "_wtd'>$" + current_sum.toString() + "</td>";
		html += 	"<td id='payment_row_" + j + "_percent'>$0</td>";
		html += "</tr>"
	}

	return html
}



function GetAmountFromPaymentArray(rows_array, payment_order, date){
	
	for(m = 0; m < rows_array.length; m++)
		if(rows_array[m]["payment_order"] == payment_order && rows_array[m]["date"] == date)
			return parseInt(rows_array[m]["payment_amount"]);

	return 0;
}

function GetSitePaymentsRows(rows_array){

	payment_rows = [];

	current_row = ""

	for(i = 0; i < rows_array.length; i++)
		if(current_row != rows_array[i]["payment_order"]){
			current_row = rows_array[i]["payment_order"];
			payment_rows.push(current_row);
		}
	
	return payment_rows;
}


function CalculateTable_1_Percent(){

	actual_total = $("#t1r2c8").html().replace('$', ""); 
	actual_total = parseInt(actual_total)

	for(k = 0; k < number_of_payment_site_rows; k++){

		row_wtd = $("#payment_row_" + k + "_wtd").html().replace('$', "");
		row_wtd = parseInt(row_wtd)

		if(actual_total == 0)
			percent = 0;
		else
			percent = parseInt(row_wtd / actual_total);

		$("#payment_row_" + k + "_percent").html("$" + percent)
	}
}

function CalculateT1R1(c){

	cel_1 = $("#t1r1c" + c).val()

	cel_1 = parseInt(cel_1) * 0.14;
	if(!Number.isInteger(cel_1))
		cel_1 = cel_1.toFixed(2);

	$("#t3r0c" + c).html("$" + cel_1);
	// $("#t4r1c" + c).html("$" + cel_1);
	// $("#t5r1c" + c).html("$" + cel_1);

	wtd_cel = $("#t1r1c8").html().replace('$', "");
	wtd_cel = parseInt(wtd_cel) * 0.1


	cel_t2r2c8 = wtd_cel * 0.15
	$("#t2r2c8").html("$" + cel_t2r2c8.toFixed(2));

	cel_t2r3c8 = wtd_cel * 0.25
	$("#t2r3c8").html("$" + cel_t2r3c8.toFixed(2));
	$("#t2r4c8").html("$" + cel_t2r3c8.toFixed(2));

	cel_t2r5c8 = wtd_cel * 0.075
	$("#t2r5c8").html("$" + cel_t2r5c8.toFixed(2));

	cel_t2r7c8 = wtd_cel * 0.03
	$("#t2r7c8").html("$" + cel_t2r7c8.toFixed(2));

	CalculateRowTable_2(2, 2, 1, false);
	CalculateRowTable_2(2, 3, 1, false);
	CalculateRowTable_2(2, 4, 1, false);
	CalculateRowTable_2(2, 5, 1, false);
	// CalculateRowTable_2(2, 6, 1, false);
	CalculateRowTable_2(2, 7, 1, false);

	sum_26 = CalculateSumOfRow(2, 6);
	cel_t2r6c8 = 91 - sum_26
	$("#t2r6c8").html("$" + sum_26);
	$("#t2r6c9").html("$" + cel_t2r6c8);
}

function CalculateSumOfRow(t, r){

	sum = 0;
	$('input[name="t'+t+'r'+r+'"]').each(function(){

        if($(this).val() == "")
			$(this).val(0)

        sum += parseInt($(this).val());
	});

	return sum;
}

function CalculateRowTable_1(t, r, c, element){

	if(element != false)
		limitIntegerReal_0(element, 1);


	if(t == 4 && r == 2){
		cel_1 = $("#t4r2c" + c).val()
		cel_1 = parseInt(cel_1)

		$("#t4r3c" + c).html("$" + cel_1);
	}
	if(t == 5 && r == 2){
		cel_1 = $("#t5r2c" + c).val()
		cel_1 = parseInt(cel_1)

		$("#t5r3c" + c).html("$" + cel_1);
	}

	
	sum = CalculateSumOfRow(t, r);

	$("#t"+t+"r"+r+"c8").html("$" + sum);


	if(t == 1 && r == 1)
		CalculateT1R1(c)

	CalculateTotalTable_1();
	CalculateTotalTable_3();
	CalculateTotalTable_45(4);
	CalculateTotalTable_45(5);


	CalculateTotalTables345();

	CalculateActualSalesC9(3)
	CalculateActualSalesC9(4)
	CalculateActualSalesC9(5)


	CalculateTable_1_Percent()

}

CalculateRowTable_1(4,1,1, false)
CalculateRowTable_1(5,1,1, false)


function CalculateActualSalesC9(t){

	cel9_1 = $("#t" + t + "r3c8").html().replace('$', "");
	cel9_2 = $("#t1r2c8").html().replace('$', "");

	if(parseInt(cel9_2) == 0 )
		total = 0;
	else
		total = parseInt(cel9_1) / parseInt(cel9_2);

	if(!Number.isInteger(total))
		total = total.toFixed(2);

	$("#t" + t + "r5c9").html("%" + total);
}

function CalculateTotalTable_45(t){

	sum8 = 0;

	for(i = 1; i <= 8; i++){

		cel_1 = $("#t"+t+"r3c" + i).html().replace('$', "");

		if(i < 8){
			sum8 += parseInt(cel_1)
			cel_2 = $("#t"+t+"r1c" + i).val();
		}else
			cel_2 = $("#t"+t+"r1c" + i).html().replace('$', "");

		total = parseInt(cel_1) - parseInt(cel_2);
		
		$("#t"+t+"r4c" + i).html("$" + total);
	}

	$("#t"+t+"r3c8").html("$" + sum8);


	for(i = 1; i <= 8; i++ ){

		if(i < 8)
			cel_1 = $("#t1r2c" + i).val();
		else
			cel_1 = $("#t1r2c" + i).html().replace('$', "");

		cel_2 = $("#t"+t+"r3c" + i).html().replace('$', "");

		if(cel_1 == "" || cel_1 == 0)
			cel_1 = 1;

		total = parseInt(cel_2) / parseInt(cel_1);
		if(!Number.isInteger(total))
			total = total.toFixed(2);

		$("#t"+t+"r5c" + i).html("%" + total);
	}

}

function CalculateWeeklyPrime(){

	cel_1 = $("#t6r1c2").html().replace('$', "");
	cel_2 = $("#t6r2c2").html().replace('$', "");
	cel_3 = $("#t1r2c8").html().replace('$', "");

	total = 0;

	if(parseInt(cel_3) != 0)
		total = (parseInt(cel_1) + parseInt(cel_2)) / parseInt(cel_3)
	
	if(!Number.isInteger(total))
			total = total.toFixed(2);

		$("#t6r4c1").html("%" + total);

	
}

function CalculateTotalTables345(){

	cel_1 = $("#t3r3c8").html().replace('$', "");
	cel_2 = $("#t4r3c8").html().replace('$', "");
	cel_3 = $("#t5r3c8").html().replace('$', "");

	total = parseInt(cel_1) + parseInt(cel_2) + parseInt(cel_3)

	$("#t5r6c1").html("$" + total);
	$("#t6r2c2").html("$" + total);


	cel_4 = $("#t1r2c8").html().replace('$', "");

	total_2 = total - cel_4

	$("#t5r6c2").html("$" + total_2);




	cel_1 = $("#t3r1c8").html().replace('$', "");
	cel_2 = $("#t4r1c8").html().replace('$', "");
	cel_3 = $("#t5r1c8").html().replace('$', "");

	total_1 = parseInt(cel_1) + parseInt(cel_2) + parseInt(cel_3)

	$("#t6r2c1").html("$" + total_1);

	total_3 = total_1 - total; 

	$("#t6r2c3").html("$" + total_3);

	row2cel2 = $("#t6r1c2").html().replace('$', "");

	total_sum = total + parseInt(row2cel2);

	if(cel_4 == 0)
		final_value = 0;
	else
		final_value = total_sum / cel_4

	
	$("#t6r4c1").html("$" + final_value);

	CalculateWeeklyPrime()
}

function CalculateTotalTable_3(){
	
	for(var i = 1; i <= 8; i++) {

		if(i < 8){
			cel_1 = $("#t3r1c" + i).val()
			cel_2 = $("#t3r2c" + i).val()
		}else{
			cel_1 = $("#t3r1c8").html().replace('$', "");
			cel_2 = $("#t3r2c8").html().replace('$', "");
		}

		total = parseInt(cel_1) + parseInt(cel_2);
		
		$("#t3r3c" + i).html("$" + total);

		cel_3 = $("#t3r0c" + i).html().replace('$', "");

		total2 = parseInt(total) - parseInt(cel_3);

		$("#t3r4c" + i).html("$" + total2);
	}

	for(i = 1; i <= 8; i++ ){

		if(i < 8)
			cel_1 = $("#t1r2c" + i).val();
		else
			cel_1 = $("#t1r2c" + i).html().replace('$', "");

		cel_2 = $("#t3r3c" + i).html().replace('$', "");

		if(cel_1 == "" || cel_1 == 0)
			cel_1 = 1;

		total = parseInt(cel_2) / parseInt(cel_1);
		if(!Number.isInteger(total))
			total = total.toFixed(2);

		$("#t3r5c" + i).html("%" + total);
	}
}


function CalculateTotalTable_1(){

	for(var i = 1; i <= 7; i++) {

		cel_1 = $("#t1r1c" + i).val()
		cel_2 = $("#t1r2c" + i).val()

		total = parseInt(cel_2) - parseInt(cel_1);
		
		$("#t1r6c" + i).html("$" + total);
	}

	cel_1 = $("#t1r1c8").html().replace('$', "");
	cel_2 = $("#t1r2c8").html().replace('$', "");

	total = parseInt(cel_2) - parseInt(cel_1);

	$("#t1r6c8").html("$" + total);

	$("#t3r0c8").html($("#t1r1c8").html());
}


function CalculateRowTable_2(t, r, c, element){

	if(element != false)
		limitIntegerReal_0(element, 1);

	sum = 0

	$('input[name="t'+t+'r'+r+'"]').each(function(){

        if($(this).val() == "")
			$(this).val(0)

        sum += parseInt($(this).val());
	});

	if(r == 6)
		CalculateT1R1(6)
	else{
	// if(r != 1){
		budget = $("#t"+t+"r"+r+"c8").html().replace('$', "");
		budget = parseFloat(budget)

		variance = budget - sum

		$("#t"+t+"r"+r+"c9").html("$" + variance);
	}

	CalculateTotalTable_2();


}

function CalculateTotalTable_2(){

	actual_total = 0
	for(i = 1; i <= 7; i++){
		sum = 0;

		for(j = 2; j <= 7; j++){

			cel_val = $("#t2r" + j + "c" + i).val()

			sum += parseInt(cel_val);
		}
		$("#t2r8c" + i).html("$" + sum);

		actual_total += sum;
	}

	$("#t6r1c2").html("$" + actual_total);


	variance_sum = 0;

	for(i = 2; i <= 7; i++){

		cel_val = $("#t2r" + i + "c9").html().replace('$', "");

		if(cel_val == "")
			cel_val = 0;

		variance_sum += parseInt(cel_val);
	}

	$("#t2r8c9").html("$" + variance_sum);

	actual_budget_sum = 0

	for(var i = 2; i <= 7; i++) {

		actual_budget_sum += parseFloat($("#t2r" + i + "c8").html().replace('$', ""))
	}

	$("#t2r8c8").html("$" + actual_budget_sum);
	$("#t6r1c1").html("$" + actual_budget_sum);
	$("#t6r1c1").html("$" + actual_budget_sum);


	CalculateTotalTables345();
}


function CalculateRowTable_6(element){

	limitIntegerReal_0(element, 1);

	cel_1 = $("#t6r3c1").val()
	cel_2 = $("#t6r3c2").val()
	
	variance = parseInt(cel_1) - parseInt(cel_2);


	$("#t6r3c3").html("$" + variance);
}


function limitIntegerReal_0(limitField, zero) {

	if(limitField.value == ""){
		limitField.value = 0;
		return;
	}
	if(limitField.value == 0)
		return;


	if (zero == 1) {
		if (limitField.value != 0)
			limitField.value = limitField.value.replace(/[^\d.]/g, "").replace('-', '').replace(/^[0]+/g, "").replace('.', '');
	} else
		limitField.value = limitField.value.replace(/[^\d.]/g, "").replace('-', '').replace(/^[0]+/g, "").replace('.', '');
	
}
