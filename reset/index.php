<?php session_start();


require_once('../includes/config.php');
require_once('../includes/db.php');
require_once('../includes/generators.php');
    
    
ConnectToDatabase();

//$loged_in = isLogedIn();

    $error_display       = "none";
    $error_message   = "";
    $success_message  = "";
    $success_display = "none";
    $display_form    = "block";
    $token = '';

    
    if(isset($_GET['token'])){
        
        $token = check_input($_GET['token']);

        $query = "SELECT TIMESTAMPDIFF(SECOND, time_generated, NOW()) as time_difference, user_id 
                  FROM recover_pass 
                  WHERE unique_id = '$token'";

        $rows = QuerySelect($query);
            
        if(count($rows)==1){
            $time_difference = $rows[0]["time_difference"];
            $user_id         = $rows[0]["user_id"];
            
            if((int)$time_difference > 0 && (int)$time_difference < 30*60){
                if(isset($_POST['password']) && isset($_POST['confirm_password'])){ 
                    
                    $pass        = check_input($_POST['password']);
                    $confirmPass = check_input($_POST['confirm_password']);
                    
                    if($pass == $confirmPass){
                        
                        if($pass == ""){
                            $error_display  = "block";                      
                            $error_message  = "You must enter a password!";
                        }else{
                        
                            $HashedPass = GenerateHashedString($pass, '1756');
                            
                            $query = "UPDATE users 
                                        SET `password` = '$HashedPass',
                                            updated_at = NOW()
                                      WHERE id = " . $user_id;
                            
                            $rows = QueryInsert($query);
                            
                            if($rows){                          
                                $success_message = "You have successfully updated your password.";
                                $success_display = "block"; 
                                $error_display   = "none";
                                $display_form    = "none";
                                
                                $query = "DELETE FROM recover_pass WHERE unique_id = '$token'";
                                
                                QueryInsert($query);
                                                                                                                            
                            }else{
                                $error_display = "block";                               
                                $error_message = "We have encountered an error. <br />Our team will see what is the problem.";
                            }
                        }
                    }else{
                        $error_display = "block";
                        $error_message = "The passwords didn't match.";
                    }
                }
            }else{
                $error_display = "block";
                $display_form  = "none";
                $error_message = "Expired link";
            }
        }else{
            $success_message = "If you already changed your password, and want to change it again make another request.";
            $success_display = "block";     
            $error_display   = "none";
            $display_form    = "none";
        }
    }else{
        
        ?>
            <script type="text/javascript">
                window.location.replace("../");
            </script>               
        <?php
        exit();
    }

    

?>


<!DOCTYPE html>
<html lang="en">
<?=getHeader("Reset Password");?>

<body>
    <?=GetHead();?>
    <?=getNavbar();?>
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <main class="form-signin mt-5">
                    
                    <form action="./?token=<?=$token?>" method="post" onsubmit="return ResetPasswordCheck();">

                        <h1 class="h3 mb-3 text-center">Change your password! </h1>
                        <div class="form-group">
                            <label for="password">New password</label>
                            <input type="password" id="password" name="password" class="form-control" autofocus>
                        </div>
                        <div class="form-group mt-3">
                            <label for="confirm_password">Retype new password</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" autofocus>
                        </div>


                        <div class="alert alert-danger mt-4" role="alert" style="display: <?= $error_display?>; margin-bottom: 0px;" id="error_message">
                            <?=$error_message?>
                        </div>
                        <div class="alert alert-success mt-4" role="alert" style="display: <?= $success_display?>; margin-bottom: 0px;" id="success_message" >
                            <?=$success_message?>
                        </div>

                        <button class="w-100 btn mt-5 black_btn" type="submit">Save</button>
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