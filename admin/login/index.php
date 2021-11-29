<?php session_start();?>
<?php
		
	require_once('../../includes/db.php');
	require_once('../../includes/config.php');
	require_once('../includes/generators.php');
	
	
	ConnectToDatabase();
	
	$table 	 = 'admins';
	$user_id = 'admin_id';
	
	$loged_in = isLogedIn($table, $user_id);
	
	$display = "none";
	$login_id = "";
	$email = "";
	$captcha = false;
	# the response from reCAPTCHA
	$resp = null;
	# the error code from reCAPTCHA, if any
	$error = null;
	

	if($loged_in){
		?>
			<script type="text/javascript">
				window.location.replace("../");
			</script>				
		<?php
	}else{
		
		$continue = true;
		
		if(isset($_POST["email"]) && isset($_POST["password"]) && $_POST["email"] != "" && $_POST["password"] != "" && $continue){
			
			$email = check_input($_POST['email']);
			$pass  = check_input($_POST['password']);
						
			$login_id = CheckHashedPassword($pass, $email, $table);
						
			if(is_numeric($login_id)){
				
				$query = "SELECT username FROM admins WHERE id = " . $login_id;
				
				$rows = QuerySelect($query);		

				$logged = false;
				
				if(count($rows) > 0)
					$logged = true;
				
				if($logged){
					$_SESSION['admin_id'] = $login_id;
					$_SESSION['failed_attempts'] = 0;
					$_SESSION['failed_attempt_time'] = 0;
										
					?>
						<script type="text/javascript">
							window.location.replace("../");
						</script>				
					<?php
				}
					
			}else
				$display = "block";
			
			
	
		}else if(isset($_POST['email']) && $_POST["email"] != ""){
			$email = $_POST["email"];
			Check_Failed_attepmts();
			$login_id = "Enter password";
		}else if(isset($_POST['password']) && $_POST["password"] != ""){
			Check_Failed_attepmts();
			$login_id = "Enter email";
		}else{
			
			$display = "none";
			if(isset($_POST["email"]) && isset($_POST["password"]) && $_POST["email"] == "" && $_POST["password"] == ""){
				Check_Failed_attepmts();
				$login_id = "Enter email and password";
			}
		}
	}
	

?>



<html lang="en">
<?=GetHeader("Admin - Log In");?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center mt-5">


                <div class="col-xl-6 col-lg-12 col-md-9 mt-5">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Admin oakland assistance chapter</h1>
                                        </div>
                                        <form class="user" method="POST" action="./">
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user"
                                                    id="email" name="email"  aria-describedby="emailHelp"
                                                    placeholder="Enter Email Address...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    id="password" name="password" placeholder="Password">
                                            </div>


									          <div class="h5 text-gray-900 mb-4" style="display:<?php echo $display;?>"> <?php echo $login_id;?> </div>
									          
													
												<?php
									             if($captcha && false)
									                echo recaptcha_get_html($publickey, $error);
									            ?>
          									
          									<input type="submit" class="btn btn-primary btn-user btn-block" value="LOGIN"> 

                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <?=GetFooterScripts(".", "../")?>


</body>

</html>