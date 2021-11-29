<?php session_start();?>
<?php

    require_once('../includes/db.php');
    require_once('../includes/config.php');
    require_once('../includes/generators.php');

    ConnectToDatabase();


$loged_in = isLogedIn();

$error_display = "none";
$error_message = "";
$success_display = "none";
$success_message = "";

if($loged_in){
    ?>
        <script type="text/javascript">
            window.location.replace("../");
        </script>
    <?php
}else{
    if(isset($_POST["email"]) && $_POST["email"] != ''){

        $email = check_input($_POST['email']);

        $token = checkEmailRecoverPassword($email);

        if($token != 0 && $token != 1){

            $query = "SELECT first_name FROM users WHERE email = '$email'";

            $rows = QuerySelect($query);

            $first_name = $rows[0]['first_name'];

            $message  = "Hello $first_name <br /><br />To recover your password click here: ";
            $message .= '<a href="https://oaklandassistance.net/reset/?token=' . $token . '">https://oaklandassistance.net/reset/?token=' . $token . '</a>';

            $subject = "Recover Password - Oakland Assistance Chapter";

            $email_sent = SendEmail($subject, $message, 'noreply@oaklandassistance.net', $email);
            
            if($email_sent)  
                $success_message = "Successfully generated recovery password <br /><br /> Check your email to complete this action.";
            else
                $error_message = 'The email was not sent successfully to you. <br />Try again.';

        }else if($token == 1)
                $error_message = "Something went wrong. Our team will see what is the problem";
              else              
                $error_message = "This email does not exists in our database";
    }
    
    if($error_message != '')
        $error_display = 'block';
    
    if($success_message != '')
        $success_display = 'block';
}
?>


<!DOCTYPE html>
<html lang="en">
<?=getHeader("Forgot Password");?>

<body>
    <?=GetHead();?>
    <?=getNavbar();?>
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <main class="form-signin mt-5">
                    <form action="./" method="POST" onsubmit="return ForgotPasswordCheck()">

                        <h1 class="h3 mb-3 text-center">Reset your password! </h1>
                        <p>Enter your email address and we will send you a link to reset your password..</p>
                        <div class="form-group">
                            <label for="inputEmail">Email address</label>
                            <input type="email" id="email" name="email" class="form-control" required autofocus>
                        </div>

                        <div class="alert alert-danger mt-5" role="alert" style="display: <?= $error_display?>; margin-bottom: 0px;" id="error_message">
                            <?=$error_message?>
                        </div>
                        <div class="alert alert-success mt-5" role="alert" style="display: <?= $success_display?>; margin-bottom: 0px;" id="success_message" >
                            <?=$success_message?>
                        </div>
                        
                        <button class="w-100 btn mt-5 black_btn" type="submit">Send</button>
                    </form>

                    <div class="text-center mt-5">
                        <div><a href="../login" class="links">Sign in </a></div>
                    </div>
                </main>
            </div>
        </div>
    </div>


    <?=getFooter();?>
</body>
<?=getBottomScripts();?>

</html>