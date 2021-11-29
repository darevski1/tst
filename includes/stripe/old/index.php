<?php
require_once('./vendor/autoload.php');


\Stripe\Stripe::setApiKey("sk_test_VtgzLovLlicgVEiw6azet3JA"); //darko
// \Stripe\Stripe::setApiKey("sk_test_NwuburEyqel9kol5Q9vjF2sO"); //test


$pk_key = 'pk_test_6jQViFNn6p1XoE237ogCiacp'; //darko
// $pk_key = 'pk_test_ZzlSi5Q6g2B0rwL0k315gHZG'; //test






if(isset($_POST['stripeToken'])){
	$token = $_POST['stripeToken'];

	try {
		 $charge = \Stripe\Charge::create([
			'amount' => 7500,
			'currency' => 'USD',
			'description' => 'Renovation estimate $75 ',
			'source' => $token,
		]);
		//echo gettype($charge) . "<br />";
		
		//echo $charge->id . "<br />";
//		echo $charge->amount . "<br />";
//		echo $charge->balance_transaction . "<br />";
//		echo $charge->source->exp_month . "<br />";
//		echo $charge->source->exp_year . "<br />";
//		echo $charge->source->brand . "<br />";
//		echo $charge->source->country . "<br />";
//		echo $charge->source->address_zip . "<br />";
//		echo $charge->source->address_country . "<br />";
//		echo $charge->source->address_line1 . "<br />";
//		echo $charge->source->address_line1_check . "<br />";
//		echo $charge->source->address_zip . "<br />";
//		echo $charge->source->address_zip_check . "<br />";
//		echo $charge->source->address_city . "<br />";
//		echo $charge->source->name . "<br />";
		
		$success = 1;
		$message = 'Successfull payment';
		
		// $query = "	INSERT INTO completed_transactions (id, quote_id, survey_id, amount, payment_method, date_time)	
		// 							VALUES(NULL, " . $quote_id . ", " . $survey_id . ", " . $rows2[0]['price'] . ", 'Stripe', NOW());";
		// QueryInsert($query);
		
		// $new_completed_transaction_id = $mysqli_link->insert_id;
		
		
		// $query = "	INSERT INTO completed_transaction_details (id, completed_transaction_id, address_city, address_country, address_line1, 
		// 														address_line1_check, address_zip, address_zip_check, cc_country, customer_name, exp_month, exp_year, brand)	
		// 							VALUES(NULL, " . $new_completed_transaction_id . ", '" . $charge->source->address_city . "', '" . $charge->source->address_country . "'
		// 							, '" . $charge->source->address_line1 . "', '" . $charge->source->address_line1_check . "', '" . $charge->source->address_zip . "'
		// 							, '" . $charge->source->address_zip_check . "', '" . $charge->source->country . "', '" . $charge->source->name . "'
		// 							, '" . $charge->source->exp_month . "', '" . $charge->source->exp_year . "', '" . $charge->source->brand . "');";
		// QueryInsert($query);
		

		
				
		// print_r($charge);

		// $charge_array = json_decode($charge, true);

		// echo "<pre>" . print_r($charge, true) . "</pre>";
				
	} catch(\Stripe\Error\Card $e) {
	  // Since it's a decline, \Stripe\Error\Card will be caught

	  $body = $e->getJsonBody();
	  $err  = $body['error'];
	  
	  // PrintError($e, $err);
	  $message = $err['message'];
	} catch (\Stripe\Error\RateLimit $e) {
	  // Too many requests made to the API too quickly

	  $body = $e->getJsonBody();
	  $err  = $body['error'];
	  
	  // PrintError($e, $err);
	  $message = $err['message'];
	  
	} catch (\Stripe\Error\InvalidRequest $e) {
	  // Invalid parameters were supplied to Stripe's API

	   $body = $e->getJsonBody();
	  $err  = $body['error'];
	
	  // PrintError($e, $err);

	  $message = $err['message'];
	} catch (\Stripe\Error\Authentication $e) {
	  // Authentication with Stripe's API failed (maybe you changed API keys recently)
	  
	  $body = $e->getJsonBody();
	  $err  = $body['error'];
	  
	  // PrintError($e, $err);
	  $message = $err['message'];
	  
	} catch (\Stripe\Error\ApiConnection $e) {
	  // Network communication with Stripe failed

	  $body = $e->getJsonBody();
	  $err  = $body['error'];
	  
	  // PrintError($e, $err);
	  $message = $err['message'];
	  
	} catch (\Stripe\Error\Base $e) {
	  // Display a very generic error to the user, and maybe send yourself an email
	  
	  $body = $e->getJsonBody();
	  $err  = $body['error'];
	  
	  // PrintError($e, $err);

	  $message = $err['message'];
	  
	} catch (Exception $e) {
	  // Something else happened, completely unrelated to Stripe
	}
	
}





function PrintError($e, $err){


	
	  echo('Status is:' . $e->getHttpStatus() . "<br />");
	  echo('Type is:' . $err['type'] . "<br />");
	  echo('Code is:' . $err['code'] . "<br />");
	  // param is '' in this case
	  echo('Param is:' . $err['param'] . "<br />");
	  echo('Message is:' . $err['message'] . "<br />");
}

?>


<!-- 
<div id="payment_div" >
            <img src="./stripe.png" style="width:200px; float:left">
                      
                      
            
            <form action="./" method="POST" style="position:relative; top:20px">
              <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="<?= $pk_key;?>"
                
                data-name="Renovation Estimate"
                data-description="Order Renovation Estimate"
                data-amount="7500"
                data-label="Sign Me Up!">
              </script>
            </form>
            
            
            
            </div>   

 -->

            <img src="./stripe.png" style="width:200px; float:left">
                <form action="./" method="POST" style="position:relative; top:20px">
				  <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
					data-key="<?= $pk_key;?>"
					data-amount="7500"
					data-name="ziprenovation"
					data-currency="USD"
					data-description="Renovation Estimate $75"
                	data-label="Renovation Estimate $75">
                  </script>
                </form>
        








