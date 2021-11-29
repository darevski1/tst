<?php session_start();?>
<?php

require_once '../includes/db.php';
require_once '../includes/config.php';
require_once '../includes/generators.php';

ConnectToDatabase();

$table = 'users';
$user_id = 'user_id';

$loged_in = isLogedIn($table, $user_id);

$display_error = "none";
$error_message = "";
$display_success = "none";
$succes_message = "";

if ($loged_in) {
    ?>
        <script type="text/javascript">
            window.location.replace("../profile");
        </script>
    <?php
    exit();
}

if (isset($_POST["first_name"])     && $_POST["first_name"] != "" &&
    isset($_POST["last_name"])      && $_POST["last_name"] != "" &&
    isset($_POST["street_adress"])  && $_POST["street_adress"] != "" &&
    isset($_POST["city"])           && $_POST["city"] != "" &&
    isset($_POST["country"])        && $_POST["country"] != "" &&
    isset($_POST["zip_code"])       && $_POST["zip_code"] != "" &&
    isset($_POST["gender"])         &&
    isset($_POST["birth_month"])    && $_POST["birth_month"] != "" &&
    isset($_POST["birth_day"])      && $_POST["birth_day"] != "" &&
    isset($_POST["birth_year"])     && $_POST["birth_year"] != "" &&
    isset($_POST["probation_officer"]) &&
    isset($_POST["court_id"])       &&
    isset($_POST["hours_need"])     && 
    isset($_POST["reason"])         && 
    isset($_POST["email"])          && $_POST["email"] != "" &&
    isset($_POST["password"])       && $_POST["password"] != "") {


    $first_name     = check_input($_POST['first_name']);
    $last_name      = check_input($_POST['last_name']);
    $street_adress  = check_input($_POST['street_adress']);
    $city           = check_input($_POST['city']);
    $country_id     = check_input($_POST['country']);
    $zip_code       = check_input($_POST['zip_code']);
    $gender         = check_input($_POST['gender']);
    $birth_month    = check_input($_POST['birth_month']);
    $birth_day      = check_input($_POST['birth_day']);
    $birth_year     = check_input($_POST['birth_year']);
    $probation      = check_input($_POST['probation_officer']);
    $court_id       = check_input($_POST['court_id']);
    $hours_need     = check_input($_POST['hours_need']);
    $reason         = check_input($_POST['reason']);
    $email          = check_input($_POST['email']);
    $pass           = check_input($_POST['password']);

    $password = GenerateHashedString($pass, '1756');

    $state_id = 0;
    $state = '';
    if(isset($_POST['state'])){
        $state_id = check_input($_POST['state']);
        $state  = GetFieldFromTable('states', 'name', $state_id);
    }

    $country = GetFieldFromTable('country', 'printable_name', $country_id);


    if (intval(CheckIfEmailExists($email, $table)) > 0) {
        $display_error = "block";
        $error_message = "The email <b>$email</b> is already used";
    } else {

        if($hours_need == "")
            $hours_need = "NULL";
        else
            $hours_need *= 60 *60;

        $query = "INSERT INTO users(unique_id, first_name, last_name, street_adress, city, country, state, zip_code, gender, birth_month, birth_day, birth_year,
                                probation_officer, court_id, hours_need, reason, email, password, created_at, status, country_id, state_id)

                  VALUES(UUID(), '$first_name', '$last_name', '$street_adress', '$city', '$country', '$state', '$zip_code', '$gender', '$birth_month', '$birth_day', '$birth_year', '$probation', '$court_id', $hours_need, '$reason', '$email', '$password', NOW(), 'not confirmed', $country_id, $state_id)";

        $rows = QueryInsert($query);

        if($rows){

            $display_success = "block";

            $succes_message  = "Your profile registration was successfully completed.<br />";
            $succes_message .= "An email was just sent to " . $email . ".<br />Please click on the link to confirm your email address";

            $new_user_id = $mysqli_link->insert_id;

            $user_unique_id = GetUniqueID_FromID($new_user_id, 'users');

            $email_subject = "Oakland Assistance Chapter - Confirm registration";

            $email_text = "YOU'RE ALMOST THERE!<br /><br />";
            $email_text .= "Welcome to Oakland Assistance Chapter, " . $first_name . ". Before you get started, please verify your email address by clicking the link below.<br /><br />";
            $email_text .= "https://www.oaklandassistance.net/confirm/?uid=" . $user_unique_id . "<br /><br />";
            $email_text .= "If you cannot click the full URL above, please copy and paste it into your web browser.<br /><br />";
            $email_text .= "Thanks for connecting with us,<br /><br />";
            $email_text .= "The Oakland Assistance Chapter Team";

            SendEmail($email_subject, $email_text, 'noreply@oaklandassistance.net', $email);
        } else {
            $display_error = "block";
            $error_message = "Something went wrong. Try again";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<?=getHeader("Register");?>

<body>
    <?=GetHead();?>
    <?=getNavbar();?>
    <div class="container">
        <div class="col-sm-12">
            <main class="form-signup mt-5">

                <form action="./#form" method="post" onsubmit="return RegisterCheck();">
                    <h1 class="h3 mb-3 text-center">Create your Account</h1>
                    <div class="row">
                        <div class="col-sm-12">
                            <h6><b>Personal Information</b></h6>
                            <hr>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">First Name:</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" autofocus>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Last Name:</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" autofocus>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Street Address:</label>
                                <input type="text" name="street_adress" id="street_adress" class="form-control"
                                    autofocus>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">City:</label>
                                <input type="text" name="city" id="city" class="form-control" autofocus>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="country">Country:</label>
                                    <?=getContries();?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="state">State / Province:</label>
                                <select class="js-example-basic-single form-control" name="state" id="state" disabled="">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Zip / Postal Code:</label>
                                <input type="text" name="zip_code" id="zip_code" class="form-control" autofocus>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-1">
                            <div class="form-group">
                                <label for="inputEmail" style="margin-right: 15px">Gender:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="male"
                                        id="gender">
                                    <label class="form-check-label" for="gender">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="female"
                                        id="gender">
                                    <label class="form-check-label" for="gender">
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="name">Month:</label>
                                <select class="js-example-basic-single form-control" name="birth_month" id="month">
                                    <option value="0" disabled="" selected="">Select Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="name">Day:</label>
                                <select class="js-example-basic-single form-control" name="birth_day" id="day">
                                    <option value="0" disabled="" selected="">Select Day</option>
                                    <?php
                                        for($i = 1; $i <= 31; $i++)
                                            echo '<option value="' . $i . '">' . $i . '</option>'
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="name">YEAR:</label>
                                <select class="js-example-basic-single form-control" name="birth_year" id="year">
                                    <option value="0" disabled="" selected="">Select year</option>
                                    <?php
                                        $date = date('Y');
                                        for($i = $date; $i >= 1920; $i--)
                                            echo '<option value="' . $i . '">' . $i . '</option>'
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 mt-5">
                            <h6><b>Account Information</b></h6>
                            <hr>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Email:</label>
                                <input type="email" class="form-control" name="email" autofocus id="email">
                            </div>
                        </div>
                        <a href="#" id="form"></a>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Password:</label>
                                <input type="password" class="form-control" name="password" id="password" autofocus>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Retype Password:</label>
                                <input type="password" class="form-control" name="confirm_pass" id="confirm_pass"
                                    autofocus>
                            </div>
                        </div>



                        <div class="col-sm-12 mt-5">
                            <h6><b>Court Information (Optional)</b></h6>
                            <hr>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Probation Officer:</label>
                                <input type="text" class="form-control" name="probation_officer" id="probation_officer"
                                    autofocus>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Court ID/Docket Number:</label>
                                <input type="text" class="form-control" name="court_id" id="court_id" autofocus>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Hours Needed:</label>
                                <input type="text" class="form-control" name="hours_need" id="hours_need" autofocus onchange="limitIntegerReal(this, 0)">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputEmail">Reason for doing Community Service:</label>
                                <textarea class="form-control" cols="10" rows="5" name="reason" id="reason" style="height: unset !important"></textarea>
                            </div>
                        </div>

                        <div class="alert alert-danger" role="alert"  id="error_message"
                             style="display: <?=$display_error?>; width: 600px; margin-left: 12px; margin-top: 20px; margin-bottom: -10px;">
                            <?=$error_message?>
                        </div>
                        <div class="alert alert-success" role="alert" id="success_message"
                             style="display: <?=$display_success?>; width: 600px; margin-left: 12px; margin-top: 20px; margin-bottom: -10px;">
                            <?=$succes_message?>
                        </div>

                        <div class="col-sm-12">
                            <button class="w-100 btn mt-5 black_btn mb-5" type="submit">Register</button>
                        </div>

                    </div>

                </form>

                <div class="d-flex flex-row justify-content-between mt-5">
                    <div><a href="#" class="links">Forgot Password</a></div>
                </div>
            </main>
        </div>
    </div>
    <?=getFooter();?>
</body>
<?=getBottomScripts();?>

</html>