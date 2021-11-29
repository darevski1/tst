<?php session_start();?>
<?php

require_once '../includes/db.php';
require_once '../includes/config.php';
require_once '../includes/generators.php';

require_once('../includes/stripe/old/vendor/autoload.php');
require_once '../includes/stripe_payments.php';


ConnectToDatabase();
    
    $donation_unique_id = "";
    $donation_amount    = "";
    $donation_name      = "";

    if( isset($_GET["duid"]) && $_GET["duid"] != "" && 
        isset($_GET["da"])   && $_GET["da"]   != ""){

        $donation_unique_id = check_input($_GET["duid"]);
        $donation_amount    = check_input($_GET["da"]);

        $query = "SELECT donation_name FROM donations WHERE unique_id = '$donation_unique_id'";

        $rows = QuerySelect($query);

        if(count($rows) > 0)
            $donation_name = $rows[0]["donation_name"];

        if($donation_name != "")
            SubmitDonation();
    }

?>

<!DOCTYPE html>
<html lang="en">
    <?=getHeader("Donations");?>

    <body>
        <?=GetHead();?>
        <?=getNavbar();?>

        <?=GetAllDonationsContent()?>
        
        <?=getFooter();?>

        <?=PopUpButtons();?>

        <?php if($donation_name != ""){ ?>
            <form action="./?duid=<?=$donation_unique_id?>&da=<?=$donation_amount?>" method="POST" id="stripe_form" style="display: none" >
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="<?=$pk_key?>"
                    data-amount=""
                    data-name="<?=$donation_name?> - $<?=$donation_amount?>"
                    data-currency="USD"
                    data-label="<?=$donation_name?> - $<?=$donation_amount?>">
                </script>
            </form>
        <?php } ?>


        <a href="#" id="submit_link" style="display:none;"></a>
    </body>
    
    <?=getBottomScripts();?>


<script type="text/javascript">

    function SubmitStripeButton(){

        var x = document.getElementsByClassName("stripe-button-el");

        if(x.length > 0)
            x[0].click();
        else
            setTimeout(function(){
                SubmitStripeButton();          
            }, (500));
    }

    donation_name = "<?=$donation_name?>";

    if(donation_name != ""){

        window.history.replaceState({}, document.title, "/donations/");
        // window.history.replaceState({}, document.title, "/lawyer/donations/");
        
        payment_success_message = "<?=$payment_success_message?>";
        payment_success_display = "<?=$payment_success_display?>";

        payment_error_display   = "<?=$payment_error_display?>";
        payment_error_message   = "<?=$payment_error_message?>";

        if(payment_error_display == "block")
            PopUpMessage(payment_error_message);

        if(payment_success_display == "block")
            PopUpMessageSuccess(payment_success_message);

        if(payment_error_display == "none" && payment_success_display == "none")
            SubmitStripeButton()
    }


</script>
</html>