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
$error_message = "Wrong login details";

if ($loged_in) {
    ?>
        <script type="text/javascript">
            window.location.replace("../profile");
        </script>
    <?php
    exit();
}


if (isset($_POST["email"]) && isset($_POST["password"]) && $_POST["email"] != "" && $_POST["password"] != "") {

    $email = check_input($_POST['email']);
    $pass = check_input($_POST['password']);

    $login_id = CheckHashedPassword($pass, $email);

    if(is_numeric($login_id)) {

        $status = GetStatusFromUser($login_id);
        if ($status == "not confirmed") {
            $display_error = "block";
            $error_message = "Your email is not confirmed<br />Check your email";
        }else {

            $_SESSION['user_id'] = $login_id;

            if (isset($_POST['remember_me'])) {
                $expire_time = time() + 60 * 60 * 24 * 30;
                $user_unique_id = GetUniqueID_FromID($login_id, 'users');
                setcookie("uud", $user_unique_id, $expire_time, "/", ".mkoglasnik.mk");
            }

            ?>
                <script type="text/javascript">
                    window.location.replace("../profile");
                </script>
            <?php
            exit();
        }
    } else {
        $display_error = "block";
        $error_message = $login_id;
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<?=getHeader("Login");?>

<body>
    <?=GetHead();?>
    <?=getNavbar();?>
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <main class="form-signin mt-5">
                    <form action="./" method="post" onsubmit="return LoginCheck();">
                        <h1 class="h3 mb-3 text-center">Login</h1>
                        <div class="form-group">
                            <label for="inputEmail">Email address</label>
                            <input type="email" id="email" name="email" class="form-control" autofocus>
                        </div>
                        <div class="form-group mt-3">
                            <label for="inputPassword">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>

                        <div class="alert alert-danger" role="alert" style="display:<?=$display_error?>; margin-top:20px; margin-bottom:-10px;" id="error_message">
                            <?=$error_message?>
                        </div>

                        <button class="w-100 btn mt-5 black_btn" type="submit">Login</button>
                    </form>

                    <div class="d-flex flex-row justify-content-between mt-5">
                        <div><a href="../forgot-password" class="links">Forgot Password</a></div>
                        <div><a href="../register"        class="links">Create Account</a></div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <?=getFooter();?>
</body>
<?=getBottomScripts();?>

</html>