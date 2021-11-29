<?php session_start();?>
<?php

    require_once '../includes/db.php';
    require_once '../includes/config.php';
    require_once '../includes/generators.php';

    require_once('../includes/stripe/old/vendor/autoload.php');
    require_once '../includes/stripe_payments.php';

    ConnectToDatabase();
    $values = GetPageTextValues(5);

    $display_stripe_image = "none !important";

    $loged_in = isLogedIn();

    $user_id = 0;

    if($loged_in){
        $user_id = $_SESSION["user_id"];
        $display_stripe_image = "flex";
    }

    
    $pricing_plan = OrderComunityService();

?>
<!DOCTYPE html>
<html lang="en">
<?=getHeader("Pricing Our Guarantee");?>

<body>
    <?=GetHead();?>
    <?=getNavbar();?>

    <main class="pricing-h d-flex justify-content-center align-items-center" style="min-height: auto;">
        <div class="pricing-header">
            <h1 class="display-4 text-center bold"><?=$values[0]?> <br>
                <small class="text-white"><?=$values[1]?></small>
            </h1>
            <p class="h3 text-black-50 mb-5"><?=$values[2]?></p>
        </div>
    </main>

    <div class="pricing-plans p-4">
        <div class="container mb-5">
            
            <div class="col-sm-12 d-flex flex-column justify-content-end align-items-end" style="display: <?=$display_stripe_image?>">
                <p class="mr"><b>Powered by</b></p>
                <img src="../includes/stripe/old/stripe.png" class="img-stripe mb-2"/>
            </div>
            
            <?php

                if($loged_in)
                    include("pricing_plans_stripe.php");
                else
                    include("pricing_plans.php");

            ?>

        </div>
    </div>



    <div class="pricing d-flex align-items-center mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h3 class="display-6 bold mt-4"><?=$values[3]?></h3>
                    <ul class="list_price">
                        <li>
                            <i class="fas fa-check "></i> <?=$values[4]?>
                        </li>
                        <li>
                            <i class="fas fa-check"></i> <?=$values[5]?>
                        </li>
                        <li>
                            <i class="fas fa-check"></i> <?=$values[6]?>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center">
                    <h2 class="bold hbs"><?=$values[7]?></h2>
                    <div class="col-sm-12 text-center">
                        <a href="./login" type="button" class="btn black_btn mt-4 w-300 btn-lg">Sign up to get started</a>
                    </div>
                    <img src="./../assets/images/logo_oaklend.png" alt="logo oaklend" class="mt-5">
                </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

    <?=getFooter();?>


    <?=PopUpButtons();?>

</body>
<?=getBottomScripts();?>

<script type="text/javascript">
        

    payment_success_message = "<?=$payment_success_message?>";
    payment_success_display = "<?=$payment_success_display?>";

    payment_error_display   = "<?=$payment_error_display?>";
    payment_error_message   = "<?=$payment_error_message?>";

    if(payment_error_display == "block")
        PopUpMessage(payment_error_message);

    if(payment_success_display == "block")
        PopUpMessageSuccess(payment_success_message);
    
    

</script>

</html>