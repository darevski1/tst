<?php session_start();?>
<?php

require_once '../includes/db.php';
require_once '../includes/config.php';
require_once '../includes/generators.php';

require_once('../includes/stripe/old/vendor/autoload.php');
require_once '../includes/stripe_payments.php';

ConnectToDatabase();

if (isset($_GET['uid']) && $_GET['uid'] != "") {

    $static_page_unique_id = check_input($_GET['uid']);

    $static_page_id = GetID_FromUniqueID($static_page_unique_id, "static_pages");

    if($static_page_id == 0)
        exit("");
    
    $query = "SELECT content, page_title, page_name FROM static_pages WHERE id = $static_page_id";

    $rows = QuerySelect($query);

    $content    = $rows[0]["content"];
    $page_title = $rows[0]["page_title"];
    $page_name  = $rows[0]["page_name"];

    $donation_content = "";

    $rows = GetDonationsDB("", $static_page_id);

    if(count($rows) > 0)
        $donation_content = GenerateDonationContent($rows[0], $static_page_unique_id);


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

} else {
    exit("");
}


?>
<!DOCTYPE html>
<html lang="en">
<?=getHeader($page_name);?>

<body>
    <?=GetHead();?>
    <?=getNavbar();?>
    <div class="section-2 ">
        <div class="container">
            <div class="col-sm-12 text-center d-flex justify-content-center align-items-center flex-column">
                <div class="col-sm-12 text-center mb-4">
                    <img src="./../assets/images/logo_oaklend.png" alt="logo oaklend" class="mb-3">
                </div>
                <h4 class="display-6 mb-2 w-75"> <?=$page_title?>
                </h4>
            </div>
            <div class="col-sm-12 mb-5">
                <div class="big_p mt-4">
                    <?=$content?>
                </div>
            </div>
            <div class="col-sm-12 mt-5">
                <div class="">
                    <?=$donation_content?>
                </div>
            </div>
        </div>
    </div>
    <?=getFooter();?>

        <?=PopUpButtons();?>

        <?php if($donation_name != ""){ ?>
            <form   action="./?uid=<?=$static_page_unique_id?>&duid=<?=$donation_unique_id?>&da=<?=$donation_amount?>" 
                    method="POST" id="stripe_form" style="display: none" >
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

    page_unique_id = '<?=$static_page_unique_id?>';

    if(donation_name != ""){

        window.history.replaceState({}, document.title, "/page/?uid=" + page_unique_id);
        // window.history.replaceState({}, document.title, "/lawyer/page/?uid=" + page_unique_id);
        
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