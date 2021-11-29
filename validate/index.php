<?php session_start();?>
<?php

require_once '../includes/db.php';
require_once '../includes/config.php';
require_once '../includes/generators.php';

ConnectToDatabase();

$code = "";

if(isset($_GET['code']) && $_GET['code'] != "")
    $code = check_input($_GET['code']);



?>

<!DOCTYPE html>
<html lang="en">
<?=getHeader("Validate Document");?>

<body>
    <?=GetHead();?>
    <?=getNavbar();?>
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <main class="form-signin mt-5">
                    <form>

                        <h1 class="h3 mb-3 text-center">Documents Validation </h1>
                        <p>Enter the Verification Code and see if document with that Verification Code exists </p>
                        <div class="form-group">
                            <label for="inputEmail">Enter code:</label>
                            <input type="text" id="validate" name="validate" class="form-control" required autofocus>
                        </div>

                        <div class="alert alert-danger mt-4"  role="alert" style="display: none; margin-bottom: 0px;" id="error_message"> </div>
                        <div class="alert alert-success mt-4" role="alert" style="display: none; margin-bottom: 0px;" id="success_message"> </div>

                    <div class="text-center mt-4">
                        <p id="result_text" style="display: none">Varnish is free software licensed under a two-clause BSD licence, also known as the FreeBSD
                            license. The project was initiated in 2005. Varnish Cache 1.0 was released in september
                            2006.</p>
                    </div>
                        <button class="w-100 btn mt-1 black_btn" type="button" onclick="ValidateCode()">Check</button>
                    </form>

                </main>
            </div>
        </div>
    </div>

    <?=getFooter();?>
</body>
<?=getBottomScripts();?>

<script type="text/javascript">
        
    code = '<?=$code?>';

    if(code != ""){

        $("#validate").val(code)

        window.history.replaceState({}, document.title, "/validate/");
        // window.history.replaceState({}, document.title, "/lawyer/validate/");


ValidateCode()

    }

</script>

</html>