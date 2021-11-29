<?php
	
// \Stripe\Stripe::setApiKey("sk_test_VtgzLovLlicgVEiw6azet3JA"); //darko
// \Stripe\Stripe::setApiKey("sk_test_51IIyVNA6lOLX6yqEiqf0uoVdOOB0VVLQBhzhrUNPTwc0T8QA3xm47x7s6H9u1MnO9xi65YGqxJGBWbTolKOJ8WYB00cIApsX4j"); //test
\Stripe\Stripe::setApiKey("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"); //live

// $pk_key = 'pk_test_6jQViFNn6p1XoE237ogCiacp'; //darko
// $pk_key = 'pk_test_51IIyVNA6lOLX6yqEx7AIgQH65msWyqRs5T91fuwZV2t20HycLAV9zpYGvxeqRawCZCzEbIbfI2TkrtT8YRpIA8Kx00P6mlQMIv'; //test
$pk_key = 'pk_live_51IIySpL11l9Jv4VqeovHgYJqrQVrJ774PTjA0frCRUwNDS3b3JhUuXNbv00i5DrtLOMAh6yb61SaF7jD2g5mjSu100xIX2uc9h'; //live




$payment_made = 0;
$payment_success_message = "";
$payment_success_display = "none";

$payment_error_display 	= "none";
$payment_error_message 	= "";

$pricing_plans 			= [0, 2995, 5995, 7995, 9995, 10995, 12995, 14995, 16995];
$pricing_plans_hours 	= [0, "1-5", "6-10", "11-25", "26-50", "51-75", "76-250", "251-500", "501-1000"];
$pricing_plans_hours_2 	= [0, 5, 10, 25, 50, 75, 250, 500, 1000];


function OrderComunityService(){

	global $pricing_plans;
	global $pricing_plans_hours;
	global $pricing_plans_hours_2;
	global $payment_made;

	global $payment_success_message;
	global $payment_success_display;
	global $payment_error_display;
	global $payment_error_message;
	
	global $user_id;
	global $mysqli_link;

	if(isset($_POST['stripeToken']) && isset($_GET['pp']) && $_GET['pp'] != ""){

	    $token = $_POST['stripeToken'];

        $pricing_plan = intval(check_input($_GET['pp']));
        
        if($pricing_plan > 0 && $pricing_plan < 9){

		    try {

	        	$hours 			= $pricing_plans_hours_2[$pricing_plan];
	        	$payment_amount = $pricing_plans[$pricing_plan];
	        	$pricing_hours 	= $pricing_plans_hours[$pricing_plan];

		        $charge = \Stripe\Charge::create([
		            'amount' 		=> $payment_amount,
		            'currency' 		=> "USD",
		            'description' 	=> "$pricing_hours Hours of Community Service",
		            'source' 		=> $token,
		        ]);

		        $payment_amount_value = ($payment_amount / 100);

	            $query = "INSERT INTO user_subsciptions(unique_id, user_id, pricing_plan, hours, payment_amount, payment_date) 
	                      				VALUES(UUID(), $user_id, $pricing_plan, $hours, $payment_amount_value, NOW())";
	            
	            QueryInsert($query);

				SavePaymentInDB($user_id, $payment_amount_value, "community service");

	            $payment_success_message = "<b>$pricing_hours hours</b> of community service is successfully activated";
	            $payment_success_display = "block";

	            $hours_seconds = $hours * 3600;

	            $query = "UPDATE users
	            			 SET hours_available = hours_available + $hours_seconds
	            		   WHERE id = $user_id";

	            QueryInsert($query);

		        return $pricing_plan;

		    } catch(\Stripe\Error\Card $e) {
				// Since it's a decline, \Stripe\Error\Card will be caught

				$body = $e->getJsonBody();
				$err  = $body['error'];

				$payment_error_message = $err['message'];
				$payment_error_display = 'block';

		    } catch (\Stripe\Error\RateLimit $e) {
		      // Too many requests made to the API too quickly

		      	$body = $e->getJsonBody();
		      	$err  = $body['error'];
		     
		      	$payment_error_message = $err['message'];
				$payment_error_display = 'block';
		      
		    } catch (\Stripe\Error\InvalidRequest $e) {
		      // Invalid parameters were supplied to Stripe's API

		      	$body = $e->getJsonBody();
		      	$err  = $body['error'];

		      	$payment_error_message = $err['message'];
				$payment_error_display = 'block';

		    } catch (\Stripe\Error\Authentication $e) {
		      // Authentication with Stripe's API failed (maybe you changed API keys recently)
		      
		      	$body = $e->getJsonBody();
		      	$err  = $body['error'];
		      
		      	$payment_error_message = $err['message'];
				$payment_error_display = 'block';
		      
		    } catch (\Stripe\Error\ApiConnection $e) {
		      // Network communication with Stripe failed

		      	$body = $e->getJsonBody();
		      	$err  = $body['error'];
		      
		      	$payment_error_message = $err['message'];
				$payment_error_display = 'block';
		      
		    } catch (\Stripe\Error\Base $e) {
		      // Display a very generic error to the user, and maybe send yourself an email
		      
		      	$body = $e->getJsonBody();
		      	$err  = $body['error'];

		      	$payment_error_message = $err['message'];
				$payment_error_display = 'block';
		      
		    } catch (Exception $e) {
		      // Something else happened, completely unrelated to Stripe
		    	$payment_error_message = "Something went wrong. Try again.";
				$payment_error_display = 'block';
		    }
		}
	    
	}

	return 0;
}




function OrderJoinEvent(){

	global $payment_made;

	global $payment_success_message;
	global $payment_success_display;
	global $payment_error_display;
	global $payment_error_message;

	global $user_id;
	global $mysqli_link;

	global $event_id;
	global $date;
	global $time;

	if( isset($_POST['stripeToken']) && 
		isset($_GET['id']) && $_GET['id'] != "" && 
		isset($_GET['d'])  && $_GET['d']  != "" && 
		isset($_GET['t'])  && $_GET['t']  != ""){

	    $token = $_POST['stripeToken'];

        $time 	  = check_input($_GET['t']);
		$date 	  = check_input($_GET['d']);
		$event_id = check_input($_GET['id']);

		if(UserSignedUpOnEvent($event_id, $user_id)){

			$payment_error_message = "You are already signed up for this event.";
			$payment_error_display = 'block';

			return 0;
		}	

		$query = "SELECT title, price FROM scheduled_events WHERE id = $event_id";

		$rows = QuerySelect($query);

		if(count($rows) == 0){

			$payment_error_message = "This event does not exists";
			$payment_error_display = 'block';

			return 0;
		}

		$event_title = $rows[0]["title"];
		$event_price = round(floatval($rows[0]["price"]) * 1.03, 2);

	    try {

	        $charge = \Stripe\Charge::create([
	            'amount' 		=> str_replace('.', "", strval($event_price)),
	            'currency' 		=> "USD",
	            'description' 	=> "Signup for $event_title",
	            'source' 		=> $token,
	        ]);

            $query = "INSERT INTO scheduled_events_users (scheduled_event_id, user_id, signed_datetime, start_date, start_time)
										 VALUES($event_id, $user_id, NOW(), '$date', '$time')";

			$rows = QueryInsert($query);

			$date = last_monday($date);

			SavePaymentInDB($user_id, $event_price, "counseling");

			if($rows){

				$query = "UPDATE scheduled_events
							 SET users_aplied = users_aplied + 1
						   WHERE id = $event_id";

				QueryInsert($query);

				UpdateEventStatusIfFull($event_id);

				SendEmailForJoinEvent($user_id, $event_price);
			}

            $payment_success_display = "block";

	        return 1;

	    } catch(\Stripe\Error\Card $e) {
			// Since it's a decline, \Stripe\Error\Card will be caught

			$body = $e->getJsonBody();
			$err  = $body['error'];

			$payment_error_message = $err['message'];
			$payment_error_display = 'block';

	    } catch (\Stripe\Error\RateLimit $e) {
	      // Too many requests made to the API too quickly

	      	$body = $e->getJsonBody();
	      	$err  = $body['error'];
	     
	      	$payment_error_message = $err['message'];
			$payment_error_display = 'block';
	      
	    } catch (\Stripe\Error\InvalidRequest $e) {
	      // Invalid parameters were supplied to Stripe's API

	      	$body = $e->getJsonBody();
	      	$err  = $body['error'];

	      	$payment_error_message = $err['message'];
			$payment_error_display = 'block';

	    } catch (\Stripe\Error\Authentication $e) {
	      // Authentication with Stripe's API failed (maybe you changed API keys recently)
	      
	      	$body = $e->getJsonBody();
	      	$err  = $body['error'];
	      
	      	$payment_error_message = $err['message'];
			$payment_error_display = 'block';
	      
	    } catch (\Stripe\Error\ApiConnection $e) {
	      // Network communication with Stripe failed

	      	$body = $e->getJsonBody();
	      	$err  = $body['error'];
	      
	      	$payment_error_message = $err['message'];
			$payment_error_display = 'block';
	      
	    } catch (\Stripe\Error\Base $e) {
	      // Display a very generic error to the user, and maybe send yourself an email
	      
	      	$body = $e->getJsonBody();
	      	$err  = $body['error'];

	      	$payment_error_message = $err['message'];
			$payment_error_display = 'block';
	      
	    } catch (Exception $e) {
	      // Something else happened, completely unrelated to Stripe
	    		$payment_error_message = "Something went wrong. Try again.";
			$payment_error_display = 'block';
	    }
	    
	}

	return 0;
}



function SubmitDonation(){

	global $payment_made;

	global $payment_success_message;
	global $payment_success_display;
	global $payment_error_display;
	global $payment_error_message;

	global $mysqli_link;


	if( isset($_POST['stripeToken']) && 
		isset($_GET['duid']) && $_GET['duid'] != "" && 
		isset($_GET['da'])   && $_GET['da']   != ""){

	    $token = $_POST['stripeToken'];

		$donation_unique_id = check_input($_GET["duid"]);
        $donation_amount    = intval(check_input($_GET["da"]));

		$query = "SELECT id, donation_name FROM donations WHERE unique_id = '$donation_unique_id'";

		$rows = QuerySelect($query);

		if(count($rows) == 0){

			$payment_error_message = "This donation does not exists";
			$payment_error_display = 'block';

			return 0;
		}

		$donation_id   = $rows[0]["id"];
		$donation_name = $rows[0]["donation_name"];

	    try {

	        $charge = \Stripe\Charge::create([
	            'amount' 		=> $donation_amount * 100,
	            'currency' 		=> "USD",
	            'description' 	=> "Donation for \"$donation_name\"",
	            'source' 		=> $token,
	        ]);

        	$user_id = 0;

        	if(isLogedIn() != false)
        		$user_id = $_SESSION["user_id"];


			SavePaymentInDB($user_id, $donation_amount, $donation_name, $donation_id);

	        $payment_success_message =  "You have successfully donated <b>\$$donation_amount</b> to <b>$donation_name</b>. <br /><br />";
	        $payment_success_message .= "Thank you for your donation.";

        	$payment_success_display = "block";

        	if($user_id != 0){

        		$email = GetFieldFromTable("users", "email", $user_id);

	            $email_subject = "Oakland Assistance Chapter - Thank you for donating";

	            $email_text =  "Thank you for donating to one of our programs. Your contribution helps tremendously. <br /><br />";
	            $email_text .= "A receipt will be sent shortly from Oakland Assistance for your records. EIN # 80-0946765<br /><br />";
	            $email_text .= "The Oakland Assistance Chapter Team";

	            SendEmail($email_subject, $email_text, 'noreply@oaklandassistance.net', $email);
	        }

        	return 1;

	    } catch(\Stripe\Error\Card $e) {
			// Since it's a decline, \Stripe\Error\Card will be caught

			$body = $e->getJsonBody();
			$err  = $body['error'];

			$payment_error_message = $err['message'];
			$payment_error_display = 'block';

	    } catch (\Stripe\Error\RateLimit $e) {
	      // Too many requests made to the API too quickly

	      	$body = $e->getJsonBody();
	      	$err  = $body['error'];
	     
	      	$payment_error_message = $err['message'];
			$payment_error_display = 'block';
	      
	    } catch (\Stripe\Error\InvalidRequest $e) {
	      // Invalid parameters were supplied to Stripe's API

	      	$body = $e->getJsonBody();
	      	$err  = $body['error'];

	      	$payment_error_message = $err['message'];
			$payment_error_display = 'block';

	    } catch (\Stripe\Error\Authentication $e) {
	      // Authentication with Stripe's API failed (maybe you changed API keys recently)
	      
	      	$body = $e->getJsonBody();
	      	$err  = $body['error'];
	      
	      	$payment_error_message = $err['message'];
			$payment_error_display = 'block';
	      
	    } catch (\Stripe\Error\ApiConnection $e) {
	      // Network communication with Stripe failed

	      	$body = $e->getJsonBody();
	      	$err  = $body['error'];
	      
	      	$payment_error_message = $err['message'];
			$payment_error_display = 'block';
	      
	    } catch (\Stripe\Error\Base $e) {
	      // Display a very generic error to the user, and maybe send yourself an email
	      
	      	$body = $e->getJsonBody();
	      	$err  = $body['error'];

	      	$payment_error_message = $err['message'];
			$payment_error_display = 'block';
	      
	    } catch (Exception $e) {
	      // Something else happened, completely unrelated to Stripe
	    		$payment_error_message = "Something went wrong. Try again.";
			$payment_error_display = 'block';
	    }
	    
	}

	return 0;
}



function SendEmailForJoinEvent($user_id, $payment_amount){

	$query = "SELECT CONCAT(first_name, ' ', last_name) AS username, email FROM users WHERE id = $user_id";

	$rows = QuerySelect($query);

	$username = $rows[0]["username"];
	$email 	  = $rows[0]["email"];

	$subject = "Congratulations on your step forward in self help.";

	$message = "Hi $username <br /><br />";
	$message .= "Congratulations on your step forward in self help. <br />";
	$message .= "Payment received in the amount of $" . $payment_amount . " has been successfully processed. <br />";
	$message .= "Please look out for an email within 24 hours from our counseling team with your “invite” instructions for your requested session date and time.";
	$message .= "<br /><br />Best of Luck!";

	$message .= "<br /><br />info@oaklandassistance.net – 248-291-8925 local/866-290-8294 toll free";

	SendEmail($subject, $message, "noreply@oaklandassistance.net", $email);
	SendEmail($email_subject, $message, "noreply@oaklandassistance.net", "matt@oaklandassistance.net");
	SendEmail($email_subject, $message, "noreply@oaklandassistance.net", "meghan@oaklandassistance.net");
}





function PrintError($e, $err){
    
      echo('Status is:' . $e->getHttpStatus() . "<br />");
      echo('Type is:' . $err['type'] . "<br />");
      echo('Code is:' . $err['code'] . "<br />");
      echo('Param is:' . $err['param'] . "<br />");
      echo('Message is:' . $err['message'] . "<br />");
}



function GetOrderPricingPlanStripeButton($pk_key, $pricing_plan){

	global $pricing_plans;
	global $pricing_plans_hours;
	global $pricing_plans_hours_2;

    $html = '<form action="./?pp=' . $pricing_plan . '" method="POST" style="">
				<script
					src="https://checkout.stripe.com/checkout.js" class="stripe-button"
					data-key="' . $pk_key . '"
					data-amount="' . $pricing_plans[$pricing_plan] . '"
					data-name="OaklandAssistanceChapter"
					data-currency="USD"
					data-description="' . $pricing_plans_hours[$pricing_plan] . ' Hours of Community Service"
					data-label="Order Now">
				</script>
            </form>';

    return $html;
}


function SavePaymentInDB($user_id, $payment_amount, $payment_order, $donation_id = 0){

	$query = "INSERT INTO all_payments(user_id, payment_amount, payment_order, date_time, donation_id)
				VALUES($user_id, $payment_amount, '$payment_order', NOW(), $donation_id)";

	QueryInsert($query);
}


?>
