<?php session_start();?>
<?php

require_once('../includes/db.php');
require_once('../includes/config.php');
require_once('../includes/generators.php');


ConnectToDatabase();


$display_error = "none";
$error_message = "";
$display_success = "none";
$success_message = "";

    if(isset($_GET['uid']) && $_GET["uid"] != ""){
        
        $unique_id = check_input($_GET['uid']);
        $query = "SELECT status FROM users WHERE unique_id = '" . $unique_id . "';";
        $rows = QuerySelect($query);
        
        if(count($rows)==1){
            $confirmed = $rows[0]["status"];
            
            if($confirmed == 'not confirmed'){
                    
                    $query = "UPDATE users SET status = 'confirmed' WHERE unique_id = '" . $unique_id . "';";
                                        
                    $rows = QueryInsert($query);
                    
                    if($rows)
                        $success_message  = "You have successfully confirmed your email. <br />Your account is now active and ready to use.";       
                    else
                        $error_message = "We have encountered an error. <br />Our team will see what is the problem.";
                    
            }else
                $success_message = "Your account is already activated.";
            
        }else
            $error_message = "Invalid link.";
        
    }else
        $error_message = "Invalid link.";



    
    if($error_message != '')
        $display_error = 'block';
    
    if($success_message != '')
        $display_success = 'block'; 

?>


<!DOCTYPE html>
<html lang="en">
<?=getHeader("Confirm Email");?>

<body>
    <?=GetHead();?>
    <?=getNavbar();?>
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <main class="form-signin mt-5">
                    <form onsubmit="return ForgotPasswordCheck()">

                        <h1 class="h3 mb-3 text-center">Email Confirmation </h1>
                        <!-- <p>Enter your email address and we will send you a link to reset your password..</p> -->

                        <div class="alert alert-danger mt-5" role="alert" style="display: <?= $display_error?>;" id="error_message">
                            <?=$error_message?>
                        </div>
                        <div class="alert alert-success mt-5" role="alert" style="display: <?= $display_success?>" id="success_message" >
                            <?=$success_message?>
                        </div>


                        <a class="w-100 btn mt-5 black_btn" type="button" href="../login">Sign in</a>
                    </form><!-- 

                    <div class="text-center mt-5">
                        <div><a href="../login" class="links">Sign in </a></div>
                    </div> -->
                </main>
            </div>
        </div>
    </div>


    <?=getFooter();?>
</body>
<?=getBottomScripts();?>

</html>


